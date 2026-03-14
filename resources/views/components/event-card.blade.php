@props(['event'])

<div class="event-card bg-cream rounded-xl p-6 border-l-4 border-green-accent
            shadow-sm hover:-translate-y-1 hover:shadow-md hover:border-gold
            transition-all duration-250 flex flex-col gap-0">

    {{-- Top: date badge + body --}}
    <div class="flex gap-5 items-start">
        {{-- Date badge --}}
        <div class="min-w-[64px] text-center rounded-xl py-3 px-2 flex-shrink-0 text-white"
             style="background: {{ $event->date_color }}">
            <div class="font-playfair text-3xl font-bold leading-none">
                {{ $event->starts_at->format('j') }}
            </div>
            <div class="text-[11px] tracking-wide uppercase opacity-80 mt-1">
                {{ $event->starts_at->locale('de')->isoFormat('MMM') }}
            </div>
        </div>

        {{-- Title + description --}}
        <div>
            <h3 class="font-nunito text-[17px] font-bold text-green-deep mb-1">
                {{ $event->title }}
            </h3>
            @if($event->description)
                <p class="text-sm text-gray-500">{{ $event->description }}</p>
            @endif
            @if($event->location)
                <p class="text-xs text-gray-400 mt-1">📍 {{ $event->location }}</p>
            @endif
        </div>
    </div>

    {{-- Footer: tag + Google Calendar --}}
    <div class="flex items-center justify-between mt-4 pt-4 border-t border-cream-dark">
        <span class="inline-block text-[11px] font-bold tracking-wide uppercase
                     bg-green-accent/10 text-green-accent px-3 py-1 rounded-full">
            {{ $event->category_emoji }} {{ $event->category_label }}
        </span>

        <a href="{{ $event->google_calendar_url }}" target="_blank" rel="noopener"
           class="inline-flex items-center gap-1.5 text-[12px] font-semibold text-[#1a73e8]
                  px-3 py-1.5 rounded-lg bg-[#1a73e8]/8 border border-[#1a73e8]/20
                  hover:bg-[#1a73e8]/15 hover:-translate-y-px transition-all duration-200
                  whitespace-nowrap">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
                <rect x="3" y="4" width="18" height="18" rx="2" stroke="#1a73e8" stroke-width="2"/>
                <line x1="16" y1="2" x2="16" y2="6" stroke="#1a73e8" stroke-width="2"/>
                <line x1="8" y1="2" x2="8" y2="6" stroke="#1a73e8" stroke-width="2"/>
                <line x1="3" y1="10" x2="21" y2="10" stroke="#1a73e8" stroke-width="2"/>
                <text x="12" y="19" text-anchor="middle" font-size="6" fill="#1a73e8" font-weight="bold">G</text>
            </svg>
            In Google Kalender
        </a>
    </div>
</div>
