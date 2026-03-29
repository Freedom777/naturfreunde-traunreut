<x-layouts.app>

    {{-- Hero --}}
    <section class="relative pt-[72px] bg-green-deep overflow-hidden">
        <div class="absolute inset-0 opacity-20"
             style="background: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=1200&auto=format&fit=crop') center/cover no-repeat">
        </div>
        <div class="relative z-10 max-w-6xl mx-auto px-6 md:px-10 py-20 text-center">
            <div class="section-label text-gold-light">🛖 Vereinshütte</div>
            <h1 class="font-playfair font-black text-white leading-tight mb-5"
                style="font-size: clamp(32px,5vw,60px)">
                Unsere <em class="text-gold-light not-italic">Bischofsfellnalm</em>
            </h1>
            <p class="text-white/70 text-lg max-w-2xl mx-auto">
                Am Südosthang des Hochgerns — seit 1954 der Mittelpunkt unseres Vereinslebens
            </p>
        </div>
    </section>

    {{-- Erste Hütte 1952 --}}
    <section class="py-16 md:py-24 px-6 md:px-10 bg-white">
        <div class="max-w-6xl mx-auto">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-20 items-center">
                <div>
                    <div class="section-label">📜 Geschichte</div>
                    <h2 class="section-title">Unsere erste Hütte <em>1952</em></h2>
                    <p class="text-gray-500 mb-5">
                        Im Herbst 1952 gelang es der Ortsgruppe Traunreut, auf der <strong class="text-green-deep">Grundbachalm</strong>
                        eine Almhütte ausfindig zu machen. Diese wurde damals nur notdürftig hergerichtet,
                        da sie im Sommer wegen dem Almbetrieb nicht nutzbar war.
                    </p>
                    <p class="text-gray-500">
                        Verständlicherweise war der Wunsch nach einer eigenen Vereinshütte groß und es gelang
                        <strong class="text-green-deep">1954 auf der Bischofsfellnalm</strong>, am Südosthang
                        des Hochgerns eine neue Hütte — den ehemaligen Pöschl-Kaser — anzupachten.
                        Diese bereits im Jahre <strong class="text-green-deep">1826 erbaute</strong> Almhütte
                        wurde seit 1954 kontinuierlich mit viel Mühe und unzähligen Arbeitsstunden erhalten
                        und auf den jetzigen Stand ausgebaut.
                    </p>
                </div>

                <div class="relative rounded-2xl overflow-hidden shadow-xl" style="aspect-ratio:4/3">
                    <!-- https://images.unsplash.com/photo-1542718610-a1d656d1884c?w=800&auto=format&fit=crop -->
                    <img src="/storage/Heute.webp"
                         alt="Grundbachalm Hütte"
                         class="w-full h-full object-cover">
                    <div class="absolute bottom-0 left-0 right-0 px-6 py-4
                      bg-gradient-to-t from-green-deep/80 to-transparent">
            <span class="text-gold-light text-xs font-bold uppercase tracking-widest">
              Grundbachalm — heute
            </span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Bischofsfellnalm --}}
    <section class="py-16 md:py-24 px-6 md:px-10 bg-cream">
        <div class="max-w-6xl mx-auto">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-20 items-center">

                <div class="relative rounded-2xl overflow-hidden shadow-xl order-2 md:order-1" style="aspect-ratio:4/3">
                    <!-- https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=800&auto=format&fit=crop -->
                    <img src="/storage/Heute-2.webp"
                         alt="Bischofsfellnalm"
                         class="w-full h-full object-cover">
                    <div class="absolute bottom-0 left-0 right-0 px-6 py-4
                      bg-gradient-to-t from-green-deep/80 to-transparent">
            <span class="text-gold-light text-xs font-bold uppercase tracking-widest">
              Bischofsfellnalm am Hochgern
            </span>
                    </div>
                </div>

                <div class="order-1 md:order-2">
                    <div class="section-label">🏔️ Seit 1954</div>
                    <h2 class="section-title">Vereinshütte auf der <em>Bischofsfellnalm</em></h2>
                    <p class="text-gray-500 mb-5">
                        In den vergangenen Jahrzehnten haben die Vereinsmitglieder neben vielen kleinen
                        Instandhaltungsarbeiten auch größere Arbeitseinsätze durchgeführt. Das Mauerwerk
                        und der Dachstuhl befinden sich immer noch im Originalzustand.
                    </p>
                    <p class="text-gray-500 mb-5">
                        Im Laufe der Jahre wurde das vorhandene Gaslicht auf elektrisches Licht mit
                        Photovoltaikanlage umgestellt, das Dach, die Dachrinnen, Fenster sowie die
                        Eingangstüre erneuert. Aus Sicherheitsgründen wurden Rauch- und
                        Kohlenmonoxidmelder installiert.
                    </p>

                    {{-- Hüttenwarte timeline --}}
                    <div class="mt-6 bg-white rounded-xl p-5 border border-cream-dark">
                        <h4 class="font-nunito font-bold text-green-deep text-sm uppercase tracking-wide mb-4">
                            🔑 Hüttenwarte
                        </h4>
                        <ul class="space-y-2">
                            @foreach([
                              ['Piossek Hans',      '1954 – 1967'],
                              ['Willner Erich',     '1968 – 1976'],
                              ['Pfertner "Charly"', '1976 – 1985'],
                              ['Winkels Gerd',      '1986 – heute'],
                            ] as [$name, $years])
                                <li class="flex justify-between items-center text-sm
                            py-2 border-b border-cream-dark last:border-0">
                                    <span class="font-semibold text-green-deep">{{ $name }}</span>
                                    <span class="text-gray-400 text-xs">{{ $years }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- Jubiläen & Zitat --}}
    <section class="py-16 md:py-24 px-6 md:px-10 bg-green-deep relative overflow-hidden">
        <div class="absolute inset-0 opacity-10"
             style="background: url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1200&auto=format&fit=crop') center/cover no-repeat">
        </div>
        <div class="max-w-4xl mx-auto relative z-10">

            {{-- Jubiläen --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-16">
                @foreach([
                  ['1826', 'Hütte erbaut'],
                  ['1954', 'Von NaturFreunde gepachtet'],
                  ['2001', '50 Jahre NF Traunreut & 175 Jahre Hütte'],
                ] as [$year, $label])
                    <div class="text-center bg-white/8 border border-white/12 rounded-2xl p-6 backdrop-blur-sm">
                        <div class="font-playfair text-4xl font-black text-gold-light mb-2">{{ $year }}</div>
                        <div class="text-white/70 text-sm">{{ $label }}</div>
                    </div>
                @endforeach
            </div>

            {{-- Zitat --}}
            <div class="text-center">
                <p class="text-white/80 text-lg md:text-xl leading-relaxed italic mb-6 max-w-3xl mx-auto">
                    „An diesem Ort der Ruhe und Beschaulichkeit, in herrlicher Bergwelt verweilen zu dürfen
                    ist nicht als selbstverständlich anzusehen. Unser aller Aufgabe ist es, dies durch
                    umsichtiges Handeln und einem gemeinsamen Miteinander zusammen mit den Almnachbarn
                    unsere einzigartige Natur zu schützen und den nachfolgenden Generationen zu erhalten."
                </p>
                <p class="text-gold-light font-semibold">— Gerd Winkels, Hüttenwart</p>
                <p class="text-white/50 text-sm mt-1">Berg frei! 🏔️</p>
            </div>

        </div>
    </section>

    {{-- Aktivitäten auf der Hütte --}}
    <section class="py-16 md:py-24 px-6 md:px-10 bg-white">
        <div class="max-w-6xl mx-auto">

            <div class="section-label">🎯 Auf der Hütte</div>
            <h2 class="section-title">Gemeinsame <em>Aktivitäten</em></h2>
            <p class="section-lead mb-12">
                Die Hütte hat sich zu einem wichtigen Mittelpunkt im Vereinsleben entwickelt.
            </p>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                @foreach([
                  ['🥾', 'An- & Abwandern'],
                  ['🔨', 'Arbeitseinsätze'],
                  ['⛪', 'Bergmesse'],
                  ['⛷️', 'Skitouren'],
                  ['🌿', 'Wandertouren'],
                  ['🔥', 'Sonnwendfeier'],
                ] as [$icon, $label])
                    <div class="flex flex-col items-center text-center bg-cream rounded-2xl p-5
                      hover:-translate-y-1 transition-all duration-200">
                        <span class="text-3xl mb-2">{{ $icon }}</span>
                        <span class="text-xs font-semibold text-green-deep">{{ $label }}</span>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- CTA --}}
    <section class="py-12 px-6 md:px-10 bg-cream">
        <div class="max-w-2xl mx-auto text-center">
            <p class="text-gray-500 mb-6">
                Viele Mitglieder, aber auch Freunde und Gäste möchten die verbrachten
                Hüttenaufenthalte nicht vermissen.
            </p>
            <a href="{{ route('home') }}#kontakt"
               class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl bg-green-mid text-white
                font-semibold hover:bg-green-accent hover:-translate-y-0.5
                transition-all duration-200 no-underline">
                ✉️ Kontakt zum Hüttenwart
            </a>
        </div>
    </section>

</x-layouts.app>
