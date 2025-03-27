@extends('layouts.main')

@section('title', 'Articles - Cozy Modern Furniture Store')

@section('content')
    <!-- Articles Header -->
    <section class="pt-32 pb-12 md:pt-40 md:pb-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-6xl">
            <h1 class="text-3xl md:text-5xl mb-6">Inspiration & Guides</h1>
            <p class="text-xl text-gray-600 max-w-3xl">Explore our articles for design inspiration and practical guides to transform your space.</p>
        </div>
    </section>

    <!-- Articles Grid with Search -->
    <section class="py-12 md:py-16">
        <div class="container mx-auto px-4 max-w-6xl">
            @livewire('article-search')
        </div>
    </section>
@endsection 