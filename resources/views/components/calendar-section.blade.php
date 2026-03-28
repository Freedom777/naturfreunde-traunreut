@props(['calendarEvents', 'now'])

<section class="py-24 px-10 bg-white" id="kalender">
  <div class="max-w-6xl mx-auto">

    <div class="section-label">📆 Terminplan</div>
    <h2 class="section-title">Veranstaltungs<em>kalender</em></h2>
    <p class="section-lead">Alle Termine auf einen Blick. Klicken Sie auf 📅 um einen Termin in Google Kalender zu speichern.</p>

    <div class="mt-14 bg-cream rounded-2xl overflow-hidden shadow-md grid grid-cols-[1fr_320px]">

      {{-- ── Left: Calendar grid ── --}}
      <div>
        {{-- Header --}}
        <div class="flex items-center justify-between px-8 py-5 bg-green-mid text-white">
          <button class="w-9 h-9 rounded-lg bg-white/15 hover:bg-white/25 text-lg transition-colors flex items-center justify-center">‹</button>
          <h2 class="font-playfair text-xl">{{ $now->locale('de')->isoFormat('MMMM YYYY') }}</h2>
          <button class="w-9 h-9 rounded-lg bg-white/15 hover:bg-white/25 text-lg transition-colors flex items-center justify-center">›</button>
        </div>

        {{-- Day names --}}
        <div class="grid grid-cols-7 px-7 pt-6">
          @foreach(['Mo','Di','Mi','Do','Fr','Sa','So'] as $day)
            <div class="text-center text-xs font-bold uppercase tracking-wide text-gray-400 py-2">{{ $day }}</div>
          @endforeach
        </div>

        {{-- Days --}}
        @php
          $firstDay = $now->copy()->startOfMonth();
          // Monday-based: 0=Mon … 6=Sun
          $startOffset = ($firstDay->dayOfWeekIso - 1); // 0–6
          $daysInMonth = $now->daysInMonth;
          $prevMonthDays = $firstDay->copy()->subDays($startOffset);
        @endphp

        <div class="grid grid-cols-7 gap-1 px-7 pb-7">
          {{-- Previous month filler --}}
          @for($i = 0; $i < $startOffset; $i++)
            <div class="aspect-square flex items-center justify-center text-sm rounded-lg opacity-30">
              {{ $prevMonthDays->copy()->addDays($i)->day }}
            </div>
          @endfor

            {{-- Current month --}}
            @for($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $isToday   = $day === (int)$now->format('j');
                    $hasEvent  = $calendarEvents->has($day);
                    $event     = $hasEvent ? $calendarEvents->get($day) : null;
                @endphp
                <div class="aspect-square flex items-center justify-center text-sm rounded-lg
              cursor-pointer relative transition-all duration-150
              {{ $isToday
                  ? 'bg-green-mid text-white font-bold'
                  : 'hover:bg-green-accent/10 hover:text-green-accent' }}"
                     @if($hasEvent) title="{{ $event->title }}" @endif>
                    {{ $day }}
                    @if($hasEvent)
                        <span class="absolute bottom-1 w-1.5 h-1.5 rounded-full
                   {{ $isToday ? 'bg-white' : 'bg-gold' }}"></span>
                    @endif
                </div>
            @endfor
        </div>
      </div>

      {{-- ── Right: Event list sidebar ── --}}
      <div class="bg-green-deep px-6 py-6 overflow-y-auto">
        <h3 class="text-gold-light text-xs font-bold uppercase tracking-widest mb-5">
          Termine im {{ $now->locale('de')->isoFormat('MMMM') }}
        </h3>

        @forelse($calendarEvents as $day => $event)
          <div class="py-3.5 border-b border-white/8 last:border-0">
            <div class="text-xs text-gold-light font-semibold mb-1">
              {{ $event->starts_at->locale('de')->isoFormat('D. MMMM') }}
            </div>
            <div class="text-sm text-white/85 mb-2">{{ $event->title }}</div>
            <a href="{{ $event->google_calendar_url }}" target="_blank" rel="noopener"
               class="inline-flex items-center gap-1.5 text-[11px] font-semibold text-[#8ab4f8]
                      px-2.5 py-1 rounded-md bg-[#8ab4f8]/10 border border-[#8ab4f8]/20
                      hover:bg-[#8ab4f8]/20 transition-colors duration-200">
              📅 Google Kalender
            </a>
          </div>
        @empty
          <p class="text-white/50 text-sm">Keine Termine in diesem Monat.</p>
        @endforelse
      </div>

    </div>
  </div>
</section>
