<x-app-layout>
<div class="space-y-10">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 select-none">
        <div>
            <h1 class="text-2xl font-black text-white">Marketplace Partner Registry</h1>
            <p class="text-xs text-textMuted font-medium font-sans">Approve applications, adjust commission rates, and audit vendor performance</p>
        </div>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 select-none">
        <div class="glass-card p-6 border border-cardBorder flex items-center justify-between">
            <div>
                <span class="text-xs text-textMuted block mb-1 font-semibold">Total Vendor Applications</span>
                <span class="text-3xl font-black text-white tabular-nums">{{ $vendors->count() }}</span>
            </div>
            <span class="text-3xl">👥</span>
        </div>
        <div class="glass-card p-6 border border-cardBorder flex items-center justify-between">
            <div>
                <span class="text-xs text-textMuted block mb-1 font-semibold">Approved Partners</span>
                <span class="text-3xl font-black text-brandGreen tabular-nums">{{ $vendors->where('status', 'approved')->count() }}</span>
            </div>
            <span class="text-3xl">✅</span>
        </div>
        <div class="glass-card p-6 border border-cardBorder flex items-center justify-between">
            <div>
                <span class="text-xs text-textMuted block mb-1 font-semibold">Awaiting Validation</span>
                <span class="text-3xl font-black text-yellow-400 tabular-nums">{{ $vendors->where('status', 'pending')->count() }}</span>
            </div>
            <span class="text-3xl">⏳</span>
        </div>
        <div class="glass-card p-6 border border-cardBorder flex items-center justify-between">
            <div>
                <span class="text-xs text-textMuted block mb-1 font-semibold">Suspended Nodes</span>
                <span class="text-3xl font-black text-brandRed tabular-nums">{{ $vendors->where('status', 'suspended')->count() }}</span>
            </div>
            <span class="text-3xl">⚠️</span>
        </div>
    </div>

    <!-- VENDORS TABLE -->
    <div class="glass-card border border-cardBorder overflow-hidden">
        <div class="p-6 border-b border-cardBorder bg-bgDarker">
            <h3 class="font-bold text-sm text-white">Vendor Partners Registry</h3>
            <p class="text-[10px] text-textMuted font-sans">Modify merchant statuses, manage commissions, and monitor earnings ledger</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-cardBorder bg-bgDarker text-textMuted font-bold">
                        <th class="p-4">Merchant Node Details</th>
                        <th class="p-4">Owner Profile</th>
                        <th class="p-4">Commission</th>
                        <th class="p-4">Ledger Earnings</th>
                        <th class="p-4">Node Status</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cardBorder/50">
                    @forelse($vendors as $vendor)
                        <tr class="hover:bg-white/5 transition-smooth">
                            
                            <!-- Store Details -->
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-bgDarker rounded-lg border border-cardBorder flex items-center justify-center text-xl shrink-0 overflow-hidden select-none">
                                        @if($vendor->store_logo)
                                            <img src="/vendors/{{ $vendor->store_logo }}" alt="" class="w-full h-full object-cover">
                                        @else
                                            🏪
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-xs text-white">{{ $vendor->store_name }}</h4>
                                        <span class="text-[9px] text-textMuted block max-w-[200px] truncate">{{ $vendor->store_description ?? 'No description provided.' }}</span>
                                    </div>
                                </div>
                            </td>

                            <!-- Owner Account -->
                            <td class="p-4">
                                <span class="font-bold text-white block">{{ $vendor->user->name ?? 'N/A' }}</span>
                                <span class="text-[10px] text-textMuted block">{{ $vendor->user->email ?? 'N/A' }}</span>
                            </td>

                            <!-- Commission Rate -->
                            <td class="p-4 font-bold text-white tabular-nums">{{ $vendor->commission_rate }}%</td>

                            <!-- Earnings -->
                            <td class="p-4 font-black text-brandGreen tabular-nums">₹{{ number_format($vendor->earnings, 2) }}</td>

                            <!-- Status Badge -->
                            <td class="p-4">
                                @if($vendor->status === 'approved')
                                    <span class="bg-brandGreen/10 border border-brandGreen/25 text-brandGreen px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase">Approved</span>
                                @elseif($vendor->status === 'pending')
                                    <span class="bg-yellow-500/10 border border-yellow-500/25 text-yellow-400 px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase">Pending</span>
                                @elseif($vendor->status === 'suspended')
                                    <span class="bg-brandRed/10 border border-brandRed/25 text-brandRed px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase">Suspended</span>
                                @else
                                    <span class="bg-cardBorder text-textMuted px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase">{{ $vendor->status }}</span>
                                @endif
                            </td>

                            <!-- Action Buttons -->
                            <td class="p-4 text-right">
                                <div class="flex justify-end gap-2">
                                    @if($vendor->status === 'pending')
                                        <form method="POST" action="/admin/vendors/{{ $vendor->id }}/status">
                                            @csrf
                                            <button type="submit" name="status" value="approved"
                                                    class="bg-brandGreen/15 hover:bg-brandGreen text-brandGreen hover:text-white px-3.5 py-1.5 rounded-lg text-[10px] font-bold transition-smooth btn-micro-anim">
                                                Approve
                                            </button>
                                        </form>
                                        <form method="POST" action="/admin/vendors/{{ $vendor->id }}/status">
                                            @csrf
                                            <button type="submit" name="status" value="rejected"
                                                    class="bg-brandRed/15 hover:bg-brandRed text-brandRed hover:text-white px-3.5 py-1.5 rounded-lg text-[10px] font-bold transition-smooth btn-micro-anim">
                                                Reject
                                            </button>
                                        </form>
                                    @elseif($vendor->status === 'approved')
                                        <form method="POST" action="/admin/vendors/{{ $vendor->id }}/status">
                                            @csrf
                                            <button type="submit" name="status" value="suspended"
                                                    class="bg-brandRed/15 hover:bg-brandRed text-brandRed hover:text-white px-3.5 py-1.5 rounded-lg text-[10px] font-bold transition-smooth btn-micro-anim">
                                                Suspend
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="/admin/vendors/{{ $vendor->id }}/status">
                                            @csrf
                                            <button type="submit" name="status" value="approved"
                                                    class="bg-brandGreen/15 hover:bg-brandGreen text-brandGreen hover:text-white px-3.5 py-1.5 rounded-lg text-[10px] font-bold transition-smooth btn-micro-anim">
                                                Activate
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-textMuted">No vendor application records registered.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
</x-app-layout>
