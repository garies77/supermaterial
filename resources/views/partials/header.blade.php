<header class="fixed w-full bg-white/95 backdrop-blur-sm z-50 border-b border-gray-200" x-data="{ isOpen: false }">
    <nav class="container mx-auto px-4 py-4">
        <div class="flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-3xl font-bold tracking-tighter">
                @if($webInfo->site_logo)
                    <img src="{{ asset('storage/'.$webInfo->site_logo) }}" alt="Logo" class="w-10 h-10">
                @elseif($webInfo->site_name)
                    {{ $webInfo->site_name }}
                @else
                    {{ config('app.name', 'Laravel') }}
                @endif
            </a>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-black">Home</a>
                <a href="{{ route('products') }}" class="text-gray-600 hover:text-black">Products</a>
                <a href="{{ route('articles') }}" class="text-gray-600 hover:text-black">Articles</a>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="isOpen = !isOpen" class="md:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden" x-show="isOpen" @click.away="isOpen = false">
            <div class="pt-4 pb-3 space-y-3">
                <a href="{{ route('home') }}" class="block text-gray-600 hover:text-black">Home</a>
                <a href="{{ route('products') }}" class="block text-gray-600 hover:text-black">Products</a>
                <a href="{{ route('articles') }}" class="block text-gray-600 hover:text-black">Articles</a>
            </div>
        </div>
    </nav>
</header>