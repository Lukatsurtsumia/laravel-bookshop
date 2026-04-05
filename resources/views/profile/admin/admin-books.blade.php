@extends('layouts.admin')

@section('content')

 

<main class="flex-1 p-4 md:p-8 max-w-7xl mx-auto w-full space-y-8">

<!-- HEADER -->

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

<h1 class="text-2xl font-serif text-amber-400">
Books Management
</h1>

<a href="{{ route('admin.books.create') }}"
class="bg-amber-500 hover:bg-amber-400 text-black px-5 py-2 rounded-lg text-sm">

* Add New Book

  </a>

</div>

<!-- SEARCH + FILTER -->

<form method="GET"
class="bg-gradient-to-br from-[#18181f] to-[#121218]
border border-gray-800 rounded-2xl
p-5 md:p-6
shadow-xl
flex flex-col gap-6">

<!-- TOP ROW (SEARCH + CATEGORY) -->

<div class="flex flex-col md:flex-row gap-4 items-stretch">

<!-- SEARCH -->

<div class="relative flex-1">

<svg xmlns="http://www.w3.org/2000/svg"
class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-500"
fill="none" viewBox="0 0 24 24" stroke="currentColor">

<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z"/>

</svg>

<input
type="text"
name="search"
value="{{ request('search') }}"
placeholder="Search books, authors..."
class="w-full pl-10 pr-4 py-3
bg-[#111118] border border-gray-700
rounded-xl
text-sm text-gray-200
placeholder-gray-500
focus:outline-none
focus:ring-2 focus:ring-amber-500
focus:border-amber-500
transition">

</div>

<!-- CATEGORY -->

<select
    name="category"
    class="w-1/2 bg-[#111118] border border-gray-700
    rounded-xl px-4 py-3 text-sm
    text-gray-200
    focus:outline-none
    focus:ring-2 focus:ring-amber-500
    focus:border-amber-500
    transition">

<option value="">All Categories</option>

@foreach($categories as $category)

<option
value="{{ $category->id }}"
{{ request('category') == $category->id ? 'selected' : '' }}>

{{ $category->name }}

</option>

@endforeach

</select>

<!-- SUBMIT -->

<button
class="bg-amber-500 hover:bg-amber-400
text-black font-medium
px-6 py-3
rounded-xl
shadow-md
transition">

Apply

</button>

</div>

<!-- FILTER PILLS -->

@php
$filters = [
'' => 'All',
'popular' => 'Popular',
'expensive' => 'Expensive',
'mostRated' => 'Most Rated'
];
@endphp

<div class="flex flex-wrap gap-3">

@foreach ($filters as $key => $label)

<a
href="{{ route('admin.books.index', [...request()->query() , 'filter'=>$key]) }}"

class="px-4 py-2 rounded-full text-sm font-medium
border transition

{{ request('filter') == $key
? 'bg-amber-500 text-black border-amber-500'
: 'border-gray-700 text-gray-400 hover:text-white hover:border-amber-500' }}">

{{ $label }}

</a>

@endforeach

</div>

</form>


<!-- DESKTOP TABLE -->

<div class="hidden md:block bg-[#17171d] border border-gray-800 rounded-xl overflow-x-auto">

<table class="w-full text-center">

<thead class="bg-[#1c1c24] text-gray-400 text-sm">

<tr>

<th class="p-4">Cover</th>
<th class="p-4">Title</th>
<th class="p-4">Author</th>
<th class="p-4">Categories</th>
<th class="p-4">Price</th>
<th class="p-4">Rating</th>
<th class="p-4">Quantity</th>

<th class="p-4">Actions</th>

</tr>

</thead>

<tbody class="divide-y divide-gray-800 text-center">

@foreach ($books as $book)

<tr class="hover:bg-[#1c1c24]">

<td class="p-4">
<img
src="{{ asset('storage/' .$book->image ) }}"
onerror="this.onerror=null; this.src='{{ asset('storage/books/default.jpg') }}';" 
class="w-12 h-16 object-cover rounded">
</td>

<td class="p-4 text-white">

{{ $book->title }}

</td>
<td class="p-4 text-white">
{{ $book->author }}
</td>
<td class="p-4 text-gray-300">
@foreach ( $book->categories as $category )
 
<span class="bg-[#22222a] text-xs px-2 py-1 rounded mr-1 ">
{{ $category->name }}
</span>
@endforeach
</td>

<td class="p-4 text-amber-400">
${{ $book->price }}
</td>

<td class="p-4 text-gray-300">
⭐ {{ number_format($book->reviews_avg_rating,1) }}
</td>
<td class="p-4 text-red-400">
{{ $book->quantity }}#
</td>
<td class="p-4 flex gap-5 mt-5">

<a href="{{ route('admin.books.edit',$book->id) }}"
class="text-blue-400 text-sm hover:text-blue-300">
Edit
</a>
<a href="{{ route('books.show',$book) }}"
class="text-amber-400 text-sm hover:text-blue-300">
View
</a>
<form method="POST" action="{{ route('admin.books.destroy',$book->id) }}">
@csrf
@method('DELETE')
<button type="submit"
class="text-red-400 text-sm hover:text-red-300">
Delete
</button>

</form>
</td>
</tr>

@endforeach

</tbody>
</table>
</div>

<!-- MOBILE CARDS -->

<div class="md:hidden space-y-4">

@foreach($books as $book)

<div class="bg-[#17171d]/90 backdrop-blur 
            border border-white/5 
            rounded-2xl p-4 
            shadow-md hover:shadow-xl transition 
            flex gap-4">

    <!-- Image -->
    <div class="relative flex-shrink-0">
        <img 
            src="{{ asset('storage/' . $book->image) }}"
            onerror="this.onerror=null; this.src='{{ asset('storage/books/default.jpg') }}';"
            class="w-24 h-36 object-cover rounded-xl"
        >

        <span class="absolute top-2 left-2 text-[10px] px-2 py-0.5 rounded-md text-white
            {{ $book->quantity > 0 ? 'bg-green-500/90' : 'bg-red-500/90' }}">
            {{ $book->quantity > 0 ? 'In Stock' : 'Out' }}
        </span>
    </div>

    <!-- Content -->
    <div class="flex-1 flex flex-col justify-between">

        <!-- Top -->
        <div class="space-y-1.5">

            <h3 class="text-white font-semibold text-sm line-clamp-2">
                {{ $book->title }}
            </h3>

            <p class="text-amber-400 text-xs">
                {{ $book->author }}
            </p>

            <div class="flex flex-wrap gap-1 pt-1">
                @foreach ($book->categories as $category)
                    <span class="bg-white/5 text-gray-300 text-[10px] px-2 py-0.5 rounded-md">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>

        </div>

        <!-- Bottom -->
        <div class="pt-3 space-y-2">

            <!-- Quantity -->
            <p class="text-[11px] font-medium
                {{ $book->quantity < 4 ? 'text-red-400' : 'text-green-400' }}">
                {{ $book->quantity }} left
            </p>

            <!-- Price + Rating (INLINE) -->
            <div class="flex items-center gap-3 text-xs">
                <span class="text-amber-400 font-semibold">
                    ${{ $book->price }}
                </span>

                <span class="text-gray-400">
                    ⭐ {{ number_format($book->reviews_avg_rating,1) }}
                </span>
            </div>

            <!-- Actions (INLINE) -->
            <div class="flex items-center justify-between pt-2">

                <a href="{{ route('books.show',$book) }}"
                   class="text-[11px] px-3 py-1.5 rounded-lg 
                          bg-amber-500 hover:bg-amber-400 
                          text-black font-semibold transition">
                    View
                </a>

                <div class="flex gap-2">

                    <a href="{{ route('admin.books.edit',$book) }}"
                       class="p-2 rounded-md bg-blue-500/20 text-blue-400 hover:bg-blue-500/30 transition">
                        ✏️
                    </a>

                    <form method="POST" action="{{ route('admin.books.destroy', $book) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            onclick="return confirm('Delete this book?')"
                            class="p-2 rounded-md bg-red-500/20 text-red-400 hover:bg-red-500/30 transition">
                            🗑
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach

</div>
<!-- PAGINATION -->
<div class="pt-4">
@include('components.pagination', ['paginator'=>$books])

</div>
</main>
@endsection
