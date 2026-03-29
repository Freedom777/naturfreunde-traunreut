<x-layouts.app>

    {{-- Hero --}}
    <section class="relative pt-[72px] bg-green-deep overflow-hidden">
        <div class="absolute inset-0 opacity-20"
             style="background: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1200&auto=format&fit=crop') center/cover no-repeat">
        </div>
        <div class="relative z-10 max-w-6xl mx-auto px-6 md:px-10 py-20 text-center">
            <div class="section-label text-gold-light">📖 Geschichte</div>
            <h1 class="font-playfair font-black text-white leading-tight mb-5"
                style="font-size: clamp(32px,5vw,60px)">
                Vereins<em class="text-gold-light not-italic">chronik</em>
            </h1>
            <p class="text-white/70 text-lg max-w-2xl mx-auto">
                Die Geschichte der NaturFreunde Traunreut — von der Gründung 1951 bis heute.
            </p>
        </div>
    </section>

    {{-- Timeline --}}
    <section class="py-16 md:py-24 px-6 md:px-10 bg-cream">
        <div class="max-w-5xl mx-auto flex flex-col gap-16">

            {{-- ── 1951: Gründung ── --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow duration-250">
                    <div class="inline-block bg-gold/10 text-gold font-playfair font-black text-4xl
                            px-4 py-2 rounded-xl mb-4">1951</div>
                    <h2 class="font-playfair text-2xl text-green-deep font-bold mb-3">
                        Gründung der NaturFreunde Traunreut
                    </h2>
                    <p class="text-gray-500 mb-4">
                        Am <strong class="text-green-deep">13. Januar 1951</strong> wurde unsere Ortsgruppe
                        „Touristenverein die Naturfreunde" Traunreut von sieben ehemaligen Mitgliedern
                        der Ortsgruppe Traunstein ins Leben gerufen.
                    </p>
                    <p class="text-gray-500 mb-4">
                        Ziel war es, den arbeitenden Menschen die Schönheit der Natur näher zu bringen.
                        Die ersten Aktivitäten beschränkten sich auf die nähere Umgebung, da die
                        Ausgangspunkte zu den Bergtouren nur mit dem Fahrrad erreichbar waren.
                    </p>
                    <div class="bg-cream rounded-xl p-4 mt-4">
                        <p class="text-xs font-bold uppercase tracking-widest text-green-accent mb-3">
                            🌱 Gründungsmitglieder
                        </p>
                        <div class="flex flex-wrap gap-2">
                            @foreach(['Heribert Farmer', 'Hans Heinicke', 'Ermeline Heinicke', 'Wulf Letzel', 'Elfriede Letzel', 'Ladislaus Baumann', 'Heinz Antler (Ehrenvorsitzender)'] as $name)
                                <span class="text-xs bg-white border border-cream-dark text-green-deep
                                         font-semibold px-3 py-1.5 rounded-full">{{ $name }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div>
                    <div class="rounded-2xl overflow-hidden shadow-xl" style="aspect-ratio:4/3">
                        <img src="{{ asset('storage/chronic/01-haus-bw.webp') }}"
                             alt="Anfänge 1951" class="w-full h-full object-cover">
                    </div>
                    <p class="text-xs text-gray-400 mt-2 text-center italic">Die Anfänge — 1951</p>
                </div>
            </div>

            {{-- ── 1952: Hütte ── --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                <div>
                    <div class="rounded-2xl overflow-hidden shadow-xl" style="aspect-ratio:4/3">
                        <img src="{{ asset('storage/chronic/02-haus-color.webp') }}"
                             alt="Bischofsfellnalm" class="w-full h-full object-cover">
                    </div>
                    <p class="text-xs text-gray-400 mt-2 text-center italic">Bischofsfellnalm am Hochgern</p>
                </div>
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow duration-250">
                    <div class="inline-block bg-gold/10 text-gold font-playfair font-black text-4xl
                            px-4 py-2 rounded-xl mb-4">1952</div>
                    <h2 class="font-playfair text-2xl text-green-deep font-bold mb-3">
                        Arbeitseinsatz Bischofsfellnalm am Hochgern
                    </h2>
                    <p class="text-gray-500 mb-4">
                        Bereits 1952 gelang es, auf der <strong class="text-green-deep">Grundbachalm am Hochgern</strong>
                        eine Hütte ausfindig zu machen. 1954 wurde dann die Bischofsfellnalm gepachtet —
                        der ehemalige Pöschl-Kaser, erbaut im Jahre 1826.
                    </p>
                    <p class="text-gray-500">
                        Ab dem Zeitpunkt, als sich die ersten Mitglieder ein Auto leisten konnten,
                        wurde auch der Aktionsradius größer. Dolomiten, Monte Rosa, Bernina-Gruppe,
                        Ötztaler- und Zillertaler Alpen gehörten seitdem zum Jahresprogramm.
                    </p>
                    <div class="mt-4 space-y-2">
                        @foreach(['Mont Blanc Besteigung', 'Dufourspitze', 'Skitouren im Wallis', 'Haute Route'] as $highlight)
                            <div class="flex items-center gap-2 text-sm text-gray-600">
                                <span class="text-gold">⭐</span> {{ $highlight }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ── 1985: Aktivitäten ── --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow duration-250">
                    <div class="inline-block bg-gold/10 text-gold font-playfair font-black text-4xl
                            px-4 py-2 rounded-xl mb-4">1985</div>
                    <h2 class="font-playfair text-2xl text-green-deep font-bold mb-3">
                        Ausflüge und Aktivitäten
                    </h2>
                    <p class="text-gray-500 mb-4">
                        Neben der Organisation von Wanderungen und Bergtouren wird das Vereinsleben
                        nicht vergessen. Sommer- und Jahresabschlussfest, Radtouren, Wochenendausflüge
                        und Aktivitäten auf der Hütte prägen den Vereinsalltag.
                    </p>
                    <p class="text-gray-500">
                        Seit <strong class="text-green-deep">1985</strong> ist die Bergmesse auf dem
                        Hochgern, die alle zwei Jahre stattfindet, fester Bestandteil im Jahresprogramm
                        der Traunreuter Ortsgruppe.
                    </p>
                </div>
                <div class="flex flex-col gap-3">
                    <div class="rounded-2xl overflow-hidden shadow-xl" style="aspect-ratio:16/9">
                        <img src="{{ asset('storage/chronic/03-haus-build.webp') }}"
                             alt="Arbeitseinsatz" class="w-full h-full object-cover">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="rounded-xl overflow-hidden shadow-md" style="aspect-ratio:4/3">
                            <img src="{{ asset('storage/chronic/04-haus-build.webp') }}"
                                 alt="Arbeitseinsatz" class="w-full h-full object-cover">
                        </div>
                        <div class="rounded-xl overflow-hidden shadow-md" style="aspect-ratio:4/3">
                            <img src="{{ asset('storage/chronic/05-haus-build.webp') }}"
                                 alt="Arbeitseinsatz" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 text-center italic">Arbeitseinsätze an der Hütte</p>
                </div>
            </div>

            {{-- ── 2001: Jubiläum ── --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                <div class="grid grid-cols-2 gap-3">
                    <div class="rounded-xl overflow-hidden shadow-md" style="aspect-ratio:4/3">
                        <img src="{{ asset('storage/chronic/06-team-all.webp') }}"
                             alt="Jubiläum 2001" class="w-full h-full object-cover">
                    </div>
                    <div class="rounded-xl overflow-hidden shadow-md" style="aspect-ratio:4/3">
                        <img src="{{ asset('storage/chronic/07-team-leave.webp') }}"
                             alt="Jubiläum 2001" class="w-full h-full object-cover">
                    </div>
                    <p class="col-span-2 text-xs text-gray-400 text-center italic">Jubiläum 2001</p>
                </div>
                <div class="bg-green-mid rounded-2xl p-8 shadow-sm">
                    <div class="inline-block bg-gold/20 text-gold-light font-playfair font-black text-4xl
                            px-4 py-2 rounded-xl mb-4">2001</div>
                    <h2 class="font-playfair text-2xl text-white font-bold mb-3">Doppeljubiläum 🎉</h2>
                    <p class="text-white/80 mb-5">Im Jahr 2001 konnten gleich zwei Jubiläen gefeiert werden:</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white/10 rounded-xl p-4 text-center">
                            <div class="font-playfair text-3xl font-black text-gold-light">50</div>
                            <div class="text-white/70 text-sm mt-1">Jahre NaturFreunde Traunreut</div>
                        </div>
                        <div class="bg-white/10 rounded-xl p-4 text-center">
                            <div class="font-playfair text-3xl font-black text-gold-light">175</div>
                            <div class="text-white/70 text-sm mt-1">Jahre Vereinshütte</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- CTA --}}
    <section class="py-12 px-6 md:px-10 bg-white">
        <div class="max-w-2xl mx-auto text-center">
            <p class="text-gray-500 mb-6">
                Werden Sie Teil unserer Geschichte — wir freuen uns über neue Mitglieder!
            </p>
            <a href="{{ route('home') }}#mitglied"
               class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl bg-green-mid text-white
                font-semibold hover:bg-green-accent hover:-translate-y-0.5
                transition-all duration-200 no-underline">
                🌿 Mitglied werden
            </a>
        </div>
    </section>

</x-layouts.app>
