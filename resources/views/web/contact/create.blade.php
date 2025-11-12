@extends('web.layouts.web')

@section('content')
    <div class="bg-white">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-green-50 via-white to-cyan-50 pt-16 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Contact opnemen
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Heb je een vraag of wil je meer weten over coaching? Ik help je graag verder.
                        @if($profile && $profile->naam)
                            Vul het formulier in en {{ $profile->naam }} neemt zo snel mogelijk contact met je op.
                        @else
                            Vul het formulier in en ik neem zo snel mogelijk contact met je op.
                        @endif
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
                            <span class="ml-4 text-sm font-medium text-gray-500">Contact</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Contact Form Section -->
        <section class="py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-16 items-start">
                    <!-- Contact Info -->
                    <div>
                        @if($profile && $profile->photo)
                            <div class="mb-8">
                                <div class="relative w-32 h-32 mx-auto lg:mx-0">
                                    <div class="absolute inset-0 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-2xl transform rotate-3"></div>
                                    <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->naam }}"
                                         class="relative w-full h-full rounded-2xl object-cover shadow-lg">
                                </div>
                            </div>
                        @endif

                        <div class="text-center lg:text-left mb-8">
                            @if($profile && $profile->naam)
                                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                                    Neem contact op met {{ $profile->naam }}
                                </h2>
                            @else
                                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                                    Laten we kennismaken
                                </h2>
                            @endif

                            <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                                @if($profile && $profile->introduction_description)
                                    {{ Str::limit($profile->introduction_description, 150) }}
                                @else
                                    Ik sta klaar om je te helpen bij je persoonlijke ontwikkeling en groei. Deel je verhaal en ontdek hoe coaching jouw leven kan veranderen.
                                @endif
                            </p>
                        </div>

                        <!-- Contact Methods -->
                        <div class="space-y-6">
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <div class="w-12 h-12 bg-[#0c6885]/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-envelope text-[#0c6885] text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-semibold text-gray-900">E-mail</h3>
                                    <p class="text-gray-600">
                                        <a href="mailto:{{ $profile->email ?? 'info@coach.nl' }}" class="text-[#0c6885] hover:text-[#0a5a73] transition-colors">
                                            {{ $profile->email ?? 'info@coach.nl' }}
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <div class="w-12 h-12 bg-[#92c24f]/20 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-phone text-[#92c24f] text-xl"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-semibold text-gray-900">Telefoon</h3>
                                    <p class="text-gray-600">
                                        <a href="tel:{{ $profile->telefoon ?? '+31612345678' }}" class="text-[#92c24f] hover:text-[#7da542] transition-colors">
                                            {{ $profile->telefoon ?? '06 - 12 34 56 78' }}
                                        </a>
                                    </p>
                                    <p class="text-sm text-gray-500">Ma-Vr 9:00-17:00</p>
                                </div>
                            </div>

                            @if($profile && $profile->adres)
                                <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                    <div class="w-12 h-12 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-map-marker-alt text-white text-xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="font-semibold text-gray-900">Locatie</h3>
                                        <p class="text-gray-600">{{ $profile->adres }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Response Time -->
                        <div class="mt-8 p-4 bg-gradient-to-r from-[#92c24f]/10 to-[#0c6885]/10 rounded-xl">
                            <div class="flex items-center">
                                <i class="fas fa-clock text-[#0c6885] mr-3"></i>
                                <div>
                                    <h4 class="font-semibold text-gray-900">Reactietijd</h4>
                                    <p class="text-gray-600">Meestal binnen 24 uur op werkdagen</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                        @if ($errors->any())
                            <div class="mb-6 rounded-xl bg-red-50 p-4 border border-red-200">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-circle text-red-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">
                                            Er zijn enkele problemen met je invoer
                                        </h3>
                                        <div class="mt-2 text-sm text-red-700">
                                            <ul role="list" class="list-disc space-y-1 pl-5">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="mb-6 rounded-xl bg-red-50 p-4 border border-red-200">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-circle text-red-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('web.contact.store') }}" method="POST" class="space-y-6">
                            @csrf

                            <!-- Honeypot field (hidden) -->
                            <input type="text" name="website" class="hidden" tabindex="-1" autocomplete="off">

                            <!-- Name Field -->
                            <div>
                                <label for="name" class="block text-sm font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-user text-[#0c6885] mr-2"></i>
                                    Naam <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    value="{{ old('name') }}"
                                    autocomplete="name"
                                    required
                                    class="block w-full rounded-xl border-0 px-4 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0c6885] transition-all @error('name') ring-red-500 focus:ring-red-500 @enderror"
                                    placeholder="Je volledige naam">
                                @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-envelope text-[#0c6885] mr-2"></i>
                                    E-mailadres <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    autocomplete="email"
                                    required
                                    class="block w-full rounded-xl border-0 px-4 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0c6885] transition-all @error('email') ring-red-500 focus:ring-red-500 @enderror"
                                    placeholder="je@email.com">
                                @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Subject Field -->
                            <div>
                                <label for="subject" class="block text-sm font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-tag text-[#0c6885] mr-2"></i>
                                    Onderwerp <span class="text-red-500">*</span>
                                </label>
                                <select
                                    name="subject"
                                    id="subject"
                                    required
                                    class="block w-full rounded-xl border-0 px-4 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-[#0c6885] transition-all @error('subject') ring-red-500 focus:ring-red-500 @enderror">
                                    <option value="">Kies een onderwerp</option>
                                    <option value="Algemene vraag" {{ old('subject') == 'Algemene vraag' ? 'selected' : '' }}>Algemene vraag</option>
                                    @foreach($coachingTypes as $type)
                                        <option value="{{ $type->title }}" {{ old('subject') == $type->title ? 'selected' : '' }}>{{ $type->title }}</option>
                                    @endforeach
                                    <option value="Kennismakingsgesprek" {{ old('subject') == 'Kennismakingsgesprek' ? 'selected' : '' }}>Kennismakingsgesprek</option>
                                    <option value="Tarieven en pakketten" {{ old('subject') == 'Tarieven en pakketten' ? 'selected' : '' }}>Tarieven en pakketten</option>
                                </select>
                                @error('subject')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Message Field -->
                            <div>
                                <label for="message" class="block text-sm font-semibold text-gray-900 mb-2">
                                    <i class="fas fa-comment text-[#0c6885] mr-2"></i>
                                    Bericht <span class="text-red-500">*</span>
                                </label>
                                <textarea
                                    name="message"
                                    id="message"
                                    rows="6"
                                    required
                                    class="block w-full rounded-xl border-0 px-4 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-[#0c6885] transition-all @error('message') ring-red-500 focus:ring-red-500 @enderror"
                                    placeholder="Vertel me meer over je situatie, je vragen of waar je hulp bij nodig hebt...">{{ old('message') }}</textarea>
                                @error('message')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-sm text-gray-500">
                                    <i class="fas fa-lightbulb text-[#92c24f] mr-1"></i>
                                    Deel gerust je achtergrond, doelen of specifieke uitdagingen. Hoe meer ik weet, hoe beter ik je kan helpen.
                                </p>
                            </div>

                            <!-- Privacy Notice -->
                            <div class="rounded-xl bg-gradient-to-r from-[#92c24f]/10 to-[#0c6885]/10 p-4 border border-[#0c6885]/20">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-shield-alt text-[#0c6885]"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-gray-800">
                                            <strong>Privacy:</strong> Je gegevens worden vertrouwelijk behandeld en alleen gebruikt om contact met je op te nemen.
                                            We delen je informatie nooit met derden.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div>
                                <button
                                    type="submit"
                                    class="w-full inline-flex items-center justify-center px-8 py-4 bg-[#0c6885] hover:bg-[#0a5a73] text-white font-semibold rounded-xl transition-colors duration-300 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-paper-plane mr-3"></i>
                                    Bericht versturen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Contact Section -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Waarom contact opnemen?</h2>
                <p class="text-xl text-gray-600 mb-12 max-w-2xl mx-auto">
                    Een eerste gesprek is altijd vrijblijvend en geeft ons beiden de kans om te kijken of we goed bij elkaar passen.
                </p>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <div class="w-12 h-12 bg-[#92c24f]/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-comments text-[#92c24f] text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Vrijblijvend gesprek</h3>
                        <p class="text-gray-600">
                            Geen verplichtingen, gewoon kennismaken en kijken of coaching iets voor jou is.
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <div class="w-12 h-12 bg-[#0c6885]/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-user-check text-[#0c6885] text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Persoonlijke match</h3>
                        <p class="text-gray-600">
                            Belangrijke klik tussen coach en cliënt. Alleen als het goed voelt, gaan we verder.
                        </p>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                        <div class="w-12 h-12 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-lg flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-route text-white text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Duidelijk plan</h3>
                        <p class="text-gray-600">
                            We bespreken jouw doelen en maken samen een plan dat bij jou past.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
