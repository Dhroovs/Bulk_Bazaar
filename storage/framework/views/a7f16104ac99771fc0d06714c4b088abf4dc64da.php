<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<div class="bg-[#0b1120] min-h-screen text-white">

    <!-- TOP -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">

        <div>

            <h1 class="text-5xl font-black mb-3">
                Products
            </h1>

            <p class="text-gray-400 text-lg">
                Manage all products from your ecommerce platform.
            </p>

        </div>

        <!-- ACTIONS -->
        <div class="flex gap-4">

            <a href="/admin/categories"
               class="bg-[#172033]
                      hover:bg-[#22304d]
                      px-6 py-4 rounded-2xl
                      font-bold transition duration-300">

                Categories

            </a>

            <a href="/admin/products/create"
               class="bg-blue-500 hover:bg-blue-600
                      px-8 py-4 rounded-2xl
                      font-bold text-lg
                      transition duration-300
                      hover:scale-105">

                + Add Product

            </a>

        </div>

    </div>

    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <!-- TOTAL -->
        <div class="bg-[#172033]
                    border border-gray-800
                    rounded-3xl p-8">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-400 mb-3">
                        Total Products
                    </p>

                    <h2 class="text-5xl font-black text-blue-400">

                        <?php echo e($products->count()); ?>


                    </h2>

                </div>

                <div class="text-6xl">
                    📦
                </div>

            </div>

        </div>

        <!-- STOCK -->
        <div class="bg-[#172033]
                    border border-gray-800
                    rounded-3xl p-8">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-400 mb-3">
                        In Stock
                    </p>

                    <h2 class="text-5xl font-black text-green-400">

                        <?php echo e($products->where('stock', '>', 0)->count()); ?>


                    </h2>

                </div>

                <div class="text-6xl">
                    ✅
                </div>

            </div>

        </div>

        <!-- OUT -->
        <div class="bg-[#172033]
                    border border-gray-800
                    rounded-3xl p-8">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-gray-400 mb-3">
                        Out of Stock
                    </p>

                    <h2 class="text-5xl font-black text-red-400">

                        <?php echo e($products->where('stock', '<=', 0)->count()); ?>


                    </h2>

                </div>

                <div class="text-6xl">
                    ⚠️
                </div>

            </div>

        </div>

    </div>

    <!-- TABLE -->
    <div class="bg-[#172033]
                border border-gray-800
                rounded-[35px]
                overflow-hidden shadow-2xl">

        <!-- HEADER -->
        <div class="flex items-center justify-between
                    px-8 py-6 border-b border-gray-800">

            <div>

                <h2 class="text-3xl font-black mb-2">
                    All Products
                </h2>

                <p class="text-gray-400">
                    View and manage all products.
                </p>

            </div>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-[#1b263b]">

                    <tr>

                        <th class="text-left p-6 text-gray-300 font-bold">
                            Product
                        </th>

                        <th class="text-left p-6 text-gray-300 font-bold">
                            Category
                        </th>

                        <th class="text-left p-6 text-gray-300 font-bold">
                            Price
                        </th>

                        <th class="text-left p-6 text-gray-300 font-bold">
                            Stock
                        </th>

                        <th class="text-left p-6 text-gray-300 font-bold">
                            Status
                        </th>

                        <th class="text-left p-6 text-gray-300 font-bold">
                            Actions
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <tr class="border-b border-gray-800
                                   hover:bg-[#1a2437]
                                   transition duration-300">

                            <!-- PRODUCT -->
                            <td class="p-6">

                                <div class="flex items-center gap-5">

                                    <!-- ICON -->
                                    <div class="w-20 h-20 rounded-2xl
                                                bg-[#1e293b]
                                                flex items-center justify-center
                                                text-4xl">

                                        <?php if($product->category): ?>

                                            <?php if(strtolower($product->category->name) == 'electronics'): ?>
                                                📱

                                            <?php elseif(strtolower($product->category->name) == 'fashion'): ?>
                                                👕

                                            <?php elseif(strtolower($product->category->name) == 'books'): ?>
                                                📚

                                            <?php elseif(strtolower($product->category->name) == 'sports'): ?>
                                                ⚽

                                            <?php else: ?>
                                                📦
                                            <?php endif; ?>

                                        <?php else: ?>

                                            📦

                                        <?php endif; ?>

                                    </div>

                                    <!-- INFO -->
                                    <div>

                                        <h3 class="text-xl font-bold mb-2">

                                            <?php echo e($product->name); ?>


                                        </h3>

                                        <p class="text-gray-400 text-sm">

                                            Product ID:
                                            #<?php echo e($product->id); ?>


                                        </p>

                                    </div>

                                </div>

                            </td>

                            <!-- CATEGORY -->
                            <td class="p-6">

                                <span class="bg-blue-500/20
                                             text-blue-400
                                             px-4 py-2 rounded-full
                                             text-sm font-semibold">

                                    <?php echo e($product->category->name ?? 'Category'); ?>


                                </span>

                            </td>

                            <!-- PRICE -->
                            <td class="p-6">

                                <h3 class="text-2xl font-black text-blue-400">

                                    ₹<?php echo e($product->price); ?>


                                </h3>

                            </td>

                            <!-- STOCK -->
                            <td class="p-6">

                                <h3 class="text-xl font-bold">

                                    <?php echo e($product->stock); ?>


                                </h3>

                            </td>

                            <!-- STATUS -->
                            <td class="p-6">

                                <?php if($product->stock > 0): ?>

                                    <span class="bg-green-500/20
                                                 text-green-400
                                                 px-4 py-2 rounded-full
                                                 text-sm font-bold">

                                        In Stock

                                    </span>

                                <?php else: ?>

                                    <span class="bg-red-500/20
                                                 text-red-400
                                                 px-4 py-2 rounded-full
                                                 text-sm font-bold">

                                        Out of Stock

                                    </span>

                                <?php endif; ?>

                            </td>

                            <!-- ACTIONS -->
                            <td class="p-6">

                                <div class="flex gap-3">

                                    <!-- EDIT -->
                                    <a href="/admin/products/edit/<?php echo e($product->id); ?>"
                                       class="bg-yellow-500 hover:bg-yellow-600
                                              text-black px-5 py-2 rounded-xl
                                              font-bold transition duration-300">

                                        Edit

                                    </a>

                                    <!-- DELETE -->
                                    <a href="/admin/products/delete/<?php echo e($product->id); ?>"
                                       class="bg-red-500 hover:bg-red-600
                                              text-white px-5 py-2 rounded-xl
                                              font-bold transition duration-300">

                                        Delete

                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\BulkBazaar\resources\views/admin/products/index.blade.php ENDPATH**/ ?>