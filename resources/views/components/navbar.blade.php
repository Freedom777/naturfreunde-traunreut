<nav x-data="{ open: false, vereinOpen: false }"
     id="navbar"
     class="fixed top-0 left-0 right-0 z-50 bg-green-deep/96 backdrop-blur-md shadow-lg transition-all duration-300">

    <div class="flex items-center justify-between px-6 md:px-10 h-[72px]">

        {{-- Brand --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 no-underline">
            <div class="w-11 h-11 rounded-full bg-gold flex items-center justify-center
                        font-playfair font-black text-xl text-white flex-shrink-0">NF</div>
            <div class="text-white font-playfair font-semibold text-[17px] leading-tight">
                NaturFreunde Traunreut
                <span class="block text-[11px] font-nunito font-light opacity-70 tracking-widest uppercase">
                    e.V. — Ortsgruppe
                </span>
            </div>
        </a>

        {{-- Desktop links --}}
        <div class="hidden md:flex items-center gap-1">
            <a href="{{ route('home') }}"
               class="text-white/80 no-underline text-sm font-medium px-4 py-2 rounded-lg
                      hover:text-white hover:bg-white/10 transition-all duration-200
                      {{ request()->routeIs('home') ? 'text-gold-light' : '' }}">Home</a>

            <a href="{{ route('home') }}#veranstaltungen"
               class="text-white/80 no-underline text-sm font-medium px-4 py-2 rounded-lg
                      hover:text-white hover:bg-white/10 transition-all duration-200">Veranstaltungen</a>

            <a href="{{ route('gallery') }}"
               class="text-white/80 no-underline text-sm font-medium px-4 py-2 rounded-lg
                      hover:text-white hover:bg-white/10 transition-all duration-200
                      {{ request()->routeIs('gallery') ? 'text-gold-light' : '' }}">Galerie</a>

            {{-- Dropdown Verein --}}
            <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                <button @click="open = !open"
                        class="flex items-center gap-1.5 text-white/80 text-sm font-medium
                               px-4 py-2 rounded-lg hover:text-white hover:bg-white/10
                               transition-all duration-200
                               {{ request()->routeIs('team','vereinsleben','vereinshuette','vereinschronik','vereinsjubilaeum') ? 'text-gold-light' : '' }}">
                    Verein
                    <svg class="w-3.5 h-3.5 transition-transform duration-200"
                         :class="open ? 'rotate-180' : ''"
                         fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M6 9l6 6 6-6"/>
                    </svg>
                </button>

                {{-- Dropdown menu --}}
                <div x-show="open"
                     x-transition:enter="transition duration-150"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition duration-100"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="absolute top-full left-0 mt-2 w-52 bg-green-deep border border-white/10
                            rounded-xl shadow-xl overflow-hidden"
                     style="display:none">
                    @foreach([
                        ['Über uns',        route('home').'#verein',    'home'],
                        ['Wer macht was?',  route('team'),               'team'],
                        ['Vereinsleben',    route('vereinsleben'),       'vereinsleben'],
                        ['Vereinshütte',    route('vereinshuette'),      'vereinshuette'],
                        ['Vereinschronik',  route('vereinschronik'),     'vereinschronik'],
                        ['Vereinsjubiläum', route('vereinsjubilaeum'),   'vereinsjubilaeum'],
                    ] as [$label, $href, $route])
                        <a href="{{ $href }}" @click="open = false"
                           class="block px-4 py-3 text-sm text-white/75 hover:text-white
                                  hover:bg-white/10 transition-all duration-150 no-underline
                                  border-b border-white/5 last:border-0
                                  {{ request()->routeIs($route) ? 'text-gold-light bg-white/5' : '' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('home') }}#kontakt"
               class="text-white/80 no-underline text-sm font-medium px-4 py-2 rounded-lg
                      hover:text-white hover:bg-white/10 transition-all duration-200">Kontakt</a>

            <a href="{{ route('home') }}#mitglied"
               class="ml-2 px-5 py-2 rounded-lg bg-gold text-white font-semibold text-sm
                      hover:bg-gold-light transition-colors duration-200 no-underline">
                Mitglied werden
            </a>
        </div>

        {{-- Hamburger --}}
        <button @click="open = !open"
                class="md:hidden flex flex-col justify-center items-center w-10 h-10
                       rounded-lg hover:bg-white/10 transition-colors duration-200 gap-1.5">
            <span class="block w-6 h-0.5 bg-white transition-all duration-300"
                  :class="open ? 'rotate-45 translate-y-2' : ''"></span>
            <span class="block w-6 h-0.5 bg-white transition-all duration-300"
                  :class="open ? 'opacity-0' : ''"></span>
            <span class="block w-6 h-0.5 bg-white transition-all duration-300"
                  :class="open ? '-rotate-45 -translate-y-2' : ''"></span>
        </button>

    </div>

    {{-- Mobile menu --}}
    <div x-show="open"
         x-transition:enter="transition duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden bg-green-deep border-t border-white/10 px-6 py-4 flex flex-col gap-1"
         style="display:none">

        <a href="{{ route('home') }}" @click="open = false"
           class="text-white/80 no-underline text-sm font-medium px-4 py-3 rounded-lg
                  hover:text-white hover:bg-white/10 transition-all duration-200
                  {{ request()->routeIs('home') ? 'text-gold-light' : '' }}">Home</a>

        <a href="{{ route('home') }}#veranstaltungen" @click="open = false"
           class="text-white/80 no-underline text-sm font-medium px-4 py-3 rounded-lg
                  hover:text-white hover:bg-white/10 transition-all duration-200">Veranstaltungen</a>

        <a href="{{ route('gallery') }}" @click="open = false"
           class="text-white/80 no-underline text-sm font-medium px-4 py-3 rounded-lg
                  hover:text-white hover:bg-white/10 transition-all duration-200
                  {{ request()->routeIs('gallery') ? 'text-gold-light' : '' }}">Galerie</a>

        {{-- Verein группа на мобиле --}}
        <div>
            <button @click="vereinOpen = !vereinOpen"
                    class="w-full flex items-center justify-between text-white/80 text-sm font-medium
                           px-4 py-3 rounded-lg hover:text-white hover:bg-white/10 transition-all duration-200">
                Verein
                <svg class="w-3.5 h-3.5 transition-transform duration-200"
                     :class="vereinOpen ? 'rotate-180' : ''"
                     fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M6 9l6 6 6-6"/>
                </svg>
            </button>

            <div x-show="vereinOpen" style="display:none"
                 class="ml-4 mt-1 flex flex-col gap-0.5 border-l-2 border-white/10 pl-3">
                @foreach([
                    ['Über uns',        route('home').'#verein'],
                    ['Wer macht was?',  route('team')],
                    ['Vereinsleben',    route('vereinsleben')],
                    ['Vereinshütte',    route('vereinshuette')],
                    ['Vereinschronik',  route('vereinschronik')],
                    ['Vereinsjubiläum', route('vereinsjubilaeum')],
                ] as [$label, $href])
                    <a href="{{ $href }}" @click="open = false; vereinOpen = false"
                       class="text-white/70 no-underline text-sm px-3 py-2.5 rounded-lg
                              hover:text-white hover:bg-white/10 transition-all duration-200">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>

        <a href="{{ route('home') }}#kontakt" @click="open = false"
           class="text-white/80 no-underline text-sm font-medium px-4 py-3 rounded-lg
                  hover:text-white hover:bg-white/10 transition-all duration-200">Kontakt</a>

        <a href="{{ route('home') }}#mitglied" @click="open = false"
           class="mt-2 px-5 py-3 rounded-lg bg-gold text-white font-semibold text-sm
                  hover:bg-gold-light transition-colors duration-200 no-underline text-center">
            Mitglied werden
        </a>

    </div>

</nav>
