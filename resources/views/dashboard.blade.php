<x-app-layout>

<div class="bg-[#0b1120] min-h-screen text-white py-10">

    <div class="max-w-7xl mx-auto px-6">

        <!-- HEADER -->
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">

            <div>

                <h1 class="text-5xl font-black mb-4">
                    My Account
                </h1>

                <p class="text-gray-400 text-lg">
                    Manage your profile, orders and shopping activity.
                </p>

            </div>

            <!-- PROFILE BADGE -->
            <div class="bg-[#172033]
                        border border-gray-800
                        rounded-3xl px-8 py-5">

                <div class="flex items-center gap-5">

                    <div class="w-16 h-16 rounded-full
                                bg-blue-500
                                flex items-center justify-center
                                text-3xl font-black">

                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}

                    </div>

                    <div>

                        <h3 class="text-2xl font-bold">

                            {{ Auth::user()->name }}

                        </h3>

                        <p class="text-gray-400">

                            {{ Auth::user()->email }}

                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- STATS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <!-- TOTAL ORDERS -->
            <div class="bg-[#172033]
                        border border-gray-800
                        rounded-3xl p-8">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 mb-3">
                            Total Orders
                        </p>

                        <h2 class="text-5xl font-black text-blue-400">

                            {{ \App\Models\Order::where('user_id', Auth::id())->count() }}

                        </h2>

                    </div>

                    <div class="text-6xl">
                        📦
                    </div>

                </div>

            </div>

            <!-- CART ITEMS -->
            <div class="bg-[#172033]
                        border border-gray-800
                        rounded-3xl p-8">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 mb-3">
                            Cart Items
                        </p>

                        <h2 class="text-5xl font-black text-green-400">

                            {{ count(session('cart', [])) }}

                        </h2>

                    </div>

                    <div class="text-6xl">
                        🛒
                    </div>

                </div>

            </div>

            <!-- ACCOUNT STATUS -->
            <div class="bg-[#172033]
                        border border-gray-800
                        rounded-3xl p-8">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 mb-3">
                            Account Status
                        </p>

                        <h2 class="text-4xl font-black text-purple-400">

                            Active

                        </h2>

                    </div>

                    <div class="text-6xl">
                        👤
                    </div>

                </div>

            </div>

        </div>

        <!-- MAIN GRID -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- LEFT -->
            <div class="lg:col-span-2 space-y-8">

                <!-- RECENT ORDERS -->
                <div class="bg-[#172033]
                            border border-gray-800
                            rounded-[35px]
                            overflow-hidden shadow-2xl">

                    <!-- HEADER -->
                    <div class="p-8 border-b border-gray-800">

                        <div class="flex items-center justify-between">

                            <div>

                                <h2 class="text-3xl font-black mb-2">
                                    Recent Orders
                                </h2>

                                <p class="text-gray-400">
                                    Your latest order activity.
                                </p>

                            </div>

                            <a href="/my-orders"
                               class="bg-blue-500 hover:bg-blue-600
                                      px-5 py-3 rounded-2xl
                                      font-bold transition">

                                View All

                            </a>

                        </div>

                    </div>

                    <!-- ORDERS -->
                    <div class="p-8 space-y-5">

                        @forelse(\App\Models\Order::where('user_id', Auth::id())->latest()->take(3)->get() as $order)

                            <div class="bg-[#111827]
                                        border border-gray-800
                                        rounded-3xl p-6">

                                <div class="flex flex-col md:flex-row
                                            md:items-center
                                            md:justify-between gap-5">

                                    <!-- LEFT -->
                                    <div>

                                        <h3 class="text-2xl font-bold mb-2">

                                            Order #{{ $order->id }}

                                        </h3>

                                        <p class="text-gray-400">

                                            {{ $order->created_at->format('d M Y') }}

                                        </p>

                                    </div>

                                    <!-- CENTER -->
                                    <div>

                                        <p class="text-gray-400 mb-2">
                                            Total
                                        </p>

                                        <h3 class="text-3xl font-black text-blue-400">

                                            ₹{{ $order->total_price }}

                                        </h3>

                                    </div>

                                    <!-- STATUS -->
                                    <div>

                                        @if($order->status == 'pending')

                                            <span class="bg-yellow-500/20
                                                         text-yellow-400
                                                         px-5 py-3 rounded-full
                                                         font-bold">

                                                Pending

                                            </span>

                                        @elseif($order->status == 'shipped')

                                            <span class="bg-blue-500/20
                                                         text-blue-400
                                                         px-5 py-3 rounded-full
                                                         font-bold">

                                                Shipped

                                            </span>

                                        @elseif($order->status == 'delivered')

                                            <span class="bg-green-500/20
                                                         text-green-400
                                                         px-5 py-3 rounded-full
                                                         font-bold">

                                                Delivered

                                            </span>

                                        @else

                                            <span class="bg-gray-500/20
                                                         text-gray-400
                                                         px-5 py-3 rounded-full
                                                         font-bold">

                                                {{ ucfirst($order->status) }}

                                            </span>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        @empty

                            <div class="text-center py-16">

                                <div class="text-7xl mb-5">
                                    📦
                                </div>

                                <h3 class="text-3xl font-black mb-3">
                                    No Orders Yet
                                </h3>

                                <p class="text-gray-400 mb-8">
                                    Start shopping to place your first order.
                                </p>

                                <a href="/products"
                                   class="bg-blue-500 hover:bg-blue-600
                                          px-8 py-4 rounded-2xl
                                          font-bold inline-block">

                                    Browse Products

                                </a>

                            </div>

                        @endforelse

                    </div>

                </div>

            </div>

            <!-- RIGHT -->
            <div class="space-y-8">

                <!-- QUICK ACTIONS -->
                <div class="bg-[#172033]
                            border border-gray-800
                            rounded-[35px]
                            p-8 shadow-2xl">

                    <h2 class="text-3xl font-black mb-8">
                        Quick Actions
                    </h2>

                    <div class="space-y-5">

                        <!-- PRODUCTS -->
                        <a href="/products"
                           class="flex items-center gap-5
                                  bg-blue-500 hover:bg-blue-600
                                  px-6 py-5 rounded-2xl
                                  transition duration-300
                                  hover:scale-105">

                            <div class="text-3xl">
                                🛍️
                            </div>

                            <div>

                                <h3 class="font-bold text-lg">
                                    Browse Products
                                </h3>

                                <p class="text-sm text-blue-100">
                                    Explore all products
                                </p>

                            </div>

                        </a>

                        <!-- CART -->
                        <a href="/cart"
                           class="flex items-center gap-5
                                  bg-green-500 hover:bg-green-600
                                  px-6 py-5 rounded-2xl
                                  transition duration-300
                                  hover:scale-105">

                            <div class="text-3xl">
                                🛒
                            </div>

                            <div>

                                <h3 class="font-bold text-lg">
                                    View Cart
                                </h3>

                                <p class="text-sm text-green-100">
                                    Manage your cart items
                                </p>

                            </div>

                        </a>

                        <!-- ORDERS -->
                        <a href="/my-orders"
                           class="flex items-center gap-5
                                  bg-purple-500 hover:bg-purple-600
                                  px-6 py-5 rounded-2xl
                                  transition duration-300
                                  hover:scale-105">

                            <div class="text-3xl">
                                📦
                            </div>

                            <div>

                                <h3 class="font-bold text-lg">
                                    My Orders
                                </h3>

                                <p class="text-sm text-purple-100">
                                    Track your purchases
                                </p>

                            </div>

                        </a>

                        <!-- ADMIN CATEGORIES -->
