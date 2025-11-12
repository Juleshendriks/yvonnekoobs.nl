@extends('web.layouts.web')

@section('content')
    <div class="bg-white">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-green-50 via-white to-cyan-50 pt-16 pb-20">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <!-- Category Badge -->
                    @if($post->category)
                        <div class="mb-6">
                            <span class="bg-[#92c24f] text-white px-4 py-2 rounded-full text-sm font-semibold">
                                {{ $post->category }}
                            </span>
                        </div>
                    @endif

                    <!-- Title -->
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        {{ $post->title }}
                    </h1>

                    <!-- Meta Info -->
                    <div class="flex items-center justify-center gap-6 text-gray-600">
                        <div class="flex items-center">
                            <i class="fas fa-user-circle text-[#0c6885] mr-2"></i>
                            <span>{{ $post->user->name ?? 'Admin' }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-calendar text-[#0c6885] mr-2"></i>
                            <time datetime="{{ $post->published_at->format('Y-m-d') }}">
                                {{ $post->published_at->format('j F Y') }}
                            </time>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-eye text-[#92c24f] mr-2"></i>
                            <span>{{ number_format($post->view_count) }} weergaven</span>
                        </div>
                    </div>
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
                            <a href="{{ route('web.posts.index') }}"
                               class="ml-4 text-sm font-medium text-gray-500 hover:text-[#0c6885] transition-colors">
                                Blog
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-300 text-sm" aria-hidden="true"></i>
                            <span class="ml-4 text-sm font-medium text-gray-500">{{ Str::limit($post->title, 50) }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <!-- Main Content -->
        <article class="py-12">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Featured Image -->
                @if($post->featured_image)
                    <div class="mb-12 rounded-2xl overflow-hidden shadow-xl">
                        <img src="{{ asset('storage/' . $post->featured_image) }}"
                             alt="{{ $post->title }}"
                             class="w-full h-auto">
                    </div>
                @endif

                <!-- Excerpt -->
                @if($post->excerpt)
                    <div class="mb-12">
                        <p class="text-xl text-gray-700 leading-relaxed font-medium">
                            {{ $post->excerpt }}
                        </p>
                    </div>
                @endif

                <!-- Content -->
                <div class="prose prose-lg max-w-none mb-16">
                    {!! $post->content !!}
                </div>

                <!-- Tags -->
                @if($post->tags && count($post->tags) > 0)
                    <div class="mb-16 pt-8 border-t border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Tags</h3>
                        <div class="flex flex-wrap gap-3">
                            @foreach($post->tags as $tag)
                                <span class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-full text-sm font-medium transition-colors">
                                    <i class="fas fa-tag mr-2"></i>{{ ucfirst($tag) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Author Bio -->
                <div class="bg-gradient-to-r from-green-50 to-cyan-50 rounded-2xl p-8 mb-16">
                    <div class="flex items-start gap-6">
                        <div class="w-20 h-20 bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-white font-bold text-2xl">
                                {{ substr($post->user->name ?? 'A', 0, 1) }}
                            </span>
                        </div>
                        <div class="flex-grow">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Geschreven door {{ $post->user->name ?? 'Admin' }}</h3>
                            <p class="text-gray-600 leading-relaxed mb-4">
                                Expert in persoonlijke ontwikkeling en coaching. Gepassioneerd over het helpen van mensen om hun volledige potentieel te bereiken.
                            </p>
                            <a href="{{ route('web.contact.create') }}"
                               class="inline-flex items-center text-[#0c6885] hover:text-[#0a5a73] font-semibold transition-colors">
                                Neem contact op
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>

{{--                <!-- Share Buttons -->--}}
{{--                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 mb-16">--}}
{{--                    <h3 class="text-lg font-bold text-gray-900 mb-4">Deel dit artikel</h3>--}}
{{--                    <div class="flex flex-wrap gap-3">--}}
{{--                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('web.posts.show', $post->slug)) }}"--}}
{{--                           target="_blank"--}}
{{--                           class="inline-flex items-center px-4 py-2 bg-[#1877F2] hover:bg-[#0c63d4] text-white font-medium rounded-lg transition-colors">--}}
{{--                            <i class="fab fa-facebook-f mr-2"></i>--}}
{{--                            Facebook--}}
{{--                        </a>--}}
{{--                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('web.posts.show', $post->slug)) }}&text={{ urlencode($post->title) }}"--}}
{{--                           target="_blank"--}}
{{--                           class="inline-flex items-center px-4 py-2 bg-[#1DA1F2] hover:bg-[#0c8bd9] text-white font-medium rounded-lg transition-colors">--}}
{{--                            <i class="fab fa-twitter mr-2"></i>--}}
{{--                            Twitter--}}
{{--                        </a>--}}
{{--                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(route('web.posts.show', $post->slug)) }}"--}}
{{--                           target="_blank"--}}
{{--                           class="inline-flex items-center px-4 py-2 bg-[#0077B5] hover:bg-[#005f94] text-white font-medium rounded-lg transition-colors">--}}
{{--                            <i class="fab fa-linkedin-in mr-2"></i>--}}
{{--                            LinkedIn--}}
{{--                        </a>--}}
{{--                        <button onclick="copyToClipboard()"--}}
{{--                                class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">--}}
{{--                            <i class="fas fa-link mr-2"></i>--}}
{{--                            Kopieer link--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <!-- CTA -->
                <div class="bg-gradient-to-r from-[#92c24f] to-[#0c6885] rounded-2xl p-8 text-center text-white mb-16">
                    <h3 class="text-2xl font-bold mb-4">Klaar voor persoonlijke groei?</h3>
                    <p class="text-lg mb-6 text-white/90">
                        Ontdek hoe coaching jou kan helpen om je doelen te bereiken en je potentieel te benutten.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('web.coaching-types.index') }}"
                           class="inline-flex items-center px-6 py-3 bg-white hover:bg-gray-100 text-[#0c6885] font-semibold rounded-xl transition-colors duration-300 shadow-lg">
                            <i class="fas fa-heart mr-2"></i>
                            Bekijk coaching
                        </a>
                        <a href="{{ route('web.contact.create') }}"
                           class="inline-flex items-center px-6 py-3 bg-transparent hover:bg-white/10 text-white font-semibold rounded-xl border-2 border-white transition-colors duration-300">
                            <i class="fas fa-calendar-check mr-2"></i>
                            Plan een gesprek
                        </a>
                    </div>
                </div>
            </div>
        </article>

        <!-- Related Posts -->
        @php
            $relatedPosts = \App\Models\Post::where('is_published', true)
                ->where('published_at', '<=', now())
                ->where('id', '!=', $post->id)
                ->when($post->category, function($query) use ($post) {
                    $query->where('category', $post->category);
                })
                ->orderBy('published_at', 'desc')
                ->limit(3)
                ->get();
        @endphp

        @if($relatedPosts->count() > 0)
            <section class="py-20 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-bold text-gray-900 mb-4">Meer artikelen</h2>
                        <p class="text-xl text-gray-600">Dit vind je misschien ook interessant</p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        @foreach($relatedPosts as $related)
                            <article class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100 group overflow-hidden flex flex-col h-full">
                                @if($related->featured_image)
                                    <div class="aspect-[16/9] w-full overflow-hidden">
                                        <img src="{{ asset('storage/' . $related->featured_image) }}"
                                             alt="{{ $related->title }}"
                                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                                    </div>
                                @else
                                    <div class="aspect-[16/9] w-full bg-gradient-to-r from-[#92c24f] to-[#0c6885] flex items-center justify-center">
                                        <i class="fas fa-pen-fancy text-white text-4xl"></i>
                                    </div>
                                @endif

                                <div class="p-6 flex flex-col flex-grow">
                                    @if($related->category)
                                        <p class="text-[#92c24f] mb-3 font-medium text-sm">{{ $related->category }}</p>
                                    @endif

                                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-[#0c6885] transition-colors">
                                        {{ $related->title }}
                                    </h3>

                                    @if($related->excerpt)
                                        <p class="text-gray-600 mb-4 leading-relaxed flex-grow">
                                            {{ Str::limit($related->excerpt, 100) }}
                                        </p>
                                    @endif

                                    <div class="mt-auto">
                                        <a href="{{ route('web.posts.show', $related->slug) }}"
                                           class="inline-flex items-center text-[#0c6885] hover:text-[#0a5a73] font-semibold transition-colors duration-300">
                                            Lees meer
                                            <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="text-center mt-12">
                        <a href="{{ route('web.posts.index') }}"
                           class="inline-flex items-center px-6 py-3 bg-white hover:bg-gray-50 text-[#0c6885] font-semibold rounded-xl border-2 border-[#0c6885] transition-colors duration-300">
                            Alle artikelen bekijken
                        </a>
                    </div>
                </div>
            </section>
        @endif
    </div>

    @push('scripts')
        <script>
            function copyToClipboard() {
                const url = window.location.href;
                navigator.clipboard.writeText(url).then(() => {
                    alert('Link gekopieerd naar klembord!');
                }).catch(err => {
                    console.error('Kon link niet kopiëren: ', err);
                });
            }
        </script>
    @endpush
@endsection
