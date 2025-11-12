@extends('web.layouts.web')
@section('content')

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-green-50 via-white to-cyan-50 pt-16 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left">
                    @if($profile)
                        <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                            {{ $profile->introduction_title ?? 'Transform Your Life with Professional Coaching' }}
                        </h1>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            {{ $profile->introduction_description ?? 'Ontdek je potentieel en bereik je doelen met persoonlijke begeleiding van een ervaren coach.' }}
                        </p>
                    @else
                        <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                            Transform Your Life with Professional Coaching
                        </h1>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                            Ontdek je potentieel en bereik je doelen met persoonlijke begeleiding van een ervaren coach.
                        </p>
                    @endif

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('web.contact.create') }}" class=" text-center inline-flex items-center  justify-center px-8 py-4 bg-[#0c6885] hover:bg-[#0a5a73] text-white font-semibold rounded-xl transition-colors duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-calendar-check mr-3"></i>
                            Start je reis nu
                        </a>
                        <a href="{{ route('web.contact.create') }}" class=" text-center inline-flex items-center justify-center  px-8 py-4 bg-white hover:bg-gray-50 text-[#0c6885] font-semibold rounded-xl border-2 border-[#0c6885] transition-colors duration-300">
                            <i class="fas fa-envelope mr-3"></i>
                            Neem contact op
                        </a>
                    </div>
                </div>

                @if($profile && $profile->photo)
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-3xl transform rotate-3"></div>
                        <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->naam }}"
                             class="relative w-full max-w-md mx-auto rounded-3xl shadow-2xl object-cover aspect-square">
                    </div>
                @else
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-3xl transform rotate-3"></div>
                        <div class="relative w-full max-w-md mx-auto aspect-square rounded-3xl shadow-2xl bg-gray-100 flex items-center justify-center">
                            <i class="fas fa-user-circle text-8xl text-gray-400"></i>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Coaching Types Section -->
    @if($coachingTypes->count() > 0)
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Soorten Coaching</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Ontdek welke coaching het beste bij jou past en begin je transformatie vandaag nog.
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($coachingTypes as $type)
                        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100 group overflow-hidden">
                            <!-- Large Image -->
                            @if($type->banner_image)
                                <div class="aspect-[4/3] w-full overflow-hidden">
                                    <img src="{{ asset('storage/' . $type->banner_image) }}" alt="{{ $type->title }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                </div>
                            @else
                                <div class="aspect-[4/3] w-full bg-gradient-to-r from-[#92c24f] to-[#0c6885] flex items-center justify-center">
                                    <i class="fas fa-heart text-white text-4xl"></i>
                                </div>
                            @endif

                            <!-- Content -->
                            <div class="p-8">
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ $type->title }}</h3>

                                @if($type->subtitle)
                                    <p class="text-gray-600 mb-4 font-medium">{{ $type->subtitle }}</p>
                                @endif

                                <p class="text-gray-600 mb-6 leading-relaxed">{{ Str::limit($type->summary, 120) }}</p>

                                <a href="{{ route('web.coaching-types.show', $type->slug) }}" class="inline-flex items-center text-[#0c6885] hover:text-[#0a5a73] font-semibold transition-colors duration-300">
                                    Meer informatie
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- About Section -->
    @if($profile)
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <h2 class="text-4xl font-bold text-gray-900 mb-6">
                            {{ $profile->why_title ?? 'Waarom kiezen voor coaching?' }}
                        </h2>
                        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                            {{ $profile->why_description ?? 'Coaching helpt je om blokkades weg te nemen, doelen te bereiken en je volledige potentieel te ontdekken. Met persoonlijke begeleiding maak je sneller vooruitgang dan ooit tevoren.' }}
                        </p>

                        @if($profile->what_title)
                            <div class="space-y-6">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-[#92c24f]/20 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                        <i class="fas fa-check text-[#92c24f] text-sm"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-900 mb-1">{{ $profile->what_title }}</h3>
                                        <p class="text-gray-600">{{ $profile->what_description }}</p>
                                    </div>
                                </div>

                                @if($profile->how_title)
                                    <div class="flex items-start">
                                        <div class="w-8 h-8 bg-[#0c6885]/20 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                            <i class="fas fa-lightbulb text-[#0c6885] text-sm"></i>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="font-semibold text-gray-900 mb-1">{{ $profile->how_title }}</h3>
                                            <p class="text-gray-600">{{ $profile->how_description }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="relative">
                        <div class="bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-2xl p-8 text-white">
                            <i class="fas fa-quote-left text-3xl opacity-50 mb-4"></i>
                            <p class="text-lg mb-4 italic">
                                "{{ $profile->outro_message ?? 'Coaching heeft mijn leven volledig veranderd. Ik heb mijn doelen bereikt en voel me zelfverzekerder dan ooit.' }}"
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

    <!-- Reviews Section -->
    @if($reviews->count() > 0)
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Wat klanten zeggen</h2>
                    <p class="text-xl text-gray-600">Ontdek hoe coaching het leven van anderen heeft veranderd</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($reviews as $review)
                        <div class="bg-gray-50 rounded-2xl p-8 hover:shadow-lg transition-shadow duration-300">
                            <div class="flex items-center mb-4">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $review->rating ? 'text-[#92c24f]' : 'text-gray-300' }}"></i>
                                @endfor
                            </div>

                            <p class="text-gray-600 mb-6 leading-relaxed italic">
                                "{{ $review->review }}"
                            </p>

                            <div class="flex items-center">
                                @if($review->avatar)
                                    <img src="{{ asset('storage/' . $review->avatar) }}" alt="{{ $review->name }}"
                                         class="w-12 h-12 rounded-full object-cover">
                                @else
                                    <div class="w-12 h-12 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-full flex items-center justify-center">
                                        <span class="text-white font-semibold text-lg">{{ substr($review->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div class="ml-4">
                                    <p class="font-semibold text-gray-900">{{ $review->name }}</p>
                                    @if($review->position && $review->company)
                                        <p class="text-sm text-gray-500">{{ $review->position }} bij {{ $review->company }}</p>
                                    @elseif($review->company)
                                        <p class="text-sm text-gray-500">{{ $review->company }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- FAQ Section -->
    @if($faqs->count() > 0)
        <section class="py-20 bg-gray-50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Veelgestelde vragen</h2>
                    <p class="text-xl text-gray-600">Alles wat je wilt weten over coaching</p>
                </div>

                <div class="space-y-6">
                    @foreach($faqs as $index => $faq)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                            <button class="w-full px-6 py-4 text-left flex items-center justify-between hover:bg-gray-50 rounded-xl focus:outline-none focus:bg-gray-50 transition-colors duration-300"
                                    onclick="toggleFaq({{ $index }})">
                                <h3 class="text-lg font-semibold text-gray-900 pr-4">{{ $faq->question }}</h3>
                                <i class="fas fa-chevron-down text-gray-400 transition-transform duration-300" id="chevron-{{ $index }}"></i>
                            </button>
                            <div class="px-6 pb-4 hidden" id="answer-{{ $index }}">
                                <p class="text-gray-600 leading-relaxed">{{ $faq->answer }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-[#92c24f] to-[#0c6885]">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            @if($profile && $profile->cta_title)
                <h2 class="text-4xl font-bold text-white mb-6">{{ $profile->cta_title }}</h2>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">{{ $profile->cta_description }}</p>
            @else
                <h2 class="text-4xl font-bold text-white mb-6">Klaar om je leven te transformeren?</h2>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">
                    Begin vandaag nog met je reis naar persoonlijke groei en succes. Neem contact op voor een vrijblijvend gesprek.
                </p>
            @endif

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('web.contact.create') }}" class="inline-flex items-center px-8 py-4 bg-white hover:bg-gray-100 text-[#0c6885] font-semibold rounded-xl transition-colors duration-300 shadow-lg">
                    <i class="fas fa-phone mr-3"></i>
                    {{ $profile->cta_text ?? 'Neem contact op' }}
                </a>
                <a href="{{ route('web.products.index') }}" class="inline-flex items-center px-8 py-4 bg-transparent hover:bg-white/10 text-white font-semibold rounded-xl border-2 border-white transition-colors duration-300">
                    <i class="fas fa-download mr-3"></i>
                    Download gratis Downloads
                </a>
            </div>
        </div>
    </section>

    <!-- JavaScript for FAQ Toggle -->
    <script>
        function toggleFaq(index) {
            const answer = document.getElementById(`answer-${index}`);
            const chevron = document.getElementById(`chevron-${index}`);

            if (answer.classList.contains('hidden')) {
                answer.classList.remove('hidden');
                chevron.style.transform = 'rotate(180deg)';
            } else {
                answer.classList.add('hidden');
                chevron.style.transform = 'rotate(0deg)';
            }
        }
    </script>

@endsection
