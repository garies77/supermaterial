@extends('layouts.main')

@section('meta')
    {{-- Basic Meta Tags --}}
    <title>{{ $product->meta_title ?? config('app.name', 'Laravel') }} - {{ $webInfo->site_name }} - Produk</title>
    <meta name="description" content="{{ $product->meta_description }}">
    <meta name="keywords" content="{{ $product->meta_keywords }}">

    {{-- Open Graph Meta Tags --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $product->meta_title ?? config('app.name', 'Laravel') }} - {{ $webInfo->site_name }} - Produk">
    <meta property="og:description" content="{{ $product->meta_description }}">
    <meta property="og:url" content="{{ route('home') }}">
    <meta property="og:image" content="{{ asset('storage/' . $product->featured_image) }}">

    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $product->meta_title ?? config('app.name', 'Laravel') }} - {{ $webInfo->site_name }} - Produk">
    <meta name="twitter:description" content="{{ $product->meta_description }}">
    <meta name="twitter:image" content="{{ asset('storage/' . $product->featured_image) }}">


    {{-- Article Specific Meta Tags --}}
    <meta property="article:published_time" content="2025-01-01">
    <meta property="article:modified_time" content="2025-01-01">
   
     <link rel="canonical" href="{{ route('home') }}">
    

    {{-- Schema.org JSON-LD --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Article",
        "headline": "{{ $product->meta_title ?? config('app.name', 'Laravel') }} - {{ $webInfo->site_name }} - Produk",
        "description": "{{ $product->meta_description }}",
        "image": "{{ asset('storage/' . $product->featured_image) }}",
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

    @if($product->header_script)
    {!! $product->header_script !!}
    @endif
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="container mx-auto px-4 max-w-6xl pt-24 pb-4">
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
                        <a href="{{ route('products') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2">Products</a>
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

    <!-- Product Detail -->
    <section class="pt-2 pb-16 md:pb-20" 
        x-data="{
            currentSlide: 0,
            totalSlides: {{ $product->images ? $product->images->count() : 0 }},
            goToSlide(index) {
                this.currentSlide = index;
            },
            nextSlide() {
                this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
            },
            prevSlide() {
                this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
            }
        }">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                <!-- Product Image Slider -->
                <div>
                    @if($product->images && $product->images->count() > 0)
                    <!-- Main Image Slider -->
                    <div class="aspect-square bg-gray-100 mb-4 overflow-hidden relative">
                        <!-- Slides -->
                        @foreach($product->images->sortBy('sort_order') as $index => $image)
                        <div x-show="currentSlide === {{ $index }}"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             class="h-full w-full rounded-md overflow-hidden">
                            <img 
                                src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="{{ $image->alt_text ?? $product->name }}" 
                                class="w-full h-full object-cover"
                            >
                        </div>
                        @endforeach
                        
                        <!-- Navigation Arrows -->
                        <button @click="prevSlide" 
                               class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white text-gray-800 p-2 rounded-full shadow-md focus:outline-none transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button @click="nextSlide" 
                               class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/70 hover:bg-white text-gray-800 p-2 rounded-full shadow-md focus:outline-none transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Thumbnail Navigation -->
                    <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide py-2 px-1">
                        @foreach($product->images->sortBy('sort_order') as $index => $image)
                        <button 
                            @click="goToSlide({{ $index }})" 
                            class="flex-shrink-0 aspect-square bg-gray-100 cursor-pointer rounded-md overflow-hidden ring-2 transition w-20 h-20"
                            :class="currentSlide === {{ $index }} ? 'ring-black' : 'ring-transparent hover:ring-gray-300'">
                            <img 
                                src="{{ asset('storage/' . $image->image_path) }}" 
                                alt="{{ $image->alt_text ?? $product->name }}" 
                                class="w-full h-full object-cover"
                            >
                        </button>
                        @endforeach
                    </div>
                    @else
                    <!-- Fallback if no images available -->
                    <div class="aspect-square bg-gray-100 mb-4 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @endif
                </div>
                
                <!-- Product Info -->
                <div>
                    <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
                    <p class="text-xl mb-6">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                   
                    <!-- Category -->
                    @if($product->category)
                    <div class="mb-4">
                        <span class="inline-block bg-gray-100 text-gray-800 text-xs px-3 py-1 rounded-full">
                            {{ $product->category->name }}
                        </span>
                    </div>
                    @endif

                    <!-- Short Description -->
                    

                    @if($product->stock > 0)
                    <div class="mb-6">
                        <label for="quantity" class="block text-sm font-medium mb-2">Quantity</label>
                        <div class="flex items-center">
                            
                            <input type="text" 
                                  id="quantity" 
                                  value="{{ $product->stock }}"
                                  disabled
                                  class="w-16 h-10 border border-gray-300 text-center rounded-md">
                        </div>
                    </div>
                    @else
                    <div class="flex items-center text-sm text-red-600 mb-6">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Out of Stock
                    </div>
                    @endif
                    
                        
                    
                    <!-- E-commerce links -->
                    @if($product->tokopedia_link || $product->shopee_link)
                    <div class="mb-6">
                        <p class="text-sm font-medium mb-2">Also available on:</p>
                        <div class="flex space-x-3">
                            @if($product->tokopedia_link)
                            <a href="{{ $product->tokopedia_link }}" target="_blank" class="flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm hover:bg-gray-50">
                                <img src="{{ asset('images/tokopedia.png') }}" alt="Tokopedia" class="w-4 h-4 mr-2">
                                <span>Tokopedia</span>
                            </a>
                            @endif
                            
                            @if($product->shopee_link)
                            <a href="{{ $product->shopee_link }}" target="_blank" class="flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm hover:bg-gray-50">
                                <img src="{{ asset('images/shoope.png') }}" alt="Shopee" class="w-4 h-4 mr-2">
                                <span>Shopee</span>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif

                    @if($product->short_description)
                        <div class="mb-6">
                            <p class="text-gray-500 text-sm">{{ $product->short_description }}</p>
                        </div>
                    @endif
                    
                </div>
            </div>

            <div class="space-y-2 mt-5">
                <h2 class="text-xl font-bold mb-4">Description</h2>
                <div class="prose prose-sm leading-10 text-gray-500">
                    {!! $product->description !!}
                </div>
            </div>

        </div>


    </section>
    
    <!-- Related Products -->
    @if(isset($relatedProducts) && count($relatedProducts) > 0)
    <section class="py-16">
        <div class="container mx-auto px-4 max-w-6xl">
            <h2 class="text-xl font-bold mb-8">Rekomendasi untuk Anda</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
                @foreach($relatedProducts as $relatedProduct)
                <div class="group">
                    <a href="{{ route('detail', $relatedProduct->slug) }}">
                        <div class="aspect-square bg-gray-100 mb-4 overflow-hidden">
                            @if(!empty($relatedProduct->getFeaturedImageAttribute()))
                            <img 
                                src="{{ asset('storage/' . $relatedProduct->getFeaturedImageAttribute()) }}" 
                                alt="{{ $relatedProduct->name }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                            >
                            @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            @endif
                        </div>
                        <h3 class="text-sm font-medium">{{ $relatedProduct->name }}</h3>
                        <p class="text-sm text-gray-500">Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection 
@section('scripts')
    @if($product->footer_script)
    {!! $product->footer_script !!}
    @endif
@endsection