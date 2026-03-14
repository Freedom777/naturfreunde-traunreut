<x-layouts.app>

  {{-- ── HERO ── --}}
  <section class="hero h-screen min-h-[640px] relative flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0"
         style="background: linear-gradient(160deg,rgba(10,30,5,.78) 0%,rgba(30,58,15,.55) 50%,rgba(80,120,40,.3) 100%),
                url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=1600&auto=format&fit=crop') center/cover no-repeat">
    </div>

    <div class="relative z-10 text-center text-white max-w-3xl px-6" style="animation: fadeUp .9s ease both">
      <div class="inline-block bg-gold/25 border border-gold/50 text-gold-light text-xs font-bold tracking-[2px] uppercase px-5 py-1.5 rounded-full mb-6">
        🌿 Seit 1895 — Traunreut
      </div>
      <h1 class="font-playfair font-black leading-[1.1] mb-5" style="font-size: clamp(38px,6vw,72px); text-shadow: 0 4px 24px rgba(0,0,0,.3)">
        Natur erleben.<br><span class="text-gold-light">Gemeinschaft</span> stärken.
      </h1>
      <p class="text-lg font-light opacity-90 mb-10 max-w-xl mx-auto">
        Wandern, Kultur, Umwelt, Gemeinschaft — die NaturFreunde Traunreut sind seit Jahrzehnten ein lebendiger Verein für alle, die die Natur lieben.
      </p>
      <div class="flex gap-4 justify-center flex-wrap">
        <a href="#veranstaltungen" class="btn-primary">
          <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          Veranstaltungen
        </a>
        <a href="#galerie" class="btn-outline">📸 Galerie</a>
      </div>
    </div>

    <div class="absolute bottom-9 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2
                text-white/60 text-xs tracking-widest uppercase" style="animation: bounce 2s infinite">
      <span>Scroll</span>
      <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 5v14M5 12l7 7 7-7"/></svg>
    </div>
  </section>

  {{-- ── STATS ── --}}
  <div class="bg-green-deep flex flex-wrap justify-center">
    @foreach([['130+','Mitglieder'],['1895','Gegründet in Wien'],['21','Länder weltweit'],['500T','NF-Mitglieder global']] as [$num,$label])
      <div class="flex-1 min-w-[160px] py-7 px-8 text-center text-white border-r border-white/8 last:border-0">
        <div class="font-playfair text-4xl font-bold text-gold-light">{{ $num }}</div>
        <div class="text-xs opacity-65 mt-1">{{ $label }}</div>
      </div>
    @endforeach
  </div>

  {{-- ── EVENTS ── --}}
  <section class="py-24 px-10 bg-white" id="veranstaltungen">
    <div class="max-w-6xl mx-auto">
      <div class="section-label">📅 Aktuell</div>
      <h2 class="section-title">Kommende <em>Veranstaltungen</em></h2>
      <p class="section-lead">Bei jeder Veranstaltung sind Freunde und Gäste herzlich willkommen. Klicken Sie auf 📅 um einen Termin zu speichern.</p>

      <div class="grid grid-cols-2 gap-6 mt-14">
        @foreach($upcomingEvents as $event)
          <x-event-card :event="$event" />
        @endforeach
      </div>

      <div class="text-center mt-10">
        <a href="#kalender" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl bg-green-mid text-white
                                   font-semibold hover:bg-green-accent hover:-translate-y-0.5 transition-all duration-200">
          Alle Veranstaltungen ansehen →
        </a>
      </div>
    </div>
  </section>

  {{-- ── GALLERY ── --}}
  <x-gallery-section :locations="$galleryLocations" />

  {{-- ── ABOUT ── --}}
  <section class="py-24 px-10 bg-white" id="verein">
    <div class="max-w-6xl mx-auto grid grid-cols-2 gap-20 items-center">
      <div class="relative rounded-2xl overflow-hidden shadow-2xl" style="aspect-ratio:4/3">
        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&auto=format&fit=crop"
             alt="Natur erleben" class="w-full h-full object-cover">
        <div class="absolute bottom-5 left-5 bg-green-deep text-white rounded-xl p-4 text-sm font-semibold">
          <strong class="block font-playfair text-2xl text-gold-light">1895</strong>
          Gründungsjahr
        </div>
      </div>
      <div>
        <div class="section-label">🌍 Über uns</div>
        <h2 class="section-title">Eine <em>internationale</em> Bewegung</h2>
        <p class="text-gray-500 mb-4">Die NaturFreunde sind eine internationale Umwelt-, Kultur-, Freizeit- und Touristikorganisation. Von österreichischen Sozialisten 1895 in Wien gegründet.</p>
        <p class="text-gray-500 mb-4">Heute gehören zur NaturFreunde-Bewegung etwa <strong>500.000 Mitglieder in 21 Ländern</strong>, darunter fast 100.000 in Deutschland.</p>
        <p class="text-gray-500 mb-8">Unsere Ortsgruppe Traunreut ist aktiver Teil dieser Gemeinschaft — mit Wanderungen, geselligen Treffen, Umweltaktionen und kulturellen Veranstaltungen.</p>
        <div class="flex flex-wrap gap-3">
          @foreach(['🌐 Weltverband' => 'https://www.nf-int.org', '🇩🇪 Bundesverband' => 'https://www.naturfreunde.de', '🏔️ Bayern' => 'https://www.naturfreunde-bayern.de'] as $label => $url)
            <a href="{{ $url }}" target="_blank"
               class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl border-2 border-cream-dark
                      bg-cream text-green-mid text-sm font-semibold hover:border-green-accent
                      hover:text-green-accent hover:-translate-y-0.5 transition-all duration-200">
              {{ $label }}
            </a>
          @endforeach
        </div>
      </div>
    </div>
  </section>

  {{-- ── MEMBERSHIP ── --}}
  <section class="py-24 px-10 bg-green-deep relative overflow-hidden" id="mitglied">
    <div class="absolute inset-0 opacity-12"
         style="background: url('https://images.unsplash.com/photo-1448375240586-882707db888b?w=1200&auto=format&fit=crop') center/cover no-repeat">
    </div>
    <div class="max-w-6xl mx-auto relative z-10 grid grid-cols-2 gap-20 items-center">
      <div>
        <div class="section-label text-gold-light">✨ Beitreten</div>
        <h2 class="section-title text-white">Werden Sie Teil unserer solidarischen Gemeinschaft</h2>
        <p class="text-white/70 text-lg mb-4">Naturfreunde — ein starkes Netzwerk!</p>
        <p class="text-white/60 text-sm">Als Mitglied profitieren Sie von vergünstigten Übernachtungen in NaturFreunde-Hütten weltweit, gemeinsamen Wanderungen und Kulturveranstaltungen.</p>
      </div>
      <div class="bg-white/6 border border-white/12 rounded-2xl p-10 backdrop-blur-sm">
        <h3 class="font-playfair text-white text-xl mb-5">Mitgliedsbeiträge 2025</h3>
        <ul class="mb-7 space-y-0">
          @foreach(['Erwachsene' => '42 €/Jahr', 'Familien' => '65 €/Jahr', 'Jugendliche (bis 25)' => '18 €/Jahr', 'Rentner / Ermäßigt' => '28 €/Jahr'] as $cat => $price)
            <li class="flex justify-between items-center py-3 border-b border-white/8 last:border-0 text-white/80 text-sm">
              {{ $cat }}
              <strong class="text-gold-light text-lg">{{ $price }}</strong>
            </li>
          @endforeach
        </ul>
        <a href="#" class="flex items-center justify-center gap-2 w-full py-4 rounded-xl bg-gold text-white
                           font-semibold text-sm hover:bg-gold-light hover:-translate-y-0.5 transition-all duration-200">
          📄 Beitrittsformular herunterladen
        </a>
      </div>
    </div>
  </section>

  {{-- ── CALENDAR ── --}}
  <x-calendar-section :calendarEvents="$calendarEvents" :now="$now" />

  {{-- ── CONTACT ── --}}
  <x-contact-section />

</x-layouts.app>
