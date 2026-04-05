<div class="bg-[#0f0f14] border border-white/5 rounded-xl overflow-hidden">

    <!-- ================= DESKTOP TABLE ================= -->
    <div class="hidden md:block">
        <table class="w-full text-sm">

            <thead class="bg-[#12121a] text-gray-500">
                <tr>
                    <th class="p-4 text-left">Book</th>
                    <th class="p-4 text-left">Rating</th>
                    <th class="p-4 text-left">Comment</th>
                    <th class="p-4 text-left">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-white/5">
                @forelse ($reviews as $review)
                    <tr class="hover:bg-[#12121a] transition">

                        <!-- BOOK -->
                        <td class="p-4 text-white font-medium">
                            {{ $review->book->title }}
                        </td>

                        <!-- RATING -->
                        <td class="p-4 text-amber-400 font-semibold">
                            ⭐ {{ $review->rating }}
                        </td>

                        <!-- COMMENT -->
                        <td class="p-4 text-gray-300 max-w-xs truncate">
                            {{ $review->comment }}
                        </td>

                        <!-- ACTIONS -->
                        <td class="p-4">
                            <div class="flex gap-4">
                              
                                <a href="{{ route('books.reviews.edit',[$review->book->id, $review->id]) }}"
                                   class="text-blue-400 text-sm hover:underline ">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('books.reviews.destroy', [$review->book->id, $review->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button class="text-red-400 text-sm hover:underline">
                                        Delete
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-6 text-center text-gray-500">
                            No reviews yet
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>


    <!-- ================= MOBILE CARDS ================= -->
    <div class="md:hidden p-4 space-y-4">
        @forelse ($reviews as $review)

            <div class="bg-[#12121a] p-5 rounded-2xl border border-white/5 space-y-4 shadow-sm">

                <!-- HEADER -->
                <div class="flex justify-between items-start gap-3">
                    <h3 class="text-white font-semibold text-sm leading-snug line-clamp-2">
                        {{ $review->book->title }}
                    </h3>

                    <span class="text-amber-400 text-xs font-medium whitespace-nowrap">
                        ⭐ {{ $review->rating }}
                    </span>
                </div>

                <!-- COMMENT -->
                <div class="text-gray-300 text-sm leading-relaxed line-clamp-3">
                    {{ $review->comment }}
                </div>

                <!-- ACTIONS -->
                <div class="flex justify-end gap-4 pt-2 border-t border-white/5">
                    <a href="{{ route('books.reviews.edit',[$review->book->id, $review->id]) }}" class="text-blue-400 text-xs hover:underline">
                        Edit
                    </a>

                    <form method="POST" action="{{ route('books.reviews.destroy', [$review->book->id, $review->id]) }}">
                        @csrf
                        @method('DELETE')

                        <button class="text-red-400 text-xs hover:underline">
                            Delete
                        </button>
                    </form>
                </div>

            </div>

        @empty
            <p class="text-center text-gray-500">No reviews yet</p>
        @endforelse
    </div>

</div>