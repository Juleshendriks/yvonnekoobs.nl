<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env("APP_NAME")}}</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
          integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
          rel="stylesheet">
    <style>
        * {
            font-family: "Nunito", sans-serif;
        }
    </style>

    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/svg+xml" />


</head>
<body>
<header class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
    <nav aria-label="Global" class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8">
        <!-- Logo Section -->
        <div class="flex lg:flex-1">
            <a href="{{ route('web.home') }}" class="-m-1.5 p-1.5 flex items-center">
                <span class="sr-only">{{ $profile->naam ?? 'Coach' }}</span>
                <img src="{{asset('yk-logo.jpeg')}}" alt="" class="h-12 w-auto mr-3" />
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <div class="flex lg:hidden">
            <button type="button" command="show-modal" commandfor="mobile-menu"
                    class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700 hover:bg-gray-100 transition-colors">
                <span class="sr-only">Open main menu</span>
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <!-- Desktop Navigation -->
        <div class="hidden lg:flex lg:gap-x-8">
            <a href="{{route('web.home')}}"
               class="flex items-center text-sm font-semibold text-gray-700 hover:text-[#0c6885] transition-colors duration-200 px-3 py-2 rounded-lg hover:bg-gray-50">
                <i class="fas fa-home mr-2 text-[#0c6885]"></i>
                Home
            </a>
            <a href="{{route('web.about')}}"
               class="flex items-center text-sm font-semibold text-gray-700 hover:text-[#0c6885] transition-colors duration-200 px-3 py-2 rounded-lg hover:bg-gray-50">
                <i class="fas fa-user mr-2 text-[#0c6885]"></i>
                Over mij
            </a>
            <a href="{{route('web.coaching-types.index')}}"
               class="flex items-center text-sm font-semibold text-gray-700 hover:text-[#0c6885] transition-colors duration-200 px-3 py-2 rounded-lg hover:bg-gray-50">
                <i class="fas fa-heart mr-2 text-[#92c24f]"></i>
                Coaching
            </a>
            {{--            <a href="{{route('web.products.index')}}" class="flex items-center text-sm font-semibold text-gray-700 hover:text-[#0c6885] transition-colors duration-200 px-3 py-2 rounded-lg hover:bg-gray-50">--}}
            {{--                <i class="fas fa-download mr-2 text-[#92c24f]"></i>--}}
            {{--                Downloads--}}
            {{--            </a>--}}
            <a href="{{route('web.faq')}}"
               class="flex items-center text-sm font-semibold text-gray-700 hover:text-[#0c6885] transition-colors duration-200 px-3 py-2 rounded-lg hover:bg-gray-50">
                <i class="fas fa-question-circle mr-2 text-[#0c6885]"></i>
                FAQ
            </a>
        </div>

        <!-- CTA Button -->
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
            <a href="{{route('web.contact.create')}}"
               class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-[#92c24f] to-[#0c6885] text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-calendar-check mr-2"></i>
                Gratis kennismaking
            </a>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <el-dialog>
        <dialog id="mobile-menu" class="m-0 p-0 backdrop:bg-transparent lg:hidden">
            <div tabindex="0" class="fixed inset-0 focus:outline focus:outline-0">
                <el-dialog-panel
                    class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10 shadow-xl">
                    <!-- Mobile Menu Header -->
                    <div class="flex items-center justify-between border-b border-gray-200 pb-6">
                        <a href="{{ route('web.home') }}" class="-m-1.5 p-1.5 flex items-center">
                            <span class="sr-only">{{ $profile->naam ?? 'Coach' }}</span>
                            @if(isset($profile) && $profile->photo)
                                <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->naam }}"
                                     class="h-10 w-10 rounded-lg object-cover mr-3" />
                            @else
                                <img src="{{asset('yk-logo.jpeg')}}" alt="" class="h-10 w-auto mr-3" />
                            @endif
                            <div>
                                <div class="text-lg font-bold text-gray-900">
                                    {{ $profile->naam ?? 'Coaching' }}
                                </div>
                                <div class="text-sm text-[#0c6885] font-medium">
                                    Professioneel Coach
                                </div>
                            </div>
                        </a>
                        <button type="button" command="close" commandfor="mobile-menu"
                                class="-m-2.5 rounded-md p-2.5 text-gray-700 hover:bg-gray-100 transition-colors">
                            <span class="sr-only">Close menu</span>
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <!-- Mobile Menu Items -->
                    <div class="mt-6 flow-root">
                        <div class="space-y-2">
                            <a href="{{route('web.home')}}"
                               class="flex items-center rounded-lg px-4 py-3 text-base font-semibold text-gray-900 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-home mr-3 text-[#0c6885] w-5"></i>
                                Home
                            </a>
                            <a href="{{route('web.about')}}"
                               class="flex items-center rounded-lg px-4 py-3 text-base font-semibold text-gray-900 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-user mr-3 text-[#0c6885] w-5"></i>
                                Over mij
                            </a>
                            <a href="{{route('web.coaching-types.index')}}"
                               class="flex items-center rounded-lg px-4 py-3 text-base font-semibold text-gray-900 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-heart mr-3 text-[#92c24f] w-5"></i>
                                Coaching
                            </a>
                            {{--                            <a href="{{route('web.products.index')}}" class="flex items-center rounded-lg px-4 py-3 text-base font-semibold text-gray-900 hover:bg-gray-50 transition-colors">--}}
                            {{--                                <i class="fas fa-download mr-3 text-[#92c24f] w-5"></i>--}}
                            {{--                                Downloads--}}
                            {{--                            </a>--}}
                            <a href="{{route('web.faq')}}"
                               class="flex items-center rounded-lg px-4 py-3 text-base font-semibold text-gray-900 hover:bg-gray-50 transition-colors">
                                <i class="fas fa-question-circle mr-3 text-[#0c6885] w-5"></i>
                                FAQ
                            </a>

                            <!-- Mobile CTA -->
                            <div class="pt-6 border-t border-gray-200">
                                <a href="{{route('web.contact.create')}}"
                                   class="flex items-center justify-center w-full px-6 py-3 bg-gradient-to-r from-[#92c24f] to-[#0c6885] text-white font-semibold rounded-xl transition-all duration-300">
                                    <i class="fas fa-calendar-check mr-2"></i>
                                    Gratis kennismaking
                                </a>
                            </div>

                            <!-- Mobile Contact Info -->
                            <div class="pt-6 border-t border-gray-200">
                                <div class="space-y-3">
                                    <a href="tel:+31612345678"
                                       class="flex items-center text-gray-600 hover:text-[#0c6885] transition-colors">
                                        <i class="fas fa-phone mr-3 text-[#0c6885] w-5"></i>
                                        06 - 12 34 56 78
                                    </a>
                                    <a href="mailto:info@coach.nl"
                                       class="flex items-center text-gray-600 hover:text-[#0c6885] transition-colors">
                                        <i class="fas fa-envelope mr-3 text-[#0c6885] w-5"></i>
                                        info@coach.nl
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </el-dialog-panel>
            </div>
        </dialog>
    </el-dialog>