<a href="/admin/categories"
   class="flex items-center gap-5
          bg-cyan-500 hover:bg-cyan-600
          px-6 py-5 rounded-2xl
          transition duration-300
          hover:scale-105">

    <div class="text-3xl">
        📂
    </div>

    <div>

        <h3 class="font-bold text-lg">
            Admin Categories
        </h3>

        <p class="text-sm text-cyan-100">
            Manage store categories
        </p>

    </div>

</a>

                            <!-- ADMIN PRODUCTS -->
                            <a href="/admin/products"
                               class="flex items-center gap-5
                                      bg-yellow-400 hover:bg-yellow-500
                                      text-black
                                      px-6 py-5 rounded-2xl
                                      transition duration-300
                                      hover:scale-105">

                                <div class="text-3xl">
                                    ⚙️
                                </div>

                                <div>

                                    <h3 class="font-bold text-lg">
                                        Admin Products
                                    </h3>

                                    <p class="text-sm">
                                        Manage store products
                                    </p>

                                </div>

                            </a>

                            <!-- ADMIN ORDERS -->
                            <a href="/admin/orders"
                               class="flex items-center gap-5
                                      bg-red-500 hover:bg-red-600
                                      px-6 py-5 rounded-2xl
                                      transition duration-300
                                      hover:scale-105">

                                <div class="text-3xl">
                                    📊
                                </div>

                                <div>

                                    <h3 class="font-bold text-lg">
                                        Admin Orders
                                    </h3>

                                    <p class="text-sm text-red-100">
                                        Manage customer orders
                                    </p>

                                </div>

                            </a>


                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</x-app-layout>