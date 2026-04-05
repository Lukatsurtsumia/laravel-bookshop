@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center relative overflow-hidden">

    {{-- Background --}}
    <div class="absolute inset-0">
        <img src="{{ asset('storage/images/404.jpg') }}"
             class="w-full h-full object-cover opacity-150">
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>
    </div>

    {{-- Content --}}
    <div class="relative text-center px-6">

        <h1 class="text-7xl font-extrabold text-white tracking-wide">
            404
        </h1>

        <p class="mt-4 text-lg text-gray-300">
            Oops... the page you’re looking for doesn’t exist.
        </p>

        <div class="mt-8 flex justify-center gap-4">

            <a href="{{ route('home') }}"
               class="bg-amber-500 hover:bg-amber-400 text-black
                      px-6 py-3 rounded-xl font-semibold transition">
                Go Home
            </a>

             

        </div>

    </div>

</div>
@endsection