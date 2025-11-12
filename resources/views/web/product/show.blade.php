@extends('web.layouts.web')

@section('content')
    <div class="bg-white">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-green-50 via-white to-cyan-50 pt-16 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        {{ $product->name }}
                    </h1>
                    @if($product->short_description)
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                            {{ $product->short_description }}
                        </p>
                    @endif
                </div>
            </div>
        </section>

        <!-- Breadcrumb -->
        <div class="mx-auto max-w-4xl px-6 lg:px-8 py-6">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li>
                        <div>
                            <a href="{{ route('web.home') }}"
                               class="text-gray-400 hover:text-[#0c6885] transition-colors">
                                <i class="fas fa-home" aria-hidden="true"></i>
                                <span class="sr-only">Home</span>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-300 text-sm" aria-hidden="true"></i>
                            <a href="{{ route('web.products.index') }}"
                               class="ml-4 text-sm font-medium text-gray-500 hover:text-[#0c6885] transition-colors">
                                Downloads
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-300 text-sm" aria-hidden="true"></i>
                            <span class="ml-4 text-sm font-medium text-gray-500">{{ $product->name }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Main Content -->
        <section class="py-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Badges -->
                <div class="flex flex-wrap gap-3 mb-12">
                    @if($product->is_featured)
                        <span class="bg-[#92c24f] text-white px-4 py-2 rounded-full text-sm font-semibold">
                            <i class="fas fa-star mr-2"></i>Populair
                        </span>
                    @endif
                    @if($product->is_free)
                        <span class="bg-[#0c6885] text-white px-4 py-2 rounded-full text-sm font-semibold">
                            <i class="fas fa-gift mr-2"></i>Gratis
                        </span>
                    @endif
                    @if($product->category)
                        <span class="bg-gray-100 text-gray-800 px-4 py-2 rounded-full text-sm font-medium">
                            {{ $product->category }}
                        </span>
                    @endif
                </div>

                <!-- Product Description -->
                @if($product->description)
                    <div class="prose prose-lg max-w-none mb-16 text-gray-600 leading-relaxed">
                        {!! nl2br(e($product->description)) !!}
                    </div>
                @endif

                <!-- Download Section -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100 mb-16">
                    <div class="text-center">
                        <div
                            class="w-20 h-20 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-download text-white text-3xl"></i>
                        </div>

                        <h2 class="text-3xl font-bold text-gray-900 mb-4">Download {{ $product->name }}</h2>

                        @if($product->is_free)
                            <p class="text-xl text-[#92c24f] font-semibold mb-6">Volledig gratis</p>
                        @else
                            <p class="text-xl text-gray-600 mb-6">{{ $product->formatted_price }}</p>
                        @endif

                        @auth
                            <form action="#" method="POST">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center px-8 py-4 bg-[#0c6885] hover:bg-[#0a5a73] text-white font-semibold rounded-xl transition-colors duration-300 shadow-lg hover:shadow-xl text-lg">
                                    <i class="fas fa-download mr-3"></i>
                                    @if($product->is_free)
                                        Download nu gratis
                                    @else
                                        Download voor {{ $product->formatted_price }}
                                    @endif
                                </button>
                            </form>
                        @else
                            <a href="{{ route('filament.customer.pages.dashboard') }}"
                               class="inline-flex items-center px-8 py-4 bg-[#0c6885] hover:bg-[#0a5a73] text-white font-semibold rounded-xl transition-colors duration-300 shadow-lg hover:shadow-xl text-lg">
                                <i class="fas fa-lock mr-3"></i>
                                Log in om te downloaden
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Essential Product Details Only -->
                <div class="grid md:grid-cols-2 gap-8 mb-16">
                    <div class="space-y-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Product informatie</h3>

                        @if($product->file_type)
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <div class="w-12 h-12 bg-[#0c6885]/20 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-file-alt text-[#0c6885]"></i>
                                </div>
                                <div>
                                    <dt class="font-semibold text-gray-900">Bestandstype</dt>
                                    <dd class="text-gray-600">{{ strtoupper($product->file_type) }}</dd>
                                </div>
                            </div>
                        @endif

                        <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                            <div class="w-12 h-12 bg-[#0c6885]/20 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-calendar text-[#0c6885]"></i>
                            </div>
                            <div>
                                <dt class="font-semibold text-gray-900">Gepubliceerd</dt>
                                <dd class="text-gray-600">{{ $product->published_at->format('j F Y') }}</dd>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Populariteit</h3>

                        <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                            <div class="w-12 h-12 bg-[#92c24f]/20 rounded-lg flex items-center justify-center mr-4">
                                <i class="fas fa-download text-[#92c24f]"></i>
                            </div>
                            <div>
                                <dt class="font-semibold text-gray-900">Downloads</dt>
                                <dd class="text-gray-600">{{ number_format($product->download_count) }} keer
                                    gedownload
                                </dd>
                            </div>
                        </div>

                        @if($product->reviews && $product->reviews->count() > 0)
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <div class="w-12 h-12 bg-[#92c24f]/20 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-star text-[#92c24f]"></i>
                                </div>
                                <div>
                                    <dt class="font-semibold text-gray-900">Beoordeling</dt>
                                    <dd class="text-gray-600">{{ $product->reviews->count() }} reviews</dd>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tags -->
                @if($product->tags && count($product->tags) > 0)
                    <div class="mb-16">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Onderwerpen</h3>
                        <div class="flex flex-wrap gap-3">
                            @foreach($product->tags as $tag)
                                <span
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-full text-sm font-medium transition-colors">
                                    {{ ucfirst($tag) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- CTA -->
                <div class="bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-2xl p-8 text-center text-white">
                    <h3 class="text-2xl font-bold mb-4">Klaar om te beginnen?</h3>
                    <p class="text-lg mb-6 text-white/90">
                        Download dit product en begin direct met je persoonlijke ontwikkeling.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @auth
                            <form action="#" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center px-6 py-3 bg-white hover:bg-gray-100 text-[#0c6885] font-semibold rounded-xl transition-colors duration-300 shadow-lg">
                                    <i class="fas fa-download mr-2"></i>
                                    @if($product->is_free)
                                        Download gratis
                                    @else
                                        Download nu
                                    @endif
                                </button>
                            </form>
                        @else
                            <a href="{{ route('filament.customer.pages.dashboard') }}"
                               class="inline-flex items-center px-6 py-3 bg-white hover:bg-gray-100 text-[#0c6885] font-semibold rounded-xl transition-colors duration-300 shadow-lg">
                                <i class="fas fa-sign-in-alt mr-2"></i>
                                Log in om te downloaden
                            </a>
                        @endauth
                        <a href="{{ route('web.contact.create') }}"
                           class="inline-flex items-center px-6 py-3 bg-transparent hover:bg-white/10 text-white font-semibold rounded-xl border-2 border-white transition-colors duration-300">
                            <i class="fas fa-question-circle mr-2"></i>
                            Stel een vraag
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Reviews Section -->
        @if($product->reviews && $product->reviews->count() > 0)
            <section class="py-20 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-bold text-gray-900 mb-4">Ervaringen</h2>
                        <p class="text-xl text-gray-600">Wat anderen zeggen over dit product</p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        @foreach($product->reviews as $review)
                            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                                <!-- Star Rating -->
                                <div class="flex gap-1 mb-4">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-[#92c24f]' : 'text-gray-300' }}"></i>
                                    @endfor
                                </div>

                                <!-- Review Content -->
                                <p class="text-gray-600 mb-6 leading-relaxed italic">
                                    "{{ $review->review }}"
                                </p>

                                <!-- Reviewer Info -->
                                <div class="flex items-center">
                                    @if($review->avatar)
                                        <img class="w-12 h-12 rounded-full object-cover mr-4"
                                             src="{{ asset('storage/' . $review->avatar) }}" alt="{{ $review->name }}">
                                    @else
                                        <div
                                            class="w-12 h-12 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-full flex items-center justify-center mr-4">
                                            <span
                                                class="text-white font-semibold">{{ substr($review->name, 0, 1) }}</span>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $review->name }}</div>
                                        @if($review->company)
                                            <div class="text-sm text-gray-600">{{ $review->company }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Trust & Security -->
        <section class="py-20 bg-white">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <h3 class="text-2xl font-bold text-gray-900 mb-8 text-center">Waarom voor ons kiezen?</h3>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-[#92c24f]/20 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-shield-alt text-[#92c24f] text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Veilig downloaden</h4>
                        <p class="text-gray-600">Alle bestanden zijn veilig en virusscan gecontroleerd</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-[#0c6885]/20 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-bolt text-[#0c6885] text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Direct toegang</h4>
                        <p class="text-gray-600">Onmiddellijke download na aanmelding</p>
                    </div>
                    <div class="text-center">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-life-ring text-white text-2xl"></i>
                        </div>
                        <h4 class="font-semibold text-gray-900 mb-2">Ondersteuning</h4>
                        <p class="text-gray-600">Hulp bij vragen over het product</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Related Products -->
        @php
            $relatedProducts = \App\Models\Product::active()
                ->published()
                ->where('id', '!=', $product->id)
                ->when($product->category, function($query) use ($product) {
                    $query->where('category', $product->category);
                })
                ->ordered()
                ->limit(3)
                ->get();
        @endphp

        @if($relatedProducts->count() > 0)
            <section class="py-20 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-bold text-gray-900 mb-4">Andere handige Downloads</h2>
                        <p class="text-xl text-gray-600">Misschien vind je deze ook interessant</p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        @foreach($relatedProducts as $related)
                            <div
                                class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100 group overflow-hidden flex flex-col h-full">
                                @if($related->featured_image_url)
                                    <div class="aspect-[4/3] w-full overflow-hidden">
                                        <img src="{{ $related->featured_image_url }}" alt="{{ $related->name }}"
                                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                    </div>
                                @else
                                    <div
                                        class="aspect-[4/3] w-full bg-gradient-to-r from-[#92c24f] to-[#0c6885] flex items-center justify-center">
                                        <i class="fas fa-download text-white text-4xl"></i>
                                    </div>
                                @endif

                                <div class="p-6 flex flex-col flex-grow">
                                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#0c6885] transition-colors">
                                        {{ $related->name }}
                                    </h3>

                                    @if($related->category)
                                        <p class="text-[#92c24f] mb-3 font-medium text-sm">{{ $related->category }}</p>
                                    @endif

                                    @if($related->short_description)
                                        <p class="text-gray-600 mb-4 leading-relaxed flex-grow">
                                            {{ Str::limit($related->short_description, 100) }}
                                        </p>
                                    @endif

                                    <div class="mt-auto">
                                        <a href="{{ route('web.products.show', $related->slug) }}"
                                           class="inline-flex items-center text-[#0c6885] hover:text-[#0a5a73] font-semibold transition-colors duration-300">
                                            Bekijk product
                                            <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="text-center mt-12">
                        <a href="{{ route('web.products.index') }}"
                           class="inline-flex items-center px-6 py-3 bg-white hover:bg-gray-50 text-[#0c6885] font-semibold rounded-xl border-2 border-[#0c6885] transition-colors duration-300">
                            Alle Downloads bekijken
                        </a>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection
