<x-app-layout>
<div class="max-w-2xl mx-auto space-y-8 select-none py-6">
    <div class="space-y-2 text-center">
        <h1 class="text-3xl font-black text-white tracking-tight">Become a Marketplace Partner</h1>
        <p class="text-xs text-textMuted font-medium">Initialize your vendor credentials to list and distribute premium nodes</p>
    </div>

    <div class="glassmorphism-luxury border border-white/5 rounded-3xl p-8 relative overflow-hidden specular-glass shadow-2xl">
        <div class="absolute top-0 right-0 w-32 h-32 bg-glow-indigo rounded-full blur-3xl opacity-30"></div>

        <form method="POST" action="/vendor/register" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Store Name -->
            <div class="space-y-2">
                <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Store name *</label>
                <input type="text" name="store_name" required value="{{ old('store_name') }}"
                       placeholder="e.g. Apex Tech Solutions"
                       class="w-full bg-black/40 border border-white/10 rounded-2xl px-4 py-3 text-xs text-white placeholder-textMuted focus:outline-none focus:border-brandAccent focus:ring-0 transition-smooth">
                @error('store_name')
                    <span class="text-xs text-brandRed font-medium block mt-1">● {{ $message }}</span>
                @enderror
            </div>

            <!-- Store Description -->
            <div class="space-y-2">
                <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Store Description</label>
                <textarea name="store_description" rows="4"
                          placeholder="Describe your inventory focus, brand story, and shipping capacities..."
                          class="w-full bg-black/40 border border-white/10 rounded-2xl px-4 py-3 text-xs text-white placeholder-textMuted focus:outline-none focus:border-brandAccent focus:ring-0 transition-smooth">{{ old('store_description') }}</textarea>
                @error('store_description')
                    <span class="text-xs text-brandRed font-medium block mt-1">● {{ $message }}</span>
                @enderror
            </div>

            <!-- Upload Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Store Logo -->
                <div class="space-y-2">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Store Logo (PNG/JPG)</label>
                    <div class="relative bg-black/40 border border-white/10 rounded-2xl p-4 flex flex-col items-center justify-center text-center hover:border-brandAccent/50 transition-smooth">
                        <input type="file" name="store_logo" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                        <span class="text-2xl mb-1">🖼️</span>
                        <span class="text-[10px] text-textMuted font-bold">Select Store Logo</span>
                        <span class="text-[8px] text-textMuted mt-0.5">Max file size: 2MB</span>
                    </div>
                </div>

                <!-- Store Banner -->
                <div class="space-y-2">
                    <label class="text-[10px] text-textMuted uppercase font-bold tracking-wider">Store Banner (PNG/JPG)</label>
                    <div class="relative bg-black/40 border border-white/10 rounded-2xl p-4 flex flex-col items-center justify-center text-center hover:border-brandAccent/50 transition-smooth">
                        <input type="file" name="store_banner" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                        <span class="text-2xl mb-1">🌄</span>
                        <span class="text-[10px] text-textMuted font-bold">Select Store Banner</span>
                        <span class="text-[8px] text-textMuted mt-0.5">Max file size: 2MB</span>
                    </div>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-between">
                <a href="/dashboard" class="text-xs font-bold text-textMuted hover:text-white transition-smooth">
                    Cancel & Return
                </a>
                <button type="submit" class="bg-brandAccent hover:bg-brandAccentHover text-white px-6 py-3 rounded-2xl text-xs font-black tracking-wide transition-smooth btn-micro-anim shadow-lg">
                    Initialize Vendor Node
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
