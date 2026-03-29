<x-layouts.app>

    {{-- Hero --}}
    <section class="relative pt-[72px] bg-green-deep">
        <div class="max-w-4xl mx-auto px-6 md:px-10 py-16 text-center">
            <div class="section-label text-gold-light">⚖️ Rechtliches</div>
            <h1 class="font-playfair font-black text-white text-4xl md:text-5xl">Impressum</h1>
        </div>
    </section>

    {{-- Content --}}
    <section class="py-16 md:py-24 px-6 md:px-10 bg-white">
        <div class="max-w-4xl mx-auto space-y-10">

            {{-- Kontakt --}}
            <div class="bg-cream rounded-2xl p-8 border-l-4 border-green-accent">
                <h2 class="font-playfair text-2xl text-green-deep font-bold mb-5">
                    Verantwortlich & Kontakt
                </h2>
                <div class="text-gray-600 space-y-1">
                    <p class="font-semibold text-green-deep text-lg">NaturFreunde Deutschland Ortsgruppe Traunreut e.V.</p>
                    <p>Wendelsteinstr. 20</p>
                    <p>83371 Stein a.d. Traun</p>
                    <div class="pt-3 space-y-1">
                        <p>Vertreten durch:</p>
                        <p>1. Vorstand: <strong>Matthias Kolberg</strong></p>
                        <p>2. Vorstand: <strong>Sabine Ronneker-Kolberg</strong></p>
                    </div>
                    <div class="pt-3 space-y-1">
                        <p>Telefon: <a href="tel:+4986219003115" class="text-green-accent font-semibold">+49 (0 86 21) 9003115</a></p>
                        <p>E-Mail: <a href="mailto:info@naturfreunde-traunreut.de" class="text-green-accent font-semibold">info@naturfreunde-traunreut.de</a></p>
                    </div>
                </div>
            </div>

            {{-- Registereintrag --}}
            <div>
                <h2 class="font-playfair text-2xl text-green-deep font-bold mb-4">Registereintrag</h2>
                <div class="text-gray-600 space-y-1">
                    <p>Registergericht: <strong class="text-green-deep">Traunstein</strong></p>
                    <p>Registernummer: <strong class="text-green-deep">VR 901</strong></p>
                </div>
            </div>

            <hr class="border-cream-dark">

            {{-- Streitschlichtung --}}
            <div>
                <h2 class="font-playfair text-2xl text-green-deep font-bold mb-4">Streitschlichtung</h2>
                <p class="text-gray-600 mb-3">
                    Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit:
                    <a href="https://ec.europa.eu/consumers/odr" target="_blank"
                       class="text-green-accent hover:text-green-mid transition-colors">
                        ec.europa.eu/consumers/odr
                    </a>.
                    Unsere E-Mail-Adresse finden Sie oben im Impressum.
                </p>
                <p class="text-gray-600">
                    Wir sind nicht bereit oder verpflichtet, an Streitbeilegungsverfahren vor einer
                    Verbraucherschlichtungsstelle teilzunehmen.
                </p>
            </div>

            <hr class="border-cream-dark">

            {{-- Haftung für Inhalte --}}
            <div>
                <h2 class="font-playfair text-2xl text-green-deep font-bold mb-4">Haftung für Inhalte</h2>
                <p class="text-gray-600 mb-3">
                    Als Diensteanbieter sind wir gemäß § 7 Abs. 1 DDG für eigene Inhalte auf diesen Seiten
                    nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 DDG sind wir als
                    Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde
                    Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige
                    Tätigkeit hinweisen.
                </p>
                <p class="text-gray-600">
                    Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den
                    allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch
                    erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei
                    Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend
                    entfernen.
                </p>
            </div>

            <hr class="border-cream-dark">

            {{-- Urheberrecht --}}
            <div>
                <h2 class="font-playfair text-2xl text-green-deep font-bold mb-4">Urheberrecht</h2>
                <p class="text-gray-600 mb-3">
                    Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen
                    dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art
                    der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der schriftlichen
                    Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind
                    nur für den privaten, nicht kommerziellen Gebrauch gestattet.
                </p>
                <p class="text-gray-600">
                    Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die
                    Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche
                    gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden,
                    bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen
                    werden wir derartige Inhalte umgehend entfernen.
                </p>
            </div>

            {{-- Back link --}}
            <div class="pt-8 border-t border-cream-dark flex flex-wrap gap-4">
                <a href="{{ route('home') }}"
                   class="inline-flex items-center gap-2 text-sm text-green-accent font-semibold
                  hover:text-green-mid transition-colors no-underline">
                    ← Zurück zur Startseite
                </a>
                <a href="{{ route('datenschutz') }}"
                   class="inline-flex items-center gap-2 text-sm text-green-accent font-semibold
                  hover:text-green-mid transition-colors no-underline">
                    Datenschutzerklärung →
                </a>
            </div>

        </div>
    </section>

</x-layouts.app>
