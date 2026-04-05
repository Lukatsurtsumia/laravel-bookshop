@extends('layouts.app')
@section('content')


<section class="relative min-h-screen w-full flex items-center justify-center overflow-hidden">

    <!-- Background -->
    <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66"
         class="absolute inset-0 w-full h-full object-cover"
         alt="Library">

    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/75"></div>

    <!-- Content Wrapper -->
    <div class="relative z-10 w-full flex flex-col items-center">

      @include('auth.logo')

        <!-- Glass Card -->
        <div class="w-[420px] bg-white/10 backdrop-blur-xl
                    border border-white/20
                    rounded-3xl
                    shadow-2xl
                    p-10 text-white">

            <h3 class="text-3xl font-semibold text-center mb-8">
                Welcome Back
            </h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <input type="email"
                       name="email"
                       placeholder="Email"
                       class="w-full mt-5 px-5 py-4 rounded-2xl
                              bg-white/10 border
                             {{ $errors->has('email') ?  'border-red-500' : 'border-white/20' }}
                              text-white placeholder-gray-300
                              focus:outline-none focus:ring-2 focus:ring-white/40">
                @error('email')
                        <p class="text-red-400 text-xs  whitespace-pre-line">{{$message }}</p>
                @enderror
              
                <!-- Password -->
                <input type="password"
                       name="password"
                       placeholder="Password"
                       class="w-full mt-4 px-5 py-4 rounded-2xl
                              bg-white/10 border  
                              {{ $errors->has('password') ?  'border-red-500' : 'border-white/20' }}
                              text-white placeholder-gray-300
                              focus:outline-none focus:ring-2 focus:ring-white/40">
                    
              @error('password')
                        <p class="text-red-400 text-xs  whitespace-pre-line">{{$message }}</p>
                @enderror
                <!-- Login Button -->
                <button type="submit"
                        class="w-full bg-amber-500 mt-4
                               text-black text-lg font-semibold
                               py-4 rounded-2xl
                               hover:bg-amber-400 transition">
                    Login
                </button>
            </form>

            <!-- Register -->
            <p class="text-center text-gray-300 mt-8">
                Don't have an account?
                <a href="{{ route('register') }}"
                   class="text-amber-400">
                    Register
                </a>
            </p>

            <!-- Back Button -->
            <div class="text-center mt-6">
                <a href="{{ route('home') }}"
                   class="inline-block px-6 py-3 rounded-full
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