<!-- ================= LUXURY FLOATING 3D BOOK ================= -->

<div class="flex justify-center items-center min-h-[600px]
            bg-gradient-to-br from-[#0b0b0f] via-[#111114] to-[#1a1a1f]
            perspective-[2000px] overflow-hidden">

    <div id="bookWrapper"
         class="relative w-64 h-80 flex items-center justify-center">

        <div id="book"
             class="relative w-full h-full cursor-pointer floating"
             style="transform-style: preserve-3d; transition: transform 0.8s ease;">

            <!-- ===== GOLDEN GLOW BEHIND BOOK ===== -->
            <div class="absolute -inset-10 bg-amber-500/20 blur-3xl
                        rounded-full animate-pulse"></div>

            <!-- ===== BACK COVER ===== -->
            <div class="absolute w-full h-full
                        bg-gradient-to-br from-[#111] via-[#000] to-[#1a1a1a]
                        rounded-r-xl shadow-2xl">
            </div>

            <!-- ===== PAGES ===== -->
            <div class="absolute w-[94%] h-[95%] left-[3%] top-[2.5%]
                        bg-gradient-to-br from-amber-50 to-amber-100
                        rounded-r-lg shadow-inner border border-amber-200
                        flex items-center justify-center">

                <div id="pageContent"
                     class="text-center opacity-0 transition-opacity duration-700">
                         
                    <h4 class="text-xl font-bold text-amber-900 mb-3">
                      “It does not matter how slowly you go as long as you do not stop!”
                    </h4>

                    <p class="text-xs text-amber-800 px-6 mb-5">
                        -Confucius
                    </p>

                    

                </div>

            </div>

            <!-- ===== FRONT COVER ===== -->
            <div id="cover"
                 class="absolute w-full h-full
                        bg-gradient-to-br from-[#000000] via-[#0f0f0f] to-[#1c1c1c]
                        rounded-r-xl
                        shadow-[0_30px_80px_rgba(0,0,0,0.9)]
                        origin-left transition-transform duration-800"
                 style="transform-style: preserve-3d;">

                <!-- GOLD BORDER -->
                <div class="absolute inset-4 border border-amber-400/70 rounded-lg"></div>

                <!-- GOLD SHINE EFFECT -->
                <div class="shine absolute inset-0 rounded-r-xl"></div>

                <!-- TITLE -->
               <div class="flex items-center justify-center h-full">
  <h2
    class="text-amber-300 text-2xl font-extrabold tracking-[0.3em]
           drop-shadow-[0_0_10px_rgba(251,191,36,0.8)] text-center">
    BOokshOP
  </h2>
</div>


            </div>

        </div>

    </div>

</div>

 

