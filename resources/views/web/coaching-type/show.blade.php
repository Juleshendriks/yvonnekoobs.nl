@extends('web.layouts.web')

@section('content')
    <div class="bg-white">
        <!-- Hero Section -->
        <div class="relative">
            @if($coachingType->banner_image)
                <div class="aspect-[3/1] w-full overflow-hidden bg-gray-100">
                    <img src="{{ Storage::url($coachingType->banner_image) }}"
                         alt="{{ $coachingType->title }}"
                         class="h-full w-full object-center object-cover">
                </div>
                <div class="absolute inset-0 bg-black/40"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="text-center text-white">
                        <h1 class="text-4xl font-bold tracking-tight sm:text-6xl">
                            {{ $coachingType->title }}
                        </h1>
                        @if($coachingType->subtitle)
                            <p class="mt-4 text-xl">{{ $coachingType->subtitle }}</p>
                        @endif
                    </div>
                </div>
            @else
                <div class="bg-gradient-to-br from-blue-50 via-white to-blue-50 py-16 sm:py-24">
                    <div class="mx-auto max-w-4xl px-6 lg:px-8 text-center">
                        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                            {{ $coachingType->title }}
                        </h1>
                        @if($coachingType->subtitle)
                            <p class="mt-6 text-xl text-gray-600">{{ $coachingType->subtitle }}</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Breadcrumb -->
        <div class="mx-auto max-w-4xl px-6 lg:px-8 py-4">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li>
                        <div>
                            <a href="{{ route('web.home') }}" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 011.414 0l7 7A1 1 0 0117 11h-1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3a1 1 0 00-1-1H9a1 1 0 00-1 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-6H3a1 1 0 01-.707-1.707l7-7z" clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">Home</span>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                            </svg>
                            <a href="{{ route('web.coaching-types.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                                Coaching Aanbod
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="h-5 w-5 flex-shrink-0 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                            </svg>
                            <span class="ml-4 text-sm font-medium text-gray-500">{{ $coachingType->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="mx-auto max-w-4xl px-6 lg:px-8 py-16">
            <!-- Summary -->
            @if($coachingType->summary)
                <div class="prose prose-lg prose-blue max-w-none mb-16">
                    {!! $coachingType->summary !!}
                </div>
            @endif

            <!-- Content Sections -->
            <div class="space-y-16">
                <!-- Challenges -->
                @if($coachingType->challenges)
                    <section>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">
                            Uitdagingen die we aanpakken
                        </h2>
                        <div class="prose prose-lg max-w-none">
                            {!! $coachingType->challenges !!}
                        </div>
                    </section>
                @endif

                <!-- Approach -->
                @if($coachingType->approach)
                    <section class="bg-blue-50 -mx-6 px-6 py-12 lg:-mx-8 lg:px-8 rounded-2xl">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">
                            Mijn aanpak
                        </h2>
                        <div class="prose prose-lg max-w-none">
                            {!! $coachingType->approach !!}
                        </div>
                    </section>
                @endif

                <!-- Target Audience -->
                @if($coachingType->target_audience)
                    <section>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">
                            Voor wie is deze coaching?
                        </h2>
                        <div class="prose prose-lg max-w-none">
                            {!! $coachingType->target_audience !!}
                        </div>
                    </section>
                @endif

                <!-- Benefits -->
                @if($coachingType->benefits)
                    <section>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">
                            Wat kun je verwachten?
                        </h2>
                        <div class="prose prose-lg max-w-none">
                            {!! $coachingType->benefits !!}
                        </div>
                    </section>
                @endif
            </div>

            <!-- Call to Action -->
            @if($coachingType->call_to_action)
                <div class="mt-16 rounded-2xl bg-gradient-to-r from-[#92c24f] to-[#0c6885] p-8 text-center text-white">
                    <div class="prose prose-lg prose-invert max-w-none mb-6">
                        {!! $coachingType->call_to_action !!}
                    </div>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('web.contact.create') }}"
                           class="inline-flex items-center justify-center rounded-xl bg-white px-8 py-4 text-sm font-semibold text-[#0c6885] shadow-lg hover:bg-gray-50 transition-colors duration-300">
                            <i class="fas fa-calendar-check mr-3"></i>
                            Start vandaag nog
                        </a>
                        <a href="tel:+31642305664"
                           class="inline-flex items-center justify-center rounded-xl border-2 border-white px-8 py-4 text-sm font-semibold text-white hover:bg-white hover:text-[#0c6885] transition-colors duration-300">
                            <i class="fas fa-phone mr-3"></i>
                            Bel voor info
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

        <!-- Reviews Section -->
        @if($reviews && $reviews->count() > 0)
            <section class="bg-gray-50 py-16">
                <div class="mx-auto max-w-7xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                            Wat mijn klanten zeggen
                        </h2>
                        <p class="mt-4 text-lg leading-8 text-gray-600">
                            Lees wat mijn klanten over hun coaching ervaring zeggen
                        </p>
                    </div>

                    <div class="mx-auto mt-16 flow-root max-w-2xl sm:mt-20 lg:mx-0 lg:max-w-none">
                        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach($reviews as $review)
                                <div class="flex flex-col justify-between rounded-2xl bg-white p-8 shadow-lg ring-1 ring-gray-900/5">
                                    <!-- Star Rating -->
                                    <div class="flex gap-x-1 text-yellow-500">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <svg class="h-5 w-5 fill-current" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @else
                                                <svg class="h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>

                                    <!-- Review Content -->
                                    <blockquote class="mt-6 text-gray-900">
                                        <p class="leading-7">{{ $review->review }}</p>
                                    </blockquote>

                                    <!-- Reviewer Info -->
                                    <div class="mt-8 flex items-center gap-x-4">
                                        @if($review->avatar)
                                            <img class="h-12 w-12 rounded-full bg-gray-50 object-cover"
                                                 src="{{ Storage::url($review->avatar) }}"
                                                 alt="{{ $review->name }}">
                                        @else
                                            <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-sm font-medium text-blue-600">
                                        {{ strtoupper(substr($review->name, 0, 2)) }}
                                    </span>
                                            </div>
                                        @endif

                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $review->name }}</div>
                                            @if($review->company)
                                                <div class="text-sm text-gray-600">{{ $review->company }}</div>
                                            @endif
                                            @if($review->position)
                                                <div class="text-sm text-gray-500">{{ $review->position }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Call to Action -->
                    <div class="mt-16 text-center">
                        <p class="text-lg text-gray-600 mb-6">
                            Klaar om jouw eigen succesverhaal te schrijven?
                        </p>
                        <a href="{{ route('web.contact.create') }}"
                           class="inline-flex items-center justify-center rounded-md bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors duration-200">
                            Plan een kennismakingsgesprek
                        </a>
                    </div>
                </div>
            </section>
        @endif

        <!-- FAQs Section -->
        @if($faqs && $faqs->count() > 0)
            <section class="bg-white py-16">
                <div class="mx-auto max-w-4xl px-6 lg:px-8">
                    <div class="mx-auto max-w-2xl text-center">
                        <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                            Veelgestelde vragen
                        </h2>
                        <p class="mt-4 text-lg leading-8 text-gray-600">
                            Antwoorden op de meest gestelde vragen over deze coaching
                        </p>
                    </div>

                    <div class="mt-16">
                        <dl class="space-y-8">
                            @foreach($faqs as $index => $faq)
                                <div class="border-b border-gray-200 pb-8"
                                     x-data="{ open: {{ $index === 0 ? 'true' : 'false' }} }">
                                    <dt>
                                        <button type="button"
                                                class="flex w-full items-start justify-between text-left text-gray-900"
                                                @click="open = !open"
                                                :aria-expanded="open">
                                            <span class="text-lg font-semibold leading-7">{{ $faq->question }}</span>
                                            <span class="ml-6 flex h-7 items-center">
                                    <svg class="h-6 w-6 transform transition-transform duration-200"
                                         :class="open ? 'rotate-45' : 'rotate-0'"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                    </svg>
                                </span>
                                        </button>
                                    </dt>
                                    <dd class="mt-2 pr-12" x-show="open" x-transition>
                                        <div class="text-base leading-7 text-gray-600 prose prose-blue max-w-none">
                                            {!! $faq->answer !!}
                                        </div>
                                    </dd>
                                </div>
                            @endforeach
                        </dl>
                    </div>

                    <!-- Contact CTA -->
                    <div class="mt-16 rounded-2xl bg-blue-50 p-8 text-center">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">
                            Heb je nog andere vragen?
                        </h3>
                        <p class="text-gray-600 mb-6">
                            Ik beantwoord graag al je vragen in een persoonlijk gesprek.
                        </p>
                        <a href="{{ route('web.contact.create') }}"
                           class="inline-flex items-center justify-center rounded-md bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors duration-200">
                            Stel je vraag
                        </a>
                    </div>
                </div>
            </section>
        @endif

    <!-- Related Coaching Types -->
    @php
        $relatedCoachingTypes = \App\Models\CoachingType::active()
            ->published()
            ->where('id', '!=', $coachingType->id)
            ->ordered()
            ->limit(3)
            ->get();
    @endphp

    @if($relatedCoachingTypes->count() > 0)
        <section class="bg-gray-50 py-16">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center mb-12">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900">
                        Andere coaching mogelijkheden
                    </h2>
                    <p class="mt-4 text-lg text-gray-600">
                        Ontdek ook deze andere vormen van coaching
                    </p>
                </div>

                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    @foreach($relatedCoachingTypes as $related)
                        <article class="group relative flex flex-col overflow-hidden rounded-2xl bg-white shadow-lg ring-1 ring-gray-200 transition-all duration-300 hover:shadow-xl hover:ring-blue-200">
                            @if($related->banner_image)
                                <div class="aspect-[16/9] w-full overflow-hidden bg-gray-100">
                                    <img src="{{ Storage::url($related->banner_image) }}"
                                         alt="{{ $related->title }}"
                                         class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105">
                                </div>
                            @else
                                <div class="aspect-[16/9] w-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                                    <svg class="h-12 w-12 text-blue-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443a55.381 55.381 0 015.25 2.882V15m-9 6.75h8.25v-1.917c0-.969-.421-1.878-1.146-2.445A55.186 55.186 0 0012 19.5a55.18 55.18 0 00-3.354 1.888c-.725.567-1.146 1.476-1.146 2.445v1.917z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="flex flex-1 flex-col p-6">
                                <div class="flex-1">
                                    <h3 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition-colors">
                                        {{ $related->title }}
                                    </h3>

                                    @if($related->subtitle)
                                        <p class="mt-2 text-sm font-medium text-blue-600">
                                            {{ $related->subtitle }}
                                        </p>
                                    @endif

                                    @if($related->summary)
                                        <div class="mt-3 text-sm text-gray-600 line-clamp-2">
                                            {!! Str::limit(strip_tags($related->summary), 100) !!}
                                        </div>
                                    @endif
                                </div>

                                <div class="mt-4">
                                    <a href="{{ route('web.coaching-types.show', $related->slug) }}"
                                       class="inline-flex items-center text-sm font-semibold text-blue-600 hover:text-blue-500">
                                        Lees meer
                                        <svg class="ml-2 h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('web.coaching-types.index') }}"
                       class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-6 py-3 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600 transition-colors duration-200">
                        Bekijk alle coaching mogelijkheden
                    </a>
                </div>
            </div>
        </section>
    @endif

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
