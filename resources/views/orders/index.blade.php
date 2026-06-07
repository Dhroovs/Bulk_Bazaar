<x-app-layout>

<div class="space-y-10 relative">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 select-none relative z-10">
        <div>
            <h1 class="text-2xl font-black text-white tracking-tight">Fulfillment Journeys</h1>
            <p class="text-xs text-textMuted font-medium">Track your active shipments and review past commerce logs</p>
        </div>
        <a href="/products" class="bg-brandAccent hover:bg-brandAccentHover text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim shadow-lg shadow-brandAccent/10 w-fit">
            Order New Items
        </a>
    </div>

    <!-- BODY -->
    @if(count($orders) == 0)
        <!-- Empty State -->
        <div class="glassmorphism-luxury p-16 text-center border border-white/5 space-y-4 rounded-3xl shadow-2xl relative overflow-hidden">
            <div class="text-6xl">📦</div>
            <h2 class="text-xl font-bold text-white tracking-tight">No Active Journeys</h2>
            <p class="text-xs text-textMuted max-w-sm mx-auto font-medium">No order tracking logs have been registered for this customer instance. Complete a checkout transaction to generate a shipping journey.</p>
            <a href="/products" class="inline-block bg-brandAccent hover:bg-brandAccentHover text-white px-6 py-2.5 rounded-xl text-xs font-bold transition-smooth">
                Inspect Storefront
            </a>
        </div>
    @else
        <!-- STATS CARDS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative z-10 select-none">
            <div class="glassmorphism-luxury p-6 border border-white/5 flex items-center justify-between rounded-3xl shadow-2xl specular-glass">
                <div>
                    <span class="text-[9px] text-textMuted uppercase font-bold block mb-1">Total Assigned Nodes</span>
                    <span class="text-3xl font-black text-white tabular-nums">{{ $orders->count() }}</span>
                </div>
                <span class="text-3xl">📦</span>
            </div>
            <div class="glassmorphism-luxury p-6 border border-white/5 flex items-center justify-between rounded-3xl shadow-2xl specular-glass">
                <div>
                    <span class="text-[9px] text-textMuted uppercase font-bold block mb-1">In Processing</span>
                    <span class="text-3xl font-black text-yellow-400 tabular-nums">{{ $orders->where('status', 'pending')->count() }}</span>
                </div>
                <span class="text-3xl">⏳</span>
            </div>
            <div class="glassmorphism-luxury p-6 border border-white/5 flex items-center justify-between rounded-3xl shadow-2xl specular-glass">
                <div>
                    <span class="text-[9px] text-textMuted uppercase font-bold block mb-1">Success Deliveries</span>
                    <span class="text-3xl font-black text-brandGreen tabular-nums">{{ $orders->where('status', 'delivered')->count() }}</span>
                </div>
                <span class="text-3xl">✅</span>
            </div>
        </div>

        <!-- ORDERS LIST -->
        <div class="space-y-8 relative z-10">
            @foreach($orders as $order)
                <div class="glassmorphism-luxury border border-white/5 rounded-3xl shadow-2xl overflow-hidden specular-glass">
                    
                    <!-- Order Header -->
                    <div class="p-6 bg-black/40 border-b border-white/5 flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="space-y-1.5">
                            <div class="flex items-center gap-3">
                                <h3 class="font-extrabold text-base text-white">Journey #{{ $order->id }}</h3>
                                
                                <!-- Status Pill -->
                                @if($order->status == 'pending')
                                    <span class="bg-yellow-500/10 border border-yellow-500/25 text-yellow-400 text-[9px] font-bold px-2.5 py-0.5 rounded-full uppercase">Pending</span>
                                @elseif($order->status == 'approved')
                                    <span class="bg-brandAccent/10 border border-brandAccent/25 text-brandAccent text-[9px] font-bold px-2.5 py-0.5 rounded-full uppercase">Approved</span>
                                @elseif($order->status == 'processing')
                                    <span class="bg-purple-500/10 border border-purple-500/25 text-purple-400 text-[9px] font-bold px-2.5 py-0.5 rounded-full uppercase">Processing</span>
                                @elseif($order->status == 'shipped')
                                    <span class="bg-blue-500/10 border border-blue-500/25 text-blue-400 text-[9px] font-bold px-2.5 py-0.5 rounded-full uppercase">Shipped</span>
                                @elseif($order->status == 'delivered')
                                    <span class="bg-brandGreen/10 border border-brandGreen/25 text-brandGreen text-[9px] font-bold px-2.5 py-0.5 rounded-full uppercase">Delivered</span>
                                @elseif($order->status == 'cancelled')
                                    <span class="bg-brandRed/10 border border-brandRed/25 text-brandRed text-[9px] font-bold px-2.5 py-0.5 rounded-full uppercase">Cancelled</span>
                                @else
                                    <span class="bg-brandRed/10 border border-brandRed/25 text-brandRed text-[9px] font-bold px-2.5 py-0.5 rounded-full uppercase">{{ $order->status }}</span>
                                @endif
                            </div>
                            <p class="text-[10px] text-textMuted font-medium">Log Time: <span class="text-white font-bold">{{ $order->created_at->format('d M Y, h:i A') }}</span></p>
                        </div>

                        <!-- Right Info -->
                        <div class="flex flex-wrap items-center gap-6">
                            @if($order->status == 'pending')
                                <a href="/order/cancel/{{ $order->id }}" class="bg-brandRed/10 hover:bg-brandRed/20 text-brandRed hover:text-red-300 px-4 py-2 rounded-xl text-xs font-bold transition-smooth btn-micro-anim border border-brandRed/25" onclick="return confirm('Are you sure you want to cancel this order?')">
                                    Cancel Journey
                                </a>
                            @endif
                            <div>
                                <span class="text-[9px] text-textMuted uppercase font-bold block">Estimated Fulfillment</span>
                                <span class="text-xs font-bold text-white">3 - 5 Business Days</span>
                            </div>
                            <div class="w-px h-6 bg-white/5 hidden md:block"></div>
                            <div>
                                <span class="text-[9px] text-textMuted uppercase font-bold block">Fulfillment Cost</span>
                                <span class="text-base font-black text-brandGreen tabular-nums">₹{{ number_format($order->total_price, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Journey Timeline (Next-Gen visual progress mapping) -->
                    @if($order->status != 'cancelled' && $order->status != 'rejected')
                        <div class="px-6 pt-6 pb-2">
                            <span class="text-[9px] font-bold text-textMuted uppercase tracking-wider block mb-4">Journey Timeline Status</span>
                            
                            <div class="relative flex items-center justify-between w-full max-w-2xl mx-auto py-2">
                                <!-- Background Line -->
                                <div class="absolute left-0 right-0 h-0.5 bg-white/5 z-0"></div>
                                
                                <!-- Active line overlay -->
                                @php
                                    $step = 1;
                                    if ($order->status == 'approved') $step = 2;
                                    if ($order->status == 'processing') $step = 3;
                                    if ($order->status == 'shipped') $step = 4;
                                    if ($order->status == 'delivered') $step = 5;
                                    $percent = (($step - 1) / 4) * 100;
                                @endphp
                                <div class="absolute left-0 h-0.5 bg-gradient-to-r from-brandAccent to-brandGreen z-0 transition-smooth" style="width: {{ $percent }}%"></div>

                                <!-- Step Nodes -->
                                <div class="relative z-10 flex flex-col items-center">
                                    <div class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-black transition-smooth border {{ $step >= 1 ? 'bg-brandAccent text-white border-brandAccent shadow-lg shadow-brandAccent/25' : 'bg-bgDarker text-textMuted border-white/5' }}">
                                        1
                                    </div>
                                    <span class="text-[9px] font-bold uppercase mt-1.5 {{ $step >= 1 ? 'text-white' : 'text-textMuted' }}">Pending</span>
                                </div>

                                <div class="relative z-10 flex flex-col items-center">
                                    <div class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-black transition-smooth border {{ $step >= 2 ? 'bg-brandAccent text-white border-brandAccent shadow-lg shadow-brandAccent/25' : 'bg-bgDarker text-textMuted border-white/5' }}">
                                        2
                                    </div>
                                    <span class="text-[9px] font-bold uppercase mt-1.5 {{ $step >= 2 ? 'text-white' : 'text-textMuted' }}">Approved</span>
                                </div>

                                <div class="relative z-10 flex flex-col items-center">
                                    <div class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-black transition-smooth border {{ $step >= 3 ? 'bg-brandAccent text-white border-brandAccent shadow-lg shadow-brandAccent/25' : 'bg-bgDarker text-textMuted border-white/5' }}">
                                        3
                                    </div>
                                    <span class="text-[9px] font-bold uppercase mt-1.5 {{ $step >= 3 ? 'text-white' : 'text-textMuted' }}">Processing</span>
                                </div>

                                <div class="relative z-10 flex flex-col items-center">
                                    <div class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-black transition-smooth border {{ $step >= 4 ? 'bg-brandAccent text-white border-brandAccent shadow-lg shadow-brandAccent/25' : 'bg-bgDarker text-textMuted border-white/5' }}">
                                        4
                                    </div>
                                    <span class="text-[9px] font-bold uppercase mt-1.5 {{ $step >= 4 ? 'text-white' : 'text-textMuted' }}">Shipped</span>
                                </div>

                                <div class="relative z-10 flex flex-col items-center">
                                    <div class="w-6 h-6 rounded-full flex items-center justify-center text-[10px] font-black transition-smooth border {{ $step >= 5 ? 'bg-brandGreen text-white border-brandGreen shadow-lg shadow-brandGreen/25' : 'bg-bgDarker text-textMuted border-white/5' }}">
                                        ✓
                                    </div>
                                    <span class="text-[9px] font-bold uppercase mt-1.5 {{ $step >= 5 ? 'text-white' : 'text-textMuted' }}">Delivered</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Order Items -->
                    <div class="p-6 space-y-4">
                        <span class="text-[9px] font-bold text-textMuted uppercase tracking-wider block">Assigned Dispatch Units</span>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($order->items as $item)
                                <div class="bg-black/20 border border-white/5 rounded-2xl p-4 flex items-center justify-between gap-4 specular-glass">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 bg-black/40 rounded-xl border border-white/5 flex items-center justify-center text-2xl select-none shrink-0">
                                            @if($item->product && $item->product->image)
                                                <img src="/products/{{ $item->product->image }}" alt="" class="w-full h-full object-cover rounded-xl">
                                            @else
                                                📦
                                            @endif
                                        </div>
                                        <div>
                                            <h5 class="font-extrabold text-xs text-white">{{ $item->product->name ?? 'Deleted Listing' }}</h5>
                                            <p class="text-[9px] text-textMuted font-bold uppercase">Qty: {{ $item->quantity }} • SKU: {{ $item->product->sku ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs font-bold text-brandAccent tabular-nums">₹{{ number_format($item->price, 2) }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Customer Shipping logistics tracker -->
                    <div class="px-6 pb-6 pt-4 border-t border-white/5 bg-black/10 select-none">
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 text-xs">
                            <div class="space-y-1">
                                <span class="text-[9px] font-bold text-textMuted uppercase tracking-wider block">Logistics Partner & Tracking</span>
                                <p class="text-white font-bold">✈️ BlueDart Premium • <span class="font-mono text-brandAccent">BB-{{ 492040 + $order->id }}-IN</span></p>
                            </div>
                            <div class="space-y-1 text-left sm:text-right">
                                <span class="text-[9px] font-bold text-textMuted uppercase tracking-wider block">Active Status Hub Logs</span>
                                @if($order->status == 'pending')
                                    <p class="text-yellow-400 font-bold text-xs">Awaiting dispatch node validation</p>
                                @elseif($order->status == 'approved')
                                    <p class="text-blue-400 font-bold text-xs">Route initialized at Origin hub</p>
                                @elseif($order->status == 'processing')
                                    <p class="text-blue-400 font-bold text-xs">Packaging and labeling finalized</p>
                                @elseif($order->status == 'shipped')
                                    <p class="text-brandGreen font-bold text-xs">In Transit (Departed Sort Facility Bengaluru)</p>
                                @elseif($order->status == 'delivered')
                                    <p class="text-brandGreen font-bold text-xs">Delivered successfully (Signed by Consignee)</p>
                                @else
                                    <p class="text-textMuted font-bold text-xs uppercase">{{ $order->status }}</p>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</div>

</x-app-layout>