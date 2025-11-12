@extends('web.layouts.web')

@section('content')
    <div class="bg-white">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-green-50 via-white to-cyan-50 pt-16 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Digitale Downloads
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Ontdek mijn collectie van handige tools en Downloads. Van gratis werkboeken tot praktische checklists - alles om je verder te helpen op je ontwikkelingsreis.
                    </p>
                </div>
            </div>
        </section>

        <!-- Breadcrumb -->
        <div class="mx-auto max-w-7xl px-6 lg:px-8 py-6">
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
                            <span class="ml-4 text-sm font-medium text-gray-500">Downloads</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Products Grid -->
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if($products && $products->count() > 0)
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($products as $product)
                            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100 group overflow-hidden flex flex-col h-full">
                                <!-- Product Image -->
                                @if($product->featured_image_url)
                                    <div class="aspect-[4/3] w-full overflow-hidden">
                                        <img src="{{ $product->featured_image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                    </div>
                                @else
                                    <div class="aspect-[4/3] w-full bg-gradient-to-r from-[#92c24f] to-[#0c6885] flex items-center justify-center">
                                        <i class="fas fa-download text-white text-4xl"></i>
                                    </div>
                                @endif

                                <!-- Badges -->
                                <div class="absolute top-4 left-4 flex flex-col gap-2">
                                    @if($product->is_featured)
                                        <span class="bg-[#92c24f] text-white px-3 py-1.5 rounded-full text-sm font-bold shadow-lg">
                                            <i class="fas fa-star mr-1"></i>Populair
                                        </span>
                                    @endif
                                    @if($product->is_free)
                                        <span class="bg-[#0c6885] text-white px-3 py-1.5 rounded-full text-sm font-bold shadow-lg">
                                            <i class="fas fa-gift mr-1"></i>GRATIS
                                        </span>
                                    @endif
                                </div>

                                <!-- Price Badge -->
                                @if(!$product->is_free)
                                    <div class="absolute top-4 right-4">
                                        @if($product->hasDiscount())
                                            <div class="text-right">
                                                <span class="bg-red-500 text-white px-3 py-1.5 rounded-full text-sm font-bold block mb-1 shadow-lg">
                                                    -{{ $product->getDiscountPercentage() }}%
                                                </span>
                                                <span class="bg-[#0c6885] text-white px-3 py-1.5 rounded-full text-sm font-bold shadow-lg">
                                                    {{ $product->formatted_price }}
                                                </span>
                                            </div>
                                        @else
                                            <span class="bg-[#0c6885] text-white px-3 py-1.5 rounded-full text-sm font-bold shadow-lg">
                                                {{ $product->formatted_price }}
                                            </span>
                                        @endif
                                    </div>
                                @endif

                                <!-- Content -->
                                <div class="p-8 flex flex-col flex-grow">
                                    <!-- Title -->
                                    <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:text-[#0c6885] transition-colors">
                                        {{ $product->name }}
                                    </h3>

                                    <!-- Category -->
                                    @if($product->category)
                                        <p class="text-[#92c24f] mb-4 font-semibold">{{ $product->category }}</p>
                                    @endif

                                    <!-- Description -->
                                    <div class="flex-grow">
                                        @if($product->short_description)
                                            <p class="text-gray-600 mb-6 leading-relaxed">{{ Str::limit($product->short_description, 120) }}</p>
                                        @endif
                                    </div>

                                    <!-- Stats -->
                                    <div class="flex items-center gap-4 mb-6 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <i class="fas fa-download text-[#92c24f] mr-2"></i>
                                            <span>{{ number_format($product->download_count ?? 0) }} downloads</span>
                                        </div>
                                        @if($product->file_size)
                                            <div class="flex items-center">
                                                <i class="fas fa-file text-[#0c6885] mr-2"></i>
                                                <span>{{ $product->formatted_file_size }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Footer -->
                                    <div class="flex items-center justify-between mt-auto">
                                        <a href="{{ route('web.products.show', $product->slug) }}" class="inline-flex items-center text-[#0c6885] hover:text-[#0a5a73] font-semibold transition-colors duration-300 group">
                                            @if($product->is_free)
                                                Download nu
                                            @else
                                                Meer informatie
                                            @endif
                                            <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                                        </a>

                                        @if($product->reviews && $product->reviews->count() > 0)
                                            <div class="flex items-center text-sm text-gray-500">
                                                <i class="fas fa-star text-[#92c24f] mr-1"></i>
                                                <span>{{ $product->reviews->count() }} reviews</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($products->hasPages())
                        <div class="mt-12 flex justify-center">
                            {{ $products->links('pagination::tailwind') }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-20">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-download text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Downloads komen binnenkort</h3>
                        <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                            We werken hard aan het ontwikkelen van handige tools en Downloads voor jouw persoonlijke ontwikkeling. Schrijf je in voor de nieuwsbrief om op de hoogte te blijven.
                        </p>
                        <a href="{{ route('web.contact.create') }}" class="inline-flex items-center px-8 py-4 bg-[#0c6885] hover:bg-[#0a5a73] text-white font-semibold rounded-xl transition-colors duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-envelope mr-3"></i>
                            Neem contact op
                        </a>
                    </div>
                @endif
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-r from-[#92c24f] to-[#0c6885]">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-bold text-white mb-6">
                    Wil je persoonlijke begeleiding?
                </h2>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">
                    Downloads zijn een geweldige start, maar soms heb je persoonlijke begeleiding nodig om echt vooruitgang te boeken.
                    Ontdek hoe coaching jou kan helpen.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('web.coaching-types.index') }}" class="inline-flex items-center px-8 py-4 bg-white hover:bg-gray-100 text-[#0c6885] font-semibold rounded-xl transition-colors duration-300 shadow-lg">
                        <i class="fas fa-heart mr-3"></i>
                        Bekijk coaching aanbod
                    </a>
                    <a href="{{ route('web.contact.create') }}" class="inline-flex items-center px-8 py-4 bg-transparent hover:bg-white/10 text-white font-semibold rounded-xl border-2 border-white transition-colors duration-300">
                        <i class="fas fa-calendar-check mr-3"></i>
                        Plan een gesprek
                    </a>
                </div>
            </div>
        </section>
    </div>

    @push('styles')
        <style>
            .line-clamp-3 {
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        </style>
    @endpush
@endsection
