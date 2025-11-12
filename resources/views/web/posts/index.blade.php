@extends('web.layouts.web')

@section('content')
    <div class="bg-white">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-green-50 via-white to-cyan-50 pt-16 pb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Blog & Inspiratie
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Ontdek inspirerende artikelen, praktische tips en waardevolle inzichten voor jouw persoonlijke ontwikkeling en groei.
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
                            <span class="ml-4 text-sm font-medium text-gray-500">Blog</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Posts Grid -->
        <section class="py-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @if($posts && $posts->count() > 0)
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($posts as $post)
                            <article class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100 group overflow-hidden flex flex-col h-full">
                                <!-- Featured Image -->
                                @if($post->featured_image)
                                    <div class="aspect-[16/9] w-full overflow-hidden">
                                        <img src="{{ asset('storage/' . $post->featured_image) }}"
                                             alt="{{ $post->title }}"
                                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                    </div>
                                @else
                                    <div class="aspect-[16/9] w-full bg-gradient-to-r from-[#92c24f] to-[#0c6885] flex items-center justify-center">
                                        <i class="fas fa-pen-fancy text-white text-4xl"></i>
                                    </div>
                                @endif

                                <!-- Badges -->
                                <div class="absolute top-4 left-4 flex flex-col gap-2">
                                    @if($post->is_featured)
                                        <span class="bg-[#92c24f] text-white px-3 py-1.5 rounded-full text-sm font-bold shadow-lg">
                                            <i class="fas fa-star mr-1"></i>Uitgelicht
                                        </span>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div class="p-8 flex flex-col flex-grow">
                                    <!-- Meta Info -->
                                    <div class="flex items-center gap-4 mb-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar text-[#0c6885] mr-2"></i>
                                            <time datetime="{{ $post->published_at->format('Y-m-d') }}">
                                                {{ $post->published_at->format('j F Y') }}
                                            </time>
                                        </div>
                                        @if($post->view_count > 0)
                                            <div class="flex items-center">
                                                <i class="fas fa-eye text-[#92c24f] mr-2"></i>
                                                <span>{{ number_format($post->view_count) }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Category -->
                                    @if($post->category)
                                        <p class="text-[#92c24f] mb-3 font-semibold text-sm">{{ $post->category }}</p>
                                    @endif

                                    <!-- Title -->
                                    <h2 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-[#0c6885] transition-colors leading-tight">
                                        <a href="{{ route('web.posts.show', $post->slug) }}">
                                            {{ $post->title }}
                                        </a>
                                    </h2>

                                    <!-- Excerpt -->
                                    <div class="flex-grow">
                                        @if($post->excerpt)
                                            <p class="text-gray-600 mb-6 leading-relaxed">
                                                {{ Str::limit($post->excerpt, 150) }}
                                            </p>
                                        @endif
                                    </div>

                                    <!-- Footer -->
                                    <div class="flex items-center justify-between mt-auto pt-6 border-t border-gray-100">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-full flex items-center justify-center mr-3">
                                                <span class="text-white font-semibold text-sm">
                                                    {{ substr($post->user->name ?? 'A', 0, 1) }}
                                                </span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $post->user->name ?? 'Admin' }}</p>
                                            </div>
                                        </div>

                                        <a href="{{ route('web.posts.show', $post->slug) }}"
                                           class="inline-flex items-center text-[#0c6885] hover:text-[#0a5a73] font-semibold transition-colors duration-300 group">
                                            Lees meer
                                            <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($posts->hasPages())
                        <div class="mt-12 flex justify-center">
                            {{ $posts->links('pagination::tailwind') }}
                        </div>
                    @endif
                @else
                    <!-- Empty State -->
                    <div class="text-center py-20">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-pen-fancy text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Nog geen blog posts</h3>
                        <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                            We zijn druk bezig met het schrijven van inspirerende content. Kom binnenkort terug voor waardevolle inzichten en praktische tips.
                        </p>
                        <a href="{{ route('web.contact.create') }}"
                           class="inline-flex items-center px-8 py-4 bg-[#0c6885] hover:bg-[#0a5a73] text-white font-semibold rounded-xl transition-colors duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-envelope mr-3"></i>
                            Neem contact op
                        </a>
                    </div>
                @endif
            </div>
        </section>

        <!-- Newsletter CTA -->
        <section class="py-20 bg-gradient-to-r from-[#92c24f] to-[#0c6885]">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl font-bold text-white mb-6">
                    Mis geen enkel artikel
                </h2>
                <p class="text-xl text-white/90 mb-8 leading-relaxed">
                    Ontvang de nieuwste blog posts en exclusieve tips direct in je inbox.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('web.contact.create') }}"
                       class="inline-flex items-center px-8 py-4 bg-white hover:bg-gray-100 text-[#0c6885] font-semibold rounded-xl transition-colors duration-300 shadow-lg">
                        <i class="fas fa-envelope mr-3"></i>
                        Schrijf je in
                    </a>
                    <a href="{{ route('web.coaching-types.index') }}"
                       class="inline-flex items-center px-8 py-4 bg-transparent hover:bg-white/10 text-white font-semibold rounded-xl border-2 border-white transition-colors duration-300">
                        <i class="fas fa-heart mr-3"></i>
                        Bekijk coaching
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
