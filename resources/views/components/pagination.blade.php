@if ($paginator->hasPages())
<div class="mt-24 flex justify-center">

<nav class="relative flex items-center gap-2
            px-8 py-4 rounded-full
            bg-gradient-to-r from-white/5 via-white/10 to-white/5
            backdrop-blur-2xl
            border border-white/10
            shadow-[0_0_40px_rgba(251,191,36,0.15)]">

{{-- Previous --}}
@if ($paginator->onFirstPage())

<span class="px-4 py-2 rounded-full text-gray-600">
‹
</span>

@else

<a href="{{ $paginator->appends(request()->query())->previousPageUrl() }}#books"
   class="group px-4 py-2 rounded-full
          bg-white/5 text-gray-300
          hover:bg-amber-500 hover:text-black
          transition-all duration-300 hover:scale-110">

<span class="group-hover:-translate-x-1 transition">
‹
</span>

</a>

@endif


{{-- Page Numbers --}}
@for ($i = 1; $i <= $paginator->lastPage(); $i++)

@if ($i == $paginator->currentPage())

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

<a href="{{ $paginator->appends(request()->query())->url($i) }}#books"
   class="px-4 py-2 rounded-full
          bg-white/5 text-gray-300
          hover:bg-amber-500 hover:text-black
          transition-all duration-300
          hover:scale-110">

{{ $i }}

</a>

@endif

@endfor


{{-- Next --}}
@if ($paginator->hasMorePages())

<a href="{{ $paginator->appends(request()->query())->nextPageUrl() }}#books"
   class="group px-4 py-2 rounded-full
          bg-white/5 text-gray-300
          hover:bg-amber-500 hover:text-black
          transition-all duration-300 hover:scale-110">

<span class="group-hover:translate-x-1 transition">
›
</span>

</a>

@else

<span class="px-4 py-2 rounded-full text-gray-600">
›
</span>

@endif

</nav>
</div>
@endif