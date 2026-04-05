<section class="relative h-[70vh] md:h-[65vh] w-full overflow-hidden">

    <!-- Background Image -->
    <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66"
         class="absolute inset-0 w-full h-full object-cover"
         alt="Library">

    <!-- Dark Overlay -->
    <div class="absolute inset-0 bg-black/60"></div>

<!-- 🔝 CENTERED LOGO BLOCK -->
<div class="absolute top-8 left-1/2 -translate-x-1/2 z-20 
            flex flex-col items-center">

    <!-- Logo Image -->
    <img src="{{ asset('images/cover.jpg') }}"
         class="w-16 sm:w-20 md:w-24 object-contain mb-2"
         alt="Logo">

    <!-- Logo Text Under Logo -->
    <h2 class="text-white text-lg sm:text-xl md:text-2xl 
               font-extrabold tracking-widest">
        Book Shop
    </h2>

</div>


    <!-- 🎯 CENTER CONTENT -->
    <div class="relative z-10 h-full flex flex-col 
            items-center justify-center text-center px-6 
            translate-y-6 md:translate-y-10">
        <!-- Quote -->
        <h1 class="text-white 
                   text-3xl sm:text-4xl md:text-5xl lg:text-6xl
                   font-extrabold tracking-wide"
            style="font-family: 'Montserrat', sans-serif;">
            Don’t judge a book by its cover
        </h1>

        <!-- Book Image -->
  
        
        <div class="mt-8 w-44 h-32 sm:w-48 sm:h-36 md:w-56 md:h-40">

            <div class="relative w-full h-full">
                <img src="{{ asset('images/do.png') }}"
                     class="w-full h-full object-contain drop-shadow-2xl"
                     alt="Open Book">

                <!-- Login / Register inside book -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-[75%] h-[65%] flex">
                        @auth
                         
                        <a href="{{ auth()->user()->isAdmin() 
                                    ? route('admin.info')
                                    : route('user.index') }}"
                        class="w-1/2 h-full flex items-center justify-center
                         text-sm sm:text-base font-semibold text-blue-900 hover:scale-110 transition duration-300">
                        Profile
                    </a>
                        </form>
                       
                        
                        <form action="{{ route('logout') }}" method="POST">
                         @csrf
                        <button type="submit"
                        class="w-full h-full flex items-center justify-center ml-1
                        text-sm sm:text-base font-semibold text-red-700 hover:scale-110 transition duration-300">
                         Log OuT
                        </button>
                        </form>
                        @endauth
                    
                        @guest
                       <a href="{{ route('login') }}"
                        class="w-1/2 h-full flex items-center justify-center
                        text-sm sm:text-base font-semibold text-amber-900 hover:scale-110 transition duration-300">
                        Login
                        </a>
                        <a href="/register"
                        class="w-1/2 h-full flex items-center justify-center
                        text-sm sm:text-base font-semibold text-amber-900 hover:scale-110 transition duration-300">
                         Register
                        </a>
                          @endguest
                    </div>
                </div>
            </div>
        </div>
         
    </div>

</section>