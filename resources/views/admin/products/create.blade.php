<x-app-layout>

<div class="space-y-10">

    <!-- HEADER -->
    <div class="flex items-center justify-between border-b border-cardBorder pb-4">
        <div>
            <h1 class="text-2xl font-black text-white">Add New Product</h1>
            <p class="text-xs text-textMuted font-medium font-sans">Publish a new inventory product to the storefront catalog</p>
        </div>
        <a href="/admin/products" class="bg-cardGlass hover:bg-cardBorder border border-cardBorder text-white px-4 py-2 rounded-xl text-xs font-bold transition-smooth">
            ← Back to Products
        </a>
    </div>

    <!-- FORM -->
    <form action="/admin/products/store" method="POST" enctype="multipart/form-data" class="glass-card overflow-hidden">
        @csrf

        <div class="p-6 sm:p-8 space-y-6">
            
            <h3 class="font-bold text-sm text-white border-b border-cardBorder/50 pb-2">Product Specifications</h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Name -->
                <div class="md:col-span-2 space-y-1.5">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Product Name *</label>
                    <input type="text" name="name" placeholder="Enter product name (e.g. iPhone 15 Pro)" required
                           class="w-full bg-bgDark border border-cardBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0">
                </div>

                <!-- SKU -->
                <div class="space-y-1.5">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Product SKU</label>
                    <input type="text" name="sku" placeholder="ELEC-IPH-15P"
                           class="w-full bg-bgDark border border-cardBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0 font-mono">
                </div>

                <!-- Price -->
                <div class="space-y-1.5">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Original Price (₹) *</label>
                    <input type="number" step="0.01" name="price" placeholder="12999" required
                           class="w-full bg-bgDark border border-cardBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0">
                </div>

                <!-- Discount Price -->
                <div class="space-y-1.5">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Discount Price (₹)</label>
                    <input type="number" step="0.01" name="discount_price" placeholder="11999"
                           class="w-full bg-bgDark border border-cardBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0">
                </div>

                <!-- Stock Quantity -->
                <div class="space-y-1.5">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Stock Quantity *</label>
                    <input type="number" name="stock" placeholder="50" required
                           class="w-full bg-bgDark border border-cardBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0">
                </div>

                <!-- Brand -->
                <div class="space-y-1.5">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Product Brand</label>
                    <input type="text" name="brand" placeholder="Apple"
                           class="w-full bg-bgDark border border-cardBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0">
                </div>

                <!-- Category -->
                <div class="space-y-1.5">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Category *</label>
                    <select name="category_id" required
                            class="w-full bg-bgDark border border-cardBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Status -->
                <div class="space-y-1.5">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Product Status *</label>
                    <select name="status" required
                            class="w-full bg-bgDark border border-cardBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Tags -->
                <div class="md:col-span-3 space-y-1.5">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Product Tags (comma separated)</label>
                    <input type="text" name="tags" placeholder="smartphone, 5g, oled, apple"
                           class="w-full bg-bgDark border border-cardBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0">
                </div>

                <!-- Description -->
                <div class="md:col-span-3 space-y-1.5">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Product Description</label>
                    <textarea name="description" rows="4" placeholder="Enter detailed description..."
                              class="w-full bg-bgDark border border-cardBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0"></textarea>
                </div>

                <!-- Specifications JSON format editor -->
                <div class="md:col-span-3 space-y-1.5">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Product Specifications (JSON format)</label>
                    <textarea name="specifications" rows="4" placeholder='{&#10;  "RAM": "8 GB",&#10;  "Storage": "256 GB"&#10;}'
                              class="w-full bg-bgDark border border-cardBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0 font-mono"></textarea>
                </div>

                <!-- Image Upload -->
                <div class="md:col-span-3 space-y-1.5">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Product Image</label>
                    <div class="border border-dashed border-cardBorder rounded-2xl p-6 text-center hover:bg-white/5 transition-smooth">
                        <div class="text-4xl mb-2">🖼️</div>
                        <h4 class="font-bold text-xs text-white mb-1">Select file to upload</h4>
                        <p class="text-[10px] text-textMuted mb-4">PNG, JPG, or WEBP formats supported</p>
                        <input type="file" name="image" class="text-xs text-textMuted">
                    </div>
                </div>

            </div>

        </div>

        <!-- Submit Footer -->
        <div class="bg-bgDarker border-t border-cardBorder p-6 flex justify-end gap-3">
            <a href="/admin/products" class="bg-cardGlass hover:bg-cardBorder border border-cardBorder text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim">
                Cancel
            </a>
            <button type="submit" class="bg-brandAccent hover:bg-brandAccentHover text-white px-6 py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim shadow-lg shadow-brandAccent/20">
                Publish Product
            </button>
        </div>

    </form>

</div>

</x-app-layout>