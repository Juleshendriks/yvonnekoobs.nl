<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Mollie\Laravel\Facades\Mollie;

class MollieController extends Controller
{
    /**
     * Start checkout process voor een product
     */
    public function checkout(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Check of product gratis is
        if ($product->is_free || $product->price == 0) {
            return $this->handleFreeProduct($request, $product);
        }

        // Maak of vind user
        $user = $this->findOrCreateUser($request);

        // Login user
        Auth::login($user);

        // Maak order aan
        $order = Order::createForUser($user, [
            ['product_id' => $product->id, 'quantity' => 1]
        ]);

        // Start Mollie payment
        return $this->createMolliePayment($order);
    }

    /**
     * Bulk checkout voor meerdere producten
     */
    public function bulkCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'integer|min:1|max:10',
        ]);

        // Maak of vind user
        $user = $this->findOrCreateUser($request);
        Auth::login($user);

        // Prepareer product data
        $productData = collect($request->products)->map(function ($item) {
            return [
                'product_id' => $item['id'],
                'quantity' => $item['quantity'] ?? 1,
            ];
        })->toArray();

        // Check of alle producten gratis zijn
        $products = Product::whereIn('id', collect($productData)->pluck('product_id'))->get();
        $totalPrice = $products->sum('price');

        if ($totalPrice == 0) {
            return $this->handleFreeProducts($user, $products);
        }

        // Maak order aan
        $order = Order::createForUser($user, $productData);

        // Start Mollie payment
        return $this->createMolliePayment($order);
    }

    /**
     * Maak Mollie payment aan
     */
    protected function createMolliePayment(Order $order)
    {
        try {
            $payment = Mollie::api()->payments->create([
                'amount' => [
                    'currency' => $order->currency,
                    'value' => number_format($order->total, 2, '.', ''),
                ],
                'description' => "Bestelling {$order->order_number}",
                'redirectUrl' => route('mollie.return', ['order' => $order->id]),
                'webhookUrl' => route('mollie.webhook'),
                'metadata' => [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'customer_email' => $order->customer_email,
                ],
                'method' => null, // Laat klant kiezen
            ]);

            // Sla payment op in database
            Payment::createForOrder($order, $payment->id, $payment->getCheckoutUrl());

            // Redirect naar Mollie
            return redirect($payment->getCheckoutUrl());

        } catch (\Exception $e) {
            Log::error('Mollie payment creation failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Er ging iets mis bij het starten van de betaling. Probeer het opnieuw.');
        }
    }

    /**
     * Handle return from Mollie
     */
    public function return(Request $request, Order $order)
    {
        $payment = $order->payments()->latest()->first();

        if (!$payment) {
            return redirect()->route('home')->with('error', 'Betaling niet gevonden.');
        }

        try {
            // Haal payment status op van Mollie
            $molliePayment = Mollie::api()->payments->get($payment->mollie_payment_id);

            // Update payment in database
            $payment->updateFromMollie($molliePayment);

            return match($molliePayment->status) {
                'paid' => redirect()->route('dashboard.downloads')->with('success', 'Betaling succesvol! Je kunt nu je producten downloaden.'),
                'pending', 'open' => redirect()->route('dashboard.downloads')->with('info', 'Je betaling wordt nog verwerkt. Je ontvangt een email zodra deze is voltooid.'),
                'failed' => redirect()->route('products.show', $order->items->first()->product->slug)->with('error', 'De betaling is mislukt. Probeer het opnieuw.'),
                'cancelled' => redirect()->route('products.show', $order->items->first()->product->slug)->with('info', 'Je hebt de betaling geannuleerd.'),
                'expired' => redirect()->route('products.show', $order->items->first()->product->slug)->with('error', 'De betaling is verlopen. Start een nieuwe bestelling.'),
                default => redirect()->route('home')->with('error', 'Onbekende betalingsstatus.'),
            };

        } catch (\Exception $e) {
            Log::error('Error processing Mollie return', [
                'order_id' => $order->id,
                'payment_id' => $payment->mollie_payment_id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('home')->with('error', 'Er ging iets mis bij het verwerken van je betaling.');
        }
    }

    /**
     * Mollie webhook
     */
    public function webhook(Request $request)
    {
        $paymentId = $request->input('id');

        if (!$paymentId) {
            Log::warning('Mollie webhook called without payment ID');
            return response('Missing payment ID', 400);
        }

        try {
            // Haal payment op van Mollie
            $molliePayment = Mollie::api()->payments->get($paymentId);

            // Vind payment in database
            $payment = Payment::findByMollieId($paymentId);

            if (!$payment) {
                Log::warning('Payment not found in database', ['mollie_payment_id' => $paymentId]);
                return response('Payment not found', 404);
            }

            // Update payment status
            $payment->updateFromMollie($molliePayment);

            // Send email notifications
            if ($molliePayment->status === 'paid') {
                $this->sendPaymentConfirmationEmail($payment->order);
            }

            Log::info('Mollie webhook processed successfully', [
                'mollie_payment_id' => $paymentId,
                'status' => $molliePayment->status,
                'order_id' => $payment->order_id,
            ]);

            return response('OK', 200);

        } catch (\Exception $e) {
            Log::error('Error processing Mollie webhook', [
                'payment_id' => $paymentId,
                'error' => $e->getMessage(),
            ]);

            return response('Error processing webhook', 500);
        }
    }

    /**
     * Handle gratis product
     */
    protected function handleFreeProduct(Request $request, Product $product)
    {
        // Maak of vind user
        $user = $this->findOrCreateUser($request);
        Auth::login($user);

        // Maak gratis order
        $order = Order::createFreeOrder($user, $product);

        // Stuur bevestigingsmail
        $this->sendFreeProductEmail($order);

        return redirect()->route('dashboard.downloads')->with('success', 'Gefeliciteerd! Je gratis product is toegevoegd aan je account.');
    }

    /**
     * Handle meerdere gratis producten
     */
    protected function handleFreeProducts($user, $products)
    {
        foreach ($products as $product) {
            // Check of user product al heeft
            if (!$product->isPurchasedBy($user)) {
                Order::createFreeOrder($user, $product);
            }
        }

        return redirect()->route('dashboard.downloads')->with('success', 'Alle gratis producten zijn toegevoegd aan je account!');
    }

    /**
     * Vind of maak user account
     */
    protected function findOrCreateUser(Request $request)
    {
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            $user = \App\Models\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => \Hash::make(\Str::random(12)), // Random password
                'email_verified_at' => now(), // Auto-verify for purchases
            ]);
        }

        return $user;
    }

    /**
     * Stuur betaling bevestigingsmail
     */
    protected function sendPaymentConfirmationEmail(Order $order)
    {
        // TODO: Implement email notification
        // Mail::to($order->customer_email)->send(new PaymentConfirmedMail($order));

        Log::info('Payment confirmation email would be sent', [
            'order_id' => $order->id,
            'email' => $order->customer_email,
        ]);
    }

    /**
     * Stuur gratis product mail
     */
    protected function sendFreeProductEmail(Order $order)
    {
        // TODO: Implement email notification
        // Mail::to($order->customer_email)->send(new FreeProductMail($order));

        Log::info('Free product email would be sent', [
            'order_id' => $order->id,
            'email' => $order->customer_email,
        ]);
    }

    /**
     * Test Mollie connection
     */
    public function test()
    {
        try {
            $methods = Mollie::api()->methods->allActive();

            return response()->json([
                'status' => 'success',
                'message' => 'Mollie connection successful',
                'available_methods' => $methods->count(),
                'methods' => collect($methods)->pluck('description', 'id'),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Mollie connection failed: ' . $e->getMessage(),
            ], 500);
        }
    }
}
