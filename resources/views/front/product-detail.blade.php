@extends('layouts.main')

@section('title', $product->name . ' - Cozy Modern Furniture Store')

@section('content')
    <!-- Product Detail -->
    <section class="pt-32 pb-16 md:py-20">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                <!-- Product Image -->
                <div>
                    <div class="aspect-square bg-gray-100 mb-4 overflow-hidden">
                        <img src="{{ $product->featured_image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    </div>
                    
                    @if($product->images && count($product->images) > 0)
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($product->images as $image)
                        <div class="aspect-square bg-gray-100 cursor-pointer">
                            <img src="{{ $image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                
                <!-- Product Info -->
                <div>
                    <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
                    <p class="text-xl mb-6">${{ number_format($product->price, 2) }}</p>
                    
                    <div class="prose prose-sm mb-6 text-gray-600">
                        {!! $product->description !!}
                    </div>
                    
                    @if($product->is_in_stock)
                    <div class="flex items-center text-sm text-green-600 mb-6">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        In Stock
                    </div>
                    @else
                    <div class="flex items-center text-sm text-red-600 mb-6">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Out of Stock
                    </div>
                    @endif
                    
                    <form class="mb-8">
                        @if($product->has_variants && isset($product->variants) && count($product->variants) > 0)
                        <div class="mb-6">
                            <label for="variant" class="block text-sm font-medium mb-2">{{ $product->variant_name ?? 'Options' }}</label>
                            <select id="variant" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-black">
                                @foreach($product->variants as $variant)
                                <option value="{{ $variant->id }}">{{ $variant->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif
                        
                        <div class="mb-6">
                            <label for="quantity" class="block text-sm font-medium mb-2">Quantity</label>
                            <div class="flex items-center">
                                <button type="button" class="w-10 h-10 border border-gray-300 rounded-l-md flex items-center justify-center">-</button>
                                <input type="number" id="quantity" min="1" value="1" class="w-16 h-10 border-t border-b border-gray-300 text-center">
                                <button type="button" class="w-10 h-10 border border-gray-300 rounded-r-md flex items-center justify-center">+</button>
                            </div>
                        </div>
                        
                        <button type="submit" class="w-full bg-black text-white py-3 px-6 rounded-full font-medium hover:bg-gray-800 transition">
                            Add to Cart
                        </button>
                    </form>
                    
                    <div class="space-y-4 text-sm">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span>Free shipping on orders over $50</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            <span>Easy 30-day returns</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01"></path>
                            </svg>
                            <span>1-year warranty included</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Product Specifications -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 max-w-6xl">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h2 class="text-xl font-bold mb-4">Specifications</h2>
                    <table class="w-full text-sm">
                        <tbody>
                            @if($product->dimensions)
                            <tr>
                                <td class="py-2 text-gray-600">Dimensions</td>
                                <td class="py-2 font-medium">{{ $product->dimensions }}</td>
                            </tr>
                            @endif
                            @if($product->weight)
                            <tr>
                                <td class="py-2 text-gray-600">Weight</td>
                                <td class="py-2 font-medium">{{ $product->weight }}</td>
                            </tr>
                            @endif
                            @if($product->material)
                            <tr>
                                <td class="py-2 text-gray-600">Material</td>
                                <td class="py-2 font-medium">{{ $product->material }}</td>
                            </tr>
                            @endif
                            @if($product->sku)
                            <tr>
                                <td class="py-2 text-gray-600">SKU</td>
                                <td class="py-2 font-medium">{{ $product->sku }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                
                <div class="md:col-span-2">
                    <h2 class="text-xl font-bold mb-4">Features</h2>
                    <div class="prose prose-sm">
                        {!! $product->features !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Related Products -->
    @if(count($relatedProducts) > 0)
    <section class="py-16">
        <div class="container mx-auto px-4 max-w-6xl">
            <h2 class="text-2xl font-bold mb-8">You May Also Like</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
                @foreach($relatedProducts as $relatedProduct)
                <div class="group">
                    <a href="{{ route('product.detail', $relatedProduct->slug) }}">
                        <div class="aspect-square bg-gray-100 mb-4 overflow-hidden">
                            <img src="{{ $relatedProduct->featured_image }}" alt="{{ $relatedProduct->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <h3 class="text-sm font-medium">{{ $relatedProduct->name }}</h3>
                        <p class="text-sm text-gray-500">${{ number_format($relatedProduct->price, 2) }}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif
@endsection 