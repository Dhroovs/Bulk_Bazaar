<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<div class="max-w-7xl mx-auto px-4 py-10">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">

        <div>

            <h1 class="text-4xl font-bold text-white mb-2">
                Products
            </h1>

            <p class="text-gray-400">
                Explore all available products on Bulk Bazaar.
            </p>

        </div>

        <!-- SEARCH + FILTER -->
        <form action="/products"
              method="GET"
              class="flex flex-col sm:flex-row gap-3">

            <!-- SEARCH -->
            <input type="text"
                   name="search"
                   placeholder="Search products..."
                   value="<?php echo e(request('search')); ?>"
                   class="bg-gray-800 border border-gray-700
                          text-white rounded-xl px-4 py-3
                          focus:outline-none focus:ring-2 focus:ring-blue-500">

            <!-- CATEGORY -->
            <select name="category"
                    class="bg-gray-800 border border-gray-700
                           text-white rounded-xl px-4 py-3
                           focus:outline-none focus:ring-2 focus:ring-blue-500">

                <option value="">
                    All Categories
                </option>

                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option value="<?php echo e($category->id); ?>"
                        <?php echo e(request('category') == $category->id ? 'selected' : ''); ?>>

                        <?php echo e($category->name); ?>


                    </option>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </select>
            <!-- SORT -->
<select name="sort"
        class="bg-gray-800 border border-gray-700
               text-white rounded-xl px-4 py-3
               focus:outline-none focus:ring-2 focus:ring-blue-500">

    <option value="">
        Sort By
    </option>

    <option value="low-high"
        <?php echo e(request('sort') == 'low-high' ? 'selected' : ''); ?>>

        Price: Low to High

    </option>

    <option value="high-low"
        <?php echo e(request('sort') == 'high-low' ? 'selected' : ''); ?>>

        Price: High to Low

    </option>

</select>

            <!-- BUTTON -->
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600
                           transition duration-300
                           text-white px-6 py-3 rounded-xl font-semibold">

                Filter

            </button>

        </form>

    </div>

    <!-- PRODUCTS GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <!-- CARD -->
            <div class="bg-gray-800 border border-gray-700 rounded-2xl overflow-hidden shadow-lg
                        transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl">

                <!-- CATEGORY IMAGE -->
                <div class="h-64 bg-gradient-to-br from-gray-700 to-gray-900
                            flex items-center justify-center">

                    <?php

                        $categoryName = strtolower($product->category->name ?? '');

                    ?>

                    <?php if(str_contains($categoryName, 'electronic')): ?>

                        <div class="text-center">

                            <div class="text-7xl mb-3">💻</div>

                            <p class="text-gray-300 text-lg font-semibold">
                                Electronics
                            </p>

                        </div>

                    <?php elseif(str_contains($categoryName, 'fashion')): ?>

                        <div class="text-center">

                            <div class="text-7xl mb-3">👕</div>

                            <p class="text-gray-300 text-lg font-semibold">
                                Fashion
                            </p>

                        </div>

                    <?php elseif(str_contains($categoryName, 'furniture')): ?>

                        <div class="text-center">

                            <div class="text-7xl mb-3">🛋️</div>

                            <p class="text-gray-300 text-lg font-semibold">
                                Furniture
                            </p>

                        </div>

                    <?php else: ?>

                        <div class="text-center">

                            <div class="text-7xl mb-3">🛒</div>

                            <p class="text-gray-300 text-lg font-semibold">
                                Bulk Bazaar
                            </p>

                        </div>

                    <?php endif; ?>

                </div>

                <!-- CONTENT -->
                <div class="p-6">

                    <!-- NAME -->
                    <a href="/product/<?php echo e($product->id); ?>">

                        <h2 class="text-2xl font-bold text-white mb-3
                                   hover:text-blue-400 transition">

                            <?php echo e($product->name); ?>


                        </h2>

                    </a>

                    <!-- PRICE -->
                    <p class="text-3xl text-blue-400 font-bold mb-3">

                        ₹<?php echo e($product->price); ?>


                    </p>

                    <!-- STOCK -->
                    <p class="text-gray-400 mb-6">

                        Available Stock:
                        <span class="text-white font-semibold">

                            <?php echo e($product->stock); ?>


                        </span>

                    </p>

                    <!-- BUTTON -->
                    <?php if($product->stock > 0): ?>

                        <a href="/cart/add/<?php echo e($product->id); ?>"
                           class="block text-center bg-blue-500 hover:bg-blue-600
                                  hover:scale-105 transition duration-300
                                  text-white py-3 rounded-xl font-semibold">

                            Add to Cart

                        </a>

                    <?php else: ?>

                        <div class="bg-red-500 text-white text-center py-3 rounded-xl font-semibold">

                            Out of Stock

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

    <!-- PAGINATION -->
    <div class="mt-10">

        <?php echo e($products->links()); ?>


    </div>

</div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\BulkBazaar\resources\views/products/index.blade.php ENDPATH**/ ?>