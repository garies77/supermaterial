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
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4">Cozy®</h3>
                <p class="text-sm text-gray-500">Monday - Friday: 9:00 AM - 10:00 PM<br>
                Saturday - Sunday: 9:00 AM - 11:00 PM</p>
            </div>
            <div>
                <h4 class="font-medium mb-4">Shop</h4>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li><a href="#" class="hover:text-black">New Arrivals</a></li>
                    <li><a href="#" class="hover:text-black">Best Sellers</a></li>
                    <li><a href="#" class="hover:text-black">Sale</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-medium mb-4">Help</h4>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li><a href="#" class="hover:text-black">Shipping</a></li>
                    <li><a href="#" class="hover:text-black">Returns</a></li>
                    <li><a href="#" class="hover:text-black">Contact</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-medium mb-4">Follow Us</h4>
                <ul class="space-y-2 text-sm text-gray-500">
                    <li><a href="#" class="hover:text-black">Instagram</a></li>
                    <li><a href="#" class="hover:text-black">Pinterest</a></li>
                    <li><a href="#" class="hover:text-black">Twitter</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-12 pt-8 border-t text-sm text-gray-500 border-gray-200">
            <p>&copy; 2024 Cozy. All rights reserved.</p>
        </div>
    </div>
</footer>