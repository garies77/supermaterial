@extends('layouts.main')

@section('title', 'Products - Cozy Modern Furniture Store')

@section('content')
    <!-- Products Header -->
    <section class="pt-32 pb-12 md:pt-40 md:pb-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-6xl">
            <h1 class="text-3xl md:text-5xl font-bold mb-6">Our Products</h1>
            <p class="text-xl text-gray-600 max-w-3xl">Explore our curated collection of modern furniture designed for comfort and style.</p>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-12 md:py-16">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                <!-- Filters -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24">
                        <h2 class="text-lg font-medium mb-4">Categories</h2>
                        <div class="space-y-2 mb-8">
                            <a href="{{ route('products') }}" class="block text-sm {{ !request()->has('category') ? 'font-medium text-black' : 'text-gray-600 hover:text-black' }}">
                                All Products
                            </a>
                            @foreach($categories as $category)
                            <a href="{{ route('products', ['category' => $category->slug]) }}" 
                               class="block text-sm {{ request('category') == $category->slug ? 'font-medium text-black' : 'text-gray-600 hover:text-black' }}">
                                {{ $category->name }}
                            </a>
                            @endforeach
                        </div>

                        <h2 class="text-lg font-medium mb-4">Sort By</h2>
                        <div class="space-y-2">
                            <a href="{{ route('products', array_merge(request()->except('sort'), ['sort' => 'newest'])) }}" 
                               class="block text-sm {{ request('sort') == 'newest' || !request('sort') ? 'font-medium text-black' : 'text-gray-600 hover:text-black' }}">
                                Newest
                            </a>
                            <a href="{{ route('products', array_merge(request()->except('sort'), ['sort' => 'price_low'])) }}" 
                               class="block text-sm {{ request('sort') == 'price_low' ? 'font-medium text-black' : 'text-gray-600 hover:text-black' }}">
                                Price: Low to High
                            </a>
                            <a href="{{ route('products', array_merge(request()->except('sort'), ['sort' => 'price_high'])) }}" 
                               class="block text-sm {{ request('sort') == 'price_high' ? 'font-medium text-black' : 'text-gray-600 hover:text-black' }}">
                                Price: High to Low
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Products -->
                <div class="lg:col-span-3">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-4 gap-y-8">
                        @forelse($products as $product)
                        <div class="group">
                            <a href="{{ route('product.detail', $product->slug) }}">
                                <div class="aspect-square bg-gray-100 mb-4 overflow-hidden">
                                    <img src="{{ $product->featured_image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <h3 class="text-sm font-medium">{{ $product->name }}</h3>
                                <p class="text-sm text-gray-500">${{ number_format($product->price, 2) }}</p>
                            </a>
                        </div>
                        @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-600">No products found. Please try another category or check back later.</p>
                        </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection 