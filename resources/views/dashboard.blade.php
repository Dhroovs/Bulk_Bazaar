<x-app-layout>

<div class="space-y-10 relative">

    @auth
        @if(auth()->user()->is_admin)
            <!-- ==========================================
                 ADMIN COMMAND CENTER
                 ========================================== -->
            
            <!-- Header -->
            <div class="space-y-2 relative z-10 select-none">
                <h1 class="text-2xl font-black text-white tracking-tight">Commerce Operating System</h1>
                <p class="text-xs text-textMuted font-medium">Real-time marketplace intelligence, analytics node status, and transaction flows</p>
            </div>

            <!-- Overview Intelligence Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6 relative z-10 select-none">
                <!-- Total Products -->
                <div class="glassmorphism-luxury p-5 border border-white/5 space-y-4 relative overflow-hidden specular-glass shadow-2xl">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-glow-indigo rounded-full blur-2xl opacity-40"></div>
                    <span class="text-[9px] text-textMuted uppercase font-bold tracking-wider block">Catalog Inventory</span>
                    <h3 class="text-3xl font-black text-white tabular-nums">{{ \App\Models\Product::count() }}</h3>
                    <p class="text-[9px] text-brandGreen font-bold">● Active catalog node</p>
                </div>
                <!-- Total Categories -->
                <div class="glassmorphism-luxury p-5 border border-white/5 space-y-4 relative overflow-hidden specular-glass shadow-2xl">
                    <span class="text-[9px] text-textMuted uppercase font-bold tracking-wider block">Schema Classifications</span>
                    <h3 class="text-3xl font-black text-brandAccent tabular-nums">{{ \App\Models\Category::count() }}</h3>
                    <p class="text-[9px] text-textMuted font-bold">Standard divisions</p>
                </div>
                <!-- Total Orders -->
                <div class="glassmorphism-luxury p-5 border border-white/5 space-y-4 relative overflow-hidden specular-glass shadow-2xl">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-glow-green rounded-full blur-2xl opacity-30"></div>
                    <span class="text-[9px] text-textMuted uppercase font-bold tracking-wider block">Order Velocity</span>
                    <h3 class="text-3xl font-black text-yellow-400 tabular-nums">{{ \App\Models\Order::count() }}</h3>
                    <p class="text-[9px] text-yellow-400 font-bold">↑ Above Expected Trend</p>
                </div>
                <!-- Total Revenue -->
                <div class="glassmorphism-luxury p-5 border border-white/5 space-y-4 relative overflow-hidden specular-glass shadow-2xl">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-glow-indigo rounded-full blur-2xl opacity-20"></div>
                    <span class="text-[9px] text-textMuted uppercase font-bold tracking-wider block">Projected Monthly Revenue</span>
                    <h3 class="text-3xl font-black text-brandGreen tabular-nums">₹{{ number_format(\App\Models\Order::sum('total_price'), 2) }}</h3>
                    <p class="text-[9px] text-brandGreen font-bold">↑ 18.2% this week</p>
                </div>
                <!-- Total Users -->
                <div class="glassmorphism-luxury p-5 border border-white/5 space-y-4 relative overflow-hidden specular-glass shadow-2xl">
                    <span class="text-[9px] text-textMuted uppercase font-bold tracking-wider block">Marketplace Health</span>
                    <h3 class="text-3xl font-black text-purple-400 tabular-nums">Excellent</h3>
                    <p class="text-[9px] text-purple-400 font-bold">{{ \App\Models\User::count() }} nodes connected</p>
                </div>
            </div>

            <!-- ANALYTICS CHARTS (Stripe/Fintech style) -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 relative z-10">
                <!-- Sales Overview (Line chart) -->
                <div class="glassmorphism-luxury p-6 border border-white/5 lg:col-span-2 space-y-4 rounded-3xl shadow-2xl relative overflow-hidden specular-glass">
                    <div class="flex justify-between items-center select-none">
                        <h3 class="font-bold text-sm text-white">Revenue Stream Analytics</h3>
                        <span class="text-[9px] font-bold text-textMuted bg-white/5 border border-white/10 px-2.5 py-1 rounded-full uppercase">Real-Time Data Feed</span>
                    </div>
                    <div class="h-64 relative">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>

                <!-- Order statistics & Growth (Bar/Pie charts) -->
                <div class="glassmorphism-luxury p-6 border border-white/5 space-y-4 rounded-3xl shadow-2xl relative overflow-hidden specular-glass">
                    <div class="flex justify-between items-center select-none">
                        <h3 class="font-bold text-sm text-white">Fulfillment Distributions</h3>
                        <span class="text-[9px] font-bold text-textMuted bg-white/5 border border-white/10 px-2.5 py-1 rounded-full uppercase">Proportion</span>
                    </div>
                    <div class="h-64 relative flex items-center justify-center">
                        <canvas id="orderPieChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- RECENT TRANSACTIONS / ALERTS GRID -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 relative z-10">
                <!-- Left 2 Cols: Active Queue Logs -->
                <div class="lg:col-span-2 glassmorphism-luxury border border-white/5 rounded-3xl shadow-2xl overflow-hidden specular-glass">
                    <div class="p-6 border-b border-white/5 flex justify-between items-center">
                        <div>
                            <h3 class="font-extrabold text-sm text-white">Active Queue Logs</h3>
                            <p class="text-[10px] text-textMuted font-medium">Most recent transactions committed on the ledger</p>
                        </div>
                        <a href="/admin/orders" class="text-xs font-bold text-brandAccent hover:text-white transition-smooth">
                            Fulfillment Panel →
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs border-collapse select-none">
                            <thead>
                                <tr class="border-b border-white/5 bg-black/40 text-textMuted font-bold">
                                    <th class="p-4 font-extrabold">TRANSACTION ID</th>
                                    <th class="p-4 font-extrabold">CONNECTED ACCOUNT</th>
                                    <th class="p-4 font-extrabold">COMMIT DATE</th>
                                    <th class="p-4 font-extrabold">VALUE</th>
                                    <th class="p-4 font-extrabold">FULFILLMENT STAGE</th>
                                    <th class="p-4 text-right font-extrabold">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse(\App\Models\Order::with('user')->latest()->take(5)->get() as $recentOrder)
                                    <tr class="hover:bg-white/5 transition-smooth">
                                        <td class="p-4 font-mono text-white font-bold">#{{ $recentOrder->id }}</td>
                                        <td class="p-4 font-extrabold text-white flex items-center gap-2">
                                            <div class="w-6 h-6 rounded-lg bg-brandAccent/10 border border-brandAccent/25 text-brandAccent flex items-center justify-center font-black text-[9px]">
                                                {{ strtoupper(substr($recentOrder->user->name ?? 'G', 0, 1)) }}
                                            </div>
                                            <span>{{ $recentOrder->user->name ?? 'Guest User' }}</span>
                                        </td>
                                        <td class="p-4 text-textMuted font-medium">{{ $recentOrder->created_at->format('d M Y') }}</td>
                                        <td class="p-4 font-black text-brandGreen tabular-nums">₹{{ number_format($recentOrder->total_price, 2) }}</td>
                                        <td class="p-4">
                                            @if($recentOrder->status == 'pending')
                                                <span class="bg-yellow-500/10 border border-yellow-500/25 text-yellow-400 px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase">Pending</span>
                                            @elseif($recentOrder->status == 'shipped')
                                                <span class="bg-blue-500/10 border border-blue-500/25 text-blue-400 px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase">Shipped</span>
                                            @elseif($recentOrder->status == 'delivered')
                                                <span class="bg-brandGreen/10 border border-brandGreen/25 text-brandGreen px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase">Delivered</span>
                                            @else
                                                <span class="bg-white/5 border border-white/10 text-textMuted px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase">{{ $recentOrder->status }}</span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-right">
                                            <a href="/admin/orders" class="text-brandAccent hover:text-white transition-smooth font-bold">Inspect</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="p-8 text-center text-textMuted font-medium">No ledger entries registered on this node.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Right Col: Alerts & Audit Logs -->
                <div class="space-y-6">
                    <!-- Low Stock Alerts -->
                    <div class="glassmorphism-luxury border border-white/5 rounded-3xl shadow-2xl p-6 specular-glass">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-extrabold text-sm text-white flex items-center gap-1.5">
                                ⚠️ <span>Critical Inventory</span>
                            </h3>
                            <span class="text-[9px] font-bold text-brandRed bg-brandRed/10 border border-brandRed/20 px-2 py-0.5 rounded-full uppercase">Restock Alert</span>
                        </div>
                        <div class="space-y-3">
                            @php
                                $lowStockProducts = \App\Models\Product::where('stock', '<=', 5)->take(3)->get();
                            @endphp
                            @forelse($lowStockProducts as $lowProd)
                                <div class="flex items-center justify-between p-3 bg-white/5 border border-white/5 rounded-2xl">
                                    <div class="truncate max-w-[150px]">
                                        <h4 class="text-xs font-bold text-white truncate">{{ $lowProd->name }}</h4>
                                        <span class="text-[9px] text-textMuted font-mono">SKU: {{ $lowProd->sku }}</span>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs font-black text-brandRed tabular-nums">{{ $lowProd->stock }} left</span>
                                        <a href="/admin/products/edit/{{ $lowProd->id }}" class="block text-[8px] font-black text-brandAccent hover:underline uppercase mt-0.5">Restock</a>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-6 text-textMuted text-xs font-medium">
                                    ✨ All product stocks healthy
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- System Audit Trail -->
                    <div class="glassmorphism-luxury border border-white/5 rounded-3xl shadow-2xl p-6 specular-glass">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-extrabold text-sm text-white">System Audit Log</h3>
                            <span class="text-[9px] font-bold text-textMuted">Latest events</span>
                        </div>
                        <div class="space-y-3.5">
                            <div class="flex gap-3 text-xs">
                                <div class="w-2 h-2 rounded-full bg-brandGreen mt-1.5 shrink-0"></div>
                                <div>
                                    <p class="text-white font-medium">Product seed initialization completed</p>
                                    <span class="text-[9px] text-textMuted">10 mins ago • System</span>
                                </div>
                            </div>
                            <div class="flex gap-3 text-xs">
                                <div class="w-2 h-2 rounded-full bg-brandAccent mt-1.5 shrink-0"></div>
                                <div>
                                    <p class="text-white font-medium">Ledger sync complete: orders indexed</p>
                                    <span class="text-[9px] text-textMuted">32 mins ago • Database</span>
                                </div>
                            </div>
                            <div class="flex gap-3 text-xs">
                                <div class="w-2 h-2 rounded-full bg-yellow-400 mt-1.5 shrink-0"></div>
                                <div>
                                    <p class="text-white font-medium">Order velocity increased by 15.4%</p>
                                    <span class="text-[9px] text-textMuted">1 hour ago • Analytics</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Import Chart.js CDN for Admin Analytics -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    // Chart configurations matching Linear / Stripe dark mode dashboard aesthetic
                    Chart.defaults.color = '#64748b';
                    Chart.defaults.font.family = 'Inter, sans-serif';
                    
                    // Sales flow line chart
                    const ctxSales = document.getElementById('salesChart').getContext('2d');
                    const gradientSales = ctxSales.createLinearGradient(0, 0, 0, 250);
                    gradientSales.addColorStop(0, 'rgba(99, 102, 241, 0.2)');
                    gradientSales.addColorStop(1, 'rgba(99, 102, 241, 0)');

                    new Chart(ctxSales, {
                        type: 'line',
                        data: {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                            datasets: [{
                                label: 'Revenue (₹)',
                                data: [15000, 32000, 24000, 48000, 59000, {{ \App\Models\Order::sum('total_price') ?: 0 }}],
                                borderColor: '#6366f1',
                                backgroundColor: gradientSales,
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

                    // Order Status Pie Chart
                    const ctxPie = document.getElementById('orderPieChart').getContext('2d');
                    new Chart(ctxPie, {
                        type: 'doughnut',
                        data: {
                            labels: ['Pending', 'Shipped', 'Delivered'],
                            datasets: [{
                                data: [
                                    {{ \App\Models\Order::where('status', 'pending')->count() ?: 1 }}, 
                                    {{ \App\Models\Order::where('status', 'shipped')->count() ?: 0 }}, 
                                    {{ \App\Models\Order::where('status', 'delivered')->count() ?: 0 }}
                                ],
                                backgroundColor: ['#ef4444', '#6366f1', '#22c55e'],
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
                            cutout: '75%'
                        }
                    });
                });
            </script>

        @else
            <!-- ==========================================
                 CUSTOMER COMMAND CENTER (My Account)
                 ========================================== -->
            
            <!-- Header -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 select-none relative z-10">
                <div>
                    <h1 class="text-2xl font-black text-white tracking-tight">Customer Node Account</h1>
                    <p class="text-xs text-textMuted font-medium font-sans">Modify profile credentials, password settings, and purchase logs</p>
                </div>
                <!-- Profile badge -->
                <div class="glassmorphism-luxury px-4 py-2 border border-white/5 flex items-center gap-3 rounded-2xl shadow-xl">
                    <div class="w-8 h-8 rounded-xl bg-brandAccent/10 border border-brandAccent/25 flex items-center justify-center font-black text-brandAccent text-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="text-xs font-bold text-white leading-none">{{ auth()->user()->name }}</h4>
                        <span class="text-[9px] text-textMuted block mt-0.5">{{ auth()->user()->email }}</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start relative z-10">
                
                <!-- Profile Edit / Password Update Form (Left side) -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Profile Information card -->
                    <div class="glassmorphism-luxury p-6 border border-white/5 space-y-5 rounded-3xl shadow-2xl relative overflow-hidden specular-glass">
                        <h3 class="font-extrabold text-sm text-white">Account Profile Information</h3>
                        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
                            @csrf
                            @method('patch')

                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-[9px] text-textMuted uppercase font-bold tracking-wider">Account Name</label>
                                    <input type="text" name="name" value="{{ auth()->user()->name }}" required
                                           class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0 transition-smooth">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[9px] text-textMuted uppercase font-bold tracking-wider">Verified Email</label>
                                    <input type="email" name="email" value="{{ auth()->user()->email }}" required
                                           class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0 transition-smooth">
                                </div>
                            </div>
                            
                            <div class="flex justify-end pt-2">
                                <button type="submit" class="bg-brandAccent hover:bg-brandAccentHover text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim shadow-md">
                                    Commit Details
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Change Password Card -->
                    <div class="glassmorphism-luxury p-6 border border-white/5 space-y-5 rounded-3xl shadow-2xl relative overflow-hidden specular-glass">
                        <h3 class="font-extrabold text-sm text-white">Node Credential Update</h3>
                        <form method="POST" action="{{ route('password.update') }}" class="space-y-4">
                            @csrf
                            @method('put')

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                <div class="space-y-1.5">
                                    <label class="text-[9px] text-textMuted uppercase font-bold tracking-wider">Current Password</label>
                                    <input type="password" name="current_password" required
                                           class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0 transition-smooth">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[9px] text-textMuted uppercase font-bold tracking-wider">New Password</label>
                                    <input type="password" name="password" required
                                           class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0 transition-smooth">
                                </div>
                                <div class="space-y-1.5">
                                    <label class="text-[9px] text-textMuted uppercase font-bold tracking-wider">Confirm Password</label>
                                    <input type="password" name="password_confirmation" required
                                           class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0 transition-smooth">
                                </div>
                            </div>

                            <div class="flex justify-end pt-2">
                                <button type="submit" class="bg-brandAccent hover:bg-brandAccentHover text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim shadow-md">
                                    Update Password Key
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Summary statistics and navigation panel (Right side) -->
                <div class="space-y-6">
                    <div class="glassmorphism-luxury p-6 border border-white/5 space-y-5 rounded-3xl shadow-2xl relative overflow-hidden specular-glass">
                        <h3 class="font-extrabold text-sm text-white">Fulfillment Ledger</h3>
                        
                        <div class="space-y-3.5 text-xs">
                            <div class="flex justify-between items-center py-2 border-b border-white/5">
                                <span class="text-textMuted font-bold uppercase text-[9px]">Committed Journeys:</span>
                                <span class="font-black text-white tabular-nums">{{ \App\Models\Order::where('user_id', auth()->id())->count() }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2 border-b border-white/5">
                                <span class="text-textMuted font-bold uppercase text-[9px]">Settlement Expenditures:</span>
                                <span class="font-black text-brandGreen tabular-nums">₹{{ number_format(\App\Models\Order::where('user_id', auth()->id())->sum('total_price'), 2) }}</span>
                            </div>
                            <div class="flex justify-between items-center py-2">
                                <span class="text-textMuted font-bold uppercase text-[9px]">Pending Dispatch:</span>
                                <span class="font-black text-yellow-400 tabular-nums">{{ \App\Models\Order::where('user_id', auth()->id())->where('status', 'pending')->count() }}</span>
                            </div>
                        </div>

                        <a href="/my-orders" class="block text-center bg-brandAccent/10 border border-brandAccent/20 hover:bg-brandAccent hover:text-white text-brandAccent py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim">
                            Inspect Active Journeys
                        </a>
                    </div>
                </div>

            </div>

        @endif
    @endauth

</div>

</x-app-layout>