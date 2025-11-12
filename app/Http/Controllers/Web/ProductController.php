<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::active()->published()->paginate(12);

        return view('web.product.index', compact('products'));
    }
    public function show(Product $product)
    {
        // Increment view count (add this method to your Product model)
        $product->incrementViewCount();

        // Get reviews and FAQs with proper filtering
        $reviews = $product->reviews()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $faqs = $product->faqs()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('web.product.show', compact('product', 'reviews', 'faqs'));
    }
}
