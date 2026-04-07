<!-- =============================== -->
<!-- 📚 BOOK SECTION + Cart -->
<!-- =============================== -->
<div>
<section id="books"  class="relative bg-gradient-to-b from-[#1c1917] to-[#292524] text-white py-24 px-6 overflow-hidden">

    <!-- Background Glow (FIXED - not blocking clicks) -->
    <div class="absolute inset-0 pointer-events-none 
        bg-[radial-gradient(circle_at_top,rgba(251,191,36,0.15),transparent_60%)]">
    </div>

    <!-- CONTENT WRAPPER -->
    <div class="relative z-10 max-w-7xl mx-auto">

        <!-- SECTION TITLE -->
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold tracking-wide">
                Discover Your Next Obsession
            </h2>
            <p class="text-gray-400 mt-4 text-sm tracking-widest uppercase">
                Popular • Expensive • Most Rated
            </p>
        </div>

        <!-- FILTER BAR --> 
        @include('welcome_Book.filterBar')

        <livewire:cart />
        <!-- BOOK GRID -->
        <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        
        @forelse ($books as $book)
            <div class="group">
                <div class="relative aspect-[2/3] w-full overflow-hidden rounded-2xl 
                    shadow-md border border-gray-800
                    transform transition duration-300 
                    group-hover:scale-[1.03] group-hover:border-amber-400">
                     
                    <img src="{{  asset('storage/' . $book->image )}} "
                        onerror="this.onerror=null; this.src='{{ asset('storage/books/default.jpg') }}';"
                        class="w-full h-full object-cover"
                        alt="Book">
                    @if ($book->quantity <= 0)
                    <div class="absolute inset-0 bg-black/70 flex items-center justify-center">
                        <span class="text-red-500 font-bold text-lg">Out of Stock</span>
                    </div>
                        
                    @endif
                    <div class="absolute inset-0 
                        bg-gradient-to-t 

                        from-black/80 via-black/40 to-transparent">
                    </div>

                    <a href="{{ route('books.show', $book) }}" class="absolute inset-0"></a>

                    <div class="absolute bottom-4 left-4 right-4 text-white">

                        <!-- Details -->
                        <div class="p-3 rounded-lg
                            bg-black/10
                            group-hover:bg-black/50
                            group-hover:backdrop-blur-sm
                            transition duration-300">

                            <h3 class="text-lg font-bold leading-tight">
                                {{ $book->title }}
                            </h3>

                            <p class="text-red-400 text-xs mt-1">
                                {{ $book->author }}
                            </p>

                            <!-- Hover Info -->
                            <div class="opacity-0 max-h-0 overflow-hidden
                                group-hover:opacity-100 group-hover:max-h-40
                                transition-all duration-500 ease-in-out mt-2">

                                @foreach ($book->categories as $category)
                                    <p class="text-gray-300 text-xs">
                                        {{ $category->name }}
                                    </p>
                                @endforeach

                                <div class="mt-3 flex items-center justify-between">

                                    <!-- PRICE -->
                                    <span class="text-amber-400 font-semibold text-sm">
                                        ${{ number_format($book->price,2) }}
                                    </span>

                                    <!-- CART ICON -->
                                    <button wire:click="addToCart({{ $book->id }})"
                                        class="bg-amber-500 hover:bg-amber-400
                                            text-black
                                            p-2 rounded-lg
                                            transition shadow-md flex items-center justify-center">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-5 h-5"
                                            fill="none"
                                            viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 4h12m-6 0a1 1 0 100 2 1 1 0 000-2zm6 0a1 1 0 100 2 1 1 0 000-2"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="mt-2 flex items-center gap-2 text-xs">
                                <x-rating-star :rating="$book->reviews_avg_rating" class="text-amber-400"/> 
                                <span>
                                    {{ number_format($book->reviews_avg_rating,1) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500 col-span-3">
                No books found.
            </p>
        @endforelse

        </div>

    </div>

  @include('welcome_Book.pagination')
</section>
</div>
       
