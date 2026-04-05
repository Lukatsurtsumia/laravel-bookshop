@extends('layouts.admin')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-[#0f0f14] via-[#15151b] to-[#0b0b0f] py-10 text-gray-200">

<div class="max-w mx-auto px-4">

    <div class="mb-3">
        <form action="{{ route('admin.users.history') }}" method="GET"
      class="flex flex-col sm:flex-row gap-3 w-full">

    <div class="relative flex-1">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search by User Name..."
            class="w-full pl-10 pr-4 py-3
                   bg-[#111118] border border-gray-700
                   rounded-xl
                   text-sm text-gray-200
                   placeholder-gray-500
                   focus:outline-none
                   focus:ring-2 focus:ring-amber-500
                   focus:border-amber-500">

        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500">
            🔍
        </span>

    </div>

    <button
        type="submit"
        class="bg-amber-500 hover:bg-amber-400
               text-black font-medium
               px-6 py-3
               rounded-xl
               shadow-md
               transition
               w-full sm:w-auto">

        Search

    </button>

</form></div>
@if($orders->isEmpty())

<div class="bg-white/5 border border-white/10 rounded-xl p-8 text-center">
<p class="text-gray-400 text-sm">No purchases yet</p>
</div>

@else

<!-- GRID -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

@foreach($orders as $order)

<!-- RECEIPT -->
<div class="bg-[#0f0f14] border border-white/10 rounded-xl shadow-lg overflow-hidden">

<!-- HEADER -->
<div class="bg-gradient-to-r from-amber-500 to-amber-400 text-black px-4 py-3 flex justify-between items-center">

<div>
<h2 class="text-sm font-bold">BookShop Receipt</h2>
<p class="text-[11px] opacity-80">Order #{{ $order->id }}</p>
</div>

<div class="text-right text-[11px]">
<p>{{ $order->created_at->format('M d, Y') }}</p>
<p class="opacity-80">{{ $order->created_at->format('H:i') }}</p>
</div>

</div>

<!-- BODY -->
<div class="p-4 space-y-4">

<!-- ORDER INFO -->
<div class="grid grid-cols-2 text-xs border-b border-dashed border-white/20 pb-2">

<div>
<p class="text-gray-400 uppercase">Customer</p>
<p class="font-semibold text-sm">{{ $order->user->name }}</p>
</div>
 

<div class="text-right">
<p class="text-gray-400 uppercase">Payment</p>
<p class="font-semibold text-sm">Points</p>
</div>

</div>

<!-- ITEMS -->
<div class="space-y-3">

<!-- COLUMN HEADER -->
<div class="grid grid-cols-4 text-[11px] text-gray-400 border-b border-white/10 pb-1">
<span class="col-span-2">Book</span>
<span class="text-center">Qty</span>
<span class="text-right">Price</span>
</div>

@foreach($order->items as $item)

<div class="grid grid-cols-4 items-center gap-2 text-sm">

<!-- BOOK -->
<div class="col-span-2 flex items-center gap-3">
 
<img src="{{ asset('storage/'.$item->book->image) }}"
class="w-9 h-12 object-cover rounded border border-white/10">

<span class="font-medium truncate">
{{ $item->book->title }}
</span>

</div>

<!-- QUANTITY -->
<div class="text-center font-medium text-gray-300">
{{ $item->quantity }}
</div>

<!-- PRICE -->
<div class="text-right font-semibold text-amber-400">
{{ $item->price }} pts
</div>

</div>
@endforeach

</div>

<!-- TOTAL -->
<div class="border-t border-dashed border-white/20 pt-3 flex justify-between text-sm font-semibold">

<span>Total</span>

<span class="text-amber-400">
{{ $order->total }} pts
</span>

</div>

<!-- FOOTER -->
<div class="text-center text-[13px] text-green-500 pt-2 border-t border-white/10">
Payment successful
</div>

</div>

</div>

@endforeach

</div>

@endif

</div>

</div>

@endsection


