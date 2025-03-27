@extends('layouts.main')

@section('meta')
    {{-- Basic Meta Tags --}}
    <title>{{ $webInfo->meta_title ?? config('app.name', 'Laravel') }} - Artikel</title>
    <meta name="description" content="{{ $webInfo->meta_description }}">
    <meta name="keywords" content="{{ $webInfo->meta_keywords }}">

    {{-- Open Graph Meta Tags --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $webInfo->meta_title ?? config('app.name', 'Laravel') }} - Artikel">
    <meta property="og:description" content="{{ $webInfo->meta_description }}">
    <meta property="og:url" content="{{ route('home') }}">
    <meta property="og:image" content="{{ asset($webInfo->meta_image ?? 'assets/miloqu-image-meta.jpg') }}">

    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $webInfo->meta_title ?? config('app.name', 'Laravel') }} - Artikel">
    <meta name="twitter:description" content="{{ $webInfo->meta_description }}">
    <meta name="twitter:image" content="{{ asset($webInfo->meta_image ?? 'assets/miloqu-image-meta.jpg') }}">


    {{-- Article Specific Meta Tags --}}
    <meta property="article:published_time" content="2025-01-01">
    <meta property="article:modified_time" content="2025-01-01">
   
     <link rel="canonical" href="{{ route('home') }}">
    

    {{-- Schema.org JSON-LD --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Article",
        "headline": "{{ $webInfo->meta_title ?? config('app.name', 'Laravel') }}",
        "description": "{{ $webInfo->meta_description }}",
        "image": "{{ asset($webInfo->meta_image ?? 'assets/miloqu-image-meta.jpg') }}",
        "datePublished": "2025-01-01",
        "dateModified": "2025-01-01",
        "author": {
            "@type": "Person",
            "name": "{{ config('app.name', 'Laravel') }}"
        },
        "publisher": {
            "@type": "Organization",
            "name": "{{ config('app.name', 'Laravel') }}",
            "logo": {
                "@type": "ImageObject",
                "url": "{{ asset('images/logo.png') }}"
            }
        },
        "mainEntityOfPage": {
            "@type": "WebPage",
            "@id": "{{ route('home') }}"
        }
    }
    </script>
@endsection

@section('content')
    <!-- Articles Header -->
    <section class="pt-32 pb-12 md:pt-40 md:pb-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-6xl">
        <div class="prose">
                {!! $webInfo->article !!}
            </div>
        </div>
    </section>

    <!-- Articles Grid with Search -->
    <section class="py-12 md:py-16">
        <div class="container mx-auto px-4 max-w-6xl">
            @livewire('article-search')
        </div>
    </section>
@endsection 