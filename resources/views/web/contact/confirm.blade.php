@extends('web.layouts.web')

@section('content')
    <div class="bg-white">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-green-50 via-white to-cyan-50 pt-16 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <!-- Success Icon -->
                    <div class="mx-auto w-24 h-24 bg-[#92c24f] rounded-full flex items-center justify-center mb-8 shadow-lg">
                        <i class="fas fa-check text-white text-4xl"></i>
                    </div>

                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Bedankt voor je bericht!
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Je bericht is succesvol verzonden. Ik heb je contactgegevens ontvangen en zal zo snel mogelijk reageren.
                    </p>
                </div>
            </div>
        </section>

        <!-- What Happens Next Section -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Wat gebeurt er nu?</h2>
                    <p class="text-lg text-gray-600">Hier is wat je kunt verwachten na het versturen van je bericht</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-2xl shadow-lg p-8 text-center border border-gray-100 relative">
                        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 bg-[#92c24f] rounded-full flex items-center justify-center text-white font-bold">1</div>
                        <div class="w-16 h-16 bg-[#92c24f]/20 rounded-xl flex items-center justify-center mx-auto mb-6 mt-4">
                            <i class="fas fa-envelope  text-[#92c24f] text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Bevestiging</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Je ontvangt binnen enkele minuten een bevestigingsmail met de details van je bericht.
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-8 text-center border border-gray-100 relative">
                        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 bg-[#0c6885] rounded-full flex items-center justify-center text-white font-bold">2</div>
                        <div class="w-16 h-16 bg-[#0c6885]/20 rounded-xl flex items-center justify-center mx-auto mb-6 mt-4">
                            <i class="fas fa-search text-[#0c6885] text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Beoordeling</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Ik bekijk je bericht zorgvuldig en bepaal hoe ik je het beste kan helpen.
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-8 text-center border border-gray-100 relative">
                        <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 w-8 h-8 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-full flex items-center justify-center text-white font-bold">3</div>
                        <div class="w-16 h-16 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-xl flex items-center justify-center mx-auto mb-6 mt-4">
                            <i class="fas fa-reply text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Persoonlijk antwoord</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Binnen 24 uur (werkdagen) ontvang je een persoonlijk antwoord met vervolgstappen.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Response Timeline -->
        <section class="py-20 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-gradient-to-r from-[#92c24f]/10 to-[#0c6885]/10 rounded-2xl p-8 text-center border border-[#0c6885]/20">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-12 h-12 bg-[#0c6885] rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-clock text-white text-xl"></i>
                        </div>
                        <div class="text-left">
                            <h3 class="text-lg font-semibold text-gray-900">Verwachte reactietijd</h3>
                            <p class="text-2xl font-bold text-[#0c6885]">Binnen 24 uur</p>
                            <p class="text-sm text-gray-600">(alleen werkdagen)</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Action Buttons -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Wat kan je in de tussentijd doen?</h2>

                <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                    <a href="{{ route('web.home') }}" class="inline-flex items-center px-8 py-4 bg-[#0c6885] hover:bg-[#0a5a73] text-white font-semibold rounded-xl transition-colors duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-home mr-3"></i>
                        Terug naar home
                    </a>
                    <a href="{{ route('web.coaching-types.index') }}" class="inline-flex items-center px-8 py-4 bg-white hover:bg-gray-50 text-[#0c6885] font-semibold rounded-xl border-2 border-[#0c6885] transition-colors duration-300">
                        <i class="fas fa-heart mr-3"></i>
                        Bekijk coaching aanbod
                    </a>
                </div>
            </div>
        </section>

        <!-- Additional Downloads -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Meer informatie</h2>
                    <p class="text-xl text-gray-600">Ontdek meer over coaching terwijl je wacht op mijn reactie</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-8 text-center border border-gray-100">
                        <div class="w-16 h-16 bg-[#92c24f]/20 rounded-xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-question-circle text-[#92c24f] text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Veelgestelde vragen</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Bekijk antwoorden op veelgestelde vragen over coaching en mijn werkwijze.
                        </p>
                        <a href="{{ route('web.faq') }}" class="inline-flex items-center text-[#92c24f] hover:text-[#7da542] font-semibold transition-colors">
                            Bekijk FAQ <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-8 text-center border border-gray-100">
                        <div class="w-16 h-16 bg-[#0c6885]/20 rounded-xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-user text-[#0c6885] text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Over mij</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Leer meer over mijn achtergrond, ervaring en hoe ik jou kan helpen groeien.
                        </p>
                        <a href="{{ route('web.about') }}" class="inline-flex items-center text-[#0c6885] hover:text-[#0a5a73] font-semibold transition-colors">
                            Lees meer <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-8 text-center border border-gray-100">
                        <div class="w-16 h-16 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-download text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Gratis Downloads</h3>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            Download gratis werkboeken, checklists en andere hulpmiddelen voor persoonlijke groei.
                        </p>
                        <a href="{{ route('web.products.index') }}" class="inline-flex items-center text-[#0c6885] hover:text-[#0a5a73] font-semibold transition-colors">
                            Bekijk Downloads <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Emergency Contact -->
        <section class="py-20 bg-gradient-to-r from-[#92c24f] to-[#0c6885]">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="bg-white/10 rounded-2xl p-8 backdrop-blur-sm">
                    <div class="flex items-center justify-center mb-6">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-phone text-white text-2xl"></i>
                        </div>
                        <div class="text-left">
                            <h3 class="text-xl font-bold text-white mb-2">Spoedeisend?</h3>
                            <p class="text-white/90">Voor urgente zaken kun je me direct bellen</p>
                        </div>
                    </div>

                    <a href="tel:+31642305664" class="inline-flex items-center px-8 py-4 bg-white hover:bg-gray-100 text-[#0c6885] font-semibold rounded-xl transition-colors duration-300 shadow-lg">
                        <i class="fas fa-phone mr-3"></i>
                        +31 6 42305664
                    </a>

                    <p class="text-white/80 text-sm mt-4">
                        Beschikbaar tijdens kantooruren (ma-vr 9:00-17:00)
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
