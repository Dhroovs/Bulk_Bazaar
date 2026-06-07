<x-app-layout>

<div class="space-y-16 relative">

    <!-- HERO SECTION -->
    <section class="relative rounded-3xl overflow-hidden min-h-[480px] flex items-center px-8 sm:px-12 bg-gradient-to-br from-[#0a0a0f] via-[#050508] to-bgDark border border-white/5 shadow-2xl">
        
        <!-- Glowing Aurora BG elements -->
        <div class="absolute top-[-150px] right-[-150px] w-[500px] h-[500px] bg-glow-indigo rounded-full blur-3xl opacity-60"></div>
        <div class="absolute bottom-[-150px] left-[-150px] w-[500px] h-[500px] bg-glow-green rounded-full blur-3xl opacity-30"></div>
        <div class="absolute top-[20%] left-[30%] w-96 h-96 bg-glow-indigo rounded-full blur-3xl opacity-20 pointer-events-none"></div>

        <div class="max-w-2xl relative z-10 space-y-8 py-12">
            <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-brandAccent/10 border border-brandAccent/20 text-brandAccent text-[10px] font-bold tracking-widest uppercase">
                ⚡ Commerce Operating System
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-[1.1] text-white tracking-tight">
                Operating the <br>
                Future of <span class="text-transparent bg-clip-text bg-gradient-to-r from-brandAccent to-purple-400">Digital Trade</span>
            </h1>
            <p class="text-xs sm:text-sm text-textMuted leading-relaxed max-w-lg font-medium">
                A highly refined, real-time platform managing transactions, inventory logistics, global fulfillment workflows, and business intelligence with space-grade aesthetics.
            </p>
            <div class="flex flex-wrap gap-4 pt-2">
                <a href="/products" class="bg-brandAccent hover:bg-brandAccentHover text-white px-6 py-3.5 rounded-xl font-bold text-xs tracking-wide transition-smooth btn-micro-anim shadow-lg shadow-brandAccent/25">
                    Launch Storefront
                </a>
                <a href="#featured" class="bg-white/5 hover:bg-white/10 border border-white/10 text-white px-6 py-3.5 rounded-xl font-bold text-xs tracking-wide transition-smooth btn-micro-anim">
                    View Intelligence
                </a>
            </div>
        </div>

        <!-- Floating Apple Vision / Tesla UI Mockup style right side decoration -->
        <div class="hidden lg:flex flex-1 justify-end relative z-10 pl-10 select-none">
            <div class="w-80 glassmorphism-luxury p-6 specular-glass space-y-5 shadow-2xl transform rotate-1 hover:rotate-0 transition-smooth">
                <div class="h-44 bg-black/40 rounded-2xl border border-white/5 flex items-center justify-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-tr from-brandAccent/10 to-transparent"></div>
                    <img src="/logo.png" alt="Bulk Bazaar" class="h-20 w-auto object-contain transition-smooth group-hover:scale-105">
                </div>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-[9px] font-bold uppercase tracking-wider text-textMuted">Platform Status</span>
                        <span class="text-[9px] font-bold text-brandGreen bg-brandGreen/10 border border-brandGreen/20 px-2 py-0.5 rounded-full flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-brandGreen animate-pulse"></span> Active
                        </span>
                    </div>
                    <h3 class="font-extrabold text-white text-base">Bulk Bazaar OS</h3>
                    <div class="flex items-center justify-between text-xs pt-1 border-t border-white/5">
                        <span class="text-textMuted">System Health</span>
                        <span class="font-bold text-brandGreen">Excellent</span>
                    </div>
                </div>
                <a href="/products" class="block text-center bg-white/10 hover:bg-white/20 text-white py-2.5 rounded-xl text-xs font-bold transition-smooth">
                    Configure Node
                </a>
            </div>
        </div>
    </section>

    <!-- INTELLIGENCE BANNER STATS -->
    <section class="grid grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="glassmorphism-luxury p-6 border border-white/5 flex flex-col justify-center relative overflow-hidden specular-glass">
            <div class="absolute top-0 right-0 w-24 h-24 bg-glow-indigo rounded-full blur-2xl opacity-40"></div>
            <span class="text-textMuted text-[10px] uppercase font-bold tracking-wider mb-2">Total Node Products</span>
            <h3 class="text-3xl font-black text-white tabular-nums animate-count">{{ \App\Models\Product::count() }}</h3>
            <span class="text-[9px] font-bold text-brandGreen mt-1 flex items-center gap-1">↑ Active Catalog</span>
        </div>
        <div class="glassmorphism-luxury p-6 border border-white/5 flex flex-col justify-center relative overflow-hidden specular-glass">
            <div class="absolute top-0 right-0 w-24 h-24 bg-glow-green rounded-full blur-2xl opacity-30"></div>
            <span class="text-textMuted text-[10px] uppercase font-bold tracking-wider mb-2">Global Categories</span>
            <h3 class="text-3xl font-black text-brandAccent tabular-nums animate-count">{{ \App\Models\Category::count() }}</h3>
            <span class="text-[9px] font-bold text-brandAccent mt-1 flex items-center gap-1">Structured Schema</span>
        </div>
        <div class="glassmorphism-luxury p-6 border border-white/5 flex flex-col justify-center relative overflow-hidden specular-glass">
            <div class="absolute top-0 right-0 w-24 h-24 bg-glow-indigo rounded-full blur-2xl opacity-20"></div>
            <span class="text-textMuted text-[10px] uppercase font-bold tracking-wider mb-2">Active Node Users</span>
            <h3 class="text-3xl font-black text-brandGreen tabular-nums animate-count">{{ \App\Models\User::count() }}</h3>
            <span class="text-[9px] font-bold text-brandGreen mt-1 flex items-center gap-1">Verified Accounts</span>
        </div>
        <div class="glassmorphism-luxury p-6 border border-white/5 flex flex-col justify-center relative overflow-hidden specular-glass">
            <span class="text-textMuted text-[10px] uppercase font-bold tracking-wider mb-2">Platform Health</span>
            <h3 class="text-3xl font-black text-purple-400 tabular-nums">99.9%</h3>
            <span class="text-[9px] font-bold text-purple-400 mt-1 flex items-center gap-1">Operational API</span>
        </div>
    </section>

    <!-- SHOP BY CATEGORY -->
    <section class="space-y-6">
        <div>
            <h2 class="text-2xl font-black text-white tracking-tight">Catalog Categorizations</h2>
            <p class="text-xs text-textMuted font-medium">Explore specific commerce divisions mapped inside the operating system</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($categories as $category)
                <a href="/products?category={{ $category->id }}"
                   class="glassmorphism-luxury p-6 text-center glass-card-hover group relative overflow-hidden specular-glass">
                    <div class="text-4xl mb-4 transition-smooth group-hover:scale-110">
                        @if(strtolower($category->name) == 'electronics')
                            📱
                        @elseif(strtolower($category->name) == 'fashion')
                            👗
                        @elseif(strtolower($category->name) == 'sports')
                            ⚽
                        @elseif(strtolower($category->name) == 'books')
                            📚
                        @else
                            📦
                        @endif
                    </div>
                    <h3 class="font-extrabold text-sm text-white group-hover:text-brandAccent transition-smooth">
                        {{ $category->name }}
                    </h3>
                    <p class="text-[10px] text-textMuted mt-1 truncate max-w-[150px] mx-auto">
                        {{ $category->description ?? 'Explore division items' }}
                    </p>
                </a>
            @endforeach
        </div>
    </section>

    <!-- FEATURED PRODUCTS -->
    <section id="featured" class="space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-black text-white tracking-tight">Active Node Listings</h2>
                <p class="text-xs text-textMuted font-medium">Verified high-velocity products currently trade-active</p>
            </div>
            <a href="/products" class="text-xs font-bold text-brandAccent hover:text-white transition-smooth">
                All Listings →
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="glassmorphism-luxury overflow-hidden glass-card-hover flex flex-col justify-between specular-glass border border-white/5 rounded-3xl">
                    
                    <!-- Product Image Container -->
                    <div class="h-48 bg-black/40 flex items-center justify-center text-7xl select-none relative group border-b border-white/5">
                        @if($product->image)
                            <img src="/products/{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            @if($product->category)
                                @if(strtolower($product->category->name) == 'electronics')
                                    📱
                                @elseif(strtolower($product->category->name) == 'fashion')
                                    👕
                                @elseif(strtolower($product->category->name) == 'sports')
                                    ⚽
                                @elseif(strtolower($product->category->name) == 'books')
                                    📚
                                @else
                                    📦
                                @endif
                            @else
                                📦
                            @endif
                        @endif

                        <!-- Hover Overlay details link -->
                        <div class="absolute inset-0 bg-black/70 opacity-0 group-hover:opacity-100 transition-smooth flex items-center justify-center backdrop-blur-md">
                            <a href="/product/{{ $product->id }}" class="bg-white text-bgDark px-5 py-2.5 rounded-xl text-xs font-extrabold transition-smooth transform translate-y-2 group-hover:translate-y-0 shadow-xl">
                                Inspect Node
                            </a>
                        </div>
                    </div>

                    <!-- Product Details -->
                    <div class="p-5 space-y-4">
                        <div class="flex justify-between items-center text-[9px] font-bold tracking-wider">
                            <span class="text-brandAccent uppercase">
                                {{ $product->category->name ?? 'Store Item' }}
                            </span>
                            @if($product->brand)
                                <span class="text-textMuted uppercase">{{ $product->brand }}</span>
                            @endif
                        </div>

                        <a href="/product/{{ $product->id }}" class="block">
                            <h3 class="font-extrabold text-sm text-white hover:text-brandAccent transition-smooth truncate">
                                {{ $product->name }}
                            </h3>
                        </a>

                        <!-- Prices and Stars -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-baseline gap-2">
                                @if($product->discount_price)
                                    <span class="text-sm font-extrabold text-brandGreen tabular-nums">₹{{ number_format($product->discount_price, 2) }}</span>
                                    <span class="text-[10px] text-textMuted line-through tabular-nums">₹{{ number_format($product->price, 2) }}</span>
                                @else
                                    <span class="text-sm font-extrabold text-white tabular-nums">₹{{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                            <span class="text-[10px] text-yellow-400 font-bold">⭐ 4.8</span>
                        </div>

                        <!-- Stock and Buy Button -->
                        @if($product->stock > 0)
                            <a href="/cart/add/{{ $product->id }}"
                               class="block text-center bg-brandAccent hover:bg-brandAccentHover text-white py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim shadow-lg shadow-brandAccent/10">
                                Transact Item
                            </a>
                        @else
                            <div class="bg-brandRed/10 border border-brandRed/20 text-brandRed text-center py-2.5 rounded-xl text-xs font-bold">
                                Out of Stock
                            </div>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    </section>

    <!-- COMPILED SYSTEM BANNER -->
    <section class="relative rounded-3xl p-8 sm:p-12 overflow-hidden bg-gradient-to-r from-brandAccent/10 to-purple-950/10 border border-white/5 shadow-2xl">
        <div class="max-w-xl space-y-4 relative z-10">
            <h2 class="text-2xl sm:text-3xl font-black text-white tracking-tight">Marketplace Broadcast</h2>
            <p class="text-xs sm:text-sm text-textMuted font-medium leading-relaxed">
                Configure your system notifications to receive active collections drops, logistics updates, restock signals, and API health alerts.
            </p>
            <div class="flex gap-2 pt-2">
                <input type="email" placeholder="Enter verified node email..." 
                       class="bg-black/40 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-textMuted focus:outline-none focus:border-brandAccent focus:ring-0 flex-1">
                <button class="bg-white hover:bg-gray-200 text-bgDark px-5 py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim">
                    Subscribe
                </button>
            </div>
        </div>
        <div class="absolute right-[-80px] bottom-[-80px] w-80 h-80 bg-glow-indigo rounded-full blur-3xl opacity-40"></div>
    </section>

</div>

</x-app-layout>