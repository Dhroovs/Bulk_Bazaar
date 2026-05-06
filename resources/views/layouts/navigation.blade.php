<nav x-data="{ open: false }"
     class="bg-[#0b1120]/95 backdrop-blur-lg
            border-b border-gray-800
            sticky top-0 z-50">

    <div class="max-w-7xl mx-auto px-4 lg:px-6">

        <!-- TOP BAR -->
        <div class="flex items-center justify-between h-20">

            <!-- LEFT -->
            <div class="flex items-center gap-10">

                <!-- LOGO -->
                <a href="/"
                   class="flex items-center gap-3">

                    <div class="w-12 h-12
                                bg-blue-500 rounded-2xl
                                flex items-center justify-center
                                text-2xl shadow-lg">

                        🛒

                    </div>

                    <div class="hidden sm:block">

                        <h1 class="text-2xl font-black text-white leading-none">
                            Bulk Bazaar
                        </h1>

                        <p class="text-xs text-gray-400 mt-1">
                            Premium Ecommerce
                        </p>

                    </div>

                </a>

                <!-- DESKTOP NAV -->
                <div class="hidden lg:flex items-center gap-8">

                    <a href="/"
                       class="text-gray-300 hover:text-white
                              font-semibold transition duration-300">

                        Home

                    </a>

                    <a href="/products"
                       class="text-gray-300 hover:text-white
                              font-semibold transition duration-300">

                        Products

                    </a>

                    <a href="/my-orders"
                       class="text-gray-300 hover:text-white
                              font-semibold transition duration-300">

                        My Orders

                    </a>

                    <a href="/dashboard"
                       class="text-gray-300 hover:text-white
                              font-semibold transition duration-300">

                        My Account

                    </a>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-3">

                <!-- SEARCH -->
                <form action="/products"
                      method="GET"
                      class="hidden md:flex items-center
                             bg-[#172033]
                             border border-gray-800
                             rounded-2xl px-4 py-3">

                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Search products..."
                           class="bg-transparent
                                  outline-none
                                  text-white
                                  placeholder-gray-500
                                  w-40 lg:w-52">

                    <button type="submit"
                            class="text-gray-400 ml-3 hover:text-white transition">

                        🔍

                    </button>

                </form>

                <!-- CART -->
                <a href="/cart"
                   class="relative bg-[#172033]
                          border border-gray-800
                          hover:border-blue-500
                          w-14 h-14 rounded-2xl
                          flex items-center justify-center
                          text-2xl transition duration-300">

                    🛒

                    <span class="absolute -top-2 -right-2
                                 bg-blue-500 text-white
                                 text-xs font-bold
                                 w-6 h-6 rounded-full
                                 flex items-center justify-center">

                        {{ count(session('cart', [])) }}

                    </span>

                </a>

                <!-- USER -->
                @auth

                    <div class="hidden md:flex items-center gap-4
                                bg-[#172033]
                                border border-gray-800
                                rounded-2xl px-4 py-3">

                        <div class="w-11 h-11 rounded-full
                                    bg-blue-500
                                    flex items-center justify-center
                                    font-black text-lg">

                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                        </div>

                        <div>

                            <h3 class="font-bold text-white leading-none mb-1">

                                {{ Auth::user()->name }}

                            </h3>

                            <p class="text-xs text-gray-400">

                                {{ Auth::user()->email }}

                            </p>

                        </div>

                    </div>

                @endauth

                <!-- MOBILE MENU BUTTON -->
                <button @click="open = !open"
                        class="lg:hidden bg-[#172033]
                               border border-gray-800
                               w-14 h-14 rounded-2xl
                               flex items-center justify-center
                               text-2xl">

                    ☰

                </button>

            </div>

        </div>

        <!-- MOBILE MENU -->
        <div x-show="open"
             x-transition
             class="lg:hidden border-t border-gray-800 py-6 space-y-4">

            <!-- MOBILE SEARCH -->
            <form action="/products"
                  method="GET"
                  class="flex items-center
                         bg-[#172033]
                         border border-gray-800
                         rounded-2xl px-4 py-3">

                <input type="text"
                       name="search"
                       placeholder="Search products..."
                       class="bg-transparent
                              outline-none
                              text-white
                              placeholder-gray-500
                              w-full">

                <button type="submit"
                        class="text-gray-400 ml-3">

                    🔍

                </button>

            </form>

            <!-- MOBILE LINKS -->
            <a href="/"
               class="block bg-[#172033]
                      hover:bg-[#22304d]
                      px-5 py-4 rounded-2xl
                      font-semibold transition">

                Home

            </a>

            <a href="/products"
               class="block bg-[#172033]
                      hover:bg-[#22304d]
                      px-5 py-4 rounded-2xl
                      font-semibold transition">

                Products

            </a>

            <a href="/my-orders"
               class="block bg-[#172033]
                      hover:bg-[#22304d]
                      px-5 py-4 rounded-2xl
                      font-semibold transition">

                My Orders

            </a>

            <a href="/dashboard"
               class="block bg-[#172033]
                      hover:bg-[#22304d]
                      px-5 py-4 rounded-2xl
                      font-semibold transition">

                My Account

            </a>

            @auth

                @if(auth()->user()->is_admin)

                    <div class="border-t border-gray-800 pt-5 space-y-4">

                        <a href="/admin/products"
                           class="block bg-yellow-400
                                  text-black px-5 py-4
                                  rounded-2xl font-bold">

                            ⚙️ Admin Products

                        </a>

                        <a href="/admin/categories"
                           class="block bg-cyan-500
                                  text-white px-5 py-4
                                  rounded-2xl font-bold">

                            📂 Admin Categories

                        </a>

                        <a href="/admin/orders"
                           class="block bg-red-500
                                  text-white px-5 py-4
                                  rounded-2xl font-bold">

                            📊 Admin Orders

                        </a>

                    </div>

                @endif

            @endauth

        </div>

    </div>

</nav>