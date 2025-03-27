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

            <!-- Category Slider -->
            <div class="relative bg-white mb-8" x-data="{ 
                scroll: 0,
                container: null,
                init() {
                    this.container = this.$refs.scrollContainer;
                },
                scrollLeft() {
                    this.container.scrollBy({ left: -200, behavior: 'smooth' });
                },
                scrollRight() {
                    this.container.scrollBy({ left: 200, behavior: 'smooth' });
                },
                updateScroll() {
                    this.scroll = this.container.scrollLeft;
                }
            }">
                <div class="container mx-auto max-w-6xl relative">
                    <!-- Left Chevron -->
                    <button 
                        @click="scrollLeft" 
                        class="absolute left-0 top-1/5 -translate-y-1/5 w-8 h-8 flex items-center justify-center bg-white shadow-md rounded-full z-20 hover:bg-gray-50 cursor-pointer"
                        x-show="scroll > 0"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>

                    <!-- Right Chevron -->
                    <button 
                        @click="scrollRight" 
                        class="absolute right-0 top-1/5 -translate-y-1/5 w-8 h-8 flex items-center justify-center bg-white shadow-md rounded-full z-20 hover:bg-gray-50 cursor-pointer"
                        x-show="container && scroll < (container.scrollWidth - container.clientWidth)"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>

                    <!-- Shadow Overlays -->
                    <div class="absolute left-0 top-0 bottom-0 w-24 bg-gradient-to-r from-white to-transparent z-10"
                        x-show="scroll > 0"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                    ></div>
                    <div class="absolute right-0 top-0 bottom-0 w-24 bg-gradient-to-l from-white to-transparent z-10"
                        x-show="container && scroll < (container.scrollWidth - container.clientWidth)"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                    ></div>
                    
                    <!-- Scrollable Categories -->
                    <div 
                        x-ref="scrollContainer"
                        @scroll.throttle="updateScroll"
                        class="overflow-x-auto flex space-x-4 pb-4 scrollbar-hide relative scroll-smooth" 
                        style="-webkit-overflow-scrolling: touch; scrollbar-width: none; -ms-overflow-style: none;">
                        <button class="px-4 py-2 rounded-full bg-black text-white whitespace-nowrap text-sm">All Items</button>
                        @foreach ($categories as $category)
                            <button class="px-4 py-2 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-900 whitespace-nowrap text-sm cursor-pointer">{{ $category->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Product Grid -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <!-- Product Cards -->
                @foreach ($products as $product)
                    <a href="{{ route('detail', $product->slug) }}" class="group">
                        <div class="aspect-square bg-gray-100 mb-4 overflow-hidden">
                            <img src="{{ asset('storage/' . $product->getFeaturedImageAttribute()) }}" alt="Modern Chair" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <h3 class="text-sm font-medium">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500">RP. {{ number_format($product->price, 0, ',', '.') }}</p>
                    </a>
                @endforeach

            </div>
            
            <!-- Pagination -->
            <div class="mt-12 flex items-center justify-center space-x-2" x-data="{ currentPage: 1 }">
                <button class="w-10 h-10 flex items-center justify-center rounded-full border hover:bg-gray-50 transition-colors" :class="currentPage === 1 ? 'text-gray-300 cursor-not-allowed' : 'text-gray-600'">
                    <span class="sr-only">Previous</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <button 
                    class="w-10 h-10 flex items-center justify-center rounded-full border transition-colors"
                    :class="currentPage === 1 ? 'bg-black text-white' : 'hover:bg-gray-50 text-gray-600'"
                    @click="currentPage = 1"
                >1</button>
                <button 
                    class="w-10 h-10 flex items-center justify-center rounded-full border hover:bg-gray-50 text-gray-600 transition-colors"
                    :class="currentPage === 2 ? 'bg-black text-white' : 'hover:bg-gray-50 text-gray-600'"
                    @click="currentPage = 2"
                >2</button>
                <button 
                    class="w-10 h-10 flex items-center justify-center rounded-full border hover:bg-gray-50 text-gray-600 transition-colors"
                    :class="currentPage === 3 ? 'bg-black text-white' : 'hover:bg-gray-50 text-gray-600'"
                    @click="currentPage = 3"
                >3</button>

                <span class="px-2 text-gray-600">...</span>

                <button 
                    class="w-10 h-10 flex items-center justify-center rounded-full border hover:bg-gray-50 text-gray-600 transition-colors"
                    :class="currentPage === 10 ? 'bg-black text-white' : 'hover:bg-gray-50 text-gray-600'"
                    @click="currentPage = 10"
                >10</button>

                <button class="w-10 h-10 flex items-center justify-center rounded-full border hover:bg-gray-50 text-gray-600 transition-colors">
                    <span class="sr-only">Next</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </section>
@endsection
