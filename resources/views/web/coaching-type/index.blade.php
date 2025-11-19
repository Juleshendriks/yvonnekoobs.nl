@extends('web.layouts.web')

@section('content')
    <div class="bg-white">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-green-50 via-white to-cyan-50 pt-16 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Coaching Aanbod
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Ontdek welke vorm van coaching het beste bij jou past. Van persoonlijke ontwikkeling tot professionele groei - ik help je verder.
                    </p>
                </div>
            </div>
        </section>

        <!-- Breadcrumb -->
        <div class="mx-auto max-w-7xl px-6 lg:px-8 py-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li>
                        <div>
                            <a href="{{ route('web.home') }}" class="text-gray-400 hover:text-[#0c6885] transition-colors">
                                <i class="fas fa-home" aria-hidden="true"></i>
                                <span class="sr-only">Home</span>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-300 text-sm" aria-hidden="true"></i>
                            <span class="ml-4 text-sm font-medium text-gray-500">Coaching</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Coaching Types Grid -->
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if($coachingTypes && $coachingTypes->count() > 0)
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($coachingTypes as $coachingType)
                            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100 group overflow-hidden">
                                <!-- Large Image -->
                                @if($coachingType->banner_image)
                                    <div class="aspect-[4/3] w-full overflow-hidden">
                                        <img src="{{ asset('storage/' . $coachingType->banner_image) }}" alt="{{ $coachingType->title }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                    </div>
                                @else
                                    <div class="aspect-[4/3] w-full bg-gradient-to-r from-[#92c24f] to-[#0c6885] flex items-center justify-center">
                                        <i class="fas fa-heart text-white text-4xl"></i>
                                    </div>
                                @endif

                                <!-- Content -->
                                <div class="p-8">
                                    <!-- Title -->
                                    <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-[#0c6885] transition-colors">
                                        {{ $coachingType->title }}
                                    </h3>

                                    <!-- Subtitle -->
                                    @if($coachingType->subtitle)
                                        <p class="text-[#92c24f] mb-4 font-semibold">{{ $coachingType->subtitle }}</p>
                                    @endif

                                    <!-- Summary -->
                                    @if($coachingType->summary)
                                        <p class="text-gray-600 mb-6 leading-relaxed">{!!  Str::limit($coachingType->summary, 120) !!}</p>
                                    @endif

                                    <!-- Footer -->
                                    <div class="flex items-center justify-between">
                                        <a href="{{ route('web.coaching-types.show', $coachingType->slug) }}" class="inline-flex items-center text-[#0c6885] hover:text-[#0a5a73] font-semibold transition-colors duration-300 group">
                                            Meer informatie
                                            <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                                        </a>

                                        @if($coachingType->reviews && $coachingType->reviews->count() > 0)
                                            <div class="flex items-center text-sm text-gray-500">
                                                <i class="fas fa-star text-[#92c24f] mr-1"></i>
                                                <span>{{ $coachingType->reviews->count() }} reviews</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-20">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-heart text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Coaching aanbod komt binnenkort</h3>
                        <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                            We werken hard aan het ontwikkelen van verschillende coaching programma's. Neem alvast contact op voor een vrijblijvend gesprek.
                        </p>
                        <a href="{{ route('web.contact.create') }}" class="inline-flex items-center px-8 py-4 bg-[#0c6885] hover:bg-[#0a5a73] text-white font-semibold rounded-xl transition-colors duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-calendar-check mr-3"></i>
                            Plan een gesprek
                        </a>
                    </div>
                @endif
            </div>
        </section>
        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-r from-[#92c24f] to-[#0c6885]">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-bold text-white mb-6">
                    Weet je niet welke coaching bij je past?
                </h2>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">
                    Geen probleem! In een vrijblijvend kennismakingsgesprek bespreken we jouw situatie en doelen.
                    Samen bepalen we welke aanpak het beste werkt voor jou.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('web.contact.create') }}" class="inline-flex items-center px-8 py-4 bg-white hover:bg-gray-100 text-[#0c6885] font-semibold rounded-xl transition-colors duration-300 shadow-lg">
                        <i class="fas fa-calendar-check mr-3"></i>
                        Plan een kennismakingsgesprek
                    </a>
                    <a href="tel:+31612345678" class="inline-flex items-center px-8 py-4 bg-transparent hover:bg-white/10 text-white font-semibold rounded-xl border-2 border-white transition-colors duration-300">
                        <i class="fas fa-phone mr-3"></i>
                        Bel direct: 06 - 12 34 56 78
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
