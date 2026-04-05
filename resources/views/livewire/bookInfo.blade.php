<div> 
<!-- ================= PAGE BACKGROUND ================= -->
<div class="min-h-screen bg-gradient-to-br from-[#0f0f14] via-[#15151b] to-[#0b0b0f] text-gray-200">

<!-- ================= HEADER ================= -->
<header class="border-b border-gray-800 bg-[#111116]">
    <div class="max-w-6xl mx-auto flex justify-between items-center px-4">

        <!-- Logo + Title -->
           <a href="{{ route('home') }}"class="flex items-center gap-3">
            <img src="{{ asset('images/cover.jpg') }}"
                 class="w-16 sm:w-20 md:w-24 object-contain"
                 alt="Logo">

            <h1 class="text-xl sm:text-2xl tracking-widest text-amber-400 font-serif">
                VINTAGE LIBRARY
            </h1>
        </a>
<!-- BACK LINK -->
        <!-- Book Login/Register -->
        <div class="w-44 h-32 relative">
            <img src="{{ asset('images/do.png') }}"
                 class="w-full h-full object-contain drop-shadow-2xl">

            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-[75%] h-[65%] flex">
                    @auth
                     <a href="{{auth()->user()->isAdmin() 
                              ? route('admin.info')
                              : route('user.index') }}"
                       class="w-1/2 flex items-center justify-center
                       text-sm font-semibold text-blue-900 hover:scale-110 transition">
                        Profile
                    </a>
                    <form action="{{ route('logout') }}" method="post"> 
                        @csrf
                    <button type="submit"
                       class="w-full flex items-center justify-center mt-7 ml-0.5
                       text-sm font-semibold text-red-700 hover:scale-110 transition">
                       Log OuT
                    </button>
                    </form>
                    @endauth
                    @guest
                    <a href="{{ route('login') }}"
                       class="w-1/2 flex items-center justify-center
                       text-sm font-semibold text-amber-900 hover:scale-110 transition">
                       Login
                    </a>

                    <a href="{{ route('register') }}"
                       class="w-1/2 flex items-center justify-center
                       text-sm font-semibold text-amber-900 hover:scale-110 transition">
                       Register
                    </a>
                    @endguest
                </div>
            </div>
       
        </div>
     
    </div>
</header>

<div class="max-w-5xl mx-auto px-6 mt-6">
    <a href="{{ route('home') }}"
       class="inline-flex items-center gap-2 text-gray-400 hover:text-amber-400 transition text-sm">

        ← Back to Library
    </a>
</div>
<!-- ================= PRODUCT SECTION ================= -->
<section class="max-w-5xl mx-auto px-6 py-16">

<div class="bg-[#17171d] border border-gray-800 rounded-2xl p-10 shadow-2xl">

<div class="flex flex-col md:flex-row gap-12">

<!-- Book Image -->
<div class="w-full md:w-56 flex-shrink-0">
  <img 
        src="{{$book->image ? asset('storage/' . $book->image): asset('storage/books/default.jpg') }}"
        class="w-full h-full object-cover rounded-xl shadow-lg border border-gray-700"
        onerror="this.onerror=null; this.src='{{ asset('storage/books/default.jpg') }}';">
</div>
 
<!-- Book Info -->
<div class="flex-1">
 
<h2 class="text-3xl text-white font-serif">
{{ $book->title }}
</h2>

<p class="text-amber-400 text-xl mt-2">
{{ $book->price }} $
</p>

<div class="flex items-center gap-2 mt-3 text-amber-400">
<x-rating-star :rating="$book->reviews_avg_rating" class="text-amber-400" />
<span class="text-gray-500 text-sm">({{ number_format($book->reviews_avg_rating, 1) }})</span>
</div>

<p class="mt-6 text-gray-400 leading-relaxed">
{{ $book->description }}
</p>
 <div class="flex w-1/2 gap-5">
@auth
@if (auth()->user()->isAdmin())

        <a href="{{ route('admin.books.edit', $book->id) }}"
        class="mt-8 bg-blue-500 hover:bg-blue-400 text-white
        px-6 py-3 rounded-lg font-medium transition">
       Edit
        </a>
        <form action="{{ route('admin.books.destroy', $book) }}" method="post">
            @csrf
            @method('DELETE')
        <button type="submit"
              onclick="return confirm('Are you sure you want to delete this Book?')" 
         class="mt-8 bg-red-500 hover:bg-red-400 text-white
        px-6 py-3 rounded-lg font-medium transition">
        Delete
        </button>
        </form>
        @else 
          <button  wire:click="addToCart({{ $book->id }})"
        class="mt-8 bg-amber-500 hover:bg-amber-400 text-black
        px-6 py-3 rounded-lg font-medium transition">
        Add to Cart
        </button>
        @endif
@endauth
 @guest
     
 
        <button  wire:click="addToCart({{ $book->id }})"
        class="mt-8 bg-amber-500 hover:bg-amber-400 text-black
        px-6 py-3 rounded-lg font-medium transition">
        Add to Cart
        </button>
 
@endguest
          </div>
   </div>
</div>

      
<!--====Cart====-->
    <livewire:cart />




<!-- ================= SIMILAR BOOKS ================= -->
<h3 class="text-2xl text-black mb-10 font-serif rounded-lg mt-8 bg-amber-500 w-max px-4 py-2 text-center text-black">
Similar Books
</h3>

