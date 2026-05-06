<x-admin-layout>

<div class="bg-[#0b1120] min-h-screen text-white py-10">

    <div class="max-w-3xl mx-auto px-6">

        <!-- HEADER -->
        <div class="mb-10">

            <h1 class="text-5xl font-black mb-4">
                Edit Category
            </h1>

            <p class="text-gray-400 text-lg">
                Update category information.
            </p>

        </div>

        <!-- FORM -->
        <form action="/admin/categories/update/{{ $category->id }}"
              method="POST"
              class="bg-[#172033]
                     border border-gray-800
                     rounded-[35px]
                     shadow-2xl overflow-hidden">

            @csrf

            <!-- CONTENT -->
            <div class="p-10">

                <div class="mb-8">

                    <label class="block text-xl font-bold mb-4">

                        Category Name

                    </label>

                    <input type="text"
                           name="name"
                           value="{{ $category->name }}"
                           class="w-full bg-[#0f172a]
                                  border border-gray-700
                                  rounded-2xl px-6 py-5
                                  text-white text-lg
                                  focus:outline-none
                                  focus:ring-2
                                  focus:ring-blue-500">

                </div>

            </div>

            <!-- FOOTER -->
            <div class="border-t border-gray-800
                        p-8 flex justify-end gap-5">

                <a href="/admin/categories"
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

                    Update Category

                </button>

            </div>

        </form>

    </div>

</div>

</x-admin-layout>