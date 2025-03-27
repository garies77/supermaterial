@extends('layouts.main')

@section('title', 'Products - Cozy Modern Furniture Store')

@section('content')
    <section class="pt-32 pb-12 px-4 bg-gray-50">
        <div class="container mx-auto max-w-6xl">
            <div class="flex flex-col items-center text-center mb-8">
                <h1 class="text-4xl md:text-5xl font-light mb-4">Find Your Perfect Furniture</h1>
                <p class="text-gray-600 max-w-2xl">Discover our curated collection of modern, comfortable, and stylish furniture for every room in your home.</p>
            </div>
        </div>
    </section>

    <section class="container mx-auto max-w-6xl px-4 py-8">
        @livewire('product-listing')
    </section>
@endsection
