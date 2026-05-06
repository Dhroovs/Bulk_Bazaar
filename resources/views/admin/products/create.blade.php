<x-admin-layout>

<div class="bg-[#0b1120] min-h-screen text-white py-10">

    <div class="max-w-5xl mx-auto px-6">

        <!-- HEADER -->
        <div class="mb-10">

            <h1 class="text-5xl font-black mb-4">
                Add New Product
            </h1>

            <p class="text-gray-400 text-lg">
                Create and publish a new product to your ecommerce platform.
            </p>

        </div>

        <!-- FORM -->
        <form action="/admin/products/store"
              method="POST"
              enctype="multipart/form-data"
              class="bg-[#172033]
                     border border-gray-800
                     rounded-[35px]
                     shadow-2xl overflow-hidden">

            @csrf

            <!-- TOP SECTION -->
            <div class="p-10 border-b border-gray-800">

                <h2 class="text-3xl font-black mb-3">
                    Product Information
                </h2>

                <p class="text-gray-400">
                    Fill all required product details carefully.
                </p>

            </div>

            <!-- FORM CONTENT -->
            <div class="p-10">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- PRODUCT NAME -->
                    <div class="md:col-span-2">

                        <label class="block text-lg font-bold mb-3">

                            Product Name

                        </label>

                        <input type="text"
                               name="name"
                               placeholder="Enter product name"
                               class="w-full bg-[#0f172a]
                                      border border-gray-700
                                      rounded-2xl px-6 py-4
                                      text-white text-lg
                                      focus:outline-none
                                      focus:ring-2
                                      focus:ring-blue-500">

                    </div>

                    <!-- PRICE -->
                    <div>

                        <label class="block text-lg font-bold mb-3">

                            Product Price

                        </label>

                        <input type="number"
                               name="price"
                               placeholder="Enter price"
                               class="w-full bg-[#0f172a]
                                      border border-gray-700
                                      rounded-2xl px-6 py-4
                                      text-white text-lg
                                      focus:outline-none
                                      focus:ring-2
                                      focus:ring-blue-500">

                    </div>

                    <!-- STOCK -->
                    <div>

                        <label class="block text-lg font-bold mb-3">

                            Available Stock

                        </label>

                        <input type="number"
                               name="stock"
                               placeholder="Enter stock quantity"
                               class="w-full bg-[#0f172a]
                                      border border-gray-700
                                      rounded-2xl px-6 py-4
                                      text-white text-lg
                                      focus:outline-none
                                      focus:ring-2
                                      focus:ring-blue-500">

                    </div>

                    <!-- CATEGORY -->
                    <div>

                        <label class="block text-lg font-bold mb-3">

                            Product Category

                        </label>

                        <select name="category_id"
                                class="w-full bg-[#0f172a]
                                       border border-gray-700
                                       rounded-2xl px-6 py-4
                                       text-white text-lg
                                       focus:outline-none
                                       focus:ring-2
                                       focus:ring-blue-500">

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}">

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- STATUS -->
                    <div>

                        <label class="block text-lg font-bold mb-3">

                            Product Status

                        </label>

                        <select
                            class="w-full bg-[#0f172a]
                                   border border-gray-700
                                   rounded-2xl px-6 py-4
                                   text-white text-lg">

                            <option>
                                Active
                            </option>

                            <option>
                                Draft
                            </option>

                        </select>

                    </div>

                    <!-- IMAGE -->
                    <div class="md:col-span-2">

                        <label class="block text-lg font-bold mb-3">

                            Product Image

                        </label>

                        <div class="bg-[#0f172a]
                                    border-2 border-dashed
                                    border-gray-700
                                    rounded-3xl
                                    p-10 text-center">

                            <div class="text-6xl mb-5">
                                🖼️
                            </div>

                            <h3 class="text-2xl font-bold mb-3">
                                Upload Product Image
                            </h3>

                            <p class="text-gray-400 mb-6">
                                PNG, JPG or WEBP supported
                            </p>

                            <input type="file"
                                   name="image"
                                   class="bg-[#172033]
                                          border border-gray-700
                                          rounded-xl
                                          px-5 py-3">

                        </div>

                    </div>

                    <!-- DESCRIPTION -->
                    <div class="md:col-span-2">

                        <label class="block text-lg font-bold mb-3">

                            Product Description

                        </label>

                        <textarea rows="6"
                                  placeholder="Write detailed product description..."
                                  class="w-full bg-[#0f172a]
                                         border border-gray-700
                                         rounded-2xl px-6 py-4
                                         text-white text-lg
                                         focus:outline-none
                                         focus:ring-2
                                         focus:ring-blue-500"></textarea>

                    </div>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="border-t border-gray-800
                        p-8 flex flex-col sm:flex-row
                        gap-5 justify-end">

                <!-- CANCEL -->
                <a href="/admin/products"
                   class="bg-gray-700 hover:bg-gray-600
                          px-8 py-4 rounded-2xl
                          font-bold text-center
                          transition duration-300">

                    Cancel

                </a>

                <!-- SUBMIT -->
                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600
                               px-10 py-4 rounded-2xl
                               font-bold text-lg
                               transition duration-300
                               hover:scale-105">

                    Publish Product

                </button>

            </div>

        </form>

    </div>

</div>

</x-admin-layout>