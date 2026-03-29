<x-layouts.app>

    {{-- Hero --}}
    <section class="relative pt-[72px] bg-green-deep overflow-hidden">
        <div class="absolute inset-0 opacity-15"
             style="background: url('https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=1200&auto=format&fit=crop') center/cover no-repeat">
        </div>
        <div class="relative z-10 max-w-6xl mx-auto px-6 md:px-10 py-20 text-center">
            <div class="section-label text-gold-light">👥 Unser Team</div>
            <h1 class="font-playfair font-black text-white leading-tight mb-5"
                style="font-size: clamp(32px,5vw,60px)">
                Wer macht <em class="text-gold-light not-italic">was?</em>
            </h1>
            <p class="text-white/70 text-lg max-w-xl mx-auto">
                Die Leitung der NaturFreunde Traunreut — Menschen die sich mit Herzblut für unseren Verein einsetzen.
            </p>
        </div>
    </section>

    {{-- Team sections --}}
    <section class="py-16 md:py-24 px-6 md:px-10 bg-cream">
        <div class="max-w-6xl mx-auto">

            @if($groups->isEmpty())
                <p class="text-gray-500 text-center py-20">Keine Teammitglieder gefunden.</p>
            @else

                @foreach($groups as $groupName => $members)
                    <div class="{{ !$loop->first ? 'mt-20' : '' }}">

                        {{-- Group header --}}
                        <div class="flex items-center gap-4 mb-12">
                            <div class="h-px flex-1 bg-cream-dark"></div>
                            <h2 class="font-playfair text-2xl md:text-3xl text-green-deep whitespace-nowrap">
                                {{ $groupName === 'Vorstand' ? '🏛️ Vorstand und Funktionen' : '⭐ Weitere Funktionen' }}
                            </h2>
                            <div class="h-px flex-1 bg-cream-dark"></div>
                        </div>

                        {{-- Members grid --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($members as $member)
                                <div class="bg-white rounded-2xl overflow-hidden shadow-sm
                            hover:-translate-y-1 hover:shadow-lg transition-all duration-250">

                                    {{-- Photo --}}
                                    <div class="relative h-72 bg-cream-dark overflow-hidden">
                                        @if($member->photo_url)
                                            <img src="{{ $member->photo_url }}"
                                                 alt="{{ $member->name }}"
                                                 class="w-full h-full object-cover object-top">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center bg-green-mid">
                        <span class="font-playfair text-5xl font-bold text-white/80">
                          {{ $member->initials }}
                        </span>
                                            </div>
                                        @endif

                                        {{-- Role badge --}}
                                        <div class="absolute bottom-0 left-0 right-0 px-5 py-3
                                bg-gradient-to-t from-green-deep/90 to-transparent">
                      <span class="text-gold-light text-xs font-bold uppercase tracking-widest">
                        {{ $member->role }}
                      </span>
                                        </div>
                                    </div>

                                    {{-- Info --}}
                                    <div class="p-6">
                                        <h3 class="font-playfair text-xl text-green-deep font-bold mb-2">
                                            {{ $member->name }}
                                        </h3>

                                        @if($member->bio)
                                            <p class="text-gray-500 text-sm leading-relaxed mb-4">
                                                {{ $member->bio }}
                                            </p>
                                        @endif

                                        {{-- Contacts --}}
                                        @if($member->phone || $member->phone_mobile || $member->email)
                                            <div class="flex flex-col gap-1.5 pt-4 border-t border-cream-dark">
                                                @if($member->phone)
                                                    <a href="tel:{{ preg_replace('/[^+\d]/', '', $member->phone) }}"
                                                       class="inline-flex items-center gap-2 text-sm text-gray-500
                                    hover:text-green-accent transition-colors no-underline">
                                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                            <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81a19.79 19.79 0 01-3.07-8.68A2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/>
                                                        </svg>
                                                        {{ $member->phone }}
                                                    </a>
                                                @endif

                                                @if($member->phone_mobile)
                                                    <a href="tel:{{ preg_replace('/[^+\d]/', '', $member->phone_mobile) }}"
                                                       class="inline-flex items-center gap-2 text-sm text-gray-500
                                    hover:text-green-accent transition-colors no-underline">
                                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                            <rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12" y2="18"/>
                                                        </svg>
                                                        {{ $member->phone_mobile }}
                                                    </a>
                                                @endif

                                                @if($member->email)
                                                    <a href="mailto:{{ $member->email }}"
                                                       class="inline-flex items-center gap-2 text-sm text-green-accent
                                    hover:text-green-mid transition-colors no-underline">
                                                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                                            <polyline points="22,6 12,13 2,6"/>
                                                        </svg>
                                                        {{ $member->email }}
                                                    </a>
                                                @endif
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                @endforeach

            @endif

        </div>
    </section>

    {{-- Contact CTA --}}
    <section class="py-16 px-6 md:px-10 bg-white">
        <div class="max-w-2xl mx-auto text-center">
            <p class="text-gray-500 mb-6">
                Nehmen Sie einfach Kontakt zu uns auf. Wir beantworten gerne Ihre Fragen zu unserem Verein.
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('home') }}#kontakt"
                   class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl bg-green-mid text-white
                      font-semibold hover:bg-green-accent hover:-translate-y-0.5
                      transition-all duration-200 no-underline">
                    ✉️ Kontakt aufnehmen
                </a>
                <a href="{{ Storage::url('Beitrittserklärung.pdf') }}" target="_blank"
                   class="inline-flex items-center gap-2 px-7 py-3.5 rounded-xl bg-gold text-white
                      font-semibold hover:bg-gold-light hover:-translate-y-0.5
                      transition-all duration-200 no-underline">
                    📄 Beitrittsformular herunterladen
                </a>
            </div>
        </div>
    </section>

</x-layouts.app>
