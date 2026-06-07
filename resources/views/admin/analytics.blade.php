<x-app-layout>
<div class="space-y-10 relative print:space-y-6 print:text-black">

    <!-- HEADER & FILTERS -->
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 relative z-10 select-none print:hidden">
        <div>
            <h1 class="text-2xl font-black text-white tracking-tight">Marketplace Analytics</h1>
            <p class="text-xs text-textMuted font-medium font-sans">Index of transactions, category distributions, and daily revenue flows</p>
        </div>

        <!-- Filter Controls -->
        <form method="GET" action="/admin/analytics" class="flex flex-wrap items-center gap-4 bg-white/5 border border-white/5 p-4 rounded-3xl glassmorphism-luxury">
            <div class="flex items-center gap-2">
                <span class="text-[9px] text-textMuted uppercase font-black">From</span>
                <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}"
                       class="bg-black/40 border border-white/10 rounded-xl px-3 py-1.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0">
            </div>
            <div class="flex items-center gap-2">
                <span class="text-[9px] text-textMuted uppercase font-black">To</span>
                <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}"
                       class="bg-black/40 border border-white/10 rounded-xl px-3 py-1.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-brandAccent hover:bg-brandAccentHover text-white px-4 py-1.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim">
                    Apply Filter
                </button>
                <a href="/admin/analytics/export/csv?start_date={{ $startDate->format('Y-m-d') }}&end_date={{ $endDate->format('Y-m-d') }}"
                   class="bg-white/5 hover:bg-white/10 border border-white/10 text-white px-4 py-1.5 rounded-xl text-xs font-bold transition-smooth flex items-center gap-1.5 btn-micro-anim">
                    📥 CSV
                </a>
                <button type="button" onclick="window.print()"
                        class="bg-white/5 hover:bg-white/10 border border-white/10 text-white px-4 py-1.5 rounded-xl text-xs font-bold transition-smooth flex items-center gap-1.5 btn-micro-anim">
                    🖨️ PDF
                </button>
            </div>
        </form>
    </div>

    <!-- Print Header (Hidden normally, visible in print mode) -->
    <div class="hidden print:block border-b border-gray-300 pb-4 mb-6 select-none">
        <h1 class="text-3xl font-black text-black">Bulk Bazaar Analytics Ledger</h1>
        <p class="text-xs text-gray-600 mt-1">Export Date Range: {{ $startDate->format('d M Y') }} to {{ $endDate->format('d M Y') }}</p>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative z-10 select-none">
        <!-- Total Orders -->
        <div class="glassmorphism-luxury p-6 border border-white/5 space-y-4 rounded-3xl shadow-2xl relative overflow-hidden specular-glass print:bg-white print:border-gray-200 print:text-black">
            <span class="text-[9px] text-textMuted uppercase font-bold tracking-wider block print:text-gray-500">Order Volume</span>
            <h3 class="text-3xl font-black text-white tabular-nums print:text-black">{{ $totalOrders }}</h3>
            <p class="text-[9px] text-textMuted print:text-gray-500">Total orders registered in range</p>
        </div>
        <!-- Total Revenue -->
        <div class="glassmorphism-luxury p-6 border border-white/5 space-y-4 rounded-3xl shadow-2xl relative overflow-hidden specular-glass print:bg-white print:border-gray-200 print:text-black">
            <span class="text-[9px] text-textMuted uppercase font-bold tracking-wider block print:text-gray-500">Delivered Settlement</span>
            <h3 class="text-3xl font-black text-brandGreen tabular-nums print:text-green-700">₹{{ number_format($totalRevenue, 2) }}</h3>
            <p class="text-[9px] text-brandGreen font-bold print:text-green-700">Settled and final transaction values</p>
        </div>
        <!-- Pending Revenue -->
        <div class="glassmorphism-luxury p-6 border border-white/5 space-y-4 rounded-3xl shadow-2xl relative overflow-hidden specular-glass print:bg-white print:border-gray-200 print:text-black">
            <span class="text-[9px] text-textMuted uppercase font-bold tracking-wider block print:text-gray-500">Escrow Queue (Pending)</span>
            <h3 class="text-3xl font-black text-yellow-400 tabular-nums print:text-yellow-600">₹{{ number_format($pendingRevenue, 2) }}</h3>
            <p class="text-[9px] text-yellow-400 font-bold print:text-yellow-600">Transactions awaiting dispatch validation</p>
        </div>
    </div>

    <!-- GRAPH PANELS -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 relative z-10 print:hidden">
        <!-- Sales Overview Chart -->
        <div class="glassmorphism-luxury p-6 border border-white/5 lg:col-span-2 space-y-4 rounded-3xl shadow-2xl relative overflow-hidden specular-glass">
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-sm text-white">Delivered Revenue Trend</h3>
                <span class="text-[9px] font-bold text-textMuted bg-white/5 border border-white/10 px-2.5 py-1 rounded-full uppercase">Ledger Line</span>
            </div>
            <div class="h-64 relative">
                <canvas id="analyticsSalesChart"></canvas>
            </div>
        </div>

        <!-- Category Distribution Chart -->
        <div class="glassmorphism-luxury p-6 border border-white/5 space-y-4 rounded-3xl shadow-2xl relative overflow-hidden specular-glass">
            <div class="flex justify-between items-center">
                <h3 class="font-bold text-sm text-white">Sales Proportion by Category</h3>
                <span class="text-[9px] font-bold text-textMuted bg-white/5 border border-white/10 px-2.5 py-1 rounded-full uppercase">Division</span>
            </div>
            <div class="h-64 relative flex items-center justify-center">
                @if($categorySales->isEmpty())
                    <span class="text-xs text-textMuted font-medium">No sales categorized in range.</span>
                @else
                    <canvas id="analyticsCategoryChart"></canvas>
                @endif
            </div>
        </div>
    </div>

    <!-- PRINT VIEW ONLY METRICS TABLE -->
    <div class="hidden print:block border border-gray-300 rounded-lg overflow-hidden select-none mb-6">
        <table class="w-full text-left text-xs border-collapse">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-300 font-bold text-gray-700">
                    <th class="p-3">Category Name</th>
                    <th class="p-3 text-right">Delivered Total (₹)</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categorySales as $catSale)
                    <tr class="border-b border-gray-200 text-black">
                        <td class="p-3">{{ $catSale->category_name }}</td>
                        <td class="p-3 text-right font-bold">₹{{ number_format($catSale->total, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="p-3 text-center text-gray-500">No categorizations recorded.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- TRANSACTIONS REGISTER -->
    <div class="glassmorphism-luxury border border-white/5 rounded-3xl shadow-2xl overflow-hidden specular-glass print:border-gray-300 print:bg-white print:text-black">
        <div class="p-6 border-b border-white/5 bg-black/40 flex justify-between items-center print:bg-gray-100 print:border-gray-300 print:text-black">
            <div>
                <h3 class="font-extrabold text-sm text-white print:text-black">Committed Transactions Ledger</h3>
                <p class="text-[10px] text-textMuted font-medium print:text-gray-500">Transactions processed during selected timestamp block</p>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse print:text-black">
                <thead>
                    <tr class="border-b border-white/5 bg-black/40 text-textMuted font-bold print:bg-gray-100 print:text-gray-700 print:border-gray-300">
                        <th class="p-4 font-extrabold">TRANSACTION ID</th>
                        <th class="p-4 font-extrabold">CONNECTED NODE</th>
                        <th class="p-4 font-extrabold">COMMIT TIMESTAMP</th>
                        <th class="p-4 font-extrabold">FULFILLMENT VALUE</th>
                        <th class="p-4 font-extrabold">STATUS</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 print:divide-gray-200">
                    @forelse($transactions as $tx)
                        <tr class="hover:bg-white/5 transition-smooth print:hover:bg-transparent">
                            <td class="p-4 font-mono text-white font-bold print:text-black">#{{ $tx->id }}</td>
                            <td class="p-4 text-white font-extrabold print:text-black">{{ $tx->user->name ?? 'Guest User' }}</td>
                            <td class="p-4 text-textMuted font-medium print:text-gray-600">{{ $tx->created_at->format('d M Y, h:i A') }}</td>
                            <td class="p-4 font-black text-brandGreen tabular-nums print:text-green-700">₹{{ number_format($tx->total_price, 2) }}</td>
                            <td class="p-4">
                                @if($tx->status === 'delivered')
                                    <span class="bg-brandGreen/10 border border-brandGreen/25 text-brandGreen px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase print:text-green-700 print:border-green-300">Delivered</span>
                                @elseif($tx->status === 'pending')
                                    <span class="bg-yellow-500/10 border border-yellow-500/25 text-yellow-400 px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase print:text-yellow-600 print:border-yellow-300">Pending</span>
                                @else
                                    <span class="bg-white/5 border border-white/10 text-textMuted px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase print:text-gray-500 print:border-gray-300">{{ $tx->status }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-textMuted print:text-gray-500">No transaction logs match selection range.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- Stylesheet overrides for PDF print compatibility -->
<style>
@media print {
    body {
        background: white !important;
        color: black !important;
    }
    aside, nav, footer, .aurora-radial-glow, .bg-glow-indigo {
        display: none !important;
    }
    .max-w-7xl {
        max-width: 100% !important;
        width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
    }
    main {
        padding: 0 !important;
    }
}
</style>

<!-- Import Chart.js & Initialize Dynamic Data -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        Chart.defaults.color = '#64748b';
        Chart.defaults.font.family = 'Inter, sans-serif';

        // Daily sales trend line
        const ctxSales = document.getElementById('analyticsSalesChart');
        if (ctxSales) {
            const ctx = ctxSales.getContext('2d');
            const dates = @json($dailySales->pluck('date'));
            const totals = @json($dailySales->pluck('total'));

            const gradient = ctx.createLinearGradient(0, 0, 0, 250);
            gradient.addColorStop(0, 'rgba(99, 102, 241, 0.2)');
            gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: [{
                        label: 'Sales (₹)',
                        data: totals,
                        borderColor: '#6366f1',
                        backgroundColor: gradient,
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointBackgroundColor: '#6366f1',
                        pointHoverRadius: 6,
                        pointRadius: 4,
                        pointBorderColor: 'rgba(255,255,255,0.1)'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { grid: { color: 'rgba(255, 255, 255, 0.04)' }, border: { dash: [4, 4] } },
                        x: { grid: { display: false } }
                    }
                }
            });
        }

        // Category distribution doughnut chart
        const ctxCat = document.getElementById('analyticsCategoryChart');
        if (ctxCat) {
            const categories = @json($categorySales->pluck('category_name'));
            const categoryTotals = @json($categorySales->pluck('total'));

            new Chart(ctxCat.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: categories,
                    datasets: [{
                        data: categoryTotals,
                        backgroundColor: ['#6366f1', '#10b981', '#f59e0b', '#ec4899', '#3b82f6', '#8b5cf6'],
                        borderWidth: 2,
                        borderColor: 'rgba(10,10,15,0.9)',
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { boxWidth: 10, padding: 15, font: { weight: 'bold', size: 10 } }
                        }
                    },
                    cutout: '70%'
                }
            });
        }
    });
</script>
</x-app-layout>
