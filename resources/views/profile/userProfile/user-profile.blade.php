@extends('layouts.user')

@section('content')

<div class="max-w-7xl mx-auto px-4 md:px-6 py-8 space-y-10">

    <!-- STATS -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <div class="bg-[#0f0f14] border border-white/5 rounded-2xl p-6 text-center">
            <p class="text-gray-500 text-xl ">Your Reviews</p>
            <h3 class="text-3xl font-bold text-white mt-2">
                {{ $totalReviews}}
            </h3>
        </div>

        <div class="bg-[#0f0f14] border border-white/5 rounded-2xl p-6 text-center">
            <p class="text-gray-500 text-sm">Avg Rating</p>
            <h3 class="text-3xl font-bold text-amber-400 mt-2">
                {{ $reviews->count() ? number_format($reviews->avg('rating'), 1) : '0.0' }}
            </h3>
        </div>

        <div class="bg-[#0f0f14] border border-white/5 rounded-2xl p-6 text-center">
            <p class="text-gray-500 text-sm">My Points</p>
            <h3 class="text-3xl font-bold text-white mt-2">{{ auth()->user()->points }}</h3>
        </div>

    </div>

    <!-- QUICK ACTIONS -->
    <div>

        <h2 class="text-lg font-semibold text-amber-400 mb-4 text-center">
            Quick Actions
        </h2>

        <div class="grid md:grid-cols-2 gap-4">

            <a href="{{ route('user.show', auth()->user()->id )}}"
               class="bg-[#0f0f14] border border-white/5 rounded-xl p-5 hover:border-amber-400/30 transition">
                <h3 class="text-white font-medium mb-1">Check All Comments</h3>
                <p class="text-gray-500 text-sm">Explore the reviews</p>
            </a>
 

            <a href="{{ route('home') }}"
               class="bg-[#0f0f14] border border-white/5 rounded-xl p-5 hover:border-amber-400/30 transition">
                <h3 class="text-white font-medium mb-1">Open Store</h3>
                <p class="text-gray-500 text-sm">Go to homepage</p>
            </a>
        </div>

    </div>

    <!-- YOUR REVIEWS TABLE -->
    <h2 class="text-lg font-semibold text-amber-400 mb-4 text-center">
            Recent reviews
        </h2>
   @include('profile.userProfile.reviews')

</div>

@endsection