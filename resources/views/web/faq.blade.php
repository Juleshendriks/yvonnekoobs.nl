@extends('web.layouts.web')

@section('content')
    <div class="bg-white">
        <!-- Hero Section -->
        <div class="relative bg-gradient-to-br from-green-50 via-white to-cyan-50">
            <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                        Veelgestelde vragen
                    </h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        Alles wat je wilt weten over coaching en hoe we kunnen samenwerken
                    </p>
                </div>
            </div>
        </div>

        <!-- Breadcrumb -->
        <div class="mx-auto max-w-4xl px-6 lg:px-8 py-4">
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
                            <span class="ml-4 text-sm font-medium text-gray-500">Veelgestelde vragen</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- FAQ Search -->
        <section class="py-16 bg-gray-50">
            <div class="mx-auto max-w-4xl px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Zoek in veelgestelde vragen</h2>
                    <div class="relative max-w-md mx-auto">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text"
                               id="faq-search"
                               placeholder="Zoek naar een vraag..."
                               class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-[#0c6885] focus:border-[#0c6885]">
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Content -->
        @if($faqs->count() > 0)
            <section class="py-20">
                <div class="mx-auto max-w-4xl px-6 lg:px-8">
                    <div id="faq-container" class="space-y-6">
                        @foreach($faqs->groupBy('category') as $category => $categoryFaqs)
                            <div class="faq-category" data-category="{{ $category }}">
                                <h3 class="text-xl font-bold text-gray-900 mb-6 pb-3 border-b-2 border-[#92c24f]">
                                    {{ ucfirst($category) }}
                                </h3>

                                <div class="space-y-4">
                                    @foreach($categoryFaqs as $index => $faq)
                                        <div class="faq-item bg-white rounded-xl shadow-sm border border-gray-200" data-category="{{ $faq->category }}">
                                            <button class="w-full px-6 py-5 text-left flex items-center justify-between hover:bg-gray-50 rounded-xl focus:outline-none focus:bg-gray-50 transition-colors duration-300"
                                                    onclick="toggleFaq('{{ $category }}-{{ $index }}')">
                                                <h4 class="text-lg font-semibold text-gray-900 pr-4 faq-question">{{ $faq->question }}</h4>
                                                <i class="fas fa-chevron-down text-gray-400 transition-transform duration-300 flex-shrink-0" id="chevron-{{ $category }}-{{ $index }}"></i>
                                            </button>
                                            <div class="px-6 pb-5 hidden" id="answer-{{ $category }}-{{ $index }}">
                                                <div class="text-gray-600 leading-relaxed faq-answer mt-4">
                                                    {!! nl2br(e($faq->answer)) !!}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- No results message -->
                    <div id="no-results" class="hidden text-center py-12">
                        <i class="fas fa-search text-4xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Geen resultaten gevonden</h3>
                        <p class="text-gray-600 mb-6">Probeer een andere zoekterm of bekijk alle categorieën.</p>
                        <button onclick="clearSearch()" class="inline-flex items-center px-4 py-2 bg-[#0c6885] text-white font-semibold rounded-lg hover:bg-[#0a5a73] transition-colors">
                            <i class="fas fa-times mr-2"></i>
                            Wis zoekopdracht
                        </button>
                    </div>
                </div>
            </section>
        @else
            <section class="py-20">
                <div class="mx-auto max-w-4xl px-6 lg:px-8 text-center">
                    <i class="fas fa-question-circle text-6xl text-gray-300 mb-6"></i>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Nog geen veelgestelde vragen</h2>
                    <p class="text-gray-600 mb-8">We werken aan het toevoegen van nuttige informatie. Heb je een vraag?</p>
                    <a href="{{ route('web.contact.create') }}" class="inline-flex items-center px-6 py-3 bg-[#0c6885] text-white font-semibold rounded-lg hover:bg-[#0a5a73] transition-colors">
                        <i class="fas fa-envelope mr-2"></i>
                        Stel je vraag
                    </a>
                </div>
            </section>
        @endif

        <!-- Help Section -->
        <section class="py-20 bg-gray-50">
            <div class="mx-auto max-w-4xl px-6 lg:px-8">
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-lightbulb text-white text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Antwoord niet gevonden?</h2>
                    <p class="text-lg text-gray-600 mb-8">
                        Geen probleem! Ik help je graag persoonlijk verder. Neem contact op voor al je vragen over coaching.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('web.contact.create') }}" class="inline-flex items-center px-6 py-3 bg-[#0c6885] text-white font-semibold rounded-lg hover:bg-[#0a5a73] transition-colors">
                            <i class="fas fa-envelope mr-2"></i>
                            Stuur een bericht
                        </a>
                        <a href="tel:+31612345678" class="inline-flex items-center px-6 py-3 border-2 border-[#0c6885] text-[#0c6885] font-semibold rounded-lg hover:bg-[#0c6885] hover:text-white transition-colors">
                            <i class="fas fa-phone mr-2"></i>
                            Bel direct
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JavaScript for FAQ functionality -->
    <script>
        function toggleFaq(id) {
            const answer = document.getElementById(`answer-${id}`);
            const chevron = document.getElementById(`chevron-${id}`);

            if (answer.classList.contains('hidden')) {
                answer.classList.remove('hidden');
                chevron.style.transform = 'rotate(180deg)';
            } else {
                answer.classList.add('hidden');
                chevron.style.transform = 'rotate(0deg)';
            }
        }

        function filterFAQs(category) {
            const items = document.querySelectorAll('.faq-item');
            const categories = document.querySelectorAll('.faq-category');
            const buttons = document.querySelectorAll('.faq-filter-btn');
            const noResults = document.getElementById('no-results');

            // Update active button
            buttons.forEach(btn => {
                btn.classList.remove('active', 'bg-[#0c6885]', 'text-white');
                btn.classList.add('text-[#0c6885]');
            });
            event.target.classList.add('active', 'bg-[#0c6885]', 'text-white');
            event.target.classList.remove('text-[#0c6885]');

            let visibleItems = 0;

            if (category === 'all') {
                categories.forEach(cat => cat.style.display = 'block');
                items.forEach(item => {
                    item.style.display = 'block';
                    visibleItems++;
                });
            } else {
                categories.forEach(cat => {
                    if (cat.dataset.category === category) {
                        cat.style.display = 'block';
                        const categoryItems = cat.querySelectorAll('.faq-item');
                        categoryItems.forEach(item => {
                            item.style.display = 'block';
                            visibleItems++;
                        });
                    } else {
                        cat.style.display = 'none';
                    }
                });
            }

            noResults.classList.toggle('hidden', visibleItems > 0);
        }

        function searchFAQs() {
            const searchTerm = document.getElementById('faq-search').value.toLowerCase();
            const items = document.querySelectorAll('.faq-item');
            const categories = document.querySelectorAll('.faq-category');
            const noResults = document.getElementById('no-results');

            let visibleItems = 0;

            categories.forEach(category => {
                let categoryHasVisible = false;
                const categoryItems = category.querySelectorAll('.faq-item');

                categoryItems.forEach(item => {
                    const question = item.querySelector('.faq-question').textContent.toLowerCase();
                    const answer = item.querySelector('.faq-answer').textContent.toLowerCase();

                    if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                        item.style.display = 'block';
                        categoryHasVisible = true;
                        visibleItems++;
                    } else {
                        item.style.display = 'none';
                    }
                });

                category.style.display = categoryHasVisible ? 'block' : 'none';
            });

            noResults.classList.toggle('hidden', visibleItems > 0);
        }

        function clearSearch() {
            document.getElementById('faq-search').value = '';
            searchFAQs();
        }

        // Event listeners
        document.getElementById('faq-search').addEventListener('input', searchFAQs);

        // Reset filter buttons when searching
        document.getElementById('faq-search').addEventListener('input', function() {
            const buttons = document.querySelectorAll('.faq-filter-btn');
            buttons.forEach(btn => {
                btn.classList.remove('active', 'bg-[#0c6885]', 'text-white');
                btn.classList.add('text-[#0c6885]');
            });
        });
    </script>
@endsection
