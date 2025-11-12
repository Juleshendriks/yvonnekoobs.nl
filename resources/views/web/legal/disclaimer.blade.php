@extends('web.layouts.web')

@section('content')
    <div class="bg-white">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-green-50 via-white to-cyan-50 pt-16 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Disclaimer
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Belangrijke informatie over het gebruik van onze website en diensten
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
                            <span class="ml-4 text-sm font-medium text-gray-500">Disclaimer</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Content -->
        <section class="py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-lg p-8 lg:p-12 border border-gray-100">

                    <div class="mb-8 p-4 bg-gradient-to-r from-[#92c24f]/10 to-[#0c6885]/10 rounded-xl border border-[#0c6885]/20">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle text-[#0c6885] mr-3"></i>
                            <p class="text-gray-800">
                                <strong>Laatst bijgewerkt:</strong> {{ now()->format('d-m-Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="prose prose-lg max-w-none">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-info-circle text-[#92c24f] mr-3"></i>
                            1. Algemene informatie
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            De informatie op deze website is uitsluitend bedoeld voor algemene informatieve doeleinden.
                            Hoewel wij ons best doen om de informatie actueel en correct te houden, kunnen wij geen garanties geven
                            over de volledigheid, juistheid of geschiktheid van de informatie voor specifieke doeleinden.
                        </p>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-user-md text-[#0c6885] mr-3"></i>
                            2. Coaching vs. Therapie
                        </h2>
                        <div class="p-6 bg-yellow-50 border border-yellow-200 rounded-xl mb-6">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-triangle text-yellow-600 mr-3 mt-1"></i>
                                <div>
                                    <h3 class="font-semibold text-yellow-800 mb-2">Belangrijk om te weten:</h3>
                                    <p class="text-yellow-700">
                                        Coaching is geen vorm van therapie, medische behandeling of psychologische hulpverlening.
                                        Bij ernstige mentale gezondheidsproblemen verwijzen wij altijd door naar gekwalificeerde zorgverleners.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <ul class="text-gray-600 mb-6 space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-check text-[#92c24f] mr-3 mt-1"></i>
                                Coaching richt zich op toekomstige doelen en persoonlijke groei
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-[#0c6885] mr-3 mt-1"></i>
                                Wij behandelen geen psychiatrische aandoeningen
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-[#92c24f] mr-3 mt-1"></i>
                                Bij twijfel adviseren wij altijd professionele medische hulp
                            </li>
                        </ul>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-chart-line text-[#92c24f] mr-3"></i>
                            3. Resultaten
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Coaching resultaten zijn individueel en kunnen niet worden gegarandeerd. De effectiviteit van coaching
                            hangt af van vele factoren, waaronder:
                        </p>
                        <ul class="text-gray-600 mb-6 space-y-2">
                            <li class="flex items-start">
                                <i class="fas fa-arrow-right text-[#0c6885] mr-3 mt-1"></i>
                                Persoonlijke inzet en motivatie
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-arrow-right text-[#92c24f] mr-3 mt-1"></i>
                                Openheid voor verandering
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-arrow-right text-[#0c6885] mr-3 mt-1"></i>
                                Bereidheid om acties te ondernemen
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-arrow-right text-[#92c24f] mr-3 mt-1"></i>
                                Externe omstandigheden
                            </li>
                        </ul>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-shield-alt text-[#0c6885] mr-3"></i>
                            4. Aansprakelijkheid website
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Wij zijn niet aansprakelijk voor eventuele schade die voortvloeit uit het gebruik van deze website
                            of de onmogelijkheid om de website te gebruiken. Dit geldt ook voor indirecte schade zoals:
                        </p>
                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-wifi text-[#92c24f] mr-2"></i>Technische problemen
                                </h4>
                                <p class="text-sm text-gray-600">Uitval, storingen of onderhoud</p>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-bug text-[#0c6885] mr-2"></i>Software fouten
                                </h4>
                                <p class="text-sm text-gray-600">Bugs of onvolkomenheden in systemen</p>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-link text-[#92c24f] mr-2"></i>Externe links
                                </h4>
                                <p class="text-sm text-gray-600">Inhoud van websites van derden</p>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-database text-[#0c6885] mr-2"></i>Gegevensverlies
                                </h4>
                                <p class="text-sm text-gray-600">Verlies van persoonlijke gegevens</p>
                            </div>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-external-link-alt text-[#92c24f] mr-3"></i>
                            5. Links naar andere websites
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Onze website kan links bevatten naar externe websites. Wij zijn niet verantwoordelijk voor de inhoud,
                            privacy practices, of beschikbaarheid van deze externe sites. Het bezoeken van externe links gebeurt
                            op eigen risico.
                        </p>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-copyright text-[#0c6885] mr-3"></i>
                            6. Intellectueel eigendom
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Alle inhoud op deze website, inclusief teksten, afbeeldingen, logo's en designs, is eigendom van
                            [Naam Coach] of gebruikt onder licentie. Ongeautoriseerd gebruik is niet toegestaan.
                        </p>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-balance-scale text-[#92c24f] mr-3"></i>
                            7. Toepasselijk recht
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Op deze disclaimer en het gebruik van onze website is Nederlands recht van toepassing.
                            Geschillen worden voorgelegd aan de bevoegde Nederlandse rechter.
                        </p>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-edit text-[#0c6885] mr-3"></i>
                            8. Wijzigingen
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Wij behouden ons het recht voor om deze disclaimer op elk moment aan te passen.
                            Wijzigingen worden gepubliceerd op deze pagina en treden direct in werking.
                        </p>
                    </div>

                    <div class="mt-12 p-6 bg-gray-50 rounded-xl">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-question-circle text-[#0c6885] mr-3"></i>
                            <h3 class="text-lg font-semibold text-gray-900">Vragen over deze disclaimer?</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Heb je vragen over deze disclaimer of over onze diensten? Neem gerust contact op voor verduidelijking.
                        </p>
                        <a href="{{ route('web.contact.create') }}" class="inline-flex items-center px-6 py-3 bg-[#0c6885] hover:bg-[#0a5a73] text-white font-semibold rounded-xl transition-colors duration-300">
                            <i class="fas fa-phone mr-2"></i>
                            Neem contact op
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
