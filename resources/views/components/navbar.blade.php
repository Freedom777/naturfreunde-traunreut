<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between
     px-10 h-[72px] bg-green-deep/96 backdrop-blur-md shadow-lg transition-all duration-300">

    <a href="{{ route('home') }}" class="flex items-center gap-4 no-underline">
        <div class="w-11 h-11 rounded-full bg-gold flex items-center justify-center
                    font-playfair font-black text-xl text-white">NF</div>
        <div class="text-white font-playfair font-semibold text-[17px] leading-tight">
            NaturFreunde Traunreut
            <span class="block text-[11px] font-nunito font-light opacity-70 tracking-widest uppercase">
                e.V. — Ortsgruppe
            </span>
        </div>
    </a>

    <div class="flex items-center gap-1">
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

        <a href="{{ route('home') }}#verein"
           class="text-white/80 no-underline text-sm font-medium px-4 py-2 rounded-lg
                  hover:text-white hover:bg-white/10 transition-all duration-200">Über uns</a>

        <a href="{{ route('home') }}#kontakt"
           class="text-white/80 no-underline text-sm font-medium px-4 py-2 rounded-lg
                  hover:text-white hover:bg-white/10 transition-all duration-200">Kontakt</a>

        <a href="{{ route('home') }}#mitglied"
           class="ml-2 px-5 py-2 rounded-lg bg-gold text-white font-semibold text-sm
                  hover:bg-gold-light transition-colors duration-200 no-underline">
            Mitglied werden
        </a>
    </div>
</nav>
