<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulk Bazaar</title>

    <!-- Tailwind CDN (simple for now) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- NAVBAR -->
    <nav class="bg-white shadow p-4 flex justify-between">
        <div class="text-xl font-bold">
            BulkBazaar
        </div>

        <div class="space-x-4">
            <a href="/products" class="hover:text-blue-500">Products</a>
            <a href="/cart" class="hover:text-blue-500">Cart</a>
            <a href="/my-orders" class="hover:text-blue-500">Orders</a>

            @auth
                <span class="ml-4 text-gray-600">{{ auth()->user()->name }}</span>
            @endauth
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="p-6">
        @yield('content')
    </div>

</body>
</html>