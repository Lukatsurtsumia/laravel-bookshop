@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto p-6">

<div class="bg-[#111116] border border-gray-800 rounded-2xl shadow-xl overflow-hidden">

<!-- HEADER -->
<div class="border-b border-gray-800 px-6 py-4 flex items-center justify-between">

<h2 class="text-xl font-serif text-amber-400 tracking-wide">
Edit Book
</h2>
</div>

<form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
@csrf
@method('PUT')
<!-- BOOK COVER (TOP) -->
<div class="flex flex-col items-center gap-3">

<img
src="{{ asset('storage/' .$book->image ) }}"
onerror="this.onerror=null; this.src='{{ asset('images/default.jpg') }}';" 
class="w-40 h-56 object-cover rounded-xl shadow-lg border border-gray-700">

<label class="text-xs text-gray-400">
Upload new cover
</label>

<input
type="file"
name="image"
class="text-sm text-gray-400
file:bg-amber-500 file:text-black file:border-0
file:px-4 file:py-2 file:rounded-lg
hover:file:bg-amber-400 transition">
</div>
 @error('image')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror


<!-- TITLE + AUTHOR + RATING---><!-- DESCRIPTION -->
 
@include('profile.admin.bookForm.detail-form')
 
 
<!-- CATEGORIES -->
@include('profile.admin.category')

<!-- BUTTONS -->
<div class="flex items-center justify-between pt-4 border-t border-gray-800">

<a href="{{ route('admin.books.index') }}"
class="text-gray-400 hover:text-white transition text-sm">
Cancel
</a>

<button type="submit"
class="bg-amber-500 hover:bg-amber-400 text-black
px-6 py-2 rounded-lg font-medium transition shadow-md">

Update Book

</button>

</div>

</form>

</div>

</div>

@endsection
