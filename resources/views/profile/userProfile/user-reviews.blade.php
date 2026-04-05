 @extends('layouts.user')
     @section('content')
    <div>
        <h2 class="text-lg font-semibold text-amber-400 mb-4 text-center ">
            Your Reviews
        </h2>
<div class="relative w-full lg:w-1/2 mt-2 mb-4 text-center">
       <form action="{{ route('user.show', $user->id) }}" method="GET">
                <input type="text"
                          name="search"
                          value="{{ request('search') }}"
                       placeholder="Search stories, authors..."
                       class="w-full pl-12 pr-4 py-3 rounded-xl
                              bg-black/40 border border-white/10
                              placeholder-gray-400 text-sm
                              focus:outline-none focus:ring-2 focus:ring-amber-500
                              transition duration-300">
 
                <!-- Icon -->
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-amber-400"
                     fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 21l-4.35-4.35m1.85-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <button type="submit"
                class="absolute right-2 top-1/2 -translate-y-1/2
               px-4 py-2
               rounded-lg
               bg-amber-500
               text-black text-xs font-semibold
               hover:bg-amber-400
               transition duration-200">
               Search
              </button>
          </form>
            </div>

@include('profile.userProfile.reviews')
 <!-- PAGINATION --> 
<div class="mt-4"> 
    {{ $reviews->links('components.pagination') }} 
</div>
        </div>

    </div>
 

      @endsection