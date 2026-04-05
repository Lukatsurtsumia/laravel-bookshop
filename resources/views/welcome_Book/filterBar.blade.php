<!-- ================= PREMIUM FILTER BAR ================= -->
<div class="relative mb-9">
    <!-- Floating Glass Container -->
    <div
        class="backdrop-blur-2xl bg-white/5 border border-white/10
               rounded-3xl px-6 lg:px-8 py-5 lg:py-6
               shadow-[0_0_60px_rgba(251,191,36,0.08)]">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-6 lg:gap-8">
            <!-- 🔎 SEARCH -->
            <div class="relative w-full lg:w-1/3">
                <input
                    type="text"
                    name="search"
                    wire:model.live.debounce.500ms="search"
                    placeholder="Search stories, authors..."
                    class="w-full pl-11 pr-20 py-3 rounded-xl
                           bg-black/40 border border-white/10
                           placeholder-gray-400 text-sm text-gray-100
                           focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500
                           transition duration-300">
 
                <!-- Icon -->
                <svg
                    class="absolute left-3.5 top-1/2 -translate-y-1/2 w-5 h-5 text-amber-400"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 21l-4.35-4.35m1.85-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>

                <!-- Search button inside input -->
    
            </div>

            <!-- 📂 FILTER TABS -->
            @php
                $filters = [
                    ''          => 'All',
                    'popular'   => 'Popular',
                    'expensive' => 'Expensive',
                    'mostRated' => 'Most Rated',
                ];
                $active = $filter; //$filter from livewire
                
            @endphp

            <div class="flex flex-wrap justify-center lg:justify-start gap-4 text-sm tracking-wide font-medium">
                @foreach ($filters as $key => $label)
                    @php
                        $isActive = $active == $key || ($active === null && $key === '');
                    @endphp

                    <button
                        type="button"
                        wire:click="setFilter('{{ $key }}')"
                        class="relative group px-1 transition
                               {{ $isActive ? 'text-amber-400' : 'text-gray-400 hover:text-white' }}">
                        {{ $label }}
                        <span
                            class="absolute left-0 -bottom-1 h-0.5
                                   bg-amber-500 rounded-full
                                   transition-all duration-300
                                   {{ $isActive ? 'w-full' : 'w-0 group-hover:w-full' }}"
                        ></span>
                    </button>
                @endforeach
            </div>

            <!-- 🎚 CATEGORY DROPDOWN -->
            <div class="relative w-full lg:w-1/5">
                <!-- Icon -->
                <div
                    class="pointer-events-none absolute inset-y-0 left-0
                           flex items-center pl-3.5 text-amber-400" >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                         stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3 7h18M3 12h18M3 17h18"/>
                    </svg>
                </div>

                <!-- Select Categories -->
                <select
                    wire:model.live="category"
                    class="appearance-none w-full
                           pl-10 pr-8 py-3
                           rounded-xl
                           bg-black/40
                           border border-white/10
                           text-sm font-medium text-gray-200
                           truncate
                           focus:outline-none
                           focus:ring-2 focus:ring-amber-500
                           focus:border-amber-500
                           transition" >
                    <option class="bg-stone-700 text-white" value="">
                        All Categories
                    </option>

                    @foreach ($categories as $category)
                        <option
                            class="bg-stone-700 text-white"
                            value="{{ $category->id }}">
                            
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Custom Arrow -->
                <div
                    class="pointer-events-none absolute inset-y-0 right-0
                           flex items-center pr-3.5 text-amber-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                         stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19 9l-7 7-7-7"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

