<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CoachingType;
use App\Models\Faq;
use App\Models\Profile;
use App\Models\Review;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function home()
    {
        // Load profile data
        $profile = Profile::active();

        // Load 3 featured reviews
        $reviews = Review::where('is_active', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        // Load 5 active FAQs
        $faqs = Faq::where('is_active', true)
            ->orderBy('sort_order')
            ->take(5)
            ->get();

        // Load coaching types ordered by sort_order
        $coachingTypes = CoachingType::ordered()
            ->take(6) // Limiting to 6 for nice grid layout
            ->get();

        return view('web.home', compact('profile', 'reviews', 'faqs', 'coachingTypes'));
    }
    public function about()
    {
        $profile = Profile::first();
        return view('web.about', compact('profile'));
    }

    public function faq()
    {
        $faqs = Faq::where('is_active', true)
            ->orderBy('category')
            ->orderBy('sort_order')
            ->get();

        return view('web.faq', compact('faqs'));
    }

    public function terms()
    {
        return view('web.legal.terms');
    }

    public function privacy()
    {
        return view('web.legal.privacy');
    }

    public function cookies()
    {
        return view('web.legal.cookies');
    }

    public function disclaimer()
    {
        return view('web.legal.disclaimer');
    }
}
