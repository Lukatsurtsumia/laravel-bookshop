@extends('layouts.user')

@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 py-6">

<div class="bg-[#111116] border border-gray-800 rounded-2xl shadow-xl overflow-hidden">

    <!-- HEADER -->
    <div class="border-b border-gray-800 px-5 py-4">
        <h2 class="text-lg sm:text-xl font-serif text-amber-400 tracking-wide">
            Edit Review
        </h2>
    </div>

    <form action="{{ route('books.reviews.update', [$book->id, $review->id]) }}" method="POST" class="p-5 space-y-8">
        @csrf
        @method('PUT')

        <!-- BOOK SECTION -->
        <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">

            <!-- IMAGE -->
            <img
                src="{{ asset('storage/' .$book->image ) }}"
                onerror="this.onerror=null; this.src='{{ asset('images/default.jpg') }}';" 
                class="w-32 sm:w-36 h-48 sm:h-52 object-cover rounded-xl shadow-md border border-gray-700"
            >

            <!-- INFO -->
            <div class="text-center sm:text-left space-y-2">

                <h1 class="text-xl sm:text-2xl font-semibold text-white">
                    {{ $book->title }}
                </h1>

                <p class="text-gray-400 text-sm">
                    {{ $book->author }}
                </p>

                <p class="text-amber-400 font-medium">
                    ${{ $book->price }}
                </p>

                <!-- REAL RATING -->
                <div class="flex justify-center sm:justify-start items-center gap-1 mt-2">
                    @for ($i=1; $i<=5; $i++)
                    <span class="text-lg {{ $i<= ($book->reviews_avg_rating ?? 0) ? 'text-amber-400' : 'text-gray-600' }}">
                            ★
                        </span>
                    @endfor
                        
                   
                    <span class="text-gray-400 text-sm ml-2">
                        ({{ number_format($book->reviews_avg_rating, 1) }})
                    </span>
                </div>

            </div>
        </div>

        <!-- USER REVIEW -->
        <div class="space-y-5 border-t border-gray-800 pt-6">

            <h3 class="text-base sm:text-lg text-white font-medium">
                Your Review
            </h3>

            <!-- RATING -->
            <div class="flex flex-col items-center sm:items-start gap-2">

                <span class="text-sm text-gray-400">Your Rating</span>

                <div class="flex flex-row-reverse justify-center sm:justify-start gap-2">

                    @for($i = 5; $i >= 1; $i--)
                        <input
                            type="radio"
                            name="rating"
                            value="{{ $i }}"
                            id="star{{ $i }}"
                            class="peer hidden"
                            {{ old('rating', $review->rating ?? null) == $i ? 'checked' : '' }}
                        >

                        <label 
                            for="star{{ $i }}"
                            class="cursor-pointer text-3xl 
                                   text-gray-500
                                   peer-checked:text-amber-400 
                                   hover:text-amber-300 
                                   transition duration-150
                                   hover:scale-110">
                            ★
                        </label>
                    @endfor

                </div>

                @error('rating')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

            </div>

            <!-- COMMENT -->
            <div>
                <label class="text-sm text-gray-400">Your Comment</label>

                <textarea 
                    name="comment"
                    rows="4"
                    class="w-full mt-2 bg-[#0f0f14] border border-gray-700 rounded-lg p-3 text-white placeholder-gray-500 focus:ring-1 focus:ring-amber-400 focus:outline-none resize-none"
                    placeholder="Write your thoughts about this book..."
                >{{ old('comment', $review->comment) }}</textarea>

                @error('comment')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <!-- ACTIONS -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 border-t border-gray-800">

            <a href="{{ route('admin.books.index') }}"
               class="text-gray-400 hover:text-white text-sm transition">
                Cancel
            </a>

            <button type="submit"
                class="w-full sm:w-auto bg-amber-500 hover:bg-amber-400 text-black
                       px-6 py-2.5 rounded-lg font-medium transition shadow-md">
                Update Review
            </button>

        </div>

    </form>

</div>

</div>

@endsection