<nav x-data="{ mobileMenuOpen: false, profileDropdownOpen: false, notificationsOpen: false }"
     class="glassmorphism-luxury border-none m-6 mb-0 sticky top-0 z-40 px-6 sm:px-8 rounded-3xl shadow-xl">
    <div class="max-w-7xl mx-auto flex items-center justify-between h-16">
        
        <!-- LEFT: Mobile Menu Button & Search -->
        <div class="flex items-center gap-4">
            <!-- Mobile Toggle -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" 
                    class="lg:hidden w-10 h-10 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center text-white transition-smooth hover:bg-white/10">
                ☰
            </button>

            <!-- Search Form (Raycast style) -->
            <form action="/products" method="GET" class="hidden md:flex items-center bg-white/5 border border-white/10 rounded-2xl px-4 py-2 focus-within:border-brandAccent/50 focus-within:bg-white/10 transition-smooth select-none relative group">
                <span class="text-xs text-textMuted mr-2 select-none">⌘</span>
                <input type="text" id="global-search-input" name="search" value="{{ request('search') }}" placeholder="Search or run commands..." 
                       class="bg-transparent border-none outline-none text-xs text-white placeholder-textMuted w-48 lg:w-72 focus:ring-0 p-0">
                <div class="flex items-center gap-1 bg-white/10 border border-white/10 px-1.5 py-0.5 rounded text-[8px] text-textMuted font-bold uppercase select-none group-focus-within:opacity-0 transition-smooth">
                    <span>/</span>
                </div>
            </form>
        </div>

        <!-- CENTER: Mobile Brand Logo only -->
        <div class="flex lg:hidden items-center">
            <a href="/" class="flex items-center gap-2">
                <img src="/logo.png" alt="Bulk Bazaar" class="h-12 w-auto object-contain">
            </a>
        </div>

        <!-- RIGHT: Cart & User Profile -->
        <div class="flex items-center gap-3">
            <!-- Theme Toggle Button -->
            <button onclick="toggleTheme()" 
                    class="w-10 h-10 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center text-white transition-smooth hover:border-brandAccent/50 hover:bg-white/10"
                    title="Toggle Light/Dark Theme">
                <span class="dark-icon text-sm">🌙</span>
                <span class="light-icon text-sm">☀️</span>
            </button>

            <!-- Shopping Cart -->
            <a href="/cart" class="relative w-10 h-10 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center text-white transition-smooth hover:border-brandAccent/50 hover:bg-white/10">
                🛒
                @if(count(session('cart', [])) > 0)
                    <span class="absolute -top-1.5 -right-1.5 bg-brandAccent text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center animate-pulse">
                        {{ count(session('cart', [])) }}
                    </span>
                @endif
            </a>

            @auth
                <!-- Notifications Center -->
                <div class="relative">
                    <button @click="notificationsOpen = !notificationsOpen" 
                            class="relative w-10 h-10 bg-white/5 border border-white/10 rounded-xl flex items-center justify-center text-white transition-smooth hover:border-brandAccent/50 hover:bg-white/10">
                        🔔
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="absolute -top-1.5 -right-1.5 bg-yellow-500 text-black text-[9px] font-black w-5 h-5 rounded-full flex items-center justify-center animate-pulse">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </button>

                    <!-- Dropdown List -->
                    <div x-show="notificationsOpen" @click.away="notificationsOpen = false" x-transition
                         class="absolute right-0 mt-2 w-80 bg-sidebarBg border border-cardBorder rounded-2xl shadow-2xl p-4 z-50 space-y-3">
                        <div class="flex items-center justify-between border-b border-cardBorder pb-2">
                            <h4 class="font-extrabold text-xs text-white">Notifications</h4>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                                <form method="POST" action="/notifications/read-all">
                                    @csrf
                                    <button type="submit" class="text-[9px] font-black text-brandAccent hover:underline uppercase">
                                        Mark All Read
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div class="space-y-2 max-h-64 overflow-y-auto">
                            @forelse(auth()->user()->unreadNotifications->take(5) as $noti)
                                <a href="/notifications/{{ $noti->id }}/read" class="block p-2.5 rounded-xl hover:bg-white/5 border border-transparent hover:border-white/5 transition-smooth text-left">
                                    <div class="flex items-start gap-2.5">
                                        <span class="text-sm shrink-0">{{ $noti->data['icon'] ?? '🔔' }}</span>
                                        <div class="space-y-0.5">
                                            <h5 class="font-bold text-[11px] text-white leading-tight">{{ $noti->data['title'] ?? 'Notification' }}</h5>
                                            <p class="text-[10px] text-textMuted leading-snug">{{ $noti->data['message'] ?? '' }}</p>
                                            <span class="text-[8px] text-textMuted block font-medium">{{ $noti->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center py-6 text-textMuted text-xs font-semibold">
                                    ✨ All quiet on this node
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- User Auth Profile Dropdown / Guest Auth links -->
                <div class="relative">
                    <button @click="profileDropdownOpen = !profileDropdownOpen" 
                            class="flex items-center gap-2 bg-white/5 border border-white/10 rounded-xl p-1.5 transition-smooth hover:bg-white/10 text-left">
                        <div class="w-7 h-7 rounded-full bg-brandAccent flex items-center justify-center font-bold text-white text-xs">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="text-xs font-semibold text-white hidden sm:inline truncate max-w-[80px]">{{ auth()->user()->name }}</span>
                        <span class="text-textMuted text-[10px] hidden sm:inline">▼</span>
                    </button>

                    <!-- Dropdown List -->
                    <div x-show="profileDropdownOpen" @click.away="profileDropdownOpen = false" x-transition
                         class="absolute right-0 mt-2 w-48 bg-sidebarBg border border-cardBorder rounded-2xl shadow-2xl p-2 z-50">
                        <a href="/dashboard" class="block px-4 py-2 text-xs text-textMuted hover:text-white hover:bg-cardBorder rounded-xl transition-smooth">
                            👤 My Account
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-xs text-brandRed hover:bg-brandRed/10 rounded-xl transition-smooth">
                                🚪 Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="flex items-center gap-2">
                    <a href="/login" class="bg-white/5 border border-white/10 hover:bg-white/10 text-white text-xs font-bold px-4 py-2 rounded-xl transition-smooth btn-micro-anim">
                        Login
                    </a>
                    <a href="/register" class="bg-brandAccent hover:bg-brandAccentHover text-white text-xs font-bold px-4 py-2 rounded-xl transition-smooth btn-micro-anim shadow-lg">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>

    <!-- MOBILE NAVIGATION MENU (Drawer) -->
    <div x-show="mobileMenuOpen" x-transition class="lg:hidden border-t border-cardBorder py-4 space-y-3">
        <!-- Search bar for mobile -->
        <form action="/products" method="GET" class="flex items-center bg-white/5 border border-white/10 rounded-xl px-3 py-2">
            <input type="text" name="search" placeholder="Search or run commands..." class="bg-transparent border-none outline-none text-xs text-white placeholder-textMuted w-full focus:ring-0 p-0">
            <button type="submit" class="text-textMuted hover:text-white">🔍</button>
        </form>

        <div class="space-y-1">
            <a href="/" class="block px-4 py-2.5 rounded-xl text-xs font-medium text-textMuted hover:bg-white/5 hover:text-white">
                🏠 Home
            </a>
            <a href="/products" class="block px-4 py-2.5 rounded-xl text-xs font-medium text-textMuted hover:bg-white/5 hover:text-white">
                🛍️ Products
            </a>
            @auth
                <a href="/my-orders" class="block px-4 py-2.5 rounded-xl text-xs font-medium text-textMuted hover:bg-white/5 hover:text-white">
                    📦 My Orders
                </a>
                <a href="/dashboard" class="block px-4 py-2.5 rounded-xl text-xs font-medium text-textMuted hover:bg-white/5 hover:text-white">
                    👤 My Account
                </a>
                @if(auth()->user()->is_admin)
                    <div class="border-t border-cardBorder pt-2 mt-2 space-y-1">
                        <span class="px-4 text-[9px] font-bold text-brandAccent tracking-widest uppercase block mb-1">Admin Panel</span>
                        <a href="/dashboard" class="block px-4 py-2 rounded-xl text-xs font-semibold text-textMuted hover:bg-white/5 hover:text-white">📊 Admin Dashboard</a>
                        <a href="/admin/products" class="block px-4 py-2 rounded-xl text-xs font-semibold text-textMuted hover:bg-white/5 hover:text-white">⚙️ Products</a>
                        <a href="/admin/categories" class="block px-4 py-2 rounded-xl text-xs font-semibold text-textMuted hover:bg-white/5 hover:text-white">📂 Categories</a>
                        <a href="/admin/orders" class="block px-4 py-2 rounded-xl text-xs font-semibold text-textMuted hover:bg-white/5 hover:text-white">📦 Orders</a>
                    </div>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="pt-2">
                    @csrf
                    <button type="submit" class="w-full text-center bg-brandRed/10 text-brandRed hover:bg-brandRed/20 py-2 rounded-xl text-xs font-bold transition-smooth">
                        🚪 Logout
                    </button>
                </form>
            @else
                <div class="grid grid-cols-2 gap-2 pt-2 border-t border-cardBorder">
                    <a href="/login" class="flex items-center justify-center bg-white/5 border border-white/10 text-white py-2 rounded-xl text-xs font-bold">
                        Login
                    </a>
                    <a href="/register" class="flex items-center justify-center bg-brandAccent text-white py-2 rounded-xl text-xs font-bold">
                        Register
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    // Raycast global hotkey focus (/)
    document.addEventListener('keydown', function(e) {
        if (e.key === '/' && document.activeElement.tagName !== 'INPUT' && document.activeElement.tagName !== 'TEXTAREA') {
            e.preventDefault();
            const searchInput = document.getElementById('global-search-input');
            if (searchInput) {
                searchInput.focus();
                searchInput.select();
            }
        }
    });
</script>