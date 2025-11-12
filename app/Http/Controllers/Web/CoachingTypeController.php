<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CoachingType;
use Illuminate\Http\Request;

class CoachingTypeController extends Controller
{
    public function index()
    {
        $coachingTypes = CoachingType::active()
            ->published()
            ->ordered()
            ->get();

        return view('web.coaching-type.index', compact('coachingTypes'));
    }

    public function show(CoachingType $coachingType)
    {
        // Increment view count
        $coachingType->incrementViewCount();

        // Get reviews en FAQs
        $reviews = $coachingType->reviews()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $faqs = $coachingType->faqs()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('web.coaching-type.show', compact('coachingType', 'reviews', 'faqs'));
    }
}
