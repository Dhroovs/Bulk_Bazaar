<x-app-layout>

<div class="space-y-10">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-white">Category Management</h1>
            <p class="text-xs text-textMuted font-medium font-sans">Manage store catalog groups and classifications</p>
        </div>
        <div class="flex gap-2">
            <a href="/admin/products" class="bg-cardGlass hover:bg-cardBorder border border-cardBorder text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim">
                ⚙️ Products
            </a>
            <a href="/admin/categories/create" class="bg-brandAccent hover:bg-brandAccentHover text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim shadow-lg shadow-brandAccent/25">
                + Add Category
            </a>
        </div>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="glass-card p-6 border border-cardBorder flex items-center justify-between">
            <div>
                <span class="text-xs text-textMuted block mb-1 font-semibold">Total Categories</span>
                <span class="text-3xl font-black text-white tabular-nums">{{ $categories->count() }}</span>
            </div>
            <span class="text-3xl">📂</span>
        </div>
        <div class="glass-card p-6 border border-cardBorder flex items-center justify-between">
            <div>
                <span class="text-xs text-textMuted block mb-1 font-semibold">Associated Products</span>
                <span class="text-3xl font-black text-brandGreen tabular-nums">{{ \App\Models\Product::count() }}</span>
            </div>
            <span class="text-3xl">🛍️</span>
        </div>
        <div class="glass-card p-6 border border-cardBorder flex items-center justify-between">
            <div>
                <span class="text-xs text-textMuted block mb-1 font-semibold">Active Categories</span>
                <span class="text-3xl font-black text-purple-400 tabular-nums">{{ $categories->where('status', 'active')->count() }}</span>
            </div>
            <span class="text-3xl">🚀</span>
        </div>
    </div>

    <!-- CATEGORIES TABLE -->
    <div class="glass-card border border-cardBorder overflow-hidden">
        
        <div class="p-6 border-b border-cardBorder bg-bgDarker">
            <h3 class="font-bold text-sm text-white">All Store Categories</h3>
            <p class="text-[10px] text-textMuted">Create new groups, update details, or delete groups</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-cardBorder bg-bgDarker text-textMuted font-bold">
                        <th class="p-4">Category Info</th>
                        <th class="p-4">Description</th>
                        <th class="p-4">Products Linked</th>
                        <th class="p-4">Revenue Volume</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cardBorder/50">
                    @forelse($categories as $category)
                        <tr class="hover:bg-white/5 transition-smooth">
                            
                            <!-- Category Name & ID -->
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-bgDarker rounded-lg border border-cardBorder flex items-center justify-center text-xl shrink-0 select-none">
                                        @if($category->image)
                                            📂
                                        @else
                                            📂
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-xs text-white">{{ $category->name }}</h4>
                                        <span class="text-[9px] text-textMuted block">ID: #{{ $category->id }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Description -->
                            <td class="p-4 text-textMuted max-w-xs truncate">
                                {{ $category->description ?? 'No description provided.' }}
                            </td>

                            <!-- Products Linked count -->
                            <td class="p-4 font-bold text-white tabular-nums">
                                <span class="bg-brandAccent/10 border border-brandAccent/25 text-brandAccent px-2.5 py-0.5 rounded-full">
                                    {{ $category->products->count() }}
                                </span>
                            </td>

                            <!-- Revenue Volume -->
                            <td class="p-4 font-black text-brandGreen tabular-nums">
                                ₹{{ number_format(\App\Models\OrderItem::whereIn('product_id', $category->products->pluck('id'))->sum(\Illuminate\Support\Facades\DB::raw('quantity * price')), 2) }}
                            </td>

                            <!-- Status -->
                            <td class="p-4">
                                @if($category->status == 'active')
                                    <span class="bg-brandGreen/10 border border-brandGreen/25 text-brandGreen px-2.5 py-0.5 rounded-full text-[9px] font-bold">Active</span>
                                @else
                                    <span class="bg-cardBorder text-textMuted px-2.5 py-0.5 rounded-full text-[9px] font-bold">Inactive</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="p-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="/admin/categories/edit/{{ $category->id }}" class="bg-brandAccent/15 hover:bg-brandAccent text-brandAccent hover:text-white px-3.5 py-1.5 rounded-lg text-[10px] font-bold transition-smooth btn-micro-anim">
                                        Edit
                                    </a>
                                    <a href="/admin/categories/delete/{{ $category->id }}" class="bg-brandRed/15 hover:bg-brandRed text-brandRed hover:text-white px-3.5 py-1.5 rounded-lg text-[10px] font-bold transition-smooth btn-micro-anim">
                                        Delete
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-textMuted">No categories found. Add a category to organize products.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
    </div>

</div>

</x-app-layout>