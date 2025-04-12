@extends('layouts.main')

@section('meta')
    {{-- Basic Meta Tags --}}
    <title>{{ $webInfo->meta_title ?? config('app.name', 'Laravel') }}</title>
    <meta name="description" content="{{ $webInfo->meta_description }}">
    <meta name="keywords" content="{{ $webInfo->meta_keywords }}">

    {{-- Open Graph Meta Tags --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $webInfo->meta_title ?? config('app.name', 'Laravel') }}">
    <meta property="og:description" content="{{ $webInfo->meta_description }}">
    <meta property="og:url" content="{{ route('home') }}">
    <meta property="og:image" content="{{ asset('storage/' . $webInfo->meta_image) }}">

    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $webInfo->meta_title ?? config('app.name', 'Laravel') }}">
    <meta name="twitter:description" content="{{ $webInfo->meta_description }}">
    <meta name="twitter:image" content="{{ asset('storage/' . $webInfo->meta_image) }}">


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
        "image": "{{ asset('storage/' . $webInfo->meta_image) }}",
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
                "url": "{{ asset('storage/' . $webInfo->site_logo) }}"
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
    <section class="pt-36 pb-12 px-4">
        <div class="container mx-auto max-w-6xl">
            <div class="prose">
                {!! $webInfo->home !!}
            </div>
        </div>
    </section>

    @if($webInfo->home_header_component)
        {!! $webInfo->home_header_component !!}
    @endif

    <!-- Featured Products -->
    <section class="py-12 px-4">
        <div class="container mx-auto max-w-6xl">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-xl font-medium">Produk Terbaru</h2>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('products') }}" class="text-sm text-gray-500 hover:text-black underline">Lebih Banyak</a>
                </div>
            </div>

            @livewire('product-listing')
            
        </div>
    </section>

    @if($webInfo->home_footer_component)
        {!! $webInfo->home_footer_component !!}
    @endif
@endsection
