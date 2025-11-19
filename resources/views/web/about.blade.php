@extends('web.layouts.web')

@section('content')
    <div class="bg-white">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-green-50 via-white to-cyan-50 pt-16 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Over {{ $profile->naam ?? 'Mij' }}
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Ontdek mijn verhaal en hoe ik jou kan helpen groeien naar je volledige potentieel
                    </p>
                </div>
            </div>
        </section>

        <!-- Breadcrumb -->
        <div class="mx-auto max-w-4xl px-6 lg:px-8 py-6">
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
                            <span class="ml-4 text-sm font-medium text-gray-500">Over {{ $profile->naam ?? 'mij' }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Introduction Section -->
        @if($profile && ($profile->introduction_title || $profile->introduction_description))
            <section class="py-20 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <!-- Photo -->
                        <div class="relative">
                            @if($profile->photo)
                                <div class="absolute inset-0 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-3xl transform rotate-3"></div>
                                <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->naam }}"
                                     class="relative w-full max-w-md mx-auto rounded-3xl shadow-2xl object-cover aspect-square">
                            @else
                                <div class="absolute inset-0 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-3xl transform rotate-3"></div>
                                <div class="relative w-full max-w-md mx-auto aspect-square rounded-3xl shadow-2xl bg-gray-100 flex items-center justify-center">
                                    <div class="text-center">
                                        <i class="fas fa-user text-8xl text-gray-400 mb-4"></i>
                                        <p class="text-gray-600 font-medium">{{ $profile->naam ?? 'Coach' }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div>
                            @if($profile->introduction_title)
                                <h2 class="text-4xl font-bold text-gray-900 mb-6 leading-tight">
                                    {{ $profile->introduction_title }}
                                </h2>
                            @endif
                            @if($profile->introduction_description)
                                <div class="text-lg text-gray-600 mb-8 leading-relaxed">
                                    {!! nl2br(e($profile->introduction_description)) !!}
                                </div>
                            @endif

                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('web.contact.create') }}" class="inline-flex items-center px-8 py-4 bg-[#0c6885] hover:bg-[#0a5a73] text-white font-semibold rounded-xl transition-colors duration-300 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-calendar-check mr-3"></i>
                                    Plan een gesprek
                                </a>
                                <a href="{{ route('web.coaching-types.index') }}" class="inline-flex items-center px-8 py-4 bg-white hover:bg-gray-50 text-[#0c6885] font-semibold rounded-xl border-2 border-[#0c6885] transition-colors duration-300">
                                    <i class="fas fa-search mr-3"></i>
                                    Bekijk coaching
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- Why Section -->
        @if($profile && ($profile->why_title || $profile->why_description))
            <section class="py-20 bg-gray-50">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center">
                        @if($profile->why_title)
                            <h2 class="text-4xl font-bold text-gray-900 mb-6">
                                {{ $profile->why_title }}
                            </h2>
                        @endif
                        @if($profile->why_description)
                            <div class="text-lg text-gray-600 leading-relaxed max-w-3xl mx-auto">
                                {!! nl2br(e($profile->why_description)) !!}
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        <!-- What & How Section -->
        @if($profile && (($profile->what_title || $profile->what_description) || ($profile->how_title || $profile->how_description)))
            <section class="py-20 bg-white">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <div>
                            @if($profile->what_title || $profile->what_description)
                                <div class="mb-12">
                                    @if($profile->what_title)
                                        <h2 class="text-3xl font-bold text-gray-900 mb-6">
                                            {{ $profile->what_title }}
                                        </h2>
                                    @endif
                                    @if($profile->what_description)
                                        <div class="text-lg text-gray-600 leading-relaxed">
                                            {!! nl2br(e($profile->what_description)) !!}
                                        </div>
                                    @endif
                                </div>
                            @endif

                            @if($profile->how_title || $profile->how_description)
                                <div>
                                    @if($profile->how_title)
                                        <h2 class="text-3xl font-bold text-gray-900 mb-6">
                                            {{ $profile->how_title }}
                                        </h2>
                                    @endif
                                    @if($profile->how_description)
                                        <div class="text-lg text-gray-600 leading-relaxed">
                                            {!! nl2br(e($profile->how_description)) !!}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="relative">
                            <div class="bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-2xl p-8 text-white">
                                <i class="fas fa-quote-left text-3xl opacity-50 mb-4"></i>
                                <p class="text-lg mb-4 italic">
                                    "{{ $profile->outro_message ?? 'Coaching heeft mijn leven volledig veranderd. Ik help jou graag om jouw doelen te bereiken en je zelfverzekerder te voelen.' }}"
                                </p>
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-semibold">{{ $profile->naam ?? 'Professional Coach' }}</p>
                                        <p class="text-white/80 text-sm">Gecertificeerd Coach</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- Values/Approach Section -->
{{--        <section class="py-20 bg-gray-50">--}}
{{--            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">--}}
{{--                <div class="text-center mb-16">--}}
{{--                    <h2 class="text-4xl font-bold text-gray-900 mb-4">--}}
{{--                        Mijn werkwijze--}}
{{--                    </h2>--}}
{{--                    <p class="text-xl text-gray-600">--}}
{{--                        Dit is wat je van mij kunt verwachten--}}
{{--                    </p>--}}
{{--                </div>--}}

{{--                <div class="grid md:grid-cols-3 gap-8">--}}
{{--                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-8 text-center border border-gray-100">--}}
{{--                        <div class="w-16 h-16 bg-[#92c24f]/20 rounded-xl flex items-center justify-center mx-auto mb-6">--}}
{{--                            <i class="fas fa-heart text-[#92c24f] text-2xl"></i>--}}
{{--                        </div>--}}
{{--                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Persoonlijk</h3>--}}
{{--                        <p class="text-gray-600 leading-relaxed">--}}
{{--                            Iedere sessie is volledig afgestemd op jouw unieke situatie en behoeften.--}}
{{--                        </p>--}}
{{--                    </div>--}}

{{--                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-8 text-center border border-gray-100">--}}
{{--                        <div class="w-16 h-16 bg-[#0c6885]/20 rounded-xl flex items-center justify-center mx-auto mb-6">--}}
{{--                            <i class="fas fa-bullseye text-[#0c6885] text-2xl"></i>--}}
{{--                        </div>--}}
{{--                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Resultaatgericht</h3>--}}
{{--                        <p class="text-gray-600 leading-relaxed">--}}
{{--                            We werken samen aan concrete doelen en haalbare stappen vooruit.--}}
{{--                        </p>--}}
{{--                    </div>--}}

{{--                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-8 text-center border border-gray-100">--}}
{{--                        <div class="w-16 h-16 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-xl flex items-center justify-center mx-auto mb-6">--}}
{{--                            <i class="fas fa-handshake text-white text-2xl"></i>--}}
{{--                        </div>--}}
{{--                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Vertrouwelijk</h3>--}}
{{--                        <p class="text-gray-600 leading-relaxed">--}}
{{--                            Een veilige ruimte waar je jezelf volledig kunt zijn zonder oordeel.--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

        <!-- Statistics Section -->
{{--        <section class="py-20 bg-gradient-to-r from-[#92c24f] to-[#0c6885]">--}}
{{--            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">--}}
{{--                <div class="text-center mb-16">--}}
{{--                    <h2 class="text-4xl font-bold text-white mb-4">--}}
{{--                        Resultaten die spreken--}}
{{--                    </h2>--}}
{{--                    <p class="text-xl text-white/90">--}}
{{--                        Bewezen ervaring en tevreden cliënten--}}
{{--                    </p>--}}
{{--                </div>--}}

{{--                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">--}}
{{--                    <div class="text-center">--}}
{{--                        <div class="text-4xl lg:text-5xl font-bold text-white mb-2">500+</div>--}}
{{--                        <div class="text-white/80">Tevreden klanten</div>--}}
{{--                    </div>--}}
{{--                    <div class="text-center">--}}
{{--                        <div class="text-4xl lg:text-5xl font-bold text-white mb-2">5+</div>--}}
{{--                        <div class="text-white/80">Jaar ervaring</div>--}}
{{--                    </div>--}}
{{--                    <div class="text-center">--}}
{{--                        <div class="text-4xl lg:text-5xl font-bold text-white mb-2">95%</div>--}}
{{--                        <div class="text-white/80">Behaalt doelen</div>--}}
{{--                    </div>--}}
{{--                    <div class="text-center">--}}
{{--                        <div class="text-4xl lg:text-5xl font-bold text-white mb-2">24/7</div>--}}
{{--                        <div class="text-white/80">Ondersteuning</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}

        <!-- CTA Section -->
        @if($profile && ($profile->cta_title || $profile->cta_description || $profile->cta_text))
            <section class="py-20 bg-white">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    @if($profile->cta_title)
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">{{ $profile->cta_title }}</h2>
                    @else
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">Klaar voor verandering?</h2>
                    @endif

                    @if($profile->cta_description)
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed max-w-2xl mx-auto">{{ $profile->cta_description }}</p>
                    @else
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed max-w-2xl mx-auto">
                            Laten we samen ontdekken wat mogelijk is voor jou. Begin vandaag nog met je reis naar persoonlijke groei.
                        </p>
                    @endif

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('web.contact.create') }}" class="inline-flex items-center px-8 py-4 bg-[#0c6885] hover:bg-[#0a5a73] text-white font-semibold rounded-xl transition-colors duration-300 shadow-lg">
                            <i class="fas fa-calendar mr-3"></i>
                            {{ $profile->cta_text ?? 'Plan een gesprek' }}
                        </a>
                        <a href="tel:+31642305664" class="inline-flex items-center px-8 py-4 bg-transparent hover:bg-[#0c6885]/10 text-[#0c6885] font-semibold rounded-xl border-2 border-[#0c6885] transition-colors duration-300">
                            <i class="fas fa-phone mr-3"></i>
                            Bel direct
                        </a>
                    </div>
                </div>
            </section>
        @else
            <section class="py-20 bg-white">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">Klaar voor verandering?</h2>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed max-w-2xl mx-auto">
                        Laten we samen ontdekken wat mogelijk is voor jou. Begin vandaag nog met je reis naar persoonlijke groei.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('web.contact.create') }}" class="inline-flex items-center px-8 py-4 bg-[#0c6885] hover:bg-[#0a5a73] text-white font-semibold rounded-xl transition-colors duration-300 shadow-lg">
                            <i class="fas fa-calendar mr-3"></i>
                            Plan een gesprek
                        </a>
                        <a href="tel:+31642305664" class="inline-flex items-center px-8 py-4 bg-transparent hover:bg-[#0c6885]/10 text-[#0c6885] font-semibold rounded-xl border-2 border-[#0c6885] transition-colors duration-300">
                            <i class="fas fa-phone mr-3"></i>
                            Bel direct
                        </a>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection
