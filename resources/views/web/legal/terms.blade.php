@extends('web.layouts.web')

@section('content')
    <div class="bg-white">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-green-50 via-white to-cyan-50 pt-16 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Algemene Voorwaarden
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        De voorwaarden voor onze coaching diensten en het gebruik van onze website
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
                            <span class="ml-4 text-sm font-medium text-gray-500">Algemene Voorwaarden</span>
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
                            <i class="fas fa-info-circle text-[#0c6885] mr-3"></i>
                            <p class="text-gray-800">
                                <strong>Laatst bijgewerkt:</strong> {{ now()->format('d-m-Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="prose prose-lg max-w-none">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-handshake text-[#92c24f] mr-3"></i>
                            1. Algemeen
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Deze algemene voorwaarden zijn van toepassing op alle diensten die worden geleverd door [Naam Coach],
                            ingeschreven bij de Kamer van Koophandel onder nummer [KvK nummer]. Deze voorwaarden gelden voor alle
                            coaching trajecten, workshops, digitale producten en overige dienstverlening.
                        </p>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-user-tie text-[#0c6885] mr-3"></i>
                            2. Coaching Diensten
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Coaching is een vorm van persoonlijke begeleiding gericht op het bereiken van doelen en persoonlijke ontwikkeling.
                            Coaching is geen vorm van therapie, medische behandeling of psychologische hulpverlening.
                        </p>
                        <ul class="text-gray-600 mb-6 space-y-2">
                            <li class="flex items-start">
                                <i class="fas fa-check text-[#92c24f] mr-3 mt-1"></i>
                                Sessies duren standaard 60-90 minuten
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-[#92c24f] mr-3 mt-1"></i>
                                Coaching kan online of fysiek plaatsvinden
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-[#92c24f] mr-3 mt-1"></i>
                                De cliënt is verantwoordelijk voor eigen keuzes en acties
                            </li>
                        </ul>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-euro-sign text-[#92c24f] mr-3"></i>
                            3. Tarieven en Betaling
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Alle tarieven zijn inclusief BTW en worden vooraf gecommuniceerd. Betaling dient te geschieden binnen 14 dagen na factuurdatum.
                        </p>
                        <ul class="text-gray-600 mb-6 space-y-2">
                            <li class="flex items-start">
                                <i class="fas fa-check text-[#0c6885] mr-3 mt-1"></i>
                                Betaling per sessie of pakket mogelijk
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-[#0c6885] mr-3 mt-1"></i>
                                Bij te late betaling kunnen administratiekosten in rekening worden gebracht
                            </li>
                        </ul>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-calendar-times text-[#0c6885] mr-3"></i>
                            4. Afspraken en Annulering
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-4">
                            Afspraken kunnen tot 24 uur vooraf kosteloos worden geannuleerd of verzet. Bij latere annulering wordt de volledige sessieprijs in rekening gebracht.
                        </p>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-shield-alt text-[#92c24f] mr-3"></i>
                            5. Vertrouwelijkheid
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Alle informatie die tijdens coaching sessies wordt gedeeld, wordt strikt vertrouwelijk behandeld.
                            Uitzondering hierop geldt alleen bij acute gevaar voor cliënt of derden.
                        </p>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-exclamation-triangle text-[#0c6885] mr-3"></i>
                            6. Aansprakelijkheid
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            De aansprakelijkheid van de coach is beperkt tot het bedrag van de betaalde sessie(s).
                            De coach is niet aansprakelijk voor indirecte schade of gevolgschade.
                        </p>

                        <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                            <i class="fas fa-gavel text-[#92c24f] mr-3"></i>
                            7. Geschillen
                        </h2>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            Op deze overeenkomst is Nederlands recht van toepassing. Geschillen worden voorgelegd aan de bevoegde rechter in Nederland.
                        </p>
                    </div>

                    <div class="mt-12 p-6 bg-gray-50 rounded-xl">
                        <div class="flex items-center mb-4">
                            <i class="fas fa-envelope text-[#0c6885] mr-3"></i>
                            <h3 class="text-lg font-semibold text-gray-900">Vragen over deze voorwaarden?</h3>
                        </div>
                        <p class="text-gray-600 mb-4">
                            Heb je vragen over deze algemene voorwaarden? Neem gerust contact op voor verduidelijking.
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
