<x-admin-layout>

<div class="bg-[#0b1120] min-h-screen text-white py-10">

    <div class="max-w-5xl mx-auto px-6">

        <!-- HEADER -->
        <div class="mb-10">

            <h1 class="text-5xl font-black mb-4">
                Edit Product
            </h1>

            <p class="text-gray-400 text-lg">
                Update product details and inventory information.
            </p>

        </div>

        <!-- FORM -->
        <form action="/admin/products/update/{{ $product->id }}"
              method="POST"
              enctype="multipart/form-data"
              class="bg-[#172033]
                     border border-gray-800
                     rounded-[35px]
                     shadow-2xl overflow-hidden">

            @csrf

            <!-- CONTENT -->
            <div class="p-10">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- NAME -->
                    <div class="md:col-span-2">

                        <label class="block text-lg font-bold mb-3">

                            Product Name

                        </label>

                        <input type="text"
                               name="name"
                               value="{{ $product->name }}"
                               class="w-full bg-[#0f172a]
                                      border border-gray-700
                                      rounded-2xl px-6 py-4
                                      text-white text-lg">

                    </div>

                    <!-- PRICE -->
                    <div>

                        <label class="block text-lg font-bold mb-3">

                            Product Price

                        </label>

                        <input type="number"
                               name="price"
                               value="{{ $product->price }}"
                               class="w-full bg-[#0f172a]
                                      border border-gray-700
                                      rounded-2xl px-6 py-4
                                      text-white text-lg">

                    </div>

                    <!-- STOCK -->
                    <div>

                        <label class="block text-lg font-bold mb-3">

                            Available Stock

                        </label>

                        <input type="number"
                               name="stock"
                               value="{{ $product->stock }}"
                               class="w-full bg-[#0f172a]
                                      border border-gray-700
                                      rounded-2xl px-6 py-4
                                      text-white text-lg">

                    </div>

                    <!-- CATEGORY -->
                    <div class="md:col-span-2">

                        <label class="block text-lg font-bold mb-3">

                            Product Category

                        </label>

                        <select name="category_id"
                                class="w-full bg-[#0f172a]
                                       border border-gray-700
                                       rounded-2xl px-6 py-4
                                       text-white text-lg">

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}"
                                    {{ $product->category_id == $category->id ? 'selected' : '' }}>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- IMAGE -->
                    <div class="md:col-span-2">

                        <label class="block text-lg font-bold mb-5">

                            Product Image

                        </label>

                        @if($product->image)

                            <img src="/products/{{ $product->image }}"
                                 class="w-48 h-48 object-cover rounded-3xl mb-6">

                        @endif

                        <input type="file"
                               name="image"
                               class="bg-[#0f172a]
                                      border border-gray-700
                                      rounded-2xl px-6 py-4">

                    </div>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="border-t border-gray-800
                        p-8 flex justify-end gap-5">

                <a href="/admin/products"
                   class="bg-gray-700 hover:bg-gray-600
                          px-8 py-4 rounded-2xl
                          font-bold transition duration-300">

                    Cancel

                </a>

                <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600
                               px-10 py-4 rounded-2xl
                               font-bold text-lg
                               transition duration-300
                               hover:scale-105">

                    Update Product

                </button>

            </div>

        </form>

    </div>

</div>

</x-admin-layout>