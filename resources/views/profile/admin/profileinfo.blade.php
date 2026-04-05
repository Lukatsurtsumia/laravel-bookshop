@extends('layouts.admin')

@section('content')
<!-- PAGE CONTENT -->

<main class="flex-1  p-4 md:p-8 max-w-7xl mx-auto w-full space-y-10">

<!-- STATS -->

<div class="grid grid-cols-1 text-center  sm:grid-cols-2 lg:grid-cols-3 gap-6">

<div class="bg-[#17171d] border border-gray-800 rounded-xl p-6">
<p class="text-gray-400 text-sm">Total Books</p>
<h3 class="text-3xl font-bold text-white mt-2">{{ $stats['books']}}</h3>
</div>

<div class="bg-[#17171d] border border-gray-800 rounded-xl p-6">
<p class="text-gray-400 text-sm">Users</p>
<h3 class="text-3xl font-bold text-white mt-2">{{ $stats['users'] }}</h3>
</div>

<div class="bg-[#17171d] border border-gray-800 rounded-xl p-6">
<p class="text-gray-400 text-sm">Reviews</p>
<h3 class="text-3xl font-bold text-white mt-2">{{ $stats['reviews'] }}</h3>
</div>

 

</div>

<!-- QUICK ACTIONS -->

<div>

<h2 class="text-xl font-serif text-amber-400 mb-6">
Quick Actions
</h2>

<div class="grid md:grid-cols-3 gap-6">

<a href="{{ route('admin.books.create') }}"
class="bg-[#17171d] border border-gray-800 rounded-xl p-6 hover:border-amber-500 transition">
<h3 class="text-lg text-white mb-2">Add Book</h3>
<p class="text-gray-400 text-sm">
Create a new book for the store
</p>
</a>
 
<a href="{{ route('admin.users.index') }}" 
 class="bg-[#17171d] border border-gray-800 rounded-xl p-6 hover:border-amber-500 transition">
<h3 class="text-lg text-white mb-2">Manage Users</h3>
<p class="text-gray-400 text-sm">
View and manage registered users
</p>
</a>


<a href="{{ route('home') }}" class="bg-[#17171d] border border-gray-800 rounded-xl p-6 hover:border-amber-500 transition">
<h3 class="text-lg text-white mb-2">Open Store</h3>
<p class="text-gray-400 text-sm">
Go to public bookstore page
</p>
</a>

</div>

</div>

<!-- RECENT BOOKS -->

<div>

<h2 class="text-xl font-serif text-amber-400 mb-6">
Recent Books
</h2>

<div class="bg-[#17171d] border border-gray-800 rounded-xl overflow-x-auto">

<table class="w-full text-center">

<thead class="bg-[#1c1c24] text-gray-400 text-sm">

<tr>
<th class="p-4">Book</th>
<th class="p-4">Price</th>
<th class="p-4">Rating</th>
<th class="p-4">Actions</th>
</tr>

</thead>

<tbody class="divide-y divide-gray-800">
   
@foreach ($books->take(4) as $book )
<tr class="hover:bg-[#1c1c24]">
<td class="p-4 text-white">{{ $book->title }}</td>
<td class=" text-amber-400">{{ $book->price }} $</td>
<td class="p-4 text-gray-300">{{ number_format($book->reviews_avg_rating, 1) }}</td>
<td class=" flex justify-center items-center p-4 gap-5 ">
<a href="{{ route('admin.books.edit', $book->id) }}" class="text-blue-400 text-sm">Edit</a>
<form action="{{ route('admin.books.destroy', $book->id) }}" method="post">
    @csrf
    @method('DELETE')
    <button class="text-red-400 text-sm">Delete</button>
    </form>
</td>
</tr>
 


</tbody>
@endforeach
 
</table>

</div>

</div>

<!-- RECENT REVIEWS -->

<div>

<h2 class="text-xl font-serif text-amber-400 mb-6">
Recent Reviews
</h2>

<div class="space-y-4">

@foreach ($reviews as $review)

<div class="bg-[#17171d] border border-gray-800 rounded-xl p-6">
     <!-- User-->
     <div class="flex justify-between items-center mb-4">
     <h1 class="text-white-400 text-xl mb-2">
         {{ $review->user->name }}
         
     </h1>
      <span class="text-gray-500 text-xs">
            {{ $review->created_at?->diffForHumans() }}
        </span>
        </div>
    <!-- Book title -->
    <p class="text-gray-400 text-sm mb-2">
       <h1 class="text-blue-400"> Book : {{ $review->book->title }}
         </h1>
    </p>

    <!-- Comment + time -->
    <div class="flex justify-between">
        <span class="text-gray-300 text-sm">
            {{ $review->comment }}
        </span>

    </div>

    <!-- Delete -->
    <div>
    <form method="POST" action="{{ route('admin.reviews.destroy', $review->id) }}">
        @csrf
        @method('DELETE')

        <button class="text-red-500 text-sm mt-2">
            Delete Review
        </button>
    </form>

       
        </div>
</div>

@endforeach

</div>

</div>

</main>

</div>
@endsection