</header>

@if(session('success'))
    <div class="w-full bg-[#92c24f] p-4 text-white font-bold text-center">
        <p>{{session('success')}}</p>
    </div>
@endif
@yield('content')

<footer class="bg-white">
    <div class="mx-auto max-w-7xl px-6 pb-8 pt-20 sm:pt-24 lg:px-8 lg:pt-32">
        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <div class="grid grid-cols-2 gap-8 xl:col-span-2">
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <div>
                        <h3 class="text-sm/6 font-semibold text-gray-900">Coaching</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="{{ route('web.coaching-types.index') }}"
                                   class="text-sm/6 text-gray-600 hover:text-[#0c6885] transition-colors">Coaching
                                    Aanbod</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-10 md:mt-0">
                        <h3 class="text-sm/6 font-semibold text-gray-900">Ondersteuning</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="{{ route('web.contact.create') }}"
                                   class="text-sm/6 text-gray-600 hover:text-[#0c6885] transition-colors">Contact
                                    opnemen</a>
                            </li>
                            <li>
                                <a href="{{route('web.faq')}}"
                                   class="text-sm/6 text-gray-600 hover:text-[#0c6885] transition-colors">Veelgestelde
                                    vragen</a>
                            </li>
                            <li>
                                <a href="{{route('web.posts.index')}}"
                                   class="text-sm/6 text-gray-600 hover:text-[#0c6885] transition-colors">Blog</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <div>
                        <h3 class="text-sm/6 font-semibold text-gray-900">Informatie</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="{{ route('web.about') }}"
                                   class="text-sm/6 text-gray-600 hover:text-[#0c6885] transition-colors">Over mij</a>
                            </li>
                            <li>
                                <a href="{{ route('web.home') }}"
                                   class="text-sm/6 text-gray-600 hover:text-[#0c6885] transition-colors">Home</a>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-10 md:mt-0">
                        <h3 class="text-sm/6 font-semibold text-gray-900">Juridisch</h3>
                        <ul role="list" class="mt-6 space-y-4">
                            <li>
                                <a href="{{route('web.terms')}}"
                                   class="text-sm/6 text-gray-600 hover:text-[#0c6885] transition-colors">Algemene
                                    voorwaarden</a>
                            </li>
                            <li>
                                <a href="{{route('web.privacy')}}"
                                   class="text-sm/6 text-gray-600 hover:text-[#0c6885] transition-colors">Privacybeleid</a>
                            </li>
                            <li>
                                <a href="{{route('web.cookies')}}"
                                   class="text-sm/6 text-gray-600 hover:text-[#0c6885] transition-colors">Cookiebeleid</a>
                            </li>
                            <li>
                                <a href="{{route('web.disclaimer')}}"
                                   class="text-sm/6 text-gray-600 hover:text-[#0c6885] transition-colors">Disclaimer</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mt-10 xl:mt-0">
                <h3 class="text-sm/6 font-semibold text-gray-900">Blijf op de hoogte</h3>
                <p class="mt-2 text-sm/6 text-gray-600">Ontvang tips, inspiratie en updates over coaching rechtstreeks
                    in je mailbox.</p>
                <form class="mt-6 sm:flex sm:flex-col sm:max-w-md" action="{{route('web.newsletter.subscribe')}}" method="POST">
                    @csrf
                    <div class="flex flex-col gap-y-4">
                        <div>
                            <label for="name" class="sr-only">Naam</label>
                            <input id="name" type="text" name="text" required placeholder="Voer je naam in"
                                   class="w-full min-w-0 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-500 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-[#0c6885] sm:w-64 sm:text-sm/6 xl:w-full" />
                        </div>
                        <div>

                            <label for="email-address" class="sr-only">E-mailadres</label>
                            <input id="email-address" type="email" name="email" required
                                   placeholder="Voer je e-mailadres in" autocomplete="email"
                                   class="w-full min-w-0 rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-500 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-[#0c6885] sm:w-64 sm:text-sm/6 xl:w-full" />
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit"
                                class="flex w-full items-center justify-center rounded-md bg-[#0c6885] px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#0a5a73] focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#0c6885] transition-colors">
                            <i class="fas fa-envelope mr-2"></i>
                            Aanmelden
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div
            class="mt-16 border-t border-gray-900/10 pt-8 sm:mt-20 md:flex md:items-center md:justify-between lg:mt-24">
            <div class="flex gap-x-6 md:order-2">
                {{--                <a href="#" class="text-gray-600 hover:text-[#0c6885] transition-colors">--}}
                {{--                    <span class="sr-only">Facebook</span>--}}
                {{--                    <i class="fab fa-facebook text-xl"></i>--}}
                {{--                </a>--}}
                {{--                <a href="#" class="text-gray-600 hover:text-[#0c6885] transition-colors">--}}
                {{--                    <span class="sr-only">Instagram</span>--}}
                {{--                    <i class="fab fa-instagram text-xl"></i>--}}
                {{--                </a>--}}
                <a href="https://www.linkedin.com/in/ikcoachingyvonnekoobs" target="_blank"
                   class="text-gray-600 hover:text-[#0c6885] transition-colors">
                    <span class="sr-only">LinkedIn</span>
                    <i class="fab fa-linkedin text-xl"></i>
                </a>
                {{--                <a href="#" class="text-gray-600 hover:text-[#0c6885] transition-colors">--}}
                {{--                    <span class="sr-only">YouTube</span>--}}
                {{--                    <i class="fab fa-youtube text-xl"></i>--}}
                {{--                </a>--}}
                {{--                <a href="#" class="text-gray-600 hover:text-[#0c6885] transition-colors">--}}
                {{--                    <span class="sr-only">WhatsApp</span>--}}
                {{--                    <i class="fab fa-whatsapp text-xl"></i>--}}
                {{--                </a>--}}
            </div>
            <p class="mt-8 text-sm/6 text-gray-600 md:order-1 md:mt-0">
                &copy; {{ now()->year }} <span class="font-semibold">{{ $profile->naam ?? 'Coaching' }}</span>. Alle
                rechten voorbehouden.
            </p>
        </div>
    </div>
</footer>
</body>
</html>
