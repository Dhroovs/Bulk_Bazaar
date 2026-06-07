<x-app-layout>

<div class="space-y-10">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-white">Manage Products</h1>
            <p class="text-xs text-textMuted font-medium font-sans">Your custom vendor storefront inventory control panel</p>
        </div>
        <div class="flex gap-2">
            <a href="/vendor/products/create" class="bg-brandAccent hover:bg-brandAccentHover text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim shadow-lg shadow-brandAccent/25">
                + Add Product
            </a>
        </div>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="glass-card p-6 border border-cardBorder flex items-center justify-between">
            <div>
                <span class="text-xs text-textMuted block mb-1 font-semibold">My Catalog Items</span>
                <span class="text-3xl font-black text-white tabular-nums">{{ $products->count() }}</span>
            </div>
            <span class="text-3xl">📦</span>
        </div>
        <div class="glass-card p-6 border border-cardBorder flex items-center justify-between">
            <div>
                <span class="text-xs text-textMuted block mb-1 font-semibold">Active & In Stock</span>
                <span class="text-3xl font-black text-brandGreen tabular-nums">{{ $products->where('stock', '>', 0)->where('status', 'active')->count() }}</span>
            </div>
            <span class="text-3xl">✅</span>
        </div>
        <div class="glass-card p-6 border border-cardBorder flex items-center justify-between">
            <div>
                <span class="text-xs text-textMuted block mb-1 font-semibold">Stock Exhausted</span>
                <span class="text-3xl font-black text-brandRed tabular-nums">{{ $products->where('stock', '<=', 0)->count() }}</span>
            </div>
            <span class="text-3xl">⚠️</span>
        </div>
    </div>

    <!-- PRODUCTS TABLE -->
    <div class="glass-card border border-cardBorder overflow-hidden">
        
        <div class="p-6 border-b border-cardBorder bg-bgDarker">
            <h3 class="font-bold text-sm text-white">My Active Listings</h3>
            <p class="text-[10px] text-textMuted font-sans">Modify prices, stock volumes, and listing statuses</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-cardBorder bg-bgDarker text-textMuted font-bold">
                        <th class="p-4">Product Info</th>
                        <th class="p-4">SKU / Brand</th>
                        <th class="p-4">Category</th>
                        <th class="p-4">Price / Promo</th>
                        <th class="p-4">Stock</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cardBorder/50">
                    @forelse($products as $product)
                        <tr class="hover:bg-white/5 transition-smooth">
                            
                            <!-- Product Name & ID -->
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-bgDarker rounded-lg border border-cardBorder flex items-center justify-center text-xl shrink-0 select-none">
                                        @if($product->image)
                                            <img src="/products/{{ $product->image }}" alt="" class="w-full h-full object-cover rounded-lg">
                                        @else
                                            📦
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-xs text-white">{{ $product->name }}</h4>
                                        <span class="text-[9px] text-textMuted block">ID: #{{ $product->id }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- SKU & Brand -->
                            <td class="p-4">
                                <span class="font-mono text-white block">{{ $product->sku ?? 'N/A' }}</span>
                                <span class="text-[10px] text-textMuted block">{{ $product->brand ?? 'N/A' }}</span>
                            </td>

                            <!-- Category -->
                            <td class="p-4">
                                <span class="bg-brandAccent/10 border border-brandAccent/25 text-brandAccent px-2.5 py-0.5 rounded-full text-[10px] font-semibold">
                                    {{ $product->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>

                            <!-- Prices -->
                            <td class="p-4">
                                @if($product->discount_price)
                                    <span class="text-xs font-bold text-brandGreen block tabular-nums">₹{{ number_format($product->discount_price, 2) }}</span>
                                    <span class="text-[10px] text-textMuted line-through block tabular-nums">₹{{ number_format($product->price, 2) }}</span>
                                @else
                                    <span class="text-xs font-bold text-white block tabular-nums">₹{{ number_format($product->price, 2) }}</span>
                                @endif
                            </td>

                            <!-- Stock -->
                            <td class="p-4 font-bold text-white tabular-nums">{{ $product->stock }}</td>

                            <!-- Status -->
                            <td class="p-4">
                                @if($product->status == 'active' && $product->stock > 0)
                                    <span class="bg-brandGreen/10 border border-brandGreen/25 text-brandGreen px-2.5 py-0.5 rounded-full text-[9px] font-bold">Active</span>
                                @elseif($product->status == 'inactive')
                                    <span class="bg-cardBorder text-textMuted px-2.5 py-0.5 rounded-full text-[9px] font-bold">Inactive</span>
                                @else
                                    <span class="bg-brandRed/10 border border-brandRed/25 text-brandRed px-2.5 py-0.5 rounded-full text-[9px] font-bold">Stock Out</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="p-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="/vendor/products/edit/{{ $product->id }}" class="bg-brandAccent/15 hover:bg-brandAccent text-brandAccent hover:text-white px-3.5 py-1.5 rounded-lg text-[10px] font-bold transition-smooth btn-micro-anim">
                                        Edit
                                    </a>
                                    <a href="/vendor/products/delete/{{ $product->id }}" class="bg-brandRed/15 hover:bg-brandRed text-brandRed hover:text-white px-3.5 py-1.5 rounded-lg text-[10px] font-bold transition-smooth btn-micro-anim">
                                        Delete
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-textMuted">No vendor listings found. Use the add product form to begin.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
    </div>

</div>

</x-app-layout>
