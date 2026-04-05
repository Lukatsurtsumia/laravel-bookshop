<!-- Title + Author -->
<div class="grid md:grid-cols-2 gap-6">

    <div>
        <label class="block text-sm text-gray-400 mb-2">Book Title</label>

        <input type="text" name="title"
         value="{{ old('title', $book->title ?? '') }}"
        class="w-full bg-[#0f0f14] border border-gray-700 rounded-lg px-4 py-2
        focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition"
        placeholder="Enter book title">
        @error('title')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="block text-sm text-gray-400 mb-2">Author</label>

        <input type="text" name="author"
         value="{{ old('author',$book->author ?? '') }}"
        class="w-full bg-[#0f0f14] border border-gray-700 rounded-lg px-4 py-2
        focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition"
        placeholder="Author name">
        @error('author')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

</div>

<!-- Price + Year & Rating -->
<div class="flex flex-wrap justify-center gap-6 max-w-md mx-auto">

    <!-- Price -->
    <div class="w-[120px]">
        <label class="block text-sm text-gray-400 mb-2">Book Price</label>

        <div class="relative">
            <span class="absolute left-3 top-2.5 text-gray-400">$</span>

            <input type="number" step="0.01" min="0" name="price"
             value="{{ old('price', $book->price ?? '') }}"
            class="w-full pl-7 bg-[#0f0f14] border border-gray-700 rounded-lg px-4 py-2
            focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition"
            placeholder="0.00">
        </div>
        @error('price')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Year -->
    <div class="w-[120px]">
        <label class="block text-sm text-gray-400 mb-2">Book Year</label>

        <input type="number" min="0" name="year"
         value="{{ old('year', $book->year ?? '') }}"
        class="w-full bg-[#0f0f14] border border-gray-700 rounded-lg px-4 py-2
        focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition"
        placeholder="2024">
        @error('year')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

<div class="w-[100px]">
        <label class="block text-sm text-gray-400 mb-2">Book  Quantity</label>
            <input type="number"  min="0" name="quantity"
             value="{{ old('quantity', $book->quantity ?? '') }}"
            class="w-full pl-7 bg-[#0f0f14] border border-gray-700 rounded-lg px-4 py-2
            focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition"
            placeholder="100">
         
        @error('quantity')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
    <!-- Rating -->
    <div class="w-full flex flex-col items-center">

        <label class="block text-sm text-gray-400 mb-2">
            Book Rating
        </label>


        @include('profile.admin.bookForm.rating', [ 
            'rating' => old('rating',round($book->reviews_avg_rating ?? 0)) 
        ]) 
 

    </div>

</div>
<!-- Description -->
<div>
    <label class="block text-sm text-gray-400 mb-2">Description</label>

    <textarea name="description" rows="4"
    value="{{ old('description') }}"
    class="w-full bg-[#0f0f14] border border-gray-700 rounded-lg px-4 py-2
    focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400 transition"
    placeholder="Write a short description...">{{ old('description',  $book->description ?? '')  }}</textarea>
    @error('description')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
</div>