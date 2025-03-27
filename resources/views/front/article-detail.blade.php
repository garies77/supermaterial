@extends('layouts.main')

@section('title', $article->title . ' - Cozy Modern Furniture Store')

@section('content')
    <!-- Article Header -->
    <section class="pt-32 pb-8 md:pt-40 md:pb-12">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-3xl md:text-4xl font-bold mb-6">{{ $article->title }}</h1>
                <div class="flex items-center text-sm text-gray-500 mb-8">
                    <span>{{ $article->created_at->format('F d, Y') }}</span>
                    @if($article->reading_time)
                    <span class="mx-2">•</span>
                    <span>{{ $article->reading_time }} min read</span>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Image -->
    <section class="pb-12">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="aspect-[16/9] bg-gray-100 mb-12 overflow-hidden">
                <img src="{{ $article->featured_image }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="pb-16 md:pb-24">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12">
                <!-- Main Content -->
                <div class="md:col-span-8 md:col-start-3">
                    <div class="prose prose-lg max-w-none">
                        {!! $article->content !!}
                    </div>

                    <!-- Author -->
                    @if(isset($article->author) && $article->author)
                    <div class="mt-12 p-6 bg-gray-50 rounded-xl">
                        <div class="flex items-center">
                            @if(isset($article->author->image) && $article->author->image)
                            <img src="{{ $article->author->image }}" alt="{{ $article->author->name }}" class="w-16 h-16 rounded-full mr-4 object-cover">
                            @endif
                            <div>
                                <p class="font-medium">{{ $article->author->name }}</p>
                                <p class="text-sm text-gray-600">{{ $article->author->title ?? 'Writer' }}</p>
                            </div>
                        </div>
                        @if(isset($article->author->bio) && $article->author->bio)
                        <p class="mt-4 text-sm text-gray-600">{{ $article->author->bio }}</p>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Related Articles -->
    @if(count($relatedArticles) > 0)
    <section class="py-16 md:py-24 bg-gray-50">
        <div class="container mx-auto px-4 max-w-6xl">
            <h2 class="text-2xl font-bold mb-8">Related Articles</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                @foreach($relatedArticles as $relatedArticle)
                <div class="group">
                    <a href="{{ route('article.detail', $relatedArticle->slug) }}">
                        <div class="aspect-[4/3] bg-gray-100 mb-4 overflow-hidden">
                            <img src="{{ $relatedArticle->featured_image }}" alt="{{ $relatedArticle->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <h3 class="text-lg font-medium mb-2">{{ $relatedArticle->title }}</h3>
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $relatedArticle->excerpt }}</p>
                        <span class="text-sm text-gray-500">{{ $relatedArticle->created_at->format('F d, Y') }}</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Newsletter -->
    <section class="py-16 md:py-24">
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