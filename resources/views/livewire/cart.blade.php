 <!-- BOOK CART BUTTON -->
 <div>
  
        <div class="flex justify-center my-12">
            <button type="button"
                wire:click="toggle"
                aria-label="Open cart"
                aria-haspopup="dialog"
                aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
                class="group relative flex items-center gap-4 px-7 py-3 rounded-2xl bg-gradient-to-r from-amber-500 to-amber-400 text-black font-semibold tracking-wide shadow-xl shadow-amber-500/30 hover:scale-105 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg"
                  class="w-6 h-6 transition group-hover:rotate-12"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 4h12m-6 0a1 1 0 100 2 1 1 0 000-2zm6 0a1 1 0 100 2 1 1 0 000-2"/>
                </svg>
                <span class="text-sm tracking-wide">View Cart</span>
                <span class="absolute -top-2 -right-2 flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 rounded-full shadow-md">
                    {{ count($cart) ?? 0 }}
                </span>
            </button>
        </div>

        {{-- OVERLAY --}}
        @if($isOpen)
            <div
                wire:click="close"
                class="fixed inset-0 bg-black/50 z-40">
            </div>
        @endif

        <!-- Drawer -->
        <div
          id="cartDrawer"
          role="dialog"
          aria-modal="true"
          aria-labelledby="cartTitle"
          @class([
              'fixed top-0 right-0 h-full w-full max-w-md bg-black shadow-2xl z-50 transform transition-transform duration-300 flex flex-col',
              'translate-x-0' => $isOpen,
              'translate-x-full' => ! $isOpen,
          ]) >
          <div class="flex items-center justify-between p-5 border-b">
            <h2 id="cartTitle" class="text-lg font-semibold text-white">Your Cart</h2>
            <button wire:click="close" class="text-gray-500 hover:text-white" aria-label="Close cart">✕</button>
          </div>
 
          <div class="p-5 space-y-4 text-white flex-1 overflow-y-auto">
           @forelse($cart as $bookId => $item)
                <div class="cart-row flex items-center gap-4 border-b border-white/10 pb-4">
              <div class="w-16 h-17 bg-gray-800 rounded-lg">
                        <img class="w-full h-full object-cover"
                        src="{{ asset('storage/'. $item['image']) }}" alt="{{ $item['title'] }}">
                    </div>
                    <div class="flex-1">
                        <p class="font-medium">{{ $item['title'] }}</p>

                        <!-- QUANTITY CONTROLS -->
                        <div class="flex items-center gap-2 mt-2">
                            <!-- minus -->
                            <button 
                                class="w-7 h-7 rounded bg-white/10 hover:bg-white/20"
                                wire:click="decrease({{ $bookId }})">
                                -
                            </button>
                            <span class="px-2 text-sm quantity">
                                {{ $item['quantity'] }}
                            </span>

                            <!-- plus -->
                            <button  type="button"
                                class="w-7 h-7 rounded bg-white/10 hover:bg-white/20"
                                wire:click="increase({{ $bookId }})">
                                +
                            </button>
                        </div>
                    </div>
                    <p class="font-semibold item-total">
                        ${{ number_format($item['price'] * $item['quantity'], 2) }}
                    </p>

                    <!-- remove item -->
                    <button  type="button"
                        wire:click="remove({{ $bookId }})"
                        class="text-red-400 hover:text-red-600 text-lg ml-2">
                        ✕
                    </button>
                </div>
           @empty
                <p class="text-gray-400 text-center">Cart is empty</p>
           @endforelse

            <div class="pt-4 border-t flex items-center justify-between font-semibold">
              <span>Total</span>
              <span>${{ number_format($this->total ?? 0, 2) }}</span>
            </div>
       <div class="pt-4 border-t flex items-center justify-between font-semibold">
              <span>Your Points</span>
              @if(auth()->user())
                <span>§{{ auth()->user()->points ?? 0 }}</span>
                @else
                <span>§0</span>  
              @endif

            </div>
       @if(!empty($cart))
 
            <button 
            wire:click="checkout"
            wire:loading.attr="disabled"
        
            class="w-full rounded-xl bg-black text-white py-3 font-medium hover:bg-gray-800">
              Checkout
            </button>
         @endif
           @if(session()->has('success'))
<div class="text-green-400 text-sm mb-2">
    {{ session('success') }}
</div>
@endif

@if(session()->has('error'))
<div class="text-red-400 text-sm mb-2">
    {{ session('error') }}
</div>
@endif
          </div>
        </div>
</div>