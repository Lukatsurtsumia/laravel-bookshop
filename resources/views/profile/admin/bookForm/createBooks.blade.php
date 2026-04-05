@extends('layouts.admin')

@section('content')

<div class="max-w-4xl mx-auto p-4 md:p-6">
  
```
<!-- Card -->
<div class="bg-[#111116] border border-gray-800 rounded-xl shadow-lg">

    <!-- Header -->
    <div class="border-b border-gray-800 px-6 py-4 flex items-center justify-between">
        <h2 class="text-xl font-serif text-amber-400">
            Add New Book
        </h2>

        <a href="{{ route('admin.books.index') }}"
           class="text-sm text-gray-400 hover:text-gray-200 transition">
           ← Back
        </a>
    </div>

    <!-- Form -->
   <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-8">
@csrf

<!-- TITLE + AUTHOR + RATING---><!-- DESCRIPTION -->
 
@include('profile.admin.bookForm.detail-form')
 
 
<!-- Category + Image -->
<div class="grid md:grid-cols-2 gap-8">

<!-- Categories -->
@include('profile.admin.category')

<!-- Image -->
<div>

<label class="block text-sm text-gray-400 mb-3">Book Cover</label>

<div class="bg-[#0f0f14] border border-gray-700 rounded-lg p-4">

<input type="file" name="image"
value="{{ old('image') }}"
class="w-full text-sm text-gray-400
file:bg-amber-500 file:text-black file:border-0
file:px-4 file:py-2 file:rounded-md
hover:file:bg-amber-400 transition">
{{-- preview --}} 
<img 
id="previewImage" 
class="w-40 h-56 object-cover mt-4 rounded-lg border border-gray-700 hidden"> 
<p class="text-xs text-gray-500 mt-2">
Upload book cover image (JPG, PNG)
   @error('image')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
</p>

</div>
</div>

</div>

<!-- Buttons -->
<div class="flex items-center gap-4 pt-4">

<button class="bg-amber-500 hover:bg-amber-400 text-black px-6 py-2 rounded-lg font-medium transition shadow">
Create Book
</button>

<a href="{{ route('admin.books.index') }}"
class="text-gray-400 hover:text-gray-200 transition">
Cancel
</a>

</div>

</form>

</div>
```

</div>

@endsection
