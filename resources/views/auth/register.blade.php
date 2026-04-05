@extends('layouts.app')

@section('content')

<section class="relative h-screen w-full flex items-center justify-center overflow-hidden">

    <!-- Background -->
    <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66"
         class="absolute inset-0 w-full h-full object-cover"
         alt="Library">

    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/75"></div>

    <!-- Content -->
    <div class="relative z-10 w-full flex flex-col items-center">

        @include('auth.logo')

        <!-- Glass Card -->
        <div class="w-[420px]
                    bg-white/10 backdrop-blur-xl
                    border border-white/20
                    rounded-3xl
                    shadow-2xl
                    p-8 text-white">

            <h3 class="text-3xl font-semibold text-center mb-6">
                Create Account
            </h3>

            <!-- Global Errors -->
             

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <input type="text"
                        name="name"
                        placeholder="Full Name"
                        value="{{ old('name') }}"
                        class="w-full px-5 py-3 rounded-2xl mt-4
                        bg-white/10 border
                        {{ $errors->has('name') ? 'border-red-500' : 'border-white/20' }}
                        text-white placeholder-gray-300
                        focus:outline-none focus:ring-2 focus:ring-white/40">

                    @error('name')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <input type="email"
                        name="email"
                        placeholder="Email"
                        value="{{ old('email') }}"
                        class="w-full px-5 py-3 rounded-2xl 
                        bg-white/10 border
                        {{ $errors->has('email') ? 'border-red-500' : 'border-white/20' }}
                        text-white placeholder-gray-300
                        focus:outline-none focus:ring-2 focus:ring-white/40">

                    @error('email')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <input type="password"
                        name="password"
                        placeholder="Password"
                        class="w-full px-5 py-3 rounded-2xl
                        bg-white/10 border
                        {{ $errors->has('password') ? 'border-red-500' : 'border-white/20' }}
                        text-white placeholder-gray-300
                        focus:outline-none focus:ring-2 focus:ring-white/40">
                    
                        @error('password')
                        <p class="text-red-400 text-xs mt-1 whitespace-pre-line">{{$message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <input type="password"
                        name="password_confirmation"
                        placeholder="Confirm Password"
                        class="w-full px-5 py-3 rounded-2xl
                        bg-white/10 border border-white/20
                        {{ $errors->has('password_confirmation') ? 'border-red-500' : 'border-white/20' }}
                        text-white placeholder-gray-300
                        focus:outline-none focus:ring-2 focus:ring-white/40">

                    @error('password_confirmation')
                        <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Register Button -->
                <button type="submit"
                        class="w-full bg-amber-500
                               text-black text-lg font-semibold
                               py-3 rounded-2xl
                               hover:bg-amber-400 transition">
                    Register
                </button>

            </form>

            <!-- Login Link -->
            <p class="text-center text-gray-300 mt-6">
                Already have an account?
                <a href="{{ route('login') }}" class="text-amber-400">
                    Login
                </a>
            </p>

            <!-- Back Button -->
            <div class="text-center mt-4">
                <a href="{{ route('home') }}"
                   class="inline-block px-6 py-2 rounded-full
                          bg-white/10 border border-white/20
                          text-gray-300
                          hover:bg-white/20 transition">
                    ← Back to Book Store
                </a>
            </div>

        </div>
    </div>

</section>

@endsection