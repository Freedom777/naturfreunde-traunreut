<footer class="bg-green-deep text-white/70 px-6 md:px-10 pt-16 pb-8">
    <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-[2fr_1fr_1fr_1fr] gap-8 md:gap-12">

        <div class="col-span-2 md:col-span-1">
            <div class="font-playfair text-xl text-white font-bold mb-3">🌿 NaturFreunde Traunreut</div>
            <p class="text-sm leading-relaxed max-w-[280px]">
                Eine lebendige Gemeinschaft für Naturliebhaber, Wanderer und Menschen, die Kultur und Umwelt schätzen.
                Seit 1895.
            </p>
            <div class="flex gap-2.5 mt-5">
                <a href="https://www.instagram.com/naturfreunde_traunreut/?utm_source=new_site" target="_blank" rel="noopener"
                   class="w-10 h-10 rounded-xl bg-white/8 border border-white/12 flex items-center justify-center
              text-white/70 hover:bg-gold hover:text-white hover:border-gold transition-all duration-200">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="2" width="20" height="20" rx="5"/>
                        <circle cx="12" cy="12" r="4"/>
                        <circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" stroke="none"/>
                    </svg>
                </a>

                <a href="https://www.facebook.com/share/18ANyUMZ2Q?utm_source=new_site" target="_blank" rel="noopener"
                   class="w-10 h-10 rounded-xl bg-white/8 border border-white/12 flex items-center justify-center
              text-white/70 hover:bg-gold hover:text-white hover:border-gold transition-all duration-200">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                    </svg>
                </a>

                <a href="mailto:info@naturfreunde-traunreut.de"
                   class="w-10 h-10 rounded-xl bg-white/8 border border-white/12 flex items-center justify-center
              text-white/70 hover:bg-gold hover:text-white hover:border-gold transition-all duration-200">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </a>
            </div>
        </div>

        <div>
            <h4 class="font-nunito text-xs font-bold uppercase tracking-widest text-gold-light mb-4">Navigation</h4>
            <ul class="space-y-2.5">
                @foreach([
                  ['Home', route('home')],
                  ['Veranstaltungen', route('home').'#veranstaltungen'],
                  ['Galerie', route('gallery')],
                  ['Wer macht was?', route('team')],
                  ['Vereinsjubiläum', route('vereinsjubilaeum')],
                  ['Vereinsleben', route('vereinsleben')],
                  ['Vereinshütte', route('vereinshuette')],
                  ['Vereinschronik', route('vereinschronik')],
                ] as [$label, $href])
                    <li><a href="{{ $href }}"
                           class="text-white/65 text-sm hover:text-white transition-colors">{{ $label }}</a></li>
                @endforeach
            </ul>
        </div>

        <div>
            <h4 class="font-nunito text-xs font-bold uppercase tracking-widest text-gold-light mb-4">Verband</h4>
            <ul class="space-y-2.5">
                <li><a href="https://www.nf-int.org" target="_blank"
                       class="text-white/65 text-sm hover:text-white transition-colors">Weltverband NFI</a></li>
                <li><a href="https://www.naturfreunde.de" target="_blank"
                       class="text-white/65 text-sm hover:text-white transition-colors">Bundesverband</a></li>
                <li><a href="https://www.naturfreunde-bayern.de" target="_blank"
                       class="text-white/65 text-sm hover:text-white transition-colors">Bayern</a></li>
            </ul>
        </div>

        <div>
            <h4 class="font-nunito text-xs font-bold uppercase tracking-widest text-gold-light mb-4">Rechtliches</h4>
            <ul class="space-y-2.5">
                <li><a href="{{ route('impressum') }}" class="text-white/65 text-sm hover:text-white transition-colors">Impressum</a>
                </li>
                <li><a href="{{ route('datenschutz') }}"
                       class="text-white/65 text-sm hover:text-white transition-colors">Datenschutz</a></li>
                <li><a href="{{ route('home') }}#mitglied"
                       class="text-white/65 text-sm hover:text-white transition-colors">Mitglied werden</a></li>
            </ul>
        </div>

    </div>

    <div
        class="max-w-6xl mx-auto mt-12 pt-6 border-t border-white/8 flex justify-between items-center flex-wrap gap-3 text-xs opacity-50">
        <span>© {{ date('Y') }} NaturFreunde Traunreut e.V. Alle Rechte vorbehalten.</span>
        <span>Made with 🌿 in Traunreut</span>
    </div>
</footer>
