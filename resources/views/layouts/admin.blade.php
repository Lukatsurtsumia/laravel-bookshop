<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Vintage Library Admin</title>

<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="bg-[#0f0f14] text-gray-200 min-h-screen flex overflow-x-hidden">

<!-- SIDEBAR -->

<aside class="hidden md:flex md:w-64 bg-[#111116] border-r border-gray-800 flex-col shrink-0">

<!-- LOGO -->

<div class="p-6 border-b border-gray-800 flex items-center gap-3">
<img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f" class="w-10 h-10 object-cover rounded">
<span class="text-amber-400 font-serif text-lg tracking-wider">
VINTAGE ADMIN
</span>
</div>


<!-- NAVIGATION -->

<nav class="flex-1 p-4 space-y-2">

<a href="{{ route('admin.info') }}" class="block px-4 py-2 rounded-lg hover:bg-[#1c1c24] transition">
Dashboard
</a>

<a href="{{ route('admin.books.index') }}" class="block px-4 py-2 rounded-lg hover:bg-[#1c1c24] transition">
Books
</a>

<a href="{{ route('admin.users.index') }}" class="block px-4 py-2 rounded-lg hover:bg-[#1c1c24] transition">
Users
</a>

<a href="{{ route('admin.reviews.index') }}" class="block px-4 py-2 rounded-lg hover:bg-[#1c1c24] transition">
Reviews
</a>
<a href="{{ route('admin.users.history') }}" class="block px-4 py-2 rounded-lg hover:bg-[#1c1c24] transition">
History
</a>
</nav>

</aside>

<!-- MAIN AREA -->
<div>
      {{-- popUp message --}}
    @if(session('success'))
<div 
    x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 5000)"
    x-show="show"
    x-transition
    @click="show = false"
    class="fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg cursor-pointer"
>{{ session('success') }}</div>
@endif
</div>
<div class="flex-1 flex flex-col min-h-screen w-full">

<!-- TOPBAR -->

<header class="h-16 bg-[#111116] border-b border-gray-800 flex items-center justify-between px-4 md:px-6">

<div class="flex items-center gap-3">

@include('profile.admin.slideBar')

<h1 class="text-lg md:text-xl font-serif text-amber-400">
Admin Dashboard
</h1>

</div>

<div class="flex items-center gap-4">

<a href="{{ route('home') }}" class="text-sm text-yellow-400 hover:text-amber-600 transition">
View Store
</a>

<form action="{{ route('logout') }}" method="post">
@csrf

<button class="text-sm text-red-400 hover:text-red-500 transition">
Logout
</button>

</form>

</div>

</header>

<!-- PAGE CONTENT -->

<main class="flex-1 w-full max-w-screen-xl mx-auto p-4 md:p-6">

@yield('content')

</main>

</div>

</body>
</html>