<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bulk Bazaar - Premium Marketplace</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-bgDark text-textPrimary min-h-screen flex flex-col font-sans aurora-radial-glow relative overflow-x-hidden">

    <!-- APP WRAPPER -->
    <div class="flex flex-1 min-h-screen">

        <!-- SIDEBAR (Left) -->
        <aside class="w-64 glassmorphism-luxury border border-cardBorder rounded-3xl m-6 mr-0 flex flex-col justify-between hidden lg:flex shrink-0 relative z-30 shadow-2xl">
            <div>
                <!-- Brand Logo -->
                <div class="p-6 border-b border-cardBorder">
                    <a href="/" class="flex flex-col items-start gap-1 group">
                        <img src="/logo.png" alt="Bulk Bazaar" class="h-16 w-auto object-contain transition-smooth group-hover:scale-[1.03]">
                    </a>
                </div>

                <!-- Navigation List -->
                <div class="p-4 space-y-6 overflow-y-auto max-h-[calc(100vh-380px)]">
                    <!-- ADMIN SECTION (If admin user) -->
                    @auth
                        @if(auth()->user()->is_admin)
                            <div>
                                <span class="px-3 text-[10px] font-bold text-brandAccent tracking-widest uppercase block mb-3">
                                    Admin Control Panel
                                </span>
                                <div class="space-y-1">
                                    <a href="/dashboard" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold space-rail-item hover:bg-white/5 hover:text-white {{ request()->is('dashboard') ? 'space-rail-item-active' : 'text-textMuted' }}">
                                        📊 <span>Admin Dashboard</span>
                                    </a>
                                    <a href="/admin/analytics" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold space-rail-item hover:bg-white/5 hover:text-white {{ request()->is('admin/analytics*') ? 'space-rail-item-active' : 'text-textMuted' }}">
                                        📈 <span>Analytics</span>
                                    </a>
                                    <a href="/admin/products" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold space-rail-item hover:bg-white/5 hover:text-white {{ request()->is('admin/products*') ? 'space-rail-item-active' : 'text-textMuted' }}">
                                        ⚙️ <span>Products</span>
                                    </a>
                                    <a href="/admin/categories" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold space-rail-item hover:bg-white/5 hover:text-white {{ request()->is('admin/categories*') ? 'space-rail-item-active' : 'text-textMuted' }}">
                                        📂 <span>Categories</span>
                                    </a>
                                    <a href="/admin/orders" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold space-rail-item hover:bg-white/5 hover:text-white {{ request()->is('admin/orders*') ? 'space-rail-item-active' : 'text-textMuted' }}">
                                        📦 <span>Orders</span>
                                    </a>
                                    <a href="/admin/vendors" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold space-rail-item hover:bg-white/5 hover:text-white {{ request()->is('admin/vendors*') ? 'space-rail-item-active' : 'text-textMuted' }}">
                                        👥 <span>Vendors</span>
                                    </a>
                                    <a href="/admin/reviews" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold space-rail-item hover:bg-white/5 hover:text-white {{ request()->is('admin/reviews*') ? 'space-rail-item-active' : 'text-textMuted' }}">
                                        💬 <span>Reviews</span>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endauth

                    <!-- VENDOR SECTION (If approved vendor) -->
                    @auth
                        @if(auth()->user()->isApprovedVendor())
                            <div>
                                <span class="px-3 text-[10px] font-bold text-yellow-500 tracking-widest uppercase block mb-3">
                                    Vendor Control Panel
                                </span>
                                <div class="space-y-1">
                                    <a href="/vendor/dashboard" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold space-rail-item hover:bg-white/5 hover:text-white {{ request()->is('vendor/dashboard*') ? 'space-rail-item-active' : 'text-textMuted' }}">
                                        📊 <span>Vendor Dashboard</span>
                                    </a>
                                    <a href="/vendor/products" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold space-rail-item hover:bg-white/5 hover:text-white {{ request()->is('vendor/products*') ? 'space-rail-item-active' : 'text-textMuted' }}">
                                        🛍️ <span>Manage Products</span>
                                    </a>
                                    <a href="/vendor/orders" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold space-rail-item hover:bg-white/5 hover:text-white {{ request()->is('vendor/orders*') ? 'space-rail-item-active' : 'text-textMuted' }}">
                                        📦 <span>Orders Ledger</span>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endauth

                    <!-- MAIN NAVIGATION -->
                    <div>
                        <span class="px-3 text-[10px] font-bold text-textMuted tracking-widest uppercase block mb-3">
                            Navigation
                        </span>
                        <div class="space-y-1">
                            <a href="/" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold space-rail-item hover:bg-white/5 hover:text-white {{ request()->is('/') ? 'space-rail-item-active' : 'text-textMuted' }}">
                                🏠 <span>Home</span>
                            </a>
                            <a href="/products" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold space-rail-item hover:bg-white/5 hover:text-white {{ request()->is('products*') && !request()->is('admin*') && !request()->is('vendor*') ? 'space-rail-item-active' : 'text-textMuted' }}">
                                🛍️ <span>Products</span>
                            </a>
                            @auth
                                <a href="/my-orders" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold space-rail-item hover:bg-white/5 hover:text-white {{ request()->is('my-orders*') ? 'space-rail-item-active' : 'text-textMuted' }}">
                                    📦 <span>My Orders</span>
                                </a>
                                @if(!auth()->user()->is_admin)
                                    <a href="/dashboard" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold space-rail-item hover:bg-white/5 hover:text-white {{ request()->is('dashboard') ? 'space-rail-item-active' : 'text-textMuted' }}">
                                        👤 <span>My Account</span>
                                    </a>
                                @endif
                                @if(!auth()->user()->is_admin && !auth()->user()->isVendor())
                                    <a href="/vendor/register" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-sm font-semibold space-rail-item hover:bg-white/5 hover:text-white {{ request()->is('vendor/register') ? 'space-rail-item-active' : 'text-textMuted' }}">
                                        🤝 <span>Become a Vendor</span>
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dev Account Quick Switcher -->
            <div class="p-4 border-t border-cardBorder select-none">
                <span class="px-2 text-[9px] font-black text-brandAccent tracking-widest uppercase block mb-2">
                    ⚡ Switch Role Control
                </span>
                <div class="grid grid-cols-3 gap-1.5">
                    <a href="/dev/switch/admin" class="flex items-center justify-center bg-brandAccent/10 border border-brandAccent/20 hover:bg-brandAccent text-brandAccent hover:text-white py-2 rounded-xl text-[9px] font-black transition-smooth {{ auth()->check() && auth()->user()->is_admin ? 'bg-brandAccent text-white shadow-lg' : '' }}">
                        🔑 Admin
                    </a>
                    <a href="/dev/switch/vendor" class="flex items-center justify-center bg-yellow-500/10 border border-yellow-500/20 hover:bg-yellow-500 text-yellow-500 hover:text-black py-2 rounded-xl text-[9px] font-black transition-smooth {{ auth()->check() && !auth()->user()->is_admin && auth()->user()->isApprovedVendor() ? 'bg-yellow-500 text-black shadow-lg' : '' }}">
                        💼 Vendor
                    </a>
                    <a href="/dev/switch/customer" class="flex items-center justify-center bg-white/5 border border-white/10 hover:bg-white/10 text-textMuted hover:text-white py-2 rounded-xl text-[9px] font-black transition-smooth {{ auth()->check() && !auth()->user()->is_admin && !auth()->user()->isVendor() ? 'bg-white/10 text-white border-white/20' : '' }}">
                        👤 Cust
                    </a>
                </div>
            </div>

            <!-- Profile Summary & Logout -->
            <div class="p-4 border-t border-cardBorder">
                @auth
                    <div class="flex items-center justify-between bg-white/5 border border-white/5 rounded-2xl p-3 mb-3 relative overflow-hidden specular-glass">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-brandAccent flex items-center justify-center font-black text-white text-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="truncate max-w-[120px]">
                                <h4 class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</h4>
                                <span class="text-[10px] text-textMuted truncate block">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 bg-brandRed/10 hover:bg-brandRed/20 text-brandRed hover:text-red-300 py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim">
                            🚪 Logout
                        </button>
                    </form>
                @else
                    <div class="grid grid-cols-2 gap-2">
                        <a href="/login" class="flex items-center justify-center bg-cardBorder hover:bg-white/10 text-white py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim">
                            Login
                        </a>
                        <a href="/register" class="flex items-center justify-center bg-brandAccent hover:bg-brandAccentHover text-white py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim shadow-lg">
                            Register
                        </a>
                    </div>
                @endauth
            </div>
        </aside>

        <!-- MAIN LAYOUT WRAPPER (Right) -->
        <div class="flex-1 flex flex-col min-w-0">

            <!-- NAVBAR -->
            @include('layouts.navigation')

            <!-- SUMMARY BAR (Top header) -->
            <div class="bg-bgDarker border-b border-cardBorder py-6 px-6 sm:px-8">
                <div class="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h2 class="text-sm font-semibold text-textMuted uppercase tracking-wider">Marketplace Summary</h2>
                    </div>

                    <!-- Dynanic Stats Summary -->
                    <div class="flex flex-wrap gap-4 md:gap-8">
                        @auth
                            @if(auth()->user()->is_admin)
                                <!-- Admin Summary Bar -->
                                <div class="flex items-center gap-3">
                                    <span class="text-xs text-textMuted">Total Revenue:</span>
                                    <span class="text-sm tabular-nums text-brandGreen">₹{{ number_format(\App\Models\Order::sum('total_price'), 2) }}</span>
                                </div>
                                <div class="w-px h-4 bg-cardBorder hidden sm:block"></div>
                                <div class="flex items-center gap-3">
                                    <span class="text-xs text-textMuted">Total Orders:</span>
                                    <span class="text-sm tabular-nums text-brandAccent">{{ \App\Models\Order::count() }}</span>
                                </div>
                                <div class="w-px h-4 bg-cardBorder hidden sm:block"></div>
                                <div class="flex items-center gap-3">
                                    <span class="text-xs text-textMuted">Categories:</span>
                                    <span class="text-sm tabular-nums text-white">{{ \App\Models\Category::count() }}</span>
                                </div>
                            @else
                                <!-- Customer Summary Bar -->
                                <div class="flex items-center gap-3">
                                    <span class="text-xs text-textMuted">Total Spent:</span>
                                    <span class="text-sm tabular-nums text-brandGreen">₹{{ number_format(\App\Models\Order::where('user_id', auth()->id())->sum('total_price'), 2) }}</span>
                                </div>
                                <div class="w-px h-4 bg-cardBorder hidden sm:block"></div>
                                <div class="flex items-center gap-3">
                                    <span class="text-xs text-textMuted">My Orders:</span>
                                    <span class="text-sm tabular-nums text-brandAccent">{{ \App\Models\Order::where('user_id', auth()->id())->count() }}</span>
                                </div>
                                <div class="w-px h-4 bg-cardBorder hidden sm:block"></div>
                                <div class="flex items-center gap-3">
                                    <span class="text-xs text-textMuted">Cart Items:</span>
                                    <span class="text-sm tabular-nums text-white">{{ count(session('cart', [])) }}</span>
                                </div>
                            @endif
                        @else
                            <!-- Guest Summary Bar -->
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-textMuted">Shopping Cart:</span>
                                <span class="text-sm tabular-nums text-white">{{ count(session('cart', [])) }} items</span>
                            </div>
                            <div class="w-px h-4 bg-cardBorder hidden sm:block"></div>
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-textMuted">Product Count:</span>
                                <span class="text-sm tabular-nums text-brandAccent">{{ \App\Models\Product::count() }} items</span>
                            </div>
                            <div class="w-px h-4 bg-cardBorder hidden sm:block"></div>
                            <div class="flex items-center gap-3">
                                <span class="text-xs text-textMuted">Active Deals:</span>
                                <span class="text-sm tabular-nums text-brandGreen">Seeded Live</span>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>

            <!-- MAIN CONTENT CONTAINER -->
            <main class="flex-1 max-w-7xl w-full mx-auto px-6 sm:px-8 py-8">
                <!-- Session Success/Error alerts -->
                @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-brandGreen/10 border border-brandGreen/20 text-brandGreen text-sm flex items-center gap-2">
                        ✨ {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-6 p-4 rounded-xl bg-brandRed/10 border border-brandRed/20 text-brandRed text-sm flex items-center gap-2">
                        ❌ {{ session('error') }}
                    </div>
                @endif

                {{ $slot }}
            </main>

            <!-- FOOTER -->
            <footer class="bg-bgDarker border-t border-cardBorder py-8 mt-auto px-6 sm:px-8">
                <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-textMuted">
                    <p>© {{ date('Y') }} Bulk Bazaar. Designed with premium Linear meets Fintech aesthetics.</p>
                    <div class="flex gap-6">
                        <a href="#" class="hover:text-white transition-smooth">Privacy</a>
                        <a href="#" class="hover:text-white transition-smooth">Terms</a>
                        <a href="#" class="hover:text-white transition-smooth">Support</a>
                    </div>
                </div>
            </footer>

        </div>
    </div>

</body>

</html>