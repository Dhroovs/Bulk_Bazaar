<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<div class="bg-[#0b1120] min-h-screen text-white py-12">

    <div class="max-w-7xl mx-auto px-6">

        <!-- BREADCRUMB -->
        <div class="mb-8 text-gray-400">

            <a href="/" class="hover:text-white">
                Home
            </a>

            <span class="mx-2">
                /
            </span>

            <a href="/products" class="hover:text-white">
                Products
            </a>

            <span class="mx-2">
                /
            </span>

            <span class="text-white">
                <?php echo e($product->name); ?>

            </span>

        </div>

        <!-- MAIN PRODUCT -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

            <!-- PRODUCT IMAGE -->
            <div class="bg-[#172033]
                        border border-gray-800
                        rounded-[40px]
                        p-10 shadow-2xl">

                <div class="bg-[#1e293b]
                            rounded-[30px]
                            h-[550px]
                            flex items-center justify-center">

                    <?php if($product->category): ?>

                        <?php if(strtolower($product->category->name) == 'electronics'): ?>
                            <div class="text-[220px]">📱</div>

                        <?php elseif(strtolower($product->category->name) == 'fashion'): ?>
                            <div class="text-[220px]">👕</div>

                        <?php elseif(strtolower($product->category->name) == 'books'): ?>
                            <div class="text-[220px]">📚</div>

                        <?php elseif(strtolower($product->category->name) == 'sports'): ?>
                            <div class="text-[220px]">⚽</div>

                        <?php elseif(strtolower($product->category->name) == 'furniture'): ?>
                            <div class="text-[220px]">🛋️</div>

                        <?php else: ?>
                            <div class="text-[220px]">📦</div>
                        <?php endif; ?>

                    <?php else: ?>

                        <div class="text-[220px]">📦</div>

                    <?php endif; ?>

                </div>

            </div>

            <!-- PRODUCT DETAILS -->
            <div>

                <!-- CATEGORY -->
                <div class="mb-5">

                    <span class="bg-blue-500/20
                                 text-blue-400
                                 px-5 py-2 rounded-full
                                 text-sm font-semibold">

                        <?php echo e($product->category->name ?? 'Category'); ?>


                    </span>

                </div>

                <!-- TITLE -->
                <h1 class="text-6xl font-black leading-tight mb-6">

                    <?php echo e($product->name); ?>


                </h1>

                <!-- RATING -->
                <div class="flex items-center gap-4 mb-6">

                    <div class="text-yellow-400 text-xl">
                        ⭐⭐⭐⭐⭐
                    </div>

                    <span class="text-gray-400">
                        4.8 Rating
                    </span>

                </div>

                <!-- PRICE -->
                <div class="flex items-center gap-5 mb-8">

                    <h2 class="text-5xl font-black text-blue-400">

                        ₹<?php echo e($product->price); ?>


                    </h2>

                    <span class="line-through text-gray-500 text-2xl">

                        ₹<?php echo e($product->price + 2000); ?>


                    </span>

                </div>

                <!-- STOCK -->
                <div class="mb-8">

                    <?php if($product->stock > 0): ?>

                        <span class="bg-green-500/20
                                     text-green-400
                                     px-5 py-3 rounded-2xl
                                     font-semibold">

                            ✓ In Stock (<?php echo e($product->stock); ?> Available)

                        </span>

                    <?php else: ?>

                        <span class="bg-red-500/20
                                     text-red-400
                                     px-5 py-3 rounded-2xl
                                     font-semibold">

                            ✕ Out of Stock

                        </span>

                    <?php endif; ?>

                </div>

                <!-- DESCRIPTION -->
                <div class="mb-10">

                    <h3 class="text-2xl font-bold mb-4">
                        Product Description
                    </h3>

                    <p class="text-gray-400 leading-8 text-lg">

                        Experience premium quality and modern design with
                        <?php echo e($product->name); ?>. Crafted for performance,
                        durability and comfort, this product delivers
                        exceptional value with a premium shopping experience
                        on Bulk Bazaar.

                    </p>

                </div>

                <!-- FEATURES -->
                <div class="grid grid-cols-2 gap-5 mb-10">

                    <div class="bg-[#172033]
                                border border-gray-800
                                rounded-2xl p-5">

                        <div class="text-3xl mb-3">
                            🚚
                        </div>

                        <h4 class="font-bold text-lg mb-1">
                            Fast Delivery
                        </h4>

                        <p class="text-gray-400 text-sm">
                            Delivery within 2-5 days
                        </p>

                    </div>

                    <div class="bg-[#172033]
                                border border-gray-800
                                rounded-2xl p-5">

                        <div class="text-3xl mb-3">
                            🔒
                        </div>

                        <h4 class="font-bold text-lg mb-1">
                            Secure Payment
                        </h4>

                        <p class="text-gray-400 text-sm">
                            100% protected checkout
                        </p>

                    </div>

                    <div class="bg-[#172033]
                                border border-gray-800
                                rounded-2xl p-5">

                        <div class="text-3xl mb-3">
                            🛡️
                        </div>

                        <h4 class="font-bold text-lg mb-1">
                            Warranty
                        </h4>

                        <p class="text-gray-400 text-sm">
                            Official warranty included
                        </p>

                    </div>

                    <div class="bg-[#172033]
                                border border-gray-800
                                rounded-2xl p-5">

                        <div class="text-3xl mb-3">
                            💎
                        </div>

                        <h4 class="font-bold text-lg mb-1">
                            Premium Quality
                        </h4>

                        <p class="text-gray-400 text-sm">
                            Top quality materials
                        </p>

                    </div>

                </div>

                <!-- ACTION BUTTONS -->
                <div class="flex flex-col sm:flex-row gap-5">

                    <?php if($product->stock > 0): ?>

                        <a href="/cart/add/<?php echo e($product->id); ?>"
                           class="bg-blue-500 hover:bg-blue-600
                                  px-10 py-5 rounded-2xl
                                  text-center font-bold text-xl
                                  transition duration-300
                                  hover:scale-105">

                            Add to Cart

                        </a>

                        <a href="/checkout"
                           class="bg-white text-black
                                  px-10 py-5 rounded-2xl
                                  text-center font-bold text-xl
                                  hover:bg-gray-200
                                  transition duration-300">

                            Buy Now

                        </a>

                    <?php else: ?>

                        <div class="bg-red-500 text-white
                                    px-10 py-5 rounded-2xl
                                    font-bold text-xl">

                            Currently Unavailable

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        <!-- RELATED PRODUCTS -->
        <section class="mt-24">

            <div class="flex items-center justify-between mb-10">

                <div>

                    <h2 class="text-5xl font-black mb-3">
                        You May Also Like
                    </h2>

                    <p class="text-gray-400">
                        Related products recommended for you.
                    </p>

                </div>

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

                <?php $__currentLoopData = \App\Models\Product::take(4)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <a href="/product/<?php echo e($related->id); ?>"
                       class="bg-[#172033]
                              border border-gray-800
                              rounded-[30px]
                              overflow-hidden
                              hover:-translate-y-2
                              hover:shadow-2xl
                              transition duration-300">

                        <!-- IMAGE -->
                        <div class="h-60 bg-[#1e293b]
                                    flex items-center justify-center
                                    text-7xl">

                            📦

                        </div>

                        <!-- CONTENT -->
                        <div class="p-6">

                            <h3 class="text-2xl font-bold mb-3">

                                <?php echo e($related->name); ?>


                            </h3>

                            <p class="text-blue-400
                                      text-3xl font-black mb-5">

                                ₹<?php echo e($related->price); ?>


                            </p>

                            <div class="bg-blue-500
                                        text-center py-3
                                        rounded-2xl font-bold">

                                View Product

                            </div>

                        </div>

                    </a>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </section>

    </div>

</div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\BulkBazaar\resources\views/products/show.blade.php ENDPATH**/ ?>