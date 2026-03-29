<x-layouts.app>

    {{-- Hero --}}
    <section class="relative pt-[72px] bg-green-deep overflow-hidden">
        <div class="absolute inset-0 opacity-15"
             style="background: url('https://images.unsplash.com/photo-1464207687429-7505649dae38?w=1200&auto=format&fit=crop') center/cover no-repeat">
        </div>
        <div class="relative z-10 max-w-6xl mx-auto px-6 md:px-10 py-20 text-center">
            <div class="section-label text-gold-light">🏆 Vereinsjubiläum</div>
            <h1 class="font-playfair font-black text-white leading-tight mb-5"
                style="font-size: clamp(32px,5vw,60px)">
                Jubilare <em class="text-gold-light not-italic">{{ date('Y') }}</em>
            </h1>
            <p class="text-white/70 text-lg max-w-xl mx-auto">
                In diesem Jahr feiern diese Mitglieder ihr Vereinsjubiläum bei den NaturFreunden Traunreut.
            </p>
        </div>
    </section>

    {{-- Jubilees --}}
    <section class="py-16 md:py-24 px-6 md:px-10 bg-cream">
        <div class="max-w-4xl mx-auto">

            @if($jubilees->isEmpty())
                <p class="text-gray-500 text-center py-20">
                    Keine Jubilare in diesem Jahr.
                </p>
            @else
                <div class="flex flex-col gap-10">
                    @foreach($jubilees as $years => $members)
                        <div class="bg-white rounded-2xl overflow-hidden shadow-sm">

                            {{-- Header --}}
                            <div class="flex items-center gap-5 px-8 py-5 bg-green-mid">
                                <div class="w-16 h-16 rounded-2xl bg-gold flex flex-col items-center justify-center flex-shrink-0">
                                    <span class="font-playfair font-black text-white text-xl leading-none">{{ $years }}</span>
                                    <span class="text-white/80 text-[10px] uppercase tracking-wide">Jahre</span>
                                </div>
                                <div>
                                    <div class="text-gold-light text-xs font-bold uppercase tracking-widest mb-0.5">
                                        Jubiläum {{ date('Y') }}
                                    </div>
                                    <h2 class="font-playfair text-white text-2xl font-bold">
                                        {{ $years }} Jahre Mitglied 🎉
                                    </h2>
                                </div>
                            </div>

                            {{-- Members list --}}
                            <div class="px-8 py-6">
                                <div class="flex flex-wrap gap-3">
                                    @foreach($members as $member)
                                        <div class="inline-flex items-center gap-2 bg-cream px-4 py-2.5
                                rounded-xl border border-cream-dark text-green-deep font-semibold text-sm">
                                            🌿 {{ $member->name }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="mt-12 text-center text-gray-400 text-sm">
                    Herzlichen Glückwunsch an alle Jubilare! 🎊
                </div>
            @endif

        </div>
    </section>

</x-layouts.app>
