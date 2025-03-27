<div>
    <!-- Search Input -->


    <div class="flex items-center flex-col md:flex-row justify-between mb-8 gap-3">

        <div class="w-full max-w-xl mx-auto relative">
            <input 
                wire:model.live.debounce.300ms="search" 
                type="text" 
                placeholder="Cari produk..." 
                class="w-full px-4 py-2 md:py-3 pl-10 border border-gray-300 rounded-full focus:outline-none focus:border-black"
            >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            @if ($search)
                <button wire:click="$set('search', '')" class="absolute right-3 top-1/2 -translate-y-1/2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            @endif
        </div>

        {{-- <div class="">
            <select wire:model.live="sortOption" class="border border-gray-300 rounded-md py-2 md:py-3 pl-3 pr-10 text-sm focus:outline-none focus:border-black">
                <option value="newest">Terbaru</option>
                <option value="price_low">Harga: Murah ke Mahal</option>
                <option value="price_high">Harga: Mahal ke Murah</option>
                <option value="name_asc">Nama: A to Z</option>
                <option value="name_desc">Name: Z to A</option>
            </select>
        </div> --}}

    </div>

    <div class="flex items-center justify-between mb-6">
        <!-- Category Filter -->
        <div class="relative flex items-center mx-auto w-full max-w-6xl">
            <!-- Left Chevron -->
            <button class="absolute left-0 z-10 p-1 bg-white rounded-full shadow-md text-gray-700 hover:text-black focus:outline-none" id="scroll-left">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            
            <!-- Categories Slider -->
            <div class="flex gap-2 overflow-x-auto px-8 py-1 scroll-smooth scrollbar-hide rounded-full" id="categories-container" style="-webkit-overflow-scrolling: touch; scrollbar-width: none; -ms-overflow-style: none;">
                <button 
                    wire:click="$set('categorySlug', '')" 
                    class="px-4 py-2 rounded-full cursor-pointer text-sm whitespace-nowrap flex-shrink-0 {{ $categorySlug === '' ? 'bg-black text-white' : 'bg-gray-100 hover:bg-gray-200 text-gray-900' }}"
                >
                    All Items
                </button>
                @foreach ($categories as $category)
                    <button 
                        wire:click="$set('categorySlug', '{{ $category->slug }}')" 
                        class="px-4 py-2 rounded-full cursor-pointer text-sm whitespace-nowrap flex-shrink-0 {{ $categorySlug === $category->slug ? 'bg-black text-white' : 'bg-gray-100 hover:bg-gray-200 text-gray-900' }}"
                    >
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
            
            <!-- Right Chevron -->
            <button class="absolute right-0 z-10 p-1 bg-white rounded-full shadow-md text-gray-700 hover:text-black focus:outline-none" id="scroll-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const container = document.getElementById('categories-container');
                const scrollLeftBtn = document.getElementById('scroll-left');
                const scrollRightBtn = document.getElementById('scroll-right');
                
                scrollLeftBtn.addEventListener('click', function() {
                    container.scrollBy({ left: -200, behavior: 'smooth' });
                });
                
                scrollRightBtn.addEventListener('click', function() {
                    container.scrollBy({ left: 200, behavior: 'smooth' });
                });
            });
        </script>
        

        <!-- Sort Options -->
        
    </div>

    

    <!-- Active Filters -->
    @if ($search || $categorySlug || $sortOption !== 'newest')
        <div class="flex items-center gap-2 mb-6">
            <span class="text-sm text-gray-600">Filters:</span>
            
            @if ($search)
                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">
                    Search: "{{ $search }}"
                    <button wire:click="$set('search', '')" class="ml-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </span>
            @endif
            
            @if ($categorySlug)
                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">
                    Category: {{ $categories->where('slug', $categorySlug)->first()->name ?? '' }}
                    <button wire:click="$set('categorySlug', '')" class="ml-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </span>
            @endif
            
            @if ($sortOption !== 'newest')
                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">
                    Sort: {{ str_replace('_', ' ', ucfirst($sortOption)) }}
                    <button wire:click="$set('sortOption', 'newest')" class="ml-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </span>
            @endif
            
            <button wire:click="resetFilters" class="text-xs text-gray-600 hover:text-black underline">
                Reset all
            </button>
        </div>
    @endif

    <!-- Loading Indicator -->
    <div wire:loading class="w-full text-center py-4">
        <div class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-md">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Loading...
        </div>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8" wire:loading.class="opacity-50">
        @forelse ($products as $product)
            <a href="{{ route('detail', $product->slug) }}" class="group">
                <div class="aspect-square bg-gray-100 mb-4 overflow-hidden rounded-md">
                    @if($product->images && $product->images->where('is_primary', true)->first())
                        <img 
                            src="{{ asset('storage/' . $product->images->where('is_primary', true)->first()->image_path) }}" 
                            alt="{{ $product->name }}" 
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
                <h3 class="text-sm font-medium line-clamp-1">{{ $product->name }}</h3>
                <p class="text-sm text-gray-500">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                
            </a>
        @empty
            <div class="col-span-full text-center py-12">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-lg font-medium text-gray-900">Produk tidak ditemukan</h3>
                <p class="text-gray-500 mt-2">Coba sesuaikan pencarian atau filter untuk menemukan produk yang Anda cari.</p>
                <button wire:click="resetFilters" class="mt-4 inline-flex items-center px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800">
                    Hapus semua filter
                </button>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $products->links() }}
    </div>
</div>
