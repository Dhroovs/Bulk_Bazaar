<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Bulk Bazaar</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-[#070b14] text-white min-h-screen flex flex-col">

    <!-- NAVBAR -->
    @include('layouts.navigation')

    <!-- MAIN CONTENT -->
    <main class="flex-1">

        <div class="max-w-7xl mx-auto px-6 py-8">

            {{ $slot }}

        </div>

    </main>

    <!-- FOOTER -->
    <footer class="bg-[#0b1120]
                   border-t border-gray-800
                   mt-20">

        <div class="max-w-7xl mx-auto px-6 py-16">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

                <!-- BRAND -->
                <div>

                    <div class="flex items-center gap-4 mb-6">

                        <div class="w-14 h-14
                                    bg-blue-500 rounded-2xl
                                    flex items-center justify-center
                                    text-3xl shadow-lg">

                            🛒

                        </div>

                        <div>

                            <h2 class="text-3xl font-black text-white">
                                Bulk Bazaar
                            </h2>

                            <p class="text-sm text-gray-400">
                                Premium Ecommerce
                            </p>

                        </div>

                    </div>

                    <p class="text-gray-400 leading-7">

                        Bulk Bazaar is a modern ecommerce platform
                        built with Laravel featuring premium UI,
                        advanced admin management and complete
                        shopping functionality.

                    </p>

                </div>

                <!-- QUICK LINKS -->
                <div>

                    <h3 class="text-2xl font-black mb-6">
                        Quick Links
                    </h3>

                    <div class="space-y-4">

                        <a href="/"
                           class="block text-gray-400 hover:text-white transition">

                            Home

                        </a>

                        <a href="/products"
                           class="block text-gray-400 hover:text-white transition">

                            Products

                        </a>

                        <a href="/cart"
                           class="block text-gray-400 hover:text-white transition">

                            Cart

                        </a>

                        <a href="/my-orders"
                           class="block text-gray-400 hover:text-white transition">

                            My Orders

                        </a>

                    </div>

                </div>

                <!-- CUSTOMER SUPPORT -->
                <div>

                    <h3 class="text-2xl font-black mb-6">
                        Customer Support
                    </h3>

                    <div class="space-y-4 text-gray-400">

                        <p>
                            📧 support@bulkbazaar.com
                        </p>

                        <p>
                            📞 +91 98765 43210
                        </p>

                        <p>
                            🕒 24/7 Customer Support
                        </p>

                        <p>
                            🚚 Fast Nationwide Delivery
                        </p>

                    </div>

                </div>

                <!-- SOCIAL -->
                <div>

                    <h3 class="text-2xl font-black mb-6">
                        Follow Us
                    </h3>

                    <div class="flex gap-4 mb-6">

                        <!-- FACEBOOK -->
                        <div class="w-14 h-14
                                    bg-[#172033]
                                    border border-gray-800
                                    rounded-2xl
                                    flex items-center justify-center
                                    text-2xl hover:bg-blue-500
                                    transition duration-300 cursor-pointer">

                            📘

                        </div>

                        <!-- INSTAGRAM -->
                        <div class="w-14 h-14
                                    bg-[#172033]
                                    border border-gray-800
                                    rounded-2xl
                                    flex items-center justify-center
                                    text-2xl hover:bg-pink-500
                                    transition duration-300 cursor-pointer">

                            📸

                        </div>

                        <!-- TWITTER -->
                        <div class="w-14 h-14
                                    bg-[#172033]
                                    border border-gray-800
                                    rounded-2xl
                                    flex items-center justify-center
                                    text-2xl hover:bg-cyan-500
                                    transition duration-300 cursor-pointer">

                            🐦

                        </div>

                    </div>

                    <p class="text-gray-400 leading-7">

                        Stay connected with Bulk Bazaar for
                        latest products, offers and updates.

                    </p>

                </div>

            </div>

            <!-- BOTTOM -->
            <div class="border-t border-gray-800
                        mt-14 pt-8
                        flex flex-col lg:flex-row
                        items-center justify-between gap-5">

                <p class="text-gray-500 text-sm">

                    © {{ date('Y') }} Bulk Bazaar.
                    All Rights Reserved.

                </p>

                <div class="flex gap-6 text-sm text-gray-500">

                    <a href="#"
                       class="hover:text-white transition">

                        Privacy Policy

                    </a>

                    <a href="#"
                       class="hover:text-white transition">

                        Terms & Conditions

                    </a>

                    <a href="#"
                       class="hover:text-white transition">

                        Help Center

                    </a>

                </div>

            </div>

        </div>

    </footer>

</body>

</html>