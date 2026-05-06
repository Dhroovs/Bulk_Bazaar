<?php if (isset($component)) { $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

<div class="bg-[#0b1120] min-h-screen text-white py-10">

    <div class="max-w-7xl mx-auto px-6">

        <!-- HEADER -->
        <div class="flex flex-col lg:flex-row
                    lg:items-center
                    lg:justify-between
                    gap-6 mb-10">

            <div>

                <h1 class="text-5xl font-black mb-4">
                    Shopping Cart
                </h1>

                <p class="text-gray-400 text-lg">
                    Review your items and proceed to secure checkout.
                </p>

            </div>

            <a href="/products"
               class="bg-blue-500 hover:bg-blue-600
                      px-8 py-4 rounded-2xl
                      font-bold text-lg
                      transition duration-300
                      hover:scale-105 w-fit">

                Continue Shopping →

            </a>

        </div>

        <!-- SUCCESS -->
        <?php if(session('success')): ?>

            <div class="bg-green-500/20
                        border border-green-500
                        text-green-400
                        px-6 py-4 rounded-2xl
                        mb-8 font-semibold">

                <?php echo e(session('success')); ?>


            </div>

        <?php endif; ?>

        <!-- ERROR -->
        <?php if(session('error')): ?>

            <div class="bg-red-500/20
                        border border-red-500
                        text-red-400
                        px-6 py-4 rounded-2xl
                        mb-8 font-semibold">

                <?php echo e(session('error')); ?>


            </div>

        <?php endif; ?>

        <!-- EMPTY -->
        <?php if(count($cart) == 0): ?>

            <div class="bg-[#172033]
                        border border-gray-800
                        rounded-[40px]
                        p-16 text-center shadow-2xl">

                <div class="text-8xl mb-6">
                    🛒
                </div>

                <h2 class="text-4xl font-black mb-4">
                    Your Cart is Empty
                </h2>

                <p class="text-gray-400 text-lg mb-10 max-w-2xl mx-auto">

                    Looks like you haven’t added anything yet.
                    Explore premium products and start shopping.

                </p>

                <a href="/products"
                   class="bg-blue-500 hover:bg-blue-600
                          px-10 py-5 rounded-2xl
                          font-bold text-xl
                          transition duration-300
                          hover:scale-105 inline-block">

                    Browse Products

                </a>

            </div>

        <?php else: ?>

            <?php $total = 0; ?>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- LEFT -->
                <div class="lg:col-span-2 space-y-6">

                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php

                            $product = \App\Models\Product::find($id);

                            $itemTotal = $item['price'] * $item['quantity'];

                            $total += $itemTotal;

                        ?>

                        <!-- CART ITEM -->
                        <div class="bg-[#172033]
                                    border border-gray-800
                                    rounded-[35px]
                                    p-8 shadow-2xl">

                            <div class="flex flex-col lg:flex-row
                                        lg:items-center
                                        lg:justify-between gap-8">

                                <!-- PRODUCT -->
                                <div class="flex items-center gap-6">

                                    <!-- ICON -->
                                    <div class="w-32 h-32
                                                bg-[#1e293b]
                                                rounded-[30px]
                                                flex items-center justify-center
                                                text-6xl">

                                        📦

                                    </div>

                                    <!-- INFO -->
                                    <div>

                                        <h2 class="text-3xl font-black mb-3">

                                            <?php echo e($item['name']); ?>


                                        </h2>

                                        <p class="text-blue-400
                                                  text-2xl font-black mb-3">

                                            ₹<?php echo e($item['price']); ?>


                                        </p>

                                        <p class="text-gray-400">

                                            Subtotal:
                                            <span class="text-white font-bold">

                                                ₹<?php echo e($itemTotal); ?>


                                            </span>

                                        </p>

                                    </div>

                                </div>

                                <!-- ACTIONS -->
                                <div class="flex flex-col items-start lg:items-end gap-5">

                                    <!-- QUANTITY -->
                                    <div class="flex items-center gap-4
                                                bg-[#111827]
                                                border border-gray-800
                                                rounded-2xl px-5 py-4">

                                        <!-- DECREASE -->
                                        <a href="/cart/decrease/<?php echo e($id); ?>"
                                           class="bg-gray-700 hover:bg-gray-600
                                                  w-12 h-12 rounded-full
                                                  flex items-center justify-center
                                                  text-2xl font-black
                                                  transition duration-300">

                                            -

                                        </a>

                                        <!-- QTY -->
                                        <span class="text-2xl font-black w-10 text-center">

                                            <?php echo e($item['quantity']); ?>


                                        </span>

                                        <!-- INCREASE -->
                                        <?php if($product && $item['quantity'] < $product->stock): ?>

                                            <a href="/cart/increase/<?php echo e($id); ?>"
                                               class="bg-blue-500 hover:bg-blue-600
                                                      w-12 h-12 rounded-full
                                                      flex items-center justify-center
                                                      text-2xl font-black
                                                      transition duration-300">

                                                +

                                            </a>

                                        <?php else: ?>

                                            <div class="bg-gray-700 text-gray-500
                                                        w-12 h-12 rounded-full
                                                        flex items-center justify-center
                                                        text-2xl font-black">

                                                +

                                            </div>

                                        <?php endif; ?>

                                    </div>

                                    <!-- REMOVE -->
                                    <a href="/cart/remove/<?php echo e($id); ?>"
                                       class="bg-red-500 hover:bg-red-600
                                              px-6 py-3 rounded-2xl
                                              font-bold transition duration-300">

                                        Remove Item

                                    </a>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

                <!-- RIGHT SUMMARY -->
                <div>

                    <div class="bg-[#172033]
                                border border-gray-800
                                rounded-[35px]
                                p-8 sticky top-28 shadow-2xl">

                        <!-- TITLE -->
                        <h2 class="text-4xl font-black mb-8">
                            Order Summary
                        </h2>

                        <!-- SUMMARY -->
                        <div class="space-y-5 mb-8">

                            <div class="flex items-center justify-between">

                                <p class="text-gray-400 text-lg">
                                    Subtotal
                                </p>

                                <p class="font-bold text-xl">
                                    ₹<?php echo e($total); ?>

                                </p>

                            </div>

                            <div class="flex items-center justify-between">

                                <p class="text-gray-400 text-lg">
                                    Shipping
                                </p>

                                <p class="font-bold text-green-400">
                                    FREE
                                </p>

                            </div>

                            <div class="flex items-center justify-between">

                                <p class="text-gray-400 text-lg">
                                    Tax
                                </p>

                                <p class="font-bold">
                                    ₹0
                                </p>

                            </div>

                        </div>

                        <!-- TOTAL -->
                        <div class="border-t border-gray-800 pt-6 mb-8">

                            <div class="flex items-center justify-between">

                                <h3 class="text-2xl font-black">
                                    Total
                                </h3>

                                <h3 class="text-4xl font-black text-blue-400">

                                    ₹<?php echo e($total); ?>


                                </h3>

                            </div>

                        </div>

                        <!-- CHECKOUT -->
                        <a href="/checkout"
                           class="block bg-green-500 hover:bg-green-600
                                  text-center py-5 rounded-2xl
                                  font-black text-xl
                                  transition duration-300
                                  hover:scale-105">

                            Proceed to Checkout

                        </a>

                        <!-- FEATURES -->
                        <div class="space-y-4 mt-8">

                            <div class="flex items-center gap-4">

                                <div class="text-2xl">
                                    🔒
                                </div>

                                <p class="text-gray-400">
                                    Secure Checkout
                                </p>

                            </div>

                            <div class="flex items-center gap-4">

                                <div class="text-2xl">
                                    🚚
                                </div>

                                <p class="text-gray-400">
                                    Fast Delivery
                                </p>

                            </div>

                            <div class="flex items-center gap-4">

                                <div class="text-2xl">
                                    💳
                                </div>

                                <p class="text-gray-400">
                                    Safe Payments
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        <?php endif; ?>

    </div>

</div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\BulkBazaar\resources\views/cart.blade.php ENDPATH**/ ?>