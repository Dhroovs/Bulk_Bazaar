<x-app-layout>

<div class="space-y-10 relative">

    <!-- BREADCRUMB -->
    <div class="flex items-center gap-2 text-xs text-textMuted select-none">
        <a href="/" class="hover:text-white transition-smooth">Home</a>
        <span>/</span>
        <a href="/products" class="hover:text-white transition-smooth">Products</a>
        <span>/</span>
        <span class="text-white font-semibold">{{ $product->name }}</span>
    </div>

    <!-- MAIN PRODUCT DETAIL -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
        
        <!-- PRODUCT IMAGE (Left) -->
        <div class="glassmorphism-luxury p-6 border border-white/5 flex items-center justify-center min-h-[400px] bg-black/40 rounded-3xl relative overflow-hidden specular-glass shadow-2xl">
            <div class="absolute inset-0 bg-gradient-to-tr from-brandAccent/5 to-transparent"></div>
            <div class="text-[180px] select-none relative z-10">
                @if($product->image)
                    <img src="/products/{{ $product->image }}" alt="{{ $product->name }}" class="max-h-[380px] object-contain rounded-2xl">
                @else
                    @php
                        $categoryName = strtolower($product->category->name ?? '');
                    @endphp
                    @if(str_contains($categoryName, 'electronic'))
                        📱
                    @elseif(str_contains($categoryName, 'fashion'))
                        👕
                    @elseif(str_contains($categoryName, 'sports'))
                        ⚽
                    @elseif(str_contains($categoryName, 'books'))
                        📚
                    @else
                        📦
                    @endif
                @endif
            </div>
        </div>

        <!-- PRODUCT SPECIFICATIONS & OPTIONS (Right) -->
        <div class="glassmorphism-luxury p-8 border border-white/5 space-y-6 rounded-3xl shadow-2xl relative overflow-hidden specular-glass">
            
            <!-- Category and Brand info -->
            <div class="flex justify-between items-center relative z-10">
                <span class="bg-brandAccent/10 border border-brandAccent/20 text-brandAccent px-3.5 py-1 rounded-full text-[10px] font-bold tracking-wider uppercase">
                    {{ $product->category->name ?? 'Store Item' }}
                </span>
                @if($product->brand)
                    <span class="text-xs text-textMuted font-medium">Brand: <strong class="text-white font-extrabold uppercase">{{ $product->brand }}</strong></span>
                @endif
            </div>

            <!-- Title & SKU -->
            <div class="space-y-2 relative z-10">
                <h1 class="text-3xl font-black text-white tracking-tight leading-none">{{ $product->name }}</h1>
                @if($product->sku)
                    <p class="text-xs text-textMuted font-mono">Registry SKU: <span class="text-white font-bold">{{ $product->sku }}</span></p>
                @endif
            </div>

            <!-- Star rating -->
            @php
                $activeReviews = $product->reviews()->where('status', 'active')->get();
                $avgRating = $activeReviews->avg('rating') ?: 5.0;
                $reviewsCount = $activeReviews->count();
            @endphp
            <div class="flex items-center gap-2 text-xs relative z-10">
                <div class="text-yellow-400 font-bold">
                    @for($i = 1; $i <= 5; $i++)
                        <span>{{ $i <= round($avgRating) ? '★' : '☆' }}</span>
                    @endfor
                </div>
                <span class="text-textMuted font-medium">{{ number_format($avgRating, 1) }} / 5.0 ({{ $reviewsCount }} customer reviews)</span>
            </div>

            <!-- Price display -->
            <div class="flex items-baseline gap-4 py-3 border-y border-white/5 relative z-10">
                @if($product->discount_price)
                    <span class="text-3xl font-black text-brandGreen tabular-nums">₹{{ number_format($product->discount_price, 2) }}</span>
                    <span class="text-sm text-textMuted line-through tabular-nums">₹{{ number_format($product->price, 2) }}</span>
                @else
                    <span class="text-3xl font-black text-white tabular-nums">₹{{ number_format($product->price, 2) }}</span>
                @endif
            </div>

            <!-- Stock status -->
            <div class="relative z-10">
                @if($product->stock > 0)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-brandGreen/10 border border-brandGreen/20 text-brandGreen text-xs font-bold">
                        ● Node Live ({{ $product->stock }} units available)
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl bg-brandRed/10 border border-brandRed/20 text-brandRed text-xs font-bold">
                        ● Node Depleted
                    </span>
                @endif
            </div>

            <!-- Description -->
            <div class="space-y-2 text-xs leading-relaxed text-textMuted relative z-10">
                <h3 class="font-bold text-white text-sm">Specification Log</h3>
                <p class="font-medium">{{ $product->description ?? 'No catalog description currently registered for this registry node.' }}</p>
            </div>

            <!-- Tags -->
            @if($product->tags)
                <div class="flex flex-wrap gap-1.5 relative z-10">
                    @foreach(explode(',', $product->tags) as $tag)
                        <span class="bg-white/5 border border-white/5 text-textMuted px-3 py-0.5 rounded-full text-[9px] font-bold uppercase">#{{ trim($tag) }}</span>
                    @endforeach
                </div>
            @endif

            <!-- Specifications Table -->
            @if($product->specifications)
                @php
                    $specs = json_decode($product->specifications, true) ?? [];
                @endphp
                @if(count($specs) > 0)
                    <div class="space-y-3 pt-2 relative z-10">
                        <h3 class="font-bold text-white text-sm">Physical Specifications</h3>
                        <div class="border border-white/5 rounded-2xl overflow-hidden text-xs shadow-inner">
                            @foreach($specs as $key => $val)
                                <div class="grid grid-cols-3 border-b border-white/5 last:border-b-0">
                                    <div class="col-span-1 bg-black/40 p-3 font-bold text-textMuted border-r border-white/5">{{ $key }}</div>
                                    <div class="col-span-2 p-3 text-white bg-white/2 font-medium">{{ $val }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif

            <!-- Action Buttons -->
            <div class="flex gap-4 pt-4 relative z-10">
                @if($product->stock > 0)
                    <a href="/cart/add/{{ $product->id }}"
                       class="flex-1 text-center bg-brandAccent hover:bg-brandAccentHover text-white py-3.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim shadow-lg shadow-brandAccent/20">
                        Add to Cart
                    </a>
                    <a href="/cart/add/{{ $product->id }}?checkout=true"
                       class="flex-1 text-center bg-white hover:bg-gray-200 text-bgDark py-3.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim shadow-md">
                        Buy Now
                    </a>
                @else
                    <button disabled class="w-full bg-white/5 border border-white/5 text-textMuted py-3.5 rounded-xl text-xs font-bold cursor-not-allowed">
                        Node Depleted
                    </button>
                @endif
            </div>

        </div>

    </div>

    <!-- PRODUCT REVIEWS SECTION -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start pt-10 border-t border-white/5 relative z-10 select-none">
        
        <!-- Left: Write review form or summary -->
        <div class="glassmorphism-luxury p-6 border border-white/5 space-y-6 rounded-3xl shadow-2xl relative overflow-hidden specular-glass">
            <div>
                <h3 class="font-extrabold text-base text-white">Customer Feedback</h3>
                <p class="text-[10px] text-textMuted mt-0.5">Aggregate review ratings from verified purchasers</p>
            </div>

            <!-- Detailed star counts -->
            <div class="space-y-2">
                @for($star = 5; $star >= 1; $star--)
                    @php
                        $count = $activeReviews->where('rating', $star)->count();
                        $pct = $reviewsCount > 0 ? ($count / $reviewsCount) * 100 : 0;
                    @endphp
                    <div class="flex items-center gap-3 text-xs">
                        <span class="w-3 text-textMuted font-bold">{{ $star }}</span>
                        <span class="text-yellow-400">★</span>
                        <div class="flex-1 h-1.5 bg-black/40 rounded-full overflow-hidden">
                            <div class="bg-yellow-400 h-full rounded-full" style="width: {{ $pct }}%"></div>
                        </div>
                        <span class="w-6 text-right text-textMuted font-mono">{{ $count }}</span>
                    </div>
                @endfor
            </div>

            <!-- Write a Review Form -->
            @auth
                @php
                    $userReview = $activeReviews->where('user_id', auth()->id())->first();
                    $hasPurchased = \App\Models\Order::where('user_id', auth()->id())
                        ->whereHas('items', function ($query) use ($product) {
                            $query->where('product_id', $product->id);
                        })
                        ->exists();
                @endphp

                @if($userReview)
                    <div class="bg-brandGreen/10 border border-brandGreen/20 p-4 rounded-2xl text-brandGreen text-xs">
                        ✓ You have already reviewed this product.
                    </div>
                @elseif(!$hasPurchased)
                    <div class="bg-white/5 border border-white/5 p-4 rounded-2xl text-textMuted text-xs">
                        🔒 Only verified purchasers of this product can submit a review.
                    </div>
                @else
                    <form method="POST" action="/product/{{ $product->id }}/review" class="space-y-4 pt-4 border-t border-white/5">
                        @csrf
                        <h4 class="font-bold text-xs text-white uppercase tracking-wider">Publish Your Review</h4>
                        
                        <div class="space-y-1">
                            <label class="text-[9px] text-textMuted uppercase font-bold tracking-wider">Star Rating</label>
                            <select name="rating" required
                                    class="w-full bg-black/40 border border-white/10 rounded-xl px-3 py-2 text-xs text-white focus:outline-none focus:border-brandAccent focus:ring-0">
                                <option value="5" class="bg-bgDark">5 Stars (Excellent)</option>
                                <option value="4" class="bg-bgDark">4 Stars (Good)</option>
                                <option value="3" class="bg-bgDark">3 Stars (Average)</option>
                                <option value="2" class="bg-bgDark">2 Stars (Poor)</option>
                                <option value="1" class="bg-bgDark">1 Star (Very Poor)</option>
                            </select>
                        </div>

                        <div class="space-y-1">
                            <label class="text-[9px] text-textMuted uppercase font-bold tracking-wider">Review Title</label>
                            <input type="text" name="title" required placeholder="Summarize your experience..."
                                   class="w-full bg-black/40 border border-white/10 rounded-xl px-3 py-2 text-xs text-white placeholder-textMuted focus:outline-none focus:border-brandAccent focus:ring-0">
                        </div>

                        <div class="space-y-1">
                            <label class="text-[9px] text-textMuted uppercase font-bold tracking-wider">Description</label>
                            <textarea name="description" required rows="3" placeholder="Share details of your purchase..."
                                      class="w-full bg-black/40 border border-white/10 rounded-xl px-3 py-2 text-xs text-white placeholder-textMuted focus:outline-none focus:border-brandAccent focus:ring-0"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-brandAccent hover:bg-brandAccentHover text-white py-2.5 rounded-xl text-xs font-black transition-smooth btn-micro-anim shadow-md">
                            Submit Review
                        </button>
                    </form>
                @endif
            @else
                <div class="bg-white/5 border border-white/5 p-4 rounded-2xl text-textMuted text-xs text-center">
                    Please <a href="/login" class="text-brandAccent hover:underline font-bold">login</a> to write a review.
                </div>
            @endauth
        </div>

        <!-- Right: Recent Reviews list -->
        <div class="lg:col-span-2 space-y-4">
            <h3 class="font-extrabold text-sm text-white flex items-center gap-2">
                💬 <span>Public Reviews Log</span>
            </h3>

            <div class="space-y-4">
                @forelse($activeReviews as $rev)
                    <div class="glassmorphism-luxury p-5 border border-white/5 rounded-3xl space-y-3 relative overflow-hidden specular-glass">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <div class="w-7 h-7 rounded-full bg-brandAccent/10 border border-brandAccent/25 text-brandAccent flex items-center justify-center font-black text-[10px]">
                                    {{ strtoupper(substr($rev->user->name ?? 'G', 0, 1)) }}
                                </div>
                                <div>
                                    <span class="font-bold text-xs text-white">{{ $rev->user->name ?? 'Anonymous' }}</span>
                                    <span class="text-[9px] text-textMuted block">{{ $rev->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                            @if($rev->is_verified_purchase)
                                <span class="bg-brandGreen/10 border border-brandGreen/25 text-brandGreen px-2.5 py-0.5 rounded-full text-[8px] font-black uppercase">✓ Verified Purchaser</span>
                            @endif
                        </div>

                        <div class="space-y-1">
                            <div class="flex items-center text-yellow-400 text-[10px] font-bold gap-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                    <span>{{ $i <= $rev->rating ? '★' : '☆' }}</span>
                                @endfor
                            </div>
                            <h4 class="font-extrabold text-xs text-white">{{ $rev->title }}</h4>
                            <p class="text-[10px] text-textMuted leading-relaxed">{{ $rev->description }}</p>
                        </div>
                    </div>
                @empty
                    <div class="glassmorphism-luxury p-8 text-center border border-white/5 text-textMuted rounded-3xl">
                        No customer reviews registered for this storefront node yet.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

</div>

</x-app-layout>