@extends('layouts.admin')

@section('content')

<main class="flex-1 w-full max-w-6xl mx-auto px-4 sm:px-6 md:px-8 py-6 space-y-8">

<h1 class="text-xl sm:text-2xl font-serif text-amber-400">
Reviews Moderation
</h1>


<!-- SEARCH -->
<form action="{{ route('admin.reviews.index') }}" method="GET"
      class="flex flex-col sm:flex-row gap-3 w-full">

    <div class="relative flex-1">

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search by book, author, or user..."
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

</form>


<!-- REVIEWS -->
<div class="space-y-6">

@foreach ($reviews as $review)

<div class="bg-[#17171d] border border-gray-800 rounded-xl p-4 sm:p-6 w-full">

<div class="flex flex-col sm:flex-row sm:justify-between gap-2 mb-3">

<div>

<p class="text-white font-medium text-sm sm:text-base">
{{ $review->user->name }}
</p>

<p class="text-blue-400 text-sm break-words">
Book: {{ $review->book->title }}
</p>

</div>

<span class="text-gray-500 text-xs sm:text-sm">
{{ $review->created_at->diffForHumans() }}
</span>

</div>


<p class="text-gray-400 text-sm mb-3 break-words">
{{ $review->comment }}
</p>


<p class="text-gray-400 text-sm mb-4">
Rating: {{ $review->reviews_avg_rating }}
</p>


<form action="{{ route('admin.reviews.destroy', $review) }}" method="POST">

@csrf
@method('DELETE')

<button
onclick="return confirm('Are you sure you want to delete this review?')"
class="w-full sm:w-auto
       border border-red-400
       text-red-400
       px-4 py-2
       rounded-lg
       text-sm
       hover:bg-red-400 hover:text-black
       transition">

Delete Review

</button>

</form>

</div>

@endforeach

</div>


<!-- PAGINATION -->

<div class="flex justify-center pt-6">
@include('components.pagination', ['paginator' => $reviews])
</div>

</main>

@endsection