<div class="flex flex-row-reverse items-center gap-1 max-w-full overflow-hidden">

<input
type="radio"
value="1"
id="star1"
class="peer hidden"
@if(!empty($livewire)) wire:model.defer="rating" @else name="rating" @endif
{{ old('rating', $rating ?? 0) == 1 ? 'checked' : '' }}>
<label for="star1" class="cursor-pointer text-2xl text-gray-400 peer-checked:text-yellow-400 hover:text-yellow-400">★</label>

<input
type="radio"
value="2"
id="star2"
class="peer hidden"
@if(!empty($livewire)) wire:model.defer="rating" @else name="rating" @endif
{{ old('rating', $rating ?? 0) == 2 ? 'checked' : '' }}>
<label for="star2" class="cursor-pointer text-2xl text-gray-400 peer-checked:text-yellow-400 hover:text-yellow-400">★</label>

<input
type="radio"
value="3"
id="star3"
class="peer hidden"
@if(!empty($livewire)) wire:model.defer="rating" @else name="rating" @endif
{{ old('rating', $rating ?? 0) == 3 ? 'checked' : '' }}>
<label for="star3" class="cursor-pointer text-2xl text-gray-400 peer-checked:text-yellow-400 hover:text-yellow-400">★</label>

<input
type="radio"
value="4"
id="star4"
class="peer hidden"
@if(!empty($livewire)) wire:model.defer="rating" @else name="rating" @endif
{{ old('rating', $rating ?? 0) == 4 ? 'checked' : '' }}>
<label for="star4" class="cursor-pointer text-2xl text-gray-400 peer-checked:text-yellow-400 hover:text-yellow-400">★</label>

<input
type="radio"
value="5"
id="star5"
class="peer hidden"
@if(!empty($livewire)) wire:model.defer="rating" @else name="rating" @endif
{{ old('rating', $rating ?? 0) == 5 ? 'checked' : '' }}>
<label for="star5" class="cursor-pointer text-2xl text-gray-400 peer-checked:text-yellow-400 hover:text-yellow-400">★</label>

</div>

@error('rating')
<p class="text-red-500 text-sm mt-1">{{ $message }}</p>
@enderror
