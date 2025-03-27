@extends('layouts.main')

@section('title', 'Articles - Cozy Modern Furniture Store')

@section('content')
    <!-- Articles Header -->
    <section class="pt-32 pb-12 md:pt-40 md:pb-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-6xl">
            <h1 class="text-3xl md:text-5xl font-bold mb-6">Inspiration & Guides</h1>
            <p class="text-xl text-gray-600 max-w-3xl">Explore our articles for design inspiration and practical guides to transform your space.</p>
        </div>
    </section>

    <!-- Articles Grid -->
    <section class="py-12 md:py-16">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="space-y-12">
                @forelse($articles as $article)
                <article class="group">
                    <a href="{{ route('article.detail', $article->slug) }}" class="grid md:grid-cols-3 gap-6">
                        <div class="aspect-[4/3] bg-gray-100 overflow-hidden">
                            <img src="{{ $article->featured_image }}" 
                                 alt="{{ $article->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="md:col-span-2">
                            <h2 class="text-xl font-medium mb-2 group-hover:text-gray-600 transition-colors">{{ $article->title }}</h2>
                            <p class="text-gray-600 mb-4 line-clamp-2">{{ $article->excerpt }}</p>
                            <div class="flex items-center text-sm text-gray-500">
                                <span>{{ $article->created_at->format('F d, Y') }}</span>
                                @if($article->reading_time)
                                <span class="mx-2">•</span>
                                <span>{{ $article->reading_time }} min read</span>
                                @endif
                            </div>
                        </div>
                    </a>
                </article>
                @empty
                <div class="text-center py-12">
                    <p class="text-gray-600">No articles found. Please check back later for new content.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $articles->links() }}
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="max-w-xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-4">Subscribe to Our Blog</h2>
                <p class="text-gray-600 mb-8">Get our latest articles and design inspiration delivered straight to your inbox.</p>
                <form class="flex flex-col md:flex-row gap-4">
                    <input type="email" placeholder="Your email address" class="px-4 py-3 bg-white border border-gray-300 rounded-full flex-grow focus:outline-none focus:ring-2 focus:ring-black">
                    <button type="submit" class="px-6 py-3 bg-black text-white font-medium rounded-full hover:bg-gray-800 transition">Subscribe</button>
                </form>
            </div>
        </div>
    </section>
@endsection 