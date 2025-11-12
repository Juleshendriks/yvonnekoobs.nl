@extends('web.layouts.web')

@section('content')
    <div class="bg-white">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-green-50 via-white to-cyan-50 pt-16 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Cookiebeleid
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Informatie over het gebruik van cookies op onze website
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
                            <span class="ml-4 text-sm font-medium text-gray-500">Cookiebeleid</span>
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
                            <i class="fas fa-cookie-bite text-[#0c6885] mr-3"></i>
                            <p class="text-gray-800">
                                <strong>Laatst bijgewerkt:</strong> {{ now()->format('d-m-Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="prose prose-lg max-w-none">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-question-circle text-[#92c24f] mr-3"></i>
                            1. Wat zijn cookies?
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Cookies zijn kleine tekstbestanden die op jouw computer of mobiele apparaat worden opgeslagen wanneer je onze website bezoekt.
                            Ze helpen ons de website beter te laten functioneren en je ervaring te personaliseren.
                        </p>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-list text-[#0c6885] mr-3"></i>
                            2. Welke cookies gebruiken wij?
                        </h2>

                        <div class="space-y-6 mb-8">
                            <div class="p-6 bg-gray-50 rounded-xl">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                    <i class="fas fa-cog text-[#92c24f] mr-3"></i>
                                    Noodzakelijke cookies
                                </h3>
                                <p class="text-gray-600 mb-4">Deze cookies zijn essentieel voor het functioneren van de website.</p>
                                <ul class="text-gray-600 space-y-2">
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-[#92c24f] mr-3 mt-1"></i>
                                        Sessie cookies voor formulier functionaliteit
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-[#92c24f] mr-3 mt-1"></i>
                                        Beveiliging en CSRF bescherming
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-[#92c24f] mr-3 mt-1"></i>
                                        Cookie voorkeuren opslaan
                                    </li>
                                </ul>
                            </div>

                            <div class="p-6 bg-gray-50 rounded-xl">
                                <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                    <i class="fas fa-chart-line text-[#0c6885] mr-3"></i>
                                    Analytische cookies
                                </h3>
                                <p class="text-gray-600 mb-4">Helpen ons begrijpen hoe bezoekers onze website gebruiken (alleen met toestemming).</p>
                                <ul class="text-gray-600 space-y-2">
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-[#0c6885] mr-3 mt-1"></i>
                                        Google Analytics voor website statistieken
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-[#0c6885] mr-3 mt-1"></i>
                                        Anonieme gebruikersgegevens
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check text-[#0c6885] mr-3 mt-1"></i>
                                        Website prestaties monitoren
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-user-cog text-[#92c24f] mr-3"></i>
                            3. Jouw keuzes
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Je hebt altijd controle over welke cookies je accepteert. Noodzakelijke cookies kunnen niet worden uitgeschakeld,
                            maar je kunt kiezen voor analytische cookies.
                        </p>

                        <div class="p-6 bg-gradient-to-r from-[#92c24f]/10 to-[#0c6885]/10 rounded-xl mb-6">
                            <h3 class="font-semibold text-gray-900 mb-3">Cookie voorkeuren wijzigen:</h3>
                            <ul class="text-gray-600 space-y-2">
                                <li class="flex items-start">
                                    <i class="fas fa-arrow-right text-[#92c24f] mr-3 mt-1"></i>
                                    Via de cookie banner bij je eerste bezoek
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-arrow-right text-[#0c6885] mr-3 mt-1"></i>
                                    In je browser instellingen
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-arrow-right text-[#92c24f] mr-3 mt-1"></i>
                                    Door contact met ons op te nemen
                                </li>
                            </ul>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-browser text-[#0c6885] mr-3"></i>
                            4. Browser instellingen
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Je kunt cookies ook beheren via je browser instellingen. Houd er rekening mee dat het uitschakelen van cookies
                            de functionaliteit van de website kan beïnvloeden.
                        </p>

                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <div class="p-4 border border-gray-200 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2">
                                    <i class="fab fa-chrome text-[#0c6885] mr-2"></i>Google Chrome
                                </h4>
                                <p class="text-sm text-gray-600">Instellingen → Privacy en beveiliging → Cookies</p>
                            </div>
                            <div class="p-4 border border-gray-200 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2">
                                    <i class="fab fa-firefox text-[#92c24f] mr-2"></i>Mozilla Firefox
                                </h4>
                                <p class="text-sm text-gray-600">Opties → Privacy en beveiliging</p>
                            </div>
                            <div class="p-4 border border-gray-200 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2">
                                    <i class="fab fa-safari text-[#0c6885] mr-2"></i>Safari
                                </h4>
                                <p class="text-sm text-gray-600">Voorkeuren → Privacy</p>
                            </div>
                            <div class="p-4 border border-gray-200 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2">
                                    <i class="fab fa-edge text-[#92c24f] mr-2"></i>Microsoft Edge
                                </h4>
                                <p class="text-sm text-gray-600">Instellingen → Cookies en sitemachtigingen</p>
                            </div>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-sync-alt text-[#92c24f] mr-3"></i>
                            5. Updates van dit beleid
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            We kunnen dit cookiebeleid van tijd tot tijd bijwerken. Wijzigingen worden op deze pagina gepubliceerd
                            met de nieuwe datum. We raden je aan om dit beleid regelmatig te controleren.
                        </p>
                    </div>

                    <div class="mt-12 p-6 bg-gray-50 rounded-xl">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-question-circle text-[#0c6885] mr-3"></i>
                            <h3 class="text-lg font-semibold text-gray-900">Vragen over cookies?</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Heb je vragen over ons gebruik van cookies of wil je je voorkeuren wijzigen? Neem gerust contact op.
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
