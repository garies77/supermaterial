@extends('layouts.main')

@section('title', 'Articles - Cozy Modern Furniture Store')

@section('content')
    <!-- Articles Header -->
    <section class="pt-32 pb-12 md:pt-40 md:pb-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-6xl">
            {!! $webInfo->article !!}
        </div>
    </section>

    <!-- Articles Grid with Search -->
    <section class="py-12 md:py-16">
        <div class="container mx-auto px-4 max-w-6xl">
            @livewire('article-search')
        </div>
    </section>
@endsection 