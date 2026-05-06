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

    <!-- HERO SECTION -->
    <section class="max-w-7xl mx-auto px-6 pt-10">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

            <!-- LEFT HERO -->
            <div class="bg-gradient-to-br from-[#173c2c] to-[#10251c]
                        rounded-[40px] p-12 flex flex-col justify-center
                        relative overflow-hidden min-h-[550px]">

                <!-- GLOW -->
                <div class="absolute top-[-80px] right-[-80px]
                            w-[320px] h-[320px]
                            bg-green-500/10 rounded-full blur-3xl">
                </div>

                <span class="bg-green-600/90 text-white text-sm
                             px-5 py-2 rounded-full w-fit mb-8
                             tracking-wide font-semibold">

                    NEW COLLECTION 2026

                </span>

                <h1 class="text-6xl lg:text-7xl font-black
                           leading-tight mb-8">

                    Fashion That

                    <span class="text-[#f2b38f]">
                        Fits
                    </span>

                    Your Vibe

                </h1>

                <p class="text-gray-300 text-lg leading-relaxed
                          max-w-xl mb-10">

                    Discover premium fashion, electronics,
                    lifestyle essentials and modern collections
                    designed for everyday elegance.

                </p>

                <div class="flex flex-wrap gap-5">

                    <a href="/products"
                       class="bg-[#2f7d5b] hover:bg-[#256347]
                              px-8 py-4 rounded-full
                              font-semibold text-lg
                              transition duration-300
                              hover:scale-105">

                        Shop Now →

                    </a>

                    <a href="/products"
                       class="border border-gray-500
                              px-8 py-4 rounded-full
                              hover:bg-white hover:text-black
                              transition duration-300">

                        Explore Collection

                    </a>

                </div>

            </div>

            <!-- RIGHT HERO -->
            <div class="bg-[#dfe9e1] rounded-[40px]
                        relative overflow-hidden
                        min-h-[550px]
                        flex items-center justify-center">

                <!-- PRICE CARD -->
                <div class="absolute top-8 left-8
                            bg-white rounded-3xl
                            px-6 py-5 shadow-xl">

                    <p class="text-gray-500 text-sm mb-1">
                        Starting at
                    </p>

                    <h2 class="text-4xl font-black text-black">
                        ₹799
                    </h2>

                </div>

                <!-- ICON -->
                <div class="text-[220px] animate-pulse">
                    👗
                </div>

                <!-- FLOAT -->
                <div class="absolute bottom-8 right-8
                            bg-black text-white
                            px-6 py-4 rounded-2xl shadow-lg">

                    <p class="text-sm text-gray-300">
                        Trending Product
                    </p>

                    <h3 class="font-bold text-xl">
                        Summer Fashion
                    </h3>

                </div>

            </div>

        </div>

    </section>

    <!-- STATS -->
    <section class="max-w-7xl mx-auto px-6 py-12">

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-[#172033] rounded-3xl p-8 border border-gray-800">

                <h3 class="text-5xl font-black text-blue-400 mb-3">
                    500+
                </h3>

                <p class="text-gray-400">
                    Premium Products
                </p>

            </div>

            <div class="bg-[#172033] rounded-3xl p-8 border border-gray-800">

                <h3 class="text-5xl font-black text-green-400 mb-3">
                    50+
                </h3>

                <p class="text-gray-400">
                    Top Categories
                </p>

            </div>

            <div class="bg-[#172033] rounded-3xl p-8 border border-gray-800">

                <h3 class="text-5xl font-black text-pink-400 mb-3">
                    10K+
                </h3>

                <p class="text-gray-400">
                    Happy Customers
                </p>

            </div>

            <div class="bg-[#172033] rounded-3xl p-8 border border-gray-800">

                <h3 class="text-5xl font-black text-yellow-400 mb-3">
                    24/7
                </h3>

                <p class="text-gray-400">
                    Customer Support
                </p>

            </div>

        </div>

    </section>

    <!-- SHOP BY CATEGORY -->
    <section class="max-w-7xl mx-auto px-6 py-16">

        <div class="flex items-center justify-between mb-12">

            <div>

                <h2 class="text-5xl font-black mb-3">
                    Shop by Category
                </h2>

                <p class="text-gray-400 text-lg">
                    Explore products from your favorite categories.
                </p>

            </div>

        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">

            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <a href="/products?category=<?php echo e($category->id); ?>"
                   class="bg-[#172033]
                          border border-gray-800
                          rounded-3xl p-8 text-center
                          hover:-translate-y-3
                          hover:border-blue-500
                          hover:shadow-2xl
                          transition duration-300">

                    <div class="text-6xl mb-5">

                        <?php if(strtolower($category->name) == 'electronics'): ?>
                            📱
                        <?php elseif(strtolower($category->name) == 'fashion'): ?>
                            👗
                        <?php elseif(strtolower($category->name) == 'books'): ?>
                            📚
                        <?php elseif(strtolower($category->name) == 'sports'): ?>
                            ⚽
                        <?php elseif(strtolower($category->name) == 'furniture'): ?>
                            🛋️
                        <?php else: ?>
                            📦
                        <?php endif; ?>

                    </div>

                    <h3 class="font-bold text-xl">
                        <?php echo e($category->name); ?>

                    </h3>

                </a>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </section>

    <!-- FEATURED PRODUCTS -->
    <section class="max-w-7xl mx-auto px-6 pb-20">

        <div class="flex items-center justify-between mb-12">

            <div>

                <h2 class="text-5xl font-black mb-3">
                    Featured Products
                </h2>

                <p class="text-gray-400 text-lg">
                    Handpicked trending products for you.
                </p>

            </div>

            <a href="/products"
               class="bg-white text-black
                      px-6 py-3 rounded-full
                      font-semibold hover:scale-105
                      transition duration-300">

                View All →

            </a>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="bg-[#172033]
                            border border-gray-800
                            rounded-[32px]
                            overflow-hidden
                            hover:-translate-y-3
                            hover:shadow-2xl
                            transition duration-300">

                    <!-- IMAGE -->
                    <div class="h-72 flex items-center justify-center
                                text-8xl bg-[#1e293b]">

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

                    <!-- CONTENT -->
                    <div class="p-7">

                        <p class="text-gray-400 uppercase text-sm mb-3">

                            <?php echo e($product->category->name ?? 'Category'); ?>


                        </p>

                        <h3 class="text-2xl font-black mb-4">

                            <?php echo e($product->name); ?>


                        </h3>

                        <div class="flex items-center justify-between mb-6">

                            <p class="text-4xl font-black text-blue-400">

                                ₹<?php echo e($product->price); ?>


                            </p>

                            <span class="text-yellow-400 font-bold">
                                ⭐ 4.8
                            </span>

                        </div>

                        <?php if($product->stock > 0): ?>

                            <a href="/cart/add/<?php echo e($product->id); ?>"
                               class="block bg-blue-500 hover:bg-blue-600
                                      text-center py-4 rounded-2xl
                                      font-bold text-lg
                                      transition duration-300">

                                Add to Cart

                            </a>

                        <?php else: ?>

                            <div class="bg-red-500 text-center
                                        py-4 rounded-2xl
                                        font-bold">

                                Out of Stock

                            </div>

                        <?php endif; ?>

                    </div>

                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </section>

    <!-- PROMO SECTION -->
    <section class="max-w-7xl mx-auto px-6 pb-20">

        <div class="bg-gradient-to-r from-blue-600 to-purple-600
                    rounded-[40px] p-14 relative overflow-hidden">

            <div class="max-w-2xl relative z-10">

                <h2 class="text-6xl font-black leading-tight mb-6">

                    Get Amazing Deals
                    Every Week

                </h2>

                <p class="text-xl text-gray-200 mb-8">

                    Save big on electronics, fashion,
                    accessories and much more.

                </p>

                <a href="/products"
                   class="bg-white text-black
                          px-8 py-4 rounded-full
                          font-bold inline-block
                          hover:scale-105 transition">

                    Start Shopping →

                </a>

            </div>

            <!-- BACKGROUND GLOW -->
            <div class="absolute right-[-100px] top-[-100px]
                        w-[400px] h-[400px]
                        bg-white/10 rounded-full blur-3xl">
            </div>

        </div>

    </section>

    <!-- FOOTER -->
    <footer class="bg-[#111827] border-t border-gray-800 py-14">

        <div class="max-w-7xl mx-auto px-6">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

                <div>

                    <h2 class="text-4xl font-black mb-4">
                        BULK BAZAAR
                    </h2>

                    <p class="text-gray-400 leading-relaxed">

                        Premium ecommerce platform
                        built with Laravel & TailwindCSS.

                    </p>

                </div>

                <div>

                    <h3 class="font-bold text-xl mb-5">
                        Shop
                    </h3>

                    <div class="space-y-3 text-gray-400">

                        <a href="/products" class="block hover:text-white">
                            Products
                        </a>

                        <a href="/cart" class="block hover:text-white">
                            Cart
                        </a>

                        <a href="/my-orders" class="block hover:text-white">
                            Orders
                        </a>

                    </div>

                </div>

                <div>

                    <h3 class="font-bold text-xl mb-5">
                        Categories
                    </h3>

                    <div class="space-y-3 text-gray-400">

                        <?php $__currentLoopData = $categories->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <a href="/products?category=<?php echo e($category->id); ?>"
                               class="block hover:text-white">

                                <?php echo e($category->name); ?>


                            </a>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>

                </div>

                <div>

                    <h3 class="font-bold text-xl mb-5">
                        Newsletter
                    </h3>

                    <div class="flex">

                        <input type="text"
                               placeholder="Your email"
                               class="bg-[#1f2937]
                                      border border-gray-700
                                      px-4 py-3 rounded-l-2xl
                                      w-full text-white">

                        <button class="bg-blue-500
                                       px-5 rounded-r-2xl">

                            →

                        </button>

                    </div>

                </div>

            </div>

            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500">

                © 2026 Bulk Bazaar. All Rights Reserved.

            </div>

        </div>

    </footer>

</div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\BulkBazaar\resources\views/home.blade.php ENDPATH**/ ?>