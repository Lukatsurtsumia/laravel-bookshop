@extends('layouts.user')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-[#0f0f14] via-[#15151b] to-[#0b0b0f] py-12 text-gray-200">

<div class="max-w-5xl mx-auto px-4 sm:px-6 space-y-10">

<!-- PAGE TITLE -->
<h1 class="text-2xl sm:text-3xl font-bold text-center tracking-wide">
Payment Receipts
</h1>


@if($orders->isEmpty())

<!-- EMPTY STATE -->
<div class="bg-white/5 border border-white/10 rounded-2xl p-12 text-center">
<p class="text-gray-400 text-lg">No purchases yet</p>
</div>

@else


@foreach($orders as $order)

<!-- RECEIPT -->
<div class="bg-[#0f0f14] border border-white/10 rounded-2xl shadow-xl overflow-hidden">

<!-- RECEIPT HEADER -->
<div class="bg-gradient-to-r from-amber-500 to-amber-400 text-black px-5 sm:px-8 py-5 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-2">

<div>
<h2 class="text-lg sm:text-xl font-bold">BookShop Receipt</h2>
<p class="text-xs sm:text-sm opacity-80">Order #{{ $order->id }}</p>
</div>

<div class="text-sm sm:text-right">
<p>{{ $order->created_at->format('F d, Y') }}</p>
<p class="text-xs opacity-80">{{ $order->created_at->format('H:i') }}</p>
</div>

</div>


<!-- RECEIPT BODY -->
<div class="p-5 sm:p-8 space-y-6">

<!-- CUSTOMER INFO -->
<div class="flex flex-col sm:flex-row sm:justify-between gap-4 text-sm border-b border-dashed border-white/20 pb-4">

<div>
<p class="text-gray-400 text-xs uppercase tracking-wide">Customer</p>
<p class="font-semibold">{{ auth()->user()->name }}</p>
</div>

<div class="sm:text-right">
<p class="text-gray-400 text-xs uppercase tracking-wide">Payment Method</p>
<p class="font-semibold">Points</p>
</div>

</div>


<!-- ITEMS TABLE -->
<div class="space-y-4">

<div class="hidden sm:grid grid-cols-3 text-gray-400 text-sm border-b border-white/10 pb-2">
<span>Item</span>
<span class="text-center">Qty</span>
<span class="text-right">Price</span>
</div>

@foreach($order->items as $item)

<div class="flex flex-col sm:grid sm:grid-cols-3 gap-3 sm:gap-0 items-start sm:items-center text-sm">

<!-- BOOK -->
<div class="flex items-center gap-3">

<img src="{{ asset('storage/'.$item->book->image) }}"
class="w-10 h-14 object-cover rounded">

<span class="font-medium">
{{ $item->book->title }}
</span>

</div>

<!-- QUANTITY -->
<div class="sm:text-center text-gray-300">
Qty: {{ $item->quantity }}
</div>

<!-- PRICE -->
<div class="sm:text-right text-amber-400 font-medium">
{{ $item->price }} pts
</div>

</div>

@endforeach

</div>


<!-- TOTAL -->
<div class="border-t border-dashed border-white/20 pt-5 flex justify-between text-base sm:text-lg font-semibold">

<span>Total Paid</span>

<span class="text-amber-400">
{{ $order->total }} Points
</span>

</div>


<!-- FOOTER -->
<div class="text-center text-xs text-gray-500 pt-4 border-t border-white/10">
Thank you for your purchase
</div>

</div>

</div>

@endforeach


@endif

</div>

</div>

@endsection