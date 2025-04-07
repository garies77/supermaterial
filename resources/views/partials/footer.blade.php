<!-- Newsletter Section -->
<section class="py-24 px-4 bg-gray-50">
    <div class="container mx-auto max-w-6xl text-center">
        <h2 class="text-3xl font-light mb-6">Sign up for our newsletter</h2>
        
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif
        
        @if (session('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                {{ session('error') }}
            </div>
        @endif
        
        <form class="max-w-md mx-auto" action="{{ route('newsletter.subscribe') }}" method="POST">
            @csrf
            <div class="flex flex-col md:flex-row gap-4">
                <input type="email" name="email" placeholder="Enter your email" class="flex-1 px-4 py-3 border border-gray-300 focus:outline-none focus:border-black rounded-md @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
                <button type="submit" class="px-6 py-3 bg-black text-white hover:bg-gray-800 rounded-md transition">Subscribe</button>
            </div>
            @error('email')
                <div class="mt-2 text-red-500 text-sm text-left">
                    {{ $message }}
                </div>
            @enderror
        </form>
    </div>
</section>

<footer class="py-12 px-4 border-t border-gray-200">
    <div class="container mx-auto max-w-6xl">
        <div class="grid grid-cols-1 md:grid-cols-5 gap-8 text-gray-500">
            <div class="col-span-2">
                {!! $webInfo->column_1 !!}
            </div>
            <div>
                {!! $webInfo->column_2 !!}
            </div>
            <div>
                {!! $webInfo->column_3 !!}
            </div>
            <div>
                {!! $webInfo->column_4 !!}
            </div>
        </div>
        <div class="mt-12 pt-8 border-t text-sm text-gray-500 border-gray-200">
            <p>&copy; {{ date('Y') }} {{ $webInfo->site_name }}. All rights reserved. </p> 
        </div>
    </div>
</footer>