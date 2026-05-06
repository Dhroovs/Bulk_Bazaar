<x-app-layout>

<div class="bg-[#0b1120] min-h-screen text-white py-10">

    <div class="max-w-7xl mx-auto px-6">

        <!-- HEADER -->
        <div class="flex flex-col lg:flex-row
                    lg:items-center
                    lg:justify-between gap-6 mb-10">

            <div>

                <h1 class="text-5xl font-black mb-4">
                    Category Management
                </h1>

                <p class="text-gray-400 text-lg">
                    Manage all product categories for your ecommerce platform.
                </p>

            </div>

            <a href="/admin/categories/create"
               class="bg-blue-500 hover:bg-blue-600
                      px-8 py-4 rounded-2xl
                      font-bold text-lg
                      transition duration-300
                      hover:scale-105 w-fit">

                + Add Category

            </a>

        </div>

        <!-- SUCCESS -->
        @if(session('success'))

            <div class="bg-green-500/20
                        border border-green-500
                        text-green-400
                        px-6 py-4 rounded-2xl
                        mb-8 font-semibold">

                {{ session('success') }}

            </div>

        @endif

        <!-- STATS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <!-- TOTAL -->
            <div class="bg-[#172033]
                        border border-gray-800
                        rounded-3xl p-8">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 mb-3">
                            Total Categories
                        </p>

                        <h2 class="text-5xl font-black text-blue-400">

                            {{ $categories->count() }}

                        </h2>

                    </div>

                    <div class="text-6xl">
                        📂
                    </div>

                </div>

            </div>

            <!-- PRODUCTS -->
            <div class="bg-[#172033]
                        border border-gray-800
                        rounded-3xl p-8">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 mb-3">
                            Total Products
                        </p>

                        <h2 class="text-5xl font-black text-green-400">

                            {{ \App\Models\Product::count() }}

                        </h2>

                    </div>

                    <div class="text-6xl">
                        📦
                    </div>

                </div>

            </div>

            <!-- ACTIVE -->
            <div class="bg-[#172033]
                        border border-gray-800
                        rounded-3xl p-8">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 mb-3">
                            Active Categories
                        </p>

                        <h2 class="text-5xl font-black text-purple-400">

                            {{ $categories->count() }}

                        </h2>

                    </div>

                    <div class="text-6xl">
                        🚀
                    </div>

                </div>

            </div>

        </div>

        <!-- CATEGORY TABLE -->
        <div class="bg-[#172033]
                    border border-gray-800
                    rounded-[35px]
                    overflow-hidden shadow-2xl">

            <div class="p-8 border-b border-gray-800">

                <h2 class="text-3xl font-black mb-2">
                    All Categories
                </h2>

                <p class="text-gray-400">
                    View and manage all categories.
                </p>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-[#1b263b]">

                        <tr>

                            <th class="text-left p-6">
                                Category
                            </th>

                            <th class="text-left p-6">
                                Products
                            </th>

                            <th class="text-left p-6">
                                Status
                            </th>

                            <th class="text-left p-6">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($categories as $category)

                            <tr class="border-b border-gray-800
                                       hover:bg-[#1a2437]
                                       transition duration-300">

                                <!-- CATEGORY -->
                                <td class="p-6">

                                    <div class="flex items-center gap-5">

                                        <div class="w-20 h-20
                                                    bg-[#1e293b]
                                                    rounded-2xl
                                                    flex items-center justify-center
                                                    text-4xl">

                                            📂

                                        </div>

                                        <div>

                                            <h3 class="text-2xl font-bold mb-2">

                                                {{ $category->name }}

                                            </h3>

                                            <p class="text-gray-400 text-sm">

                                                Category ID:
                                                #{{ $category->id }}

                                            </p>

                                        </div>

                                    </div>

                                </td>

                                <!-- PRODUCTS -->
                                <td class="p-6">

                                    <h3 class="text-2xl font-black text-blue-400">

                                        {{ $category->products->count() }}

                                    </h3>

                                </td>

                                <!-- STATUS -->
                                <td class="p-6">

                                    <span class="bg-green-500/20
                                                 text-green-400
                                                 px-4 py-2 rounded-full
                                                 text-sm font-bold">

                                        Active

                                    </span>

                                </td>

                                <!-- ACTIONS -->
                                <td class="p-6">

                                    <div class="flex gap-3">

                                        <a href="/admin/categories/edit/{{ $category->id }}"
                                           class="bg-yellow-500 hover:bg-yellow-600
                                                  text-black px-5 py-2 rounded-xl
                                                  font-bold transition duration-300">

                                            Edit

                                        </a>

                                        <a href="/admin/categories/delete/{{ $category->id }}"
                                           class="bg-red-500 hover:bg-red-600
                                                  text-white px-5 py-2 rounded-xl
                                                  font-bold transition duration-300">

                                            Delete

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

</x-app-layout>