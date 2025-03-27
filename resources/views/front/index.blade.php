@extends('layouts.main')

@section('title', 'Home')

@section('content')
    <section class="pt-36 pb-12 px-4">
        <div class="container mx-auto max-w-6xl">
            <h1 class="text-4xl md:text-6xl font-light mb-6">Discover top furniture bestsellers and explore the latest styles.</h1>
        </div>
    </section>

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
@endsection
