<div>
    <!-- Search & Filter Section -->
    <div class="mb-10">
        <!-- Search Input -->
        <div class="w-full max-w-xl mx-auto relative mb-6">
            <input 
                wire:model.live.debounce.300ms="search" 
                type="text" 
                placeholder="Cari artikel..." 
                class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-full focus:outline-none focus:border-black"
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

    </div>

    <!-- Active Filters -->
    @if ($search || $category)
        <div class="flex items-center gap-2 mb-6">
            <span class="text-sm text-gray-600">Active filters:</span>
            
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
            
            @if ($category)
                <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">
                    Category: {{ $categories->where('slug', $category)->first()->name ?? '' }}
                    <button wire:click="$set('category', '')" class="ml-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </span>
            @endif
            
            <button wire:click="resetFilters" class="text-xs text-gray-600 hover:text-black underline">
                Clear all
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

    <!-- Articles Grid -->
    <div class="space-y-12" wire:loading.class="opacity-50">
        @forelse($articles as $article)
        <article class="group">
            <a href="{{ route('detail', $article->slug) }}" class="grid md:grid-cols-3 gap-6">
                <div class="aspect-[4/3] bg-gray-100 overflow-hidden rounded-md">
                    @if($article->featured_image)
                    <img src="{{ asset('storage/' . $article->featured_image) }}" 
                         alt="{{ $article->title }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @endif
                </div>
                <div class="md:col-span-2">
                    <h2 class="text-xl mb-2 group-hover:text-gray-600 transition-colors">{{ $article->title }}</h2>
                    <p class="text-gray-600 mb-4 line-clamp-2">{{ $article->excerpt }}</p>
                    <div class="flex items-center text-sm text-gray-500">
                        <span>{{ $article->created_at->format('F d, Y') }}</span>
                        @if($article->reading_time)
                        <span class="mx-2">•</span>
                        <span>{{ $article->reading_time }} min read</span>
                        @endif
                    </div>
                </div>
            </a>
        </article>
        @empty
        <div class="text-center py-12">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="text-lg font-medium text-gray-900">No articles found</h3>
            <p class="text-gray-600 mt-2">Try adjusting your search or filter to find what you're looking for.</p>
            <button wire:click="resetFilters" class="mt-4 inline-flex items-center px-4 py-2 bg-black text-white rounded-md hover:bg-gray-800 transition">
                Clear all filters
            </button>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $articles->links() }}
    </div>
</div>
