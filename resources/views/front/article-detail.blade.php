@extends('layouts.main')

@section('title', $article->title . ' - Cozy Modern Furniture Store')

@section('content')

    <!-- Breadcrumb -->
    <div class="container mx-auto max-w-5xl pt-24 pb-4">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <a href="{{ route('articles') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Articles</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Article Header -->
    <section class="pt-4  md:pt-4">

        <div class="container px-4 max-w-8xl">
            <div class="max-w-3xl mx-auto">
                <h1 class="text-xl md:text-4xl mb-2">{{ $article->title }}</h1>
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
        <div class="container mx-auto max-w-5xl">
            <div class="aspect-[16/9] bg-gray-100 mb-12 overflow-hidden rounded-md">
                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="pb-16 md:pb-24">
        <div class="container mx-auto px-4 max-w-5xl">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12">
                <!-- Main Content -->
                <div class="md:col-span-8 md:col-start-3">
                    <div class="prose prose-lg max-w-none leading-10 text-gray-500">
                        {!! $article->content !!}
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

@endsection 