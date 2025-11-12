@extends('web.layouts.web')
@section('content')

    <div class="bg-white">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-green-50 via-white to-cyan-50 pt-16 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="w-32 h-32 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-full flex items-center justify-center mx-auto mb-8">
                        <i class="fas fa-search text-white text-5xl"></i>
                    </div>

                    <p class="text-2xl font-bold text-[#0c6885] mb-4">404</p>
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Pagina niet gevonden
                    </h1>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto leading-relaxed mb-12">
                        Sorry, we kunnen de pagina die je zoekt niet vinden. Misschien is de link verouderd of heb je een typfout gemaakt.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('web.home') }}" class="inline-flex items-center px-8 py-4 bg-[#0c6885] hover:bg-[#0a5a73] text-white font-semibold rounded-xl transition-colors duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-home mr-3"></i>
                            Terug naar home
                        </a>
                        <a href="{{ route('web.contact.create') }}" class="inline-flex items-center px-8 py-4 bg-white hover:bg-gray-50 text-[#0c6885] font-semibold rounded-xl border-2 border-[#0c6885] transition-colors duration-300">
                            <i class="fas fa-envelope mr-3"></i>
                            Contact opnemen
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Helpful Links -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Waar kan ik je mee helpen?</h2>
                    <p class="text-lg text-gray-600">Probeer een van deze populaire pagina's</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <a href="{{ route('web.coaching-types.index') }}" class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 border border-gray-100 group">
                        <div class="w-12 h-12 bg-[#92c24f]/20 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-heart text-[#92c24f] text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-[#0c6885] transition-colors">
                            Coaching Aanbod
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Ontdek welke vorm van coaching bij jou past
                        </p>
                    </a>

                    <a href="{{ route('web.products.index') }}" class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 border border-gray-100 group">
                        <div class="w-12 h-12 bg-[#0c6885]/20 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-download text-[#0c6885] text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-[#0c6885] transition-colors">
                            Gratis Resources
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Download handige werkboeken en tools
                        </p>
                    </a>

                    <a href="{{ route('web.about') }}" class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 border border-gray-100 group">
                        <div class="w-12 h-12 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-user text-white text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-[#0c6885] transition-colors">
                            Over Mij
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Leer meer over mijn achtergrond en werkwijze
                        </p>
                    </a>

                    <a href="{{ route('web.faq') }}" class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 border border-gray-100 group">
                        <div class="w-12 h-12 bg-[#0c6885]/20 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-question-circle text-[#0c6885] text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-[#0c6885] transition-colors">
                            Veelgestelde Vragen
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Antwoorden op de meest gestelde vragen
                        </p>
                    </a>

                    <a href="{{ route('web.contact.create') }}" class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 border border-gray-100 group">
                        <div class="w-12 h-12 bg-[#92c24f]/20 rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-phone text-[#92c24f] text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-[#0c6885] transition-colors">
                            Contact
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Neem direct contact op voor vragen
                        </p>
                    </a>

                    <a href="{{ route('web.home') }}" class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 p-6 border border-gray-100 group">
                        <div class="w-12 h-12 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-lg flex items-center justify-center mb-4">
                            <i class="fas fa-home text-white text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2 group-hover:text-[#0c6885] transition-colors">
                            Homepage
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Terug naar de startpagina
                        </p>
                    </a>
                </div>
            </div>
        </section>

        <!-- Search Alternative -->
        <section class="py-20 bg-white">
            <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                    <div class="w-16 h-16 bg-[#0c6885]/20 rounded-xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-search text-[#0c6885] text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Hulp nodig bij het vinden?</h3>
                    <p class="text-gray-600 mb-6">
                        Als je niet kunt vinden wat je zoekt, neem dan contact op. Ik help je graag verder met je vraag.
                    </p>
                    <a href="{{ route('web.contact.create') }}" class="inline-flex items-center px-6 py-3 bg-[#0c6885] hover:bg-[#0a5a73] text-white font-semibold rounded-xl transition-colors duration-300 shadow-lg">
                        <i class="fas fa-envelope mr-2"></i>
                        Stel je vraag
                    </a>
                </div>
            </div>
        </section>
    </div>

@endsection
