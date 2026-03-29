<x-layouts.app>

    {{-- Hero --}}
    <section class="relative pt-[72px] bg-green-deep overflow-hidden">
        <div class="absolute inset-0 opacity-20"
             style="background: url('https://images.unsplash.com/photo-1551632811-561732d1e306?w=1200&auto=format&fit=crop') center/cover no-repeat">
        </div>
        <div class="relative z-10 max-w-6xl mx-auto px-6 md:px-10 py-20 text-center">
            <div class="section-label text-gold-light">🌿 Unser Verein</div>
            <h1 class="font-playfair font-black text-white leading-tight mb-5"
                style="font-size: clamp(32px,5vw,60px)">
                Vereins<em class="text-gold-light not-italic">leben</em>
            </h1>
            <p class="text-white/70 text-lg max-w-2xl mx-auto">
                Vereinsleben der Ortsgruppe Traunreut und Jugendgruppe
            </p>
        </div>
    </section>

    {{-- Über uns --}}
    <section class="py-16 md:py-24 px-6 md:px-10 bg-white">
        <div class="max-w-4xl mx-auto">

            <div class="section-label">🌍 Über die NaturFreunde</div>
            <h2 class="section-title">Eine <em>internationale</em> Bewegung</h2>

            <div class="prose prose-lg max-w-none text-gray-500 mt-8 space-y-5">
                <p>
                    Die NaturFreunde sind eine internationale Umwelt-, Kultur-, Freizeit- und Touristikorganisation.
                    Von österreichischen Sozialisten 1895 in Wien gegründet, gehören heute zur NaturFreunde-Bewegung
                    etwa <strong class="text-green-deep">500.000 Mitglieder in 21 Ländern</strong>, darunter fast
                    100.000 in Deutschland. Die NaturFreunde Internationale (NFI) als Dachverband hat ihren Sitz in Wien.
                </p>
                <p>
                    Das NaturFreunde-Leben der etwa 100.000 Mitglieder in Deutschland spielt sich in mehr als
                    750 Ortsgruppen ab. Jede Ortsgruppe wirkt eigenverantwortlich als juristisch selbständiger
                    Verein in ihrer Umgebung für die gemeinsamen Ziele. Wichtige Aufgabe ist die Förderung des
                    Natur- und Umweltschutzes.
                </p>
                <p>
                    Die Ortsgruppen veranstalten Reisen, pflegen den Breitensport, fördern musische und kulturelle
                    Betätigung, organisieren Bildungsveranstaltungen, veranstalten Vorträge, Seminare und
                    Ausstellungen, geben Zeitschriften heraus und sammeln Fachliteratur, machen praktische
                    Naturschutzarbeit.
                </p>
            </div>

            {{-- Traunreut specifics --}}
            <div class="mt-12 bg-cream rounded-2xl p-8 md:p-10 border-l-4 border-green-accent">
                <h3 class="font-playfair text-2xl text-green-deep mb-4">Ortsgruppe Traunreut</h3>
                <p class="text-gray-500 mb-4">
                    Die Ortsgruppe Traunreut bietet Ihnen ein abwechslungsreiches Vereinsleben mit Berg- und
                    Skitouren, Wanderungen, Radtouren, kulturellen Wochenendausflügen, Sonnwendfeiern auf der
                    Hütte und natürlich auch regelmäßige Versammlungen.
                </p>
                <p class="text-gray-500 mb-6">
                    Auf der vereinseigenen Berghütte am Hochgern — Bischofsfellnalm — haben Vereinsmitglieder
                    der Ortsgruppe Traunreut und ihre Familien und Freunde die Möglichkeit, die einzigartige
                    Chiemgauer Bergwelt zu erleben.
                </p>
                <p class="text-green-mid font-semibold italic">
                    Wir wünschen Euch viel Vergnügen auf unseren Seiten! Berg frei! 🏔️
                </p>
                <p class="text-sm text-gray-400 mt-2">
                    — NaturFreunde Deutschlands Ortsgruppe Traunreut e.V., der Vorstand
                </p>
            </div>

        </div>
    </section>

    {{-- Aktivitäten --}}
    <section class="py-16 md:py-24 px-6 md:px-10 bg-cream">
        <div class="max-w-6xl mx-auto">

            <div class="section-label">🎯 Programm</div>
            <h2 class="section-title">Unsere <em>Aktivitäten</em></h2>
            <p class="section-lead mb-12">
                Wir bieten eine Vielfalt von Aktivitäten in unserem Verein. Jeden Monat ist Versammlung
                bzw. ein geselliger Nachmittag.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach([
                  ['🏔️', 'Bergtouren & Wanderungen',       'Familien- und Bergtouren durch die Chiemgauer Alpen und Umgebung.'],
                  ['🚴', 'Radtouren',                        'Feierabendradtouren und Tagesausflüge für Groß und Klein.'],
                  ['⛷️', 'Winter & Schnee',                  'Skifahrten, Skitouren, Schneeschuhtouren, Rodeln und Schlittschuhlaufen.'],
                  ['🛖', 'Hüttenaufenthalte',                'Sonnwendfeuer und Abwandern auf unserer Bischofsfellnalm am Hochgern.'],
                  ['🔨', 'Arbeitseinsätze',                  'Gemeinsame Arbeitseinsätze zur Pflege unserer Vereinshütte.'],
                  ['⛪', 'Bergmesse',                         'Traditionelle Bergmesse in der Natur — ein besonderes Erlebnis.'],
                  ['🧓', 'Seniorenwanderungen',               'Gemütliche Wanderungen speziell für unsere älteren Mitglieder.'],
                  ['🎭', 'Kulturelle Ausflüge',               'Ausflüge zu kulturellen Highlights in der Region und darüber hinaus.'],
                  ['🎉', 'Vereinsfeiern',                     'Regelmäßige Versammlungen und gesellige Vereinsfeiern.'],
                  ['🎳', 'Kegeln',                            'Geselliges Kegeln für alle Vereinsmitglieder.'],
                ] as [$icon, $title, $desc])
                    <div class="bg-white rounded-2xl p-6 shadow-sm hover:-translate-y-1
                      hover:shadow-md transition-all duration-250">
                        <div class="text-4xl mb-4">{{ $icon }}</div>
                        <h3 class="font-playfair text-lg text-green-deep font-bold mb-2">{{ $title }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $desc }}</p>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 bg-green-mid rounded-2xl p-8 text-center">
                <p class="text-white/90 text-lg mb-2">
                    Falls wir Dein Interesse geweckt haben, dann bist Du herzlich willkommen!
                </p>
                <p class="text-white/65 text-sm mb-6">
                    Du kannst völlig unverbindlich in unsere Versammlungen sowie Veranstaltungen hineinschnuppern.
                </p>
                <a href="{{ route('home') }}#kontakt"
                   class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl bg-gold text-white
                  font-semibold hover:bg-gold-light hover:-translate-y-0.5
                  transition-all duration-200 no-underline">
                    ✉️ Kontakt aufnehmen
                </a>
            </div>

        </div>
    </section>

</x-layouts.app>
