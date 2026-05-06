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
        <div class="mb-10">

            <h1 class="text-5xl font-black mb-4">
                Order Management
            </h1>

            <p class="text-gray-400 text-lg">
                Track and manage all customer orders from one place.
            </p>

        </div>

        <!-- SUCCESS MESSAGE -->
        <?php if(session('success')): ?>

            <div class="bg-green-500/20 border border-green-500
                        text-green-400 px-6 py-4 rounded-2xl
                        mb-8 font-semibold">

                <?php echo e(session('success')); ?>


            </div>

        <?php endif; ?>

        <!-- STATS -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-10">

            <!-- TOTAL -->
            <div class="bg-[#172033]
                        border border-gray-800
                        rounded-3xl p-8">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 mb-3">
                            Total Orders
                        </p>

                        <h2 class="text-5xl font-black text-blue-400">

                            <?php echo e($orders->count()); ?>


                        </h2>

                    </div>

                    <div class="text-6xl">
                        📦
                    </div>

                </div>

            </div>

            <!-- PENDING -->
            <div class="bg-[#172033]
                        border border-gray-800
                        rounded-3xl p-8">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 mb-3">
                            Pending
                        </p>

                        <h2 class="text-5xl font-black text-yellow-400">

                            <?php echo e($orders->where('status', 'pending')->count()); ?>


                        </h2>

                    </div>

                    <div class="text-6xl">
                        ⏳
                    </div>

                </div>

            </div>

            <!-- SHIPPED -->
            <div class="bg-[#172033]
                        border border-gray-800
                        rounded-3xl p-8">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 mb-3">
                            Shipped
                        </p>

                        <h2 class="text-5xl font-black text-blue-400">

                            <?php echo e($orders->where('status', 'shipped')->count()); ?>


                        </h2>

                    </div>

                    <div class="text-6xl">
                        🚚
                    </div>

                </div>

            </div>

            <!-- DELIVERED -->
            <div class="bg-[#172033]
                        border border-gray-800
                        rounded-3xl p-8">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-gray-400 mb-3">
                            Delivered
                        </p>

                        <h2 class="text-5xl font-black text-green-400">

                            <?php echo e($orders->where('status', 'delivered')->count()); ?>


                        </h2>

                    </div>

                    <div class="text-6xl">
                        ✅
                    </div>

                </div>

            </div>

        </div>

        <!-- ORDERS -->
        <div class="space-y-8">

            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="bg-[#172033]
                            border border-gray-800
                            rounded-[35px]
                            overflow-hidden shadow-2xl">

                    <!-- TOP -->
                    <div class="p-8 border-b border-gray-800">

                        <div class="flex flex-col lg:flex-row
                                    lg:items-center
                                    lg:justify-between gap-6">

                            <!-- LEFT -->
                            <div>

                                <div class="flex items-center gap-4 mb-4">

                                    <h2 class="text-3xl font-black">

                                        Order #<?php echo e($order->id); ?>


                                    </h2>

                                    <!-- STATUS -->
                                    <?php if($order->status == 'pending'): ?>

                                        <span class="bg-yellow-500/20
                                                     text-yellow-400
                                                     px-4 py-2 rounded-full
                                                     text-sm font-bold">

                                            Pending

                                        </span>

                                    <?php elseif($order->status == 'shipped'): ?>

                                        <span class="bg-blue-500/20
                                                     text-blue-400
                                                     px-4 py-2 rounded-full
                                                     text-sm font-bold">

                                            Shipped

                                        </span>

                                    <?php elseif($order->status == 'delivered'): ?>

                                        <span class="bg-green-500/20
                                                     text-green-400
                                                     px-4 py-2 rounded-full
                                                     text-sm font-bold">

                                            Delivered

                                        </span>

                                    <?php else: ?>

                                        <span class="bg-gray-500/20
                                                     text-gray-400
                                                     px-4 py-2 rounded-full
                                                     text-sm font-bold">

                                            <?php echo e(ucfirst($order->status)); ?>


                                        </span>

                                    <?php endif; ?>

                                </div>

                                <div class="space-y-2 text-gray-400">

                                    <p>
                                        Customer:
                                        <span class="text-white font-semibold">

                                            <?php echo e($order->user->name ?? 'Unknown'); ?>


                                        </span>
                                    </p>

                                    <p>
                                        Email:
                                        <span class="text-white font-semibold">

                                            <?php echo e($order->user->email ?? 'Unknown'); ?>


                                        </span>
                                    </p>

                                    <p>
                                        Total Amount:
                                        <span class="text-blue-400 text-xl font-black">

                                            ₹<?php echo e($order->total_price); ?>


                                        </span>
                                    </p>

                                </div>

                            </div>

                            <!-- ACTIONS -->
                            <div class="flex flex-wrap gap-4">

                                <a href="/admin/orders/<?php echo e($order->id); ?>/pending"
                                   class="bg-yellow-500 hover:bg-yellow-600
                                          text-black px-6 py-3 rounded-2xl
                                          font-bold transition duration-300">

                                    Pending

                                </a>

                                <a href="/admin/orders/<?php echo e($order->id); ?>/shipped"
                                   class="bg-blue-500 hover:bg-blue-600
                                          text-white px-6 py-3 rounded-2xl
                                          font-bold transition duration-300">

                                    Shipped

                                </a>

                                <a href="/admin/orders/<?php echo e($order->id); ?>/delivered"
                                   class="bg-green-500 hover:bg-green-600
                                          text-white px-6 py-3 rounded-2xl
                                          font-bold transition duration-300">

                                    Delivered

                                </a>

                            </div>

                        </div>

                    </div>

                    <!-- ITEMS -->
                    <div class="p-8">

                        <div class="flex items-center justify-between mb-6">

                            <div>

                                <h3 class="text-2xl font-black mb-2">
                                    Order Items
                                </h3>

                                <p class="text-gray-400">
                                    Products included in this order.
                                </p>

                            </div>

                        </div>

                        <div class="space-y-4">

                            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <div class="bg-[#111827]
                                            border border-gray-800
                                            rounded-2xl p-5">

                                    <div class="flex flex-col md:flex-row
                                                md:items-center
                                                md:justify-between gap-5">

                                        <!-- PRODUCT -->
                                        <div class="flex items-center gap-5">

                                            <div class="w-20 h-20
                                                        bg-[#1e293b]
                                                        rounded-2xl
                                                        flex items-center justify-center
                                                        text-4xl">

                                                📦

                                            </div>

                                            <div>

                                                <h4 class="text-xl font-bold mb-2">

                                                    <?php echo e($item->product->name); ?>


                                                </h4>

                                                <p class="text-gray-400">

                                                    Quantity:
                                                    <?php echo e($item->quantity); ?>


                                                </p>

                                            </div>

                                        </div>

                                        <!-- PRICE -->
                                        <div>

                                            <h3 class="text-3xl font-black text-blue-400">

                                                ₹<?php echo e($item->price); ?>


                                            </h3>

                                        </div>

                                    </div>

                                </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                    </div>

                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </div>

</div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da)): ?>
<?php $component = $__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da; ?>
<?php unset($__componentOriginal8e2ce59650f81721f93fef32250174d77c3531da); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\BulkBazaar\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>