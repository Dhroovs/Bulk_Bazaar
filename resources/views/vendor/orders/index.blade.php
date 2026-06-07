<x-app-layout>

<div class="space-y-10 relative">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 select-none relative z-10">
        <div>
            <h1 class="text-2xl font-black text-white tracking-tight">Order Allocations Ledger</h1>
            <p class="text-xs text-textMuted font-medium">Track your product allocations, fulfillment status, and payout metrics</p>
        </div>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative z-10 select-none">
        <div class="glassmorphism-luxury p-6 border border-white/5 flex items-center justify-between rounded-3xl shadow-2xl specular-glass">
            <div>
                <span class="text-[9px] text-textMuted uppercase font-bold block mb-1">My Allocated Orders</span>
                <span class="text-3xl font-black text-white tabular-nums">{{ $orders->count() }}</span>
            </div>
            <span class="text-3xl">📦</span>
        </div>
        <div class="glassmorphism-luxury p-6 border border-white/5 flex items-center justify-between rounded-3xl shadow-2xl specular-glass">
            <div>
                <span class="text-[9px] text-textMuted uppercase font-bold block mb-1">Awaiting Delivery</span>
                <span class="text-3xl font-black text-yellow-400 tabular-nums">{{ $orders->whereIn('status', ['pending', 'approved', 'processing', 'shipped'])->count() }}</span>
            </div>
            <span class="text-3xl">⏳</span>
        </div>
        <div class="glassmorphism-luxury p-6 border border-white/5 flex items-center justify-between rounded-3xl shadow-2xl specular-glass">
            <div>
                <span class="text-[9px] text-textMuted uppercase font-bold block mb-1">Handed Over (Delivered)</span>
                <span class="text-3xl font-black text-brandGreen tabular-nums">{{ $orders->where('status', 'delivered')->count() }}</span>
            </div>
            <span class="text-3xl">✅</span>
        </div>
    </div>

    <!-- ORDERS LIST -->
    <div class="space-y-6 relative z-10">
        @forelse($orders as $order)
            @php
                $allocatedValue = 0;
                foreach($order->items as $item) {
                    $allocatedValue += $item->price * $item->quantity;
                }
            @endphp
            <div class="glassmorphism-luxury border border-white/5 rounded-3xl shadow-2xl overflow-hidden specular-glass">
                
                <!-- Top Header -->
                <div class="p-6 bg-black/40 border-b border-white/5 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-brandAccent/10 border border-brandAccent/20 flex items-center justify-center font-black text-brandAccent text-sm shadow-lg select-none">
                            {{ strtoupper(substr($order->user->name ?? 'G', 0, 2)) }}
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-center gap-3">
                                <h3 class="font-extrabold text-base text-white">Order #{{ $order->id }}</h3>
                                <span class="text-[9px] font-bold text-yellow-500 bg-yellow-500/10 border border-yellow-500/25 px-2 py-0.5 rounded-full uppercase">Vendor Allocated</span>
                            </div>
                            <div class="text-[10px] text-textMuted font-medium space-y-0.5">
                                <p>Customer Node: <span class="text-white font-bold">{{ $order->user->name ?? 'Guest User' }}</span></p>
                                <p>Commit Log: <span class="text-white font-bold">{{ $order->created_at->format('d M Y, h:i A') }}</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Total & Status -->
                    <div class="flex flex-wrap items-center gap-6">
                        <div>
                            @if($order->status == 'pending')
                                <span class="bg-yellow-500/10 border border-yellow-500/25 text-yellow-400 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase">Pending Approval</span>
                            @elseif($order->status == 'shipped')
                                <span class="bg-blue-500/10 border border-blue-500/25 text-blue-400 px-3 py-1.5 rounded-xl text-[10px] font-black uppercase">Shipped</span>
                            @elseif($order->status == 'delivered')
                                <span class="bg-brandGreen/10 border border-brandGreen/25 text-brandGreen px-3 py-1.5 rounded-xl text-[10px] font-black uppercase">Delivered</span>
                            @else
                                <span class="bg-white/5 border border-white/10 text-textMuted px-3 py-1.5 rounded-xl text-[10px] font-black uppercase">{{ strtoupper($order->status) }}</span>
                            @endif
                        </div>
                        
                        <div class="w-px h-8 bg-white/5 hidden md:block"></div>
                        
                        <div>
                            <span class="text-[9px] text-textMuted uppercase font-bold block">Your Allocated Value</span>
                            <span class="text-base font-black text-brandGreen tabular-nums">₹{{ number_format($allocatedValue, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Items list (Filter to vendor products only) -->
                <div class="p-6 space-y-3">
                    <span class="text-[9px] font-bold text-textMuted uppercase tracking-wider block mb-1">Your Allocated Items</span>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($order->items as $item)
                            <div class="bg-black/20 border border-white/5 rounded-2xl p-4 flex items-center justify-between gap-4 specular-glass">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-black/40 rounded-xl border border-white/5 flex items-center justify-center text-xl shrink-0 select-none">
                                        @if($item->product && $item->product->image)
                                            <img src="/products/{{ $item->product->image }}" alt="" class="w-full h-full object-cover rounded-xl">
                                        @else
                                            📦
                                        @endif
                                    </div>
                                    <div>
                                        <h5 class="font-extrabold text-xs text-white">{{ $item->product->name ?? 'Deleted Product' }}</h5>
                                        <p class="text-[9px] text-textMuted font-bold uppercase">Quantity: {{ $item->quantity }} • SKU: {{ $item->product->sku ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div>
                                    <span class="text-xs font-bold text-white tabular-nums">₹{{ number_format($item->price, 2) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Shipment Waybill Info -->
                <div class="px-6 pb-6 pt-4 border-t border-white/5 bg-black/10 select-none">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 text-xs">
                        <div class="flex items-center gap-3">
                            <span class="text-[9px] font-bold text-textMuted uppercase tracking-wider block">Carrier Partner:</span>
                            <span class="font-bold text-white flex items-center gap-1">✈️ BlueDart Premium</span>
                            <span class="text-textMuted">|</span>
                            <span class="text-[9px] font-bold text-textMuted uppercase tracking-wider block">Waybill ID:</span>
                            <span class="font-mono font-bold text-brandAccent">BB-{{ 492040 + $order->id }}-IN</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-[9px] font-bold text-textMuted uppercase tracking-wider block">Fulfillment Note:</span>
                            <span class="text-[10px] font-bold text-textMuted">Admin is responsible for logistics dispatch updates.</span>
                        </div>
                    </div>
                </div>

            </div>
        @empty
            <div class="glassmorphism-luxury p-16 text-center border border-white/5 text-textMuted rounded-3xl shadow-2xl">
                No orders allocated to your vendor account yet.
            </div>
        @endforelse
    </div>

</div>

</x-app-layout>
