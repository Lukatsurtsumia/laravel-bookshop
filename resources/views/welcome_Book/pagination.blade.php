@if ($books->hasPages())
<div class="mt-24 flex justify-center">

    <nav class="relative flex items-center gap-4
                px-8 py-4 rounded-full
                bg-gradient-to-r from-white/5 via-white/10 to-white/5
                backdrop-blur-2xl
                border border-white/10
                shadow-[0_0_40px_rgba(251,191,36,0.15)]">

        {{-- Previous --}}
        @unless ($books->onFirstPage())
            <a href="{{ $books->previousPageUrl() }}"
               class="group px-4 py-2 rounded-full
                      bg-white/5 text-gray-300
                      hover:bg-amber-500 hover:text-black
                      transition-all duration-300
                      hover:scale-110">
                <span class="group-hover:-translate-x-1 transition">
                    ‹
                </span>
            </a>
        @endunless


        @php
            $current = $books->currentPage();
            $last = $books->lastPage();
            $start = max($current - 2, 1);
            $end = min($current + 2, $last);
        @endphp


        {{-- First --}}
        @if ($start > 1)
            <a href="{{ $books->url(1) }}"
               class="px-4 py-2 rounded-full
                      bg-white/5 text-gray-400
                      hover:bg-amber-500 hover:text-black
                      transition-all duration-300 hover:scale-110">
                1
            </a>

            @if ($start > 2)
                <span class="px-2 text-gray-600">•••</span>
            @endif
        @endif


        {{-- Middle Pages --}}
        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $current)
                <span class="relative px-6 py-2 rounded-full
                             bg-amber-500 text-black font-semibold
                             shadow-[0_0_25px_rgba(251,191,36,0.6)]
                             scale-110 transition-all duration-300">

                    {{ $i }}

                    <span class="absolute inset-0 rounded-full
                                 animate-ping
                                 bg-amber-400/30 -z-10"></span>
                </span>
            @else
                <a href="{{ $books->url($i) }}"
                   class="px-4 py-2 rounded-full
                          bg-white/5 text-gray-300
                          hover:bg-amber-500 hover:text-black
                          transition-all duration-300
                          hover:scale-110">
                    {{ $i }}
                </a>
            @endif
        @endfor


        {{-- Last --}}
        @if ($end < $last)
            @if ($end < $last - 1)
                <span class="px-2 text-gray-600">•••</span>
            @endif

            <a href="{{ $books->url($last) }}"
               class="px-4 py-2 rounded-full
                      bg-white/5 text-gray-400
                      hover:bg-amber-500 hover:text-black
                      transition-all duration-300 hover:scale-110">
                {{ $last }}
            </a>
        @endif


        {{-- Next --}}
        @if ($books->hasMorePages())
            <a href="{{ $books->nextPageUrl() }}"
               class="group px-4 py-2 rounded-full
                      bg-white/5 text-gray-300
                      hover:bg-amber-500 hover:text-black
                      transition-all duration-300
                      hover:scale-110">
                <span class="group-hover:translate-x-1 transition">
                    ›
                </span>
            </a>
        @endif

    </nav>
</div>
@endif
