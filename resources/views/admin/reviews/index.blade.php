<x-app-layout>
<div class="space-y-10">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 select-none">
        <div>
            <h1 class="text-2xl font-black text-white">Review Moderation Center</h1>
            <p class="text-xs text-textMuted font-medium font-sans">Moderate customer ratings, hide malicious listings reviews, and audit verified purchase records</p>
        </div>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 select-none">
        <div class="glass-card p-6 border border-cardBorder flex items-center justify-between">
            <div>
                <span class="text-xs text-textMuted block mb-1 font-semibold">Total Reviews Index</span>
                <span class="text-3xl font-black text-white tabular-nums">{{ $reviews->count() }}</span>
            </div>
            <span class="text-3xl">💬</span>
        </div>
        <div class="glass-card p-6 border border-cardBorder flex items-center justify-between">
            <div>
                <span class="text-xs text-textMuted block mb-1 font-semibold font-sans">Active & Approved</span>
                <span class="text-3xl font-black text-brandGreen tabular-nums">{{ $reviews->where('status', 'active')->count() }}</span>
            </div>
            <span class="text-3xl">✅</span>
        </div>
        <div class="glass-card p-6 border border-cardBorder flex items-center justify-between">
            <div>
                <span class="text-xs text-textMuted block mb-1 font-semibold">Flagged / Hidden</span>
                <span class="text-3xl font-black text-brandRed tabular-nums">{{ $reviews->where('status', 'hidden')->count() }}</span>
            </div>
            <span class="text-3xl">👁️‍🗨️</span>
        </div>
    </div>

    <!-- REVIEWS TABLE -->
    <div class="glass-card border border-cardBorder overflow-hidden">
        <div class="p-6 border-b border-cardBorder bg-bgDarker">
            <h3 class="font-bold text-sm text-white">Submitted Customer Reviews</h3>
            <p class="text-[10px] text-textMuted font-sans">Perform live moderation actions on public customer reviews</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs border-collapse">
                <thead>
                    <tr class="border-b border-cardBorder bg-bgDarker text-textMuted font-bold">
                        <th class="p-4">Product Info</th>
                        <th class="p-4">User Info</th>
                        <th class="p-4">Rating & Content</th>
                        <th class="p-4">Audit Status</th>
                        <th class="p-4">Moderation State</th>
                        <th class="p-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-cardBorder/50">
                    @forelse($reviews as $review)
                        <tr class="hover:bg-white/5 transition-smooth">
                            
                            <!-- Product Info -->
                            <td class="p-4">
                                <span class="font-bold text-white block">{{ $review->product->name ?? 'Deleted Product' }}</span>
                                <span class="text-[10px] text-textMuted block">Product ID: #{{ $review->product_id }}</span>
                            </td>

                            <!-- User Info -->
                            <td class="p-4">
                                <span class="font-bold text-white block">{{ $review->user->name ?? 'N/A' }}</span>
                                <span class="text-[10px] text-textMuted block">{{ $review->user->email ?? 'N/A' }}</span>
                            </td>

                            <!-- Star Rating & Content -->
                            <td class="p-4 space-y-1 max-w-xs">
                                <div class="flex items-center text-yellow-400 font-bold gap-1 text-[11px]">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span>{{ $i <= $review->rating ? '★' : '☆' }}</span>
                                    @endfor
                                </div>
                                <h5 class="font-extrabold text-xs text-white">{{ $review->title }}</h5>
                                <p class="text-[10px] text-textMuted leading-relaxed">{{ $review->description }}</p>
                            </td>

                            <!-- Verified Purchase -->
                            <td class="p-4">
                                @if($review->is_verified_purchase)
                                    <span class="bg-brandGreen/10 border border-brandGreen/25 text-brandGreen px-2.5 py-0.5 rounded-full text-[9px] font-bold">✓ Verified Purchase</span>
                                @else
                                    <span class="bg-cardBorder text-textMuted px-2.5 py-0.5 rounded-full text-[9px] font-bold">Standard Review</span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="p-4">
                                @if($review->status === 'active')
                                    <span class="bg-brandGreen/10 border border-brandGreen/25 text-brandGreen px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase">Active</span>
                                @elseif($review->status === 'hidden')
                                    <span class="bg-yellow-500/10 border border-yellow-500/25 text-yellow-400 px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase">Hidden</span>
                                @else
                                    <span class="bg-brandRed/10 border border-brandRed/25 text-brandRed px-2.5 py-0.5 rounded-full text-[9px] font-bold uppercase">{{ $review->status }}</span>
                                @endif
                            </td>

                            <!-- Moderation Action Buttons -->
                            <td class="p-4 text-right">
                                <div class="flex justify-end gap-2">
                                    @if($review->status === 'active')
                                        <form method="POST" action="/admin/reviews/{{ $review->id }}/status">
                                            @csrf
                                            <button type="submit" name="status" value="hidden"
                                                    class="bg-yellow-500/15 hover:bg-yellow-500 text-yellow-500 hover:text-black px-3.5 py-1.5 rounded-lg text-[10px] font-bold transition-smooth btn-micro-anim">
                                                Hide Review
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="/admin/reviews/{{ $review->id }}/status">
                                            @csrf
                                            <button type="submit" name="status" value="active"
                                                    class="bg-brandGreen/15 hover:bg-brandGreen text-brandGreen hover:text-white px-3.5 py-1.5 rounded-lg text-[10px] font-bold transition-smooth btn-micro-anim">
                                                Activate
                                            </button>
                                        </form>
                                    @endif
                                    <form method="POST" action="/admin/reviews/{{ $review->id }}/status">
                                        @csrf
                                        <button type="submit" name="status" value="deleted"
                                                class="bg-brandRed/15 hover:bg-brandRed text-brandRed hover:text-white px-3.5 py-1.5 rounded-lg text-[10px] font-bold transition-smooth btn-micro-anim">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-textMuted">No reviews indexed.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
</x-app-layout>
