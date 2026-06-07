<x-app-layout>

<div class="space-y-10 relative">

    <!-- HEADER & FILTERS -->
    <div class="glassmorphism-luxury p-6 border border-white/5 space-y-6 rounded-3xl shadow-2xl relative overflow-hidden specular-glass">
        <div class="absolute top-[-50px] right-[-50px] w-48 h-48 bg-glow-indigo rounded-full blur-3xl opacity-30"></div>
        
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 relative z-10">
            <div>
                <h1 class="text-2xl font-black text-white tracking-tight">Active Node Registry</h1>
                <p class="text-xs text-textMuted font-medium">Browse and filter verified commerce items active on this node</p>
            </div>
            
            <!-- Filter Action Form -->
            <form action="/products" method="GET" class="flex flex-wrap items-center gap-3">
                <!-- Search -->
                <input type="text" name="search" placeholder="Search parameters..." value="{{ request('search') }}"
                       class="bg-black/40 border border-white/10 text-xs text-white rounded-xl px-4 py-2.5 focus:outline-none focus:border-brandAccent focus:ring-0 w-48 transition-smooth">

                <!-- Category -->
                <select name="category" class="bg-black/40 border border-white/10 text-xs text-white rounded-xl px-4 py-2.5 focus:outline-none focus:border-brandAccent focus:ring-0 cursor-pointer">
                    <option value="" class="bg-bgDark">All Classifications</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }} class="bg-bgDark">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Sort -->
                <select name="sort" class="bg-black/40 border border-white/10 text-xs text-white rounded-xl px-4 py-2.5 focus:outline-none focus:border-brandAccent focus:ring-0 cursor-pointer">
                    <option value="" class="bg-bgDark">Sort Sequence</option>
                    <option value="low-high" {{ request('sort') == 'low-high' ? 'selected' : '' }} class="bg-bgDark">Price: Ascending</option>
                    <option value="high-low" {{ request('sort') == 'high-low' ? 'selected' : '' }} class="bg-bgDark">Price: Descending</option>
                </select>

                <button type="submit" class="bg-brandAccent hover:bg-brandAccentHover text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim shadow-md shadow-brandAccent/10">
                    Filter Node
                </button>
            </form>
        </div>

        <!-- Quick Categories Selection Chips -->
        <div class="flex flex-wrap gap-2 pt-4 border-t border-white/5 relative z-10">
            <a href="/products" class="px-4 py-1.5 rounded-full text-xs font-bold transition-smooth {{ !request('category') ? 'bg-brandAccent text-white shadow-md' : 'bg-white/5 border border-white/10 text-textMuted hover:text-white hover:bg-white/10' }}">
                All Items
            </a>
            @foreach($categories as $category)
                <a href="/products?category={{ $category->id }}&search={{ request('search') }}&sort={{ request('sort') }}" 
                   class="px-4 py-1.5 rounded-full text-xs font-bold transition-smooth {{ request('category') == $category->id ? 'bg-brandAccent text-white shadow-md' : 'bg-white/5 border border-white/10 text-textMuted hover:text-white hover:bg-white/10' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- PRODUCTS GRID -->
    @if(count($products) > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="glassmorphism-luxury overflow-hidden glass-card-hover flex flex-col justify-between specular-glass rounded-3xl border border-white/5 shadow-2xl">
                    
                    <!-- Product Image / Category Icon Header -->
                    <div class="h-56 bg-black/40 flex items-center justify-center text-7xl select-none relative group border-b border-white/5">
                        @if($product->image)
                            <img src="/products/{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            @php
                                $categoryName = strtolower($product->category->name ?? '');
                            @endphp
                            @if(str_contains($categoryName, 'electronic'))
                                📱
                            @elseif(str_contains($categoryName, 'fashion'))
                                👕
                            @elseif(str_contains($categoryName, 'sports'))
                                ⚽
                            @elseif(str_contains($categoryName, 'books'))
                                📚
                            @else
                                📦
                            @endif
                        @endif

                        <!-- Hover overlay details -->
                        <div class="absolute inset-0 bg-black/70 opacity-0 group-hover:opacity-100 transition-smooth flex items-center justify-center backdrop-blur-md">
                            <a href="/product/{{ $product->id }}" class="bg-white text-bgDark px-5 py-2.5 rounded-xl text-xs font-bold transition-smooth transform translate-y-2 group-hover:translate-y-0 shadow-lg">
                                Inspect Node
                            </a>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 space-y-4">
                        <div class="flex justify-between items-center text-[9px] font-bold tracking-wider">
                            <span class="text-brandAccent uppercase">
                                {{ $product->category->name ?? 'Store Item' }}
                            </span>
                            @if($product->brand)
                                <span class="text-textMuted uppercase">{{ $product->brand }}</span>
                            @endif
                        </div>

                        <div class="space-y-2">
                            <a href="/product/{{ $product->id }}">
                                <h3 class="font-extrabold text-base text-white hover:text-brandAccent transition-smooth truncate">
                                    {{ $product->name }}
                                </h3>
                            </a>
                            <p class="text-xs text-textMuted line-clamp-2 leading-relaxed font-medium">
                                {{ $product->description ?? 'No catalog description currently registered for this registry node.' }}
                            </p>
                        </div>

                        <!-- Tags list -->
                        @if($product->tags)
                            <div class="flex flex-wrap gap-1.5">
                                @foreach(explode(',', $product->tags) as $tag)
                                    <span class="bg-white/5 border border-white/5 px-2.5 py-0.5 rounded text-[9px] text-textMuted font-bold uppercase">#{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                        @endif

                        <!-- Prices and Stock -->
                        <div class="flex items-center justify-between pt-2 border-t border-white/5">
                            <div class="flex items-baseline gap-2">
                                @if($product->discount_price)
                                    <span class="text-sm font-black text-brandGreen tabular-nums">₹{{ number_format($product->discount_price, 2) }}</span>
                                    <span class="text-[10px] text-textMuted line-through tabular-nums">₹{{ number_format($product->price, 2) }}</span>
                                @else
                                    <span class="text-sm font-black text-white tabular-nums">₹{{ number_format($product->price, 2) }}</span>
                                @endif
                            </div>
                            <span class="text-[10px] text-textMuted font-bold">Node Stock: <strong class="text-white font-black">{{ $product->stock }}</strong></span>
                        </div>

                        <!-- Button -->
                        @if($product->stock > 0)
                            <a href="/cart/add/{{ $product->id }}"
                               class="block text-center bg-brandAccent hover:bg-brandAccentHover text-white py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim shadow-lg shadow-brandAccent/10">
                                Transact Item
                            </a>
                        @else
                            <div class="bg-brandRed/10 border border-brandRed/20 text-brandRed text-center py-2.5 rounded-xl text-xs font-bold">
                                Node Depleted
                            </div>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>

        <!-- PAGINATION -->
        <div class="pt-6">
            {{ $products->links() }}
        </div>
    @else
        <!-- Empty State -->
        <div class="glassmorphism-luxury p-16 text-center border border-white/5 space-y-4 rounded-3xl shadow-2xl">
            <div class="text-6xl">🔍</div>
            <h3 class="text-xl font-bold text-white tracking-tight">Empty Node Registry</h3>
            <p class="text-xs text-textMuted max-w-sm mx-auto">No trade active products could be resolved matching current search criteria.</p>
            <a href="/products" class="inline-block bg-brandAccent hover:bg-brandAccentHover text-white px-6 py-2.5 rounded-xl text-xs font-bold transition-smooth">
                Reset Node Filters
            </a>
        </div>
    @endif

</div>

</x-app-layout>