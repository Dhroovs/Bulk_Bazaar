<x-app-layout>

<div x-data="{ checkoutModalOpen: false }" class="space-y-10 relative">

    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 select-none relative z-10">
        <div>
            <h1 class="text-2xl font-black text-white tracking-tight">Active Transactions</h1>
            <p class="text-xs text-textMuted font-medium">Review your selected items and configure fulfillment details</p>
        </div>
        <a href="/products" class="bg-white/5 hover:bg-white/10 border border-white/10 text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim w-fit">
            ← Continue Exploration
        </a>
    </div>

    <!-- MAIN BODY -->
    @if(count($cart) == 0)
        <!-- Empty State -->
        <div class="glassmorphism-luxury p-16 text-center border border-white/5 space-y-4 rounded-3xl shadow-2xl relative overflow-hidden">
            <div class="text-6xl">🛒</div>
            <h2 class="text-xl font-bold text-white tracking-tight">Transaction Log Empty</h2>
            <p class="text-xs text-textMuted max-w-sm mx-auto font-medium">No items have been assigned to this checkout instance yet. Load listings from storefront to begin.</p>
            <a href="/products" class="inline-block bg-brandAccent hover:bg-brandAccentHover text-white px-6 py-2.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim">
                Browse Registry
            </a>
        </div>
    @else
        @php $total = 0; @endphp
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start relative z-10">
            
            <!-- Items List (Left) -->
            <div class="lg:col-span-2 space-y-4">
                @foreach($cart as $id => $item)
                    @php
                        $product = \App\Models\Product::find($id);
                        $itemTotal = $item['price'] * $item['quantity'];
                        $total += $itemTotal;
                    @endphp
                    <div class="glassmorphism-luxury p-5 border border-white/5 rounded-3xl shadow-2xl relative overflow-hidden specular-glass">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                            <!-- Product Icon & Info -->
                            <div class="flex items-center gap-4">
                                <div class="w-20 h-20 bg-black/40 rounded-2xl flex items-center justify-center text-4xl select-none shrink-0 border border-white/5">
                                    @if($product && $product->image)
                                        <img src="/products/{{ $product->image }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover rounded-2xl">
                                    @else
                                        @if($product && $product->category)
                                            @if(strtolower($product->category->name) == 'electronics')
                                                📱
                                            @elseif(strtolower($product->category->name) == 'fashion')
                                                👕
                                            @elseif(strtolower($product->category->name) == 'sports')
                                                ⚽
                                            @elseif(strtolower($product->category->name) == 'books')
                                                📚
                                            @else
                                                📦
                                            @endif
                                        @else
                                            📦
                                        @endif
                                    @endif
                                </div>
                                <div class="space-y-1">
                                    <h3 class="font-extrabold text-sm text-white">{{ $item['name'] }}</h3>
                                    @if($product && $product->brand)
                                        <p class="text-[9px] font-bold text-textMuted uppercase">Brand: {{ $product->brand }}</p>
                                    @endif
                                    <p class="text-xs text-brandGreen font-extrabold tabular-nums">₹{{ number_format($item['price'], 2) }}</p>
                                </div>
                            </div>

                            <!-- Actions & Quantity -->
                            <div class="flex items-center justify-between sm:justify-end gap-6 w-full sm:w-auto border-t sm:border-t-0 pt-3 sm:pt-0 border-white/5">
                                
                                <!-- Subtotal -->
                                <div class="text-left sm:text-right">
                                    <span class="text-[9px] text-textMuted uppercase font-bold block">Subtotal</span>
                                    <span class="text-xs font-black text-white tabular-nums">₹{{ number_format($itemTotal, 2) }}</span>
                                </div>

                                <!-- Quantity Controls -->
                                <div class="flex items-center bg-black/40 border border-white/10 rounded-xl p-1 select-none">
                                    <a href="/cart/decrease/{{ $id }}" class="w-8 h-8 bg-white/5 hover:bg-white/10 rounded-lg flex items-center justify-center text-sm font-black transition-smooth text-white">
                                        -
                                    </a>
                                    <span class="text-xs font-bold text-white w-8 text-center tabular-nums">
                                        {{ $item['quantity'] }}
                                    </span>
                                    @if($product && $item['quantity'] < $product->stock)
                                        <a href="/cart/increase/{{ $id }}" class="w-8 h-8 bg-brandAccent hover:bg-brandAccentHover rounded-lg flex items-center justify-center text-sm font-black transition-smooth text-white">
                                            +
                                        </a>
                                    @else
                                        <span class="w-8 h-8 bg-white/5 text-textMuted rounded-lg flex items-center justify-center text-sm font-black cursor-not-allowed">
                                            +
                                        </span>
                                    @endif
                                </div>

                                <!-- Remove -->
                                <a href="/cart/remove/{{ $id }}" class="w-8 h-8 bg-brandRed/10 hover:bg-brandRed/20 text-brandRed rounded-lg flex items-center justify-center text-sm transition-smooth btn-micro-anim border border-brandRed/20">
                                    🗑️
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Summary Card (Right) -->
            <div class="glassmorphism-luxury p-6 border border-white/5 space-y-6 lg:sticky lg:top-24 rounded-3xl shadow-2xl relative overflow-hidden specular-glass">
                <h2 class="text-lg font-black text-white tracking-tight">Fulfillment Order</h2>

                <div class="space-y-3 text-xs border-b border-white/5 pb-4">
                    <div class="flex justify-between">
                        <span class="text-textMuted">Subtotal</span>
                        <span class="font-bold text-white tabular-nums">₹{{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-textMuted">Logistics Routing</span>
                        <span class="font-bold text-brandGreen uppercase">Free Delivery</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-textMuted">Estimated Node Tax</span>
                        <span class="font-bold text-white">₹0.00</span>
                    </div>
                </div>

                <div class="flex justify-between items-baseline">
                    <span class="text-sm font-bold text-white">Payable Total</span>
                    <span class="text-2xl font-black text-brandAccent tabular-nums">₹{{ number_format($total, 2) }}</span>
                </div>

                <!-- Checkout Actions -->
                <div class="space-y-3 pt-2">
                    <button @click="checkoutModalOpen = true" class="w-full text-center bg-brandGreen hover:bg-green-600 text-white py-3.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim shadow-lg shadow-brandGreen/25">
                        Configure Checkout Parameters
                    </button>
                </div>

                <!-- Secure details -->
                <div class="grid grid-cols-3 gap-2 pt-4 border-t border-white/5 text-[9px] text-center text-textMuted font-bold uppercase">
                    <div class="space-y-1">
                        <div class="text-sm">🔒</div>
                        <p class="text-white">Secure API</p>
                    </div>
                    <div class="space-y-1">
                        <div class="text-sm">🚚</div>
                        <p class="text-white">Route Optimized</p>
                    </div>
                    <div class="space-y-1">
                        <div class="text-sm">🛡️</div>
                        <p class="text-white">Insured Trade</p>
                    </div>
                </div>
            </div>

        </div>
    @endif

    <!-- ==========================================
         CHECKOUT SYSTEM MODAL (Slide-in)
         ========================================== -->
    <div x-show="checkoutModalOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-end bg-black/85 backdrop-blur-md p-4">
        
        <!-- Modal Card -->
        <div @click.away="checkoutModalOpen = false"
             class="w-full max-w-lg bg-[#0e0e13]/95 border border-white/10 rounded-3xl shadow-2xl p-6 sm:p-8 space-y-6 max-h-screen overflow-y-auto modal-slide-in relative">
            
            <div class="flex justify-between items-center border-b border-white/5 pb-4">
                <div>
                    <h2 class="text-lg font-black text-white tracking-tight">Secure Platform Checkout</h2>
                    <p class="text-[9px] text-textMuted font-bold uppercase">Configure Node Routing Parameters</p>
                </div>
                <button @click="checkoutModalOpen = false" class="w-8 h-8 bg-white/5 hover:bg-white/10 border border-white/10 text-textMuted hover:text-white rounded-lg flex items-center justify-center transition-smooth">
                    ✕
                </button>
            </div>

            <!-- Checkout Details Form -->
            <div class="space-y-5">
                <!-- Shipping Address -->
                <div class="space-y-1.5">
                    <label class="text-[9px] uppercase tracking-wider text-textMuted font-bold">Fulfillment Target Address</label>
                    <input type="text" placeholder="e.g. 123 Main St, New Delhi" required
                           class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-2.5 text-xs text-white placeholder-textMuted focus:outline-none focus:border-brandAccent focus:ring-0">
                </div>

                <!-- Billing Address -->
                <div class="space-y-1.5">
                    <label class="text-[9px] uppercase tracking-wider text-textMuted font-bold">Routing Sync</label>
                    <div class="flex items-center gap-2 mb-1">
                        <input type="checkbox" id="same_address" checked class="rounded border-white/10 bg-black/40 text-brandAccent focus:ring-0">
                        <label for="same_address" class="text-[10px] text-textMuted font-medium">Sync Billing to Target Address</label>
                    </div>
                </div>

                <!-- Payment Selection (Custom Radio design) -->
                <div class="space-y-2">
                    <label class="text-[9px] uppercase tracking-wider text-textMuted font-bold block">Fulfillment Settlement Mode</label>
                    <div class="grid grid-cols-3 gap-3">
                        <label class="border border-brandAccent bg-brandAccent/10 rounded-xl p-3 text-center cursor-pointer block transition-smooth hover:bg-brandAccent/20">
                            <input type="radio" name="payment_method" value="cod" checked class="hidden">
                            <span class="text-base block">💵</span>
                            <span class="text-[9px] font-bold text-white block mt-1">Cash on Del.</span>
                        </label>
                        <label class="border border-white/10 bg-black/40 rounded-xl p-3 text-center cursor-pointer block transition-smooth hover:bg-white/5">
                            <input type="radio" name="payment_method" value="card" class="hidden">
                            <span class="text-base block">💳</span>
                            <span class="text-[9px] font-bold text-textMuted block mt-1">Credit Card</span>
                        </label>
                        <label class="border border-white/10 bg-black/40 rounded-xl p-3 text-center cursor-pointer block transition-smooth hover:bg-white/5">
                            <input type="radio" name="payment_method" value="upi" class="hidden">
                            <span class="text-base block">📱</span>
                            <span class="text-[9px] font-bold text-textMuted block mt-1">UPI / Wallet</span>
                        </label>
                    </div>
                </div>

                <!-- Order Summary within Checkout -->
                <div class="bg-black/50 border border-white/5 rounded-2xl p-4 space-y-2.5 text-xs shadow-inner">
                    <span class="text-[9px] font-bold text-textMuted uppercase tracking-wider block">Fulfillment Summary</span>
                    <div class="flex justify-between">
                        <span class="text-textMuted">Catalog Items:</span>
                        <span class="font-bold text-white">{{ count($cart) }}</span>
                    </div>
                    <div class="flex justify-between border-t border-white/5 pt-2.5 text-sm">
                        <span class="font-bold text-white">Total Settlement:</span>
                        <span class="font-black text-brandGreen tabular-nums">₹{{ number_format($total ?? 0, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Submit secure checkout -->
            <div class="pt-4 border-t border-white/5">
                <a href="/checkout" 
                   class="block text-center bg-brandGreen hover:bg-green-600 text-white py-3.5 rounded-xl text-xs font-bold transition-smooth btn-micro-anim shadow-lg shadow-brandGreen/25">
                    Commit Node Settlement (₹{{ number_format($total ?? 0, 2) }})
                </a>
            </div>

        </div>

    </div>

</div>

</x-app-layout>