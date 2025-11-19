<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Web\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CoachingTypeController as WebCoachingTypeController;
use App\Http\Controllers\Web\ProductController as WebProductController;
use App\Http\Controllers\Web\PagesController as WebPagesController;
use App\Http\Controllers\Web\ContactController as WebContactController;

Route::name('web.')->group(function () {

    Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
    Route::get('/newsletter/unsubscribe', [NewsletterController::class, 'unsubscribe'])->name('newsletter.unsubscribe');

    Route::get('/', [WebPagesController::class, 'home'])->name('home');
    Route::get('/over-mij', [WebPagesController::class, 'about'])->name('about');
    // Coaching Types
    Route::get('/coaching-aanbod', [WebCoachingTypeController::class, 'index'])->name('coaching-types.index');
    Route::get('/coaching-aanbod/{coachingType}', [WebCoachingTypeController::class, 'show'])->name('coaching-types.show');

    // Products - andere URL's
    Route::get('/aanbod', [WebProductController::class, 'index'])->name('products.index');
    Route::get('/aanbod/{product}', [WebProductController::class, 'show'])->name('products.show');

    Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
    Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('posts.show');

    Route::get('/contact', [WebContactController::class, 'create'])->name('contact.create');
    Route::get('/veelgestelde-vragen', [WebPagesController::class, 'faq'])->name('faq');
    Route::get('/bedankt-voor-je-bericht', [WebContactController::class, 'confirm'])->name('contact.confirm');

    Route::post('/contact', [WebContactController::class, 'store'])
        ->middleware('throttle:3,1') // 3 requests per 1 minuut
        ->name('contact.store');

    Route::get('/algemene-voorwaarden', [WebPagesController::class, 'terms'])->name('terms');
    Route::get('/privacybeleid', [WebPagesController::class, 'privacy'])->name('privacy');
    Route::get('/cookiebeleid', [WebPagesController::class, 'cookies'])->name('cookies');
    Route::get('/disclaimer', [WebPagesController::class, 'disclaimer'])->name('disclaimer');
});


//Route::get('dashboard', function () {
//    return Inertia::render('Dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

//require __DIR__ . '/settings.php';
//require __DIR__ . '/auth.php';
