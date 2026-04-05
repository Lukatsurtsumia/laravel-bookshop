<div>

<label class="block text-sm text-gray-400 mb-3">Choose Categories</label>

<div class="bg-[#0f0f14] border border-gray-700 rounded-lg p-4 max-h-48 overflow-y-auto">

<div class="grid grid-cols-2 gap-3">

@foreach ($categories as $category)

<label class="flex items-center gap-2 text-sm text-gray-300 cursor-pointer hover:text-white">

<input type="checkbox"
name="categories[]"
value="{{ $category->id }}"
class="accent-amber-500 w-4 h-4"
{{ in_array($category->id, old('categories', $book->categories->pluck('id')->toArray())) ? 'checked' : '' }}>

<span>{{ $category->name }}</span>

</label>

@endforeach

</div>
@error('categories')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
</div>
</div>