<x-app-layout>
<div class="space-y-10 relative">

    <!-- Store Profile Header -->
    <div class="relative rounded-3xl overflow-hidden glassmorphism-luxury border border-white/5 shadow-2xl p-6 select-none flex flex-col md:flex-row items-center justify-between gap-6">
        @if($profile->store_banner)
            <div class="absolute inset-0 bg-cover bg-center opacity-10" style="background-image: url('/vendors/{{ $profile->store_banner }}');"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-r from-brandAccent/10 via-purple-500/5 to-transparent opacity-30 blur-xl"></div>
        @endif
        
        <div class="flex items-center gap-4 relative z-10">
            <div class="w-16 h-16 rounded-2xl bg-brandAccent/10 border border-brandAccent/25 flex items-center justify-center font-black text-brandAccent text-2xl overflow-hidden shrink-0">
                @if($profile->store_logo)
                    <img src="/vendors/{{ $profile->store_logo }}" alt="Logo" class="w-full h-full object-cover">
                @else
                    {{ strtoupper(substr($profile->store_name, 0, 1)) }}
                @endif
            </div>
            <div>
                <h1 class="text-2xl font-black text-white tracking-tight flex items-center gap-2">
                    {{ $profile->store_name }}
                    <span class="text-[10px] font-black uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-brandGreen/10 border border-brandGreen/25 text-brandGreen">Approved Vendor</span>
                </h1>
                <p class="text-xs text-textMuted font-medium font-sans mt-0.5">{{ $profile->store_description ?: 'Welcome to your vendor control center.' }}</p>
            </div>
        </div>

        <div class="flex items-center gap-3 relative z-10">
            <span class="text-xs text-textMuted font-bold bg-white/5 border border-white/10 px-3 py-1.5 rounded-xl uppercase">Node Status: Active</span>
        </div>
    </div>

    <!-- Metrics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 relative z-10 select-none">
        <!-- Products count -->
        <div class="glassmorphism-luxury p-5 border border-white/5 space-y-4 relative overflow-hidden specular-glass shadow-2xl">
            <span class="text-[9px] text-textMuted uppercase font-bold tracking-wider block">Vendor Inventory</span>
            <h3 class="text-3xl font-black text-white tabular-nums">{{ $productsCount }}</h3>
            <a href="/vendor/products" class="text-[9px] text-brandAccent font-bold hover:underline block">Manage Products →</a>
        </div>
        <!-- Orders count -->
        <div class="glassmorphism-luxury p-5 border border-white/5 space-y-4 relative overflow-hidden specular-glass shadow-2xl">
            <span class="text-[9px] text-textMuted uppercase font-bold tracking-wider block">Assigned Orders</span>
            <h3 class="text-3xl font-black text-brandAccent tabular-nums">{{ $ordersCount }}</h3>
            <a href="/vendor/orders" class="text-[9px] text-brandAccent font-bold hover:underline block">Orders Ledger →</a>
        </div>
        <!-- Gross Sales -->
        <div class="glassmorphism-luxury p-5 border border-white/5 space-y-4 relative overflow-hidden specular-glass shadow-2xl">
            <span class="text-[9px] text-textMuted uppercase font-bold tracking-wider block">Gross Node Sales</span>
            <h3 class="text-3xl font-black text-yellow-400 tabular-nums">₹{{ number_format($salesRevenue, 2) }}</h3>
            <p class="text-[9px] text-textMuted">Lifetime gross receipts</p>
        </div>
        <!-- Earnings -->
        <div class="glassmorphism-luxury p-5 border border-white/5 space-y-4 relative overflow-hidden specular-glass shadow-2xl">
            <span class="text-[9px] text-textMuted uppercase font-bold tracking-wider block">Net Ledger Earnings</span>
            <h3 class="text-3xl font-black text-brandGreen tabular-nums">₹{{ number_format($profile->earnings, 2) }}</h3>
            <p class="text-[9px] text-brandGreen font-bold">Commission Rate: {{ $profile->commission_rate }}%</p>
        </div>
    </div>

    <!-- Recent Order Ledger -->
    <div class="glassmorphism-luxury border border-white/5 rounded-3xl shadow-2xl overflow-hidden specular-glass">
        <div class="p-6 border-b border-white/5 flex justify-between items-center">
            <div>
                <h3 class="font-extrabold text-sm text-white">Recent Order Allocations</h3>
                <p class="text-[10px] text-textMuted font-medium">Orders containing your listed nodes</p>
            </div>
            <a href="/vendor/orders" class="text-xs font-bold text-brandAccent hover:text-white transition-smooth">
                Full Orders Ledger →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse select-none">
                <thead>
                    <tr class="border-b border-white/5 bg-black/40 text-textMuted font-bold">
                        <th class="p-4 font-extrabold">TRANSACTION ID</th>
                        <th class="p-4 font-extrabold">BUYER ACCOUNT</th>
                        <th class="p-4 font-extrabold">DATE</th>
                        <th class="p-4 font-extrabold">YOUR ALLOCATED VALUE</th>
                        <th class="p-4 font-extrabold">STATUS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($orders->take(5) as $order)
                        @php
                            $allocatedValue = 0;
                            foreach($order->items as $item) {
                                $allocatedValue += $item->price * $item->quantity;
                            }
                        @endphp
                        <tr class="hover:bg-white/5 transition-smooth">
                            <td class="p-4 font-mono text-white font-bold">#{{ $order->id }}</td>
                            <td class="p-4 font-extrabold text-white flex items-center gap-2">
                                <div class="w-6 h-6 rounded-lg bg-brandAccent/10 border border-brandAccent/25 text-brandAccent flex items-center justify-center font-black text-[9px]">
                                    {{ strtoupper(substr($order->user->name ?? 'G', 0, 1)) }}
                                </div>
                                <span>{{ $order->user->name ?? 'Guest User' }}</span>
                            </td>
                            <td class="p-4 text-textMuted font-medium">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="p-4 font-black text-brandGreen tabular-nums">₹{{ number_format($allocatedValue, 2) }}</td>
                            <td class="p-4">
                                @if($order->status == 'pending')
                                    <span class="bg-yellow-500/10 border border-yellow-500/25 text-yellow-400 px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase">Pending</span>
                                @elseif($order->status == 'shipped')
                                    <span class="bg-blue-500/10 border border-blue-500/25 text-blue-400 px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase">Shipped</span>
                                @elseif($order->status == 'delivered')
                                    <span class="bg-brandGreen/10 border border-brandGreen/25 text-brandGreen px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase">Delivered</span>
                                @else
                                    <span class="bg-white/5 border border-white/10 text-textMuted px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase">{{ $order->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-textMuted font-medium">No order allocations registered to this vendor node.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>
