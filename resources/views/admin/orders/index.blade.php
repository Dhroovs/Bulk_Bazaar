<x-app-layout>

<div class="space-y-10 relative">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 select-none relative z-10">
        <div>
            <h1 class="text-2xl font-black text-white tracking-tight">Commerce Dispatch Controls</h1>
            <p class="text-xs text-textMuted font-medium">Configure global routing, dispatch approval steps, and fulfillment journeys</p>
        </div>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative z-10 select-none">
        <div class="glassmorphism-luxury p-6 border border-white/5 flex items-center justify-between rounded-3xl shadow-2xl specular-glass">
            <div>
                <span class="text-[9px] text-textMuted uppercase font-bold block mb-1">Global Queue Volume</span>
                <span class="text-3xl font-black text-white tabular-nums">{{ $orders->count() }}</span>
            </div>
            <span class="text-3xl">📦</span>
        </div>
        <div class="glassmorphism-luxury p-6 border border-white/5 flex items-center justify-between rounded-3xl shadow-2xl specular-glass">
            <div>
                <span class="text-[9px] text-textMuted uppercase font-bold block mb-1">Awaiting Approval</span>
                <span class="text-3xl font-black text-yellow-400 tabular-nums">{{ $orders->where('status', 'pending')->count() }}</span>
            </div>
            <span class="text-3xl">⏳</span>
        </div>
        <div class="glassmorphism-luxury p-6 border border-white/5 flex items-center justify-between rounded-3xl shadow-2xl specular-glass">
            <div>
                <span class="text-[9px] text-textMuted uppercase font-bold block mb-1">Active Dispatch</span>
                <span class="text-3xl font-black text-blue-400 tabular-nums">{{ $orders->where('status', 'shipped')->count() }}</span>
            </div>
            <span class="text-3xl">🚚</span>
        </div>
        <div class="glassmorphism-luxury p-6 border border-white/5 flex items-center justify-between rounded-3xl shadow-2xl specular-glass">
            <div>
                <span class="text-[9px] text-textMuted uppercase font-bold block mb-1">Successful Handshakes</span>
                <span class="text-3xl font-black text-brandGreen tabular-nums">{{ $orders->where('status', 'delivered')->count() }}</span>
            </div>
            <span class="text-3xl">✅</span>
        </div>
    </div>

    <!-- ORDERS LIST -->
    <div class="space-y-6 relative z-10">
        @forelse($orders as $order)
            <div class="glassmorphism-luxury border border-white/5 rounded-3xl shadow-2xl overflow-hidden specular-glass">
                
                <!-- Top Header -->
                <div class="p-6 bg-black/40 border-b border-white/5 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    <div class="flex items-start gap-4">
                        <!-- Customer Avatar / Identity -->
                        <div class="w-12 h-12 rounded-2xl bg-brandAccent/10 border border-brandAccent/20 flex items-center justify-center font-black text-brandAccent text-sm shadow-lg select-none">
                            {{ strtoupper(substr($order->user->name ?? 'G', 0, 2)) }}
                        </div>
                        <div class="space-y-1">
                            <div class="flex items-center gap-3">
                                <h3 class="font-extrabold text-base text-white">Order #{{ $order->id }}</h3>
                                <span class="text-[9px] font-bold text-brandGreen bg-brandGreen/10 border border-brandGreen/25 px-2 py-0.5 rounded-full uppercase">Insured API</span>
                            </div>
                            <div class="text-[10px] text-textMuted font-medium space-y-0.5">
                                <p>Customer: <span class="text-white font-bold">{{ $order->user->name ?? 'Guest User' }}</span> ({{ $order->user->email ?? 'N/A' }})</p>
                                <p>Commit Log: <span class="text-white font-bold">{{ $order->created_at->format('d M Y, h:i A') }}</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions & Total -->
                    <div class="flex flex-wrap items-center gap-6">
                        <!-- Purchase Confidence Widget -->
                        <div class="hidden sm:block">
                            <span class="text-[9px] text-textMuted uppercase font-bold block mb-1">Purchase Confidence</span>
                            <span class="text-[10px] font-extrabold text-brandGreen bg-brandGreen/10 border border-brandGreen/20 px-2 py-0.5 rounded-full">High 98%</span>
                        </div>

                        <!-- Update Status Controls -->
                        <div class="flex items-center gap-2">
                            <span class="text-[9px] text-textMuted font-bold uppercase tracking-wider">Fulfillment Stage:</span>
                            <select onchange="window.location.href='/admin/orders/{{ $order->id }}/' + this.value"
                                    class="bg-black border border-white/10 text-[10px] font-bold text-white rounded-xl px-3 py-1.5 focus:outline-none focus:border-brandAccent focus:ring-0 cursor-pointer transition-smooth hover:bg-white/5">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }} class="bg-bgDark">Pending</option>
                                <option value="approved" {{ $order->status == 'approved' ? 'selected' : '' }} class="bg-bgDark">Approved</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }} class="bg-bgDark">Processing</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }} class="bg-bgDark">Shipped</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }} class="bg-bgDark">Delivered</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }} class="bg-bgDark">Cancelled</option>
                                <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }} class="bg-bgDark">Rejected</option>
                            </select>
                        </div>
                        
                        <div class="w-px h-8 bg-white/5 hidden md:block"></div>
                        
                        <div class="text-left lg:text-right">
                            <span class="text-[9px] text-textMuted uppercase font-bold block">Settlement total</span>
                            <span class="text-base font-black text-brandGreen tabular-nums">₹{{ number_format($order->total_price, 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Items list -->
                <div class="p-6 space-y-3">
                    <span class="text-[9px] font-bold text-textMuted uppercase tracking-wider block mb-1">Fulfillment Units</span>
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

                <!-- Shipment Logistics Tracker -->
                <div class="px-6 pb-6 pt-4 border-t border-white/5 bg-black/10 select-none">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 text-xs">
                        <div class="flex items-center gap-3">
                            <span class="text-[9px] font-bold text-textMuted uppercase tracking-wider block">Shipment Partner:</span>
                            <span class="font-bold text-white flex items-center gap-1">✈️ BlueDart Premium</span>
                            <span class="text-textMuted">|</span>
                            <span class="text-[9px] font-bold text-textMuted uppercase tracking-wider block">Waybill / Airbill:</span>
                            <span class="font-mono font-bold text-brandAccent">BB-{{ 492040 + $order->id }}-IN</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-[9px] font-bold text-textMuted uppercase tracking-wider block">Logistics Node Logs:</span>
                            @if($order->status == 'pending')
                                <span class="text-[10px] font-bold text-yellow-400">Waiting for Admin Dispatch Approval</span>
                            @elseif($order->status == 'approved')
                                <span class="text-[10px] font-bold text-blue-400">Hub Assignment Initialized</span>
                            @elseif($order->status == 'processing')
                                <span class="text-[10px] font-bold text-blue-400">Fulfillment Pack & Label Committed</span>
                            @elseif($order->status == 'shipped')
                                <span class="text-[10px] font-bold text-brandGreen">Departed Sort Facility (Bengaluru Hub)</span>
                            @elseif($order->status == 'delivered')
                                <span class="text-[10px] font-bold text-brandGreen">Handover Completed (Signed by Consignee)</span>
                            @else
                                <span class="text-[10px] font-bold text-textMuted uppercase">{{ $order->status }}</span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        @empty
            <div class="glassmorphism-luxury p-16 text-center border border-white/5 text-textMuted rounded-3xl shadow-2xl">
                No orders committed by users on this node instance yet.
            </div>
        @endforelse
    </div>

</div>

</x-app-layout>