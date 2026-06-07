<x-app-layout>

<div class="space-y-10">

    <!-- HEADER -->
    <div class="flex items-center justify-between border-b border-cardBorder pb-4">
        <div>
            <h1 class="text-2xl font-black text-white">Add Category</h1>
            <p class="text-xs text-textMuted font-medium font-sans">Create a new product grouping for catalog classification</p>
        </div>
        <a href="/admin/categories" class="bg-cardGlass hover:bg-cardBorder border border-cardBorder text-white px-4 py-2 rounded-xl text-xs font-bold transition-smooth">
            ← Back to Categories
        </a>
    </div>

    <!-- FORM -->
    <form action="/admin/categories/store" method="POST" enctype="multipart/form-data" class="glass-card overflow-hidden">
        @csrf

        <div class="p-6 sm:p-8 space-y-6">
            
            <h3 class="font-bold text-sm text-white border-b border-cardBorder/50 pb-2">Category Specifications</h3>

            <div class="grid grid-cols-1 gap-6">
                <!-- Name -->
                <div class="space-y-1.5">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Category Name *</label>
                    <input type="text" name="name" placeholder="Enter category name (e.g. Smart Devices)" required
                           class="w-full bg-bgDark border border-cardBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0">
                </div>

                <!-- Description -->
                <div class="space-y-1.5">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Category Description</label>
                    <textarea name="description" rows="4" placeholder="Enter category details..."
                              class="w-full bg-bgDark border border-cardBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0"></textarea>
                </div>

                <!-- Status -->
                <div class="space-y-1.5">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Category Status *</label>
                    <select name="status" required
                            class="w-full bg-bgDark border border-cardBorder rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <!-- Image Upload (Category Image) -->
                <div class="space-y-1.5">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Category Cover Image</label>
                    <div class="border border-dashed border-cardBorder rounded-2xl p-6 text-center hover:bg-white/5 transition-smooth">
                        <div class="text-4xl mb-2">📁</div>
                        <h4 class="font-bold text-xs text-white mb-1">Select category image</h4>
                        <p class="text-[10px] text-textMuted mb-4">PNG, JPG, or WEBP supported</p>
                        <input type="file" name="image" class="text-xs text-textMuted">
                    </div>
                </div>

            </div>

        </div>

        <!-- Submit Footer -->
        <div class="bg-bgDarker border-t border-cardBorder p-6 flex justify-end gap-3">
            <a href="/admin/categories" class="bg-cardGlass hover:bg-cardBorder border border-cardBorder text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim">
                Cancel
            </a>
            <button type="submit" class="bg-brandAccent hover:bg-brandAccentHover text-white px-6 py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim shadow-lg shadow-brandAccent/20">
                Create Category
            </button>
        </div>

    </form>

</div>

</x-app-layout>