<div class="flex md:grid md:grid-cols-4 gap-6 overflow-x-auto md:overflow-visible pb-4">

@foreach($similarBooks as $similar)

<div
class="min-w-[180px] md:min-w-0
bg-[#17171d] border border-gray-800 rounded-xl p-4
hover:scale-105 transition
flex flex-col justify-between"
>

<a href="{{ route('books.show', $similar->id) }}">

<img
src="{{ asset('storage/' . $similar->image) }}"
onerror="this.onerror=null; this.src='{{ asset('storage/books/default.jpg') }}';"
class="w-full h-48 object-cover rounded-lg mb-4"
>

<h4 class="text-sm text-gray-300 mb-1">
{{ $similar->title }}
</h4>

<p class="text-amber-400 text-sm mb-1">
${{ number_format($similar->price, 2) }}
</p>

<div class="flex items-center gap-1 text-xs text-gray-400">
<x-rating-star :rating="$similar->reviews_avg_rating" class="text-amber-400 text-lg" />
<span>{{ number_format($similar->reviews_avg_rating, 1) }}</span>
</div>

</a>

<div class="mt-auto pt-4 flex justify-center">
<button wire:click="addToCart({{ $similar->id }})"
class="inline-flex items-center justify-center
px-8 h-12
rounded-xl
bg-amber-500 hover:bg-amber-400
text-black
shadow-lg hover:shadow-amber-500/40
transition-transform transform hover:scale-105">

<svg xmlns="http://www.w3.org/2000/svg"
class="w-6 h-6"
fill="none"
viewBox="0 0 24 24"
stroke="currentColor">

<path stroke-linecap="round"
stroke-linejoin="round"
stroke-width="2"
d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 4h12m-6 0a1 1 0 100 2 1 1 0 000-2zm6 0a1 1 0 100 2 1 1 0 000-2"/>

</svg>

</button>
</div>

</div>

@endforeach
</div>


<!-- ================= REVIEWS ================= -->
<div class="mt-20">

<h3 class="text-2xl text-black mb-10 font-serif rounded-lg mt-8 bg-amber-500 w-max px-4 py-2 text-center text-black">

Reader Reviews
</h3>

<!-- Add Comment -->
<div class="bg-[#17171d] border border-gray-800 rounded-xl p-6 mb-10">
   @guest
    <p class="text-xl mb-2">Sign in to post a comment.</p>
@endguest

     
    {{-- comment --}}
    <form wire:submit.prevent="storeReview"> 
<textarea
wire:model="comment"
class="w-full bg-[#0f0f14] border border-gray-700 rounded-lg p-4
text-sm focus:outline-none focus:border-amber-500"
rows="4"
name="comment"
placeholder="Write your thoughts..."></textarea>
@error('comment') 
<div class="text-xs text-red-600 mb-2">{{ $message }}</div>
@enderror 

<div class="flex items-center gap-2 mt-3">


{{-- rating --}}
<span class="text-sm text-gray-400 mr-2">Rating:</span>

@include('profile.admin.bookForm.rating', ['livewire' => true])
@error('rating') 
<p class="text-xs text-red-600">{{ $message }}</p>
@enderror
</div>

<button type="submit" 
class="mt-4 bg-amber-500 hover:bg-amber-400 text-black
px-5 py-2 rounded-md text-sm transition">
Post Review
</button>
</form>
</div>
 
<!-- ----------------------- -->
<!-- All  Comment ------>
<div class="space-y-6">
@foreach($book->reviews as $review)

<div class="bg-[#17171d] border border-gray-800 rounded-xl p-6 mb-6 shadow-md">

    <!-- Top Row -->
    <div class="flex items-center justify-between mb-3">

        <!-- Reviewer -->
        <span class="font-semibold text-gray-200">
           {{$review->user->name ?? 'Anonymus'}}
        </span>
        

        <!-- Time -->
        <span class="text-xs text-gray-500">
            {{ $review->created_at->diffForHumans() }}
        </span>

    </div>

    <!-- Rating -->
    <div class="flex items-center gap-2 mb-3">
        <x-rating-star :rating="$review->rating" class="text-amber-400 text-xl" />
        <span class="text-gray-400 text-sm">
            {{ number_format($review->rating, 1) }}
        </span>
    </div>

    <!-- Comment -->
    <p class="text-gray-400 text-sm leading-relaxed">
        {{ $review->comment }}
    </p>

     @auth()
        @if (auth()->user()->isAdmin())
        <form action="{{ route('admin.reviews.destroy', $review) }}" method="post">
            @csrf
            @method('DELETE')
           <button 
                 onclick="return confirm('Are you sure you want to delete this review?')" 
           class="text-red-500 mt-3">
            DEleTe ReWiev
           </button>
        </form>   
        @endif
        @if(auth()->user() && auth()->user()->id === $review->user_id)
  
        <div class="mt-2 text-blue-400 hover:text-blue-600">
            <a href="{{ route('books.reviews.edit', [$review->book->id, $review->id]) }}">
                Edit Comment
            </a>
            </div>        
        @endif
        @endauth
</div>
@endforeach
</div>
</div>
</section>
</div>
</div>
 
