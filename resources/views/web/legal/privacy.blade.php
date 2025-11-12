@extends('web.layouts.web')

@section('content')
    <div class="bg-white">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-green-50 via-white to-cyan-50 pt-16 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Privacybeleid
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Hoe we jouw persoonlijke gegevens verzamelen, gebruiken en beschermen
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
                            <span class="ml-4 text-sm font-medium text-gray-500">Privacybeleid</span>
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
                            <i class="fas fa-shield-alt text-[#0c6885] mr-3"></i>
                            <p class="text-gray-800">
                                <strong>Laatst bijgewerkt:</strong> {{ now()->format('d-m-Y') }} | <strong>AVG-compliant</strong>
                            </p>
                        </div>
                    </div>

                    <div class="prose prose-lg max-w-none">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-info-circle text-[#92c24f] mr-3"></i>
                            1. Wie zijn wij?
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            [Naam Coach] is verantwoordelijk voor de verwerking van jouw persoonsgegevens.
                            Wij respecteren jouw privacy en handelen volgens de Algemene Verordening Gegevensbescherming (AVG).
                        </p>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-database text-[#0c6885] mr-3"></i>
                            2. Welke gegevens verzamelen wij?
                        </h2>
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Contactgegevens:</h3>
                            <ul class="text-gray-600 mb-4 space-y-2">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-[#92c24f] mr-3 mt-1"></i>
                                    Naam en contactgegevens (email, telefoon)
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-[#92c24f] mr-3 mt-1"></i>
                                    Communicatie tussen ons (emails, notities van gesprekken)
                                </li>
                            </ul>

                            <h3 class="text-lg font-semibold text-gray-900 mb-3">Website gegevens:</h3>
                            <ul class="text-gray-600 mb-6 space-y-2">
                                <li class="flex items-start">
                                    <i class="fas fa-check text-[#0c6885] mr-3 mt-1"></i>
                                    IP-adres en browserinformatie
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check text-[#0c6885] mr-3 mt-1"></i>
                                    Cookies voor website functionaliteit
                                </li>
                            </ul>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-cogs text-[#92c24f] mr-3"></i>
                            3. Waarvoor gebruiken wij je gegevens?
                        </h2>
                        <ul class="text-gray-600 mb-6 space-y-3">
                            <li class="flex items-start">
                                <i class="fas fa-arrow-right text-[#92c24f] mr-3 mt-1"></i>
                                <strong>Coaching diensten:</strong> Het verlenen van coaching en opvolging
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-arrow-right text-[#0c6885] mr-3 mt-1"></i>
                                <strong>Communicatie:</strong> Beantwoorden van vragen en afspraken maken
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-arrow-right text-[#92c24f] mr-3 mt-1"></i>
                                <strong>Nieuwsbrief:</strong> Alleen met jouw toestemming
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-arrow-right text-[#0c6885] mr-3 mt-1"></i>
                                <strong>Website verbetering:</strong> Analytics voor betere gebruikerservaring
                            </li>
                        </ul>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-lock text-[#0c6885] mr-3"></i>
                            4. Hoe beschermen wij je gegevens?
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Wij nemen passende technische en organisatorische maatregelen om jouw persoonsgegevens te beschermen tegen verlies, misbruik of ongeoorloofde toegang.
                        </p>
                        <ul class="text-gray-600 mb-6 space-y-2">
                            <li class="flex items-start">
                                <i class="fas fa-check text-[#92c24f] mr-3 mt-1"></i>
                                SSL-encryptie voor alle website communicatie
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-[#92c24f] mr-3 mt-1"></i>
                                Veilige opslag van bestanden en gegevens
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-[#92c24f] mr-3 mt-1"></i>
                                Geen gegevens delen met derden zonder toestemming
                            </li>
                        </ul>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-user-shield text-[#92c24f] mr-3"></i>
                            5. Jouw rechten
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Onder de AVG heb je verschillende rechten betreffende jouw persoonsgegevens:
                        </p>
                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-eye text-[#0c6885] mr-2"></i>Recht op inzage
                                </h4>
                                <p class="text-sm text-gray-600">Opvragen welke gegevens we van je hebben</p>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-edit text-[#92c24f] mr-2"></i>Recht op correctie
                                </h4>
                                <p class="text-sm text-gray-600">Onjuiste gegevens laten corrigeren</p>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-trash text-[#0c6885] mr-2"></i>Recht op verwijdering
                                </h4>
                                <p class="text-sm text-gray-600">Je gegevens laten verwijderen</p>
                            </div>
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <h4 class="font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-ban text-[#92c24f] mr-2"></i>Recht op beperking
                                </h4>
                                <p class="text-sm text-gray-600">Verwerking van gegevens beperken</p>
                            </div>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-clock text-[#0c6885] mr-3"></i>
                            6. Bewaartermijnen
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            We bewaren jouw gegevens niet langer dan noodzakelijk. Coaching notities worden maximaal 7 jaar bewaard conform professionele standaarden.
                            Website gegevens worden regulier opgeschoond.
                        </p>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-question-circle text-[#92c24f] mr-3"></i>
                            7. Vragen of klachten?
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Heb je vragen over dit privacybeleid of wil je gebruik maken van je rechten?
                            Neem dan contact met ons op. Je kunt ook een klacht indienen bij de Autoriteit Persoonsgegevens.
                        </p>
                    </div>

                    <div class="mt-12 p-6 bg-gray-50 rounded-xl">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-envelope text-[#0c6885] mr-3"></i>
                            <h3 class="text-lg font-semibold text-gray-900">Contact over privacy</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Voor vragen over je privacy of om gebruik te maken van je rechten kun je contact met ons opnemen.
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
