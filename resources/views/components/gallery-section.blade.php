@props(['locations'])

<section class="py-24 px-10 bg-cream" id="galerie">
    <div class="max-w-6xl mx-auto">

        <div class="section-label">📸 Fotoalbum</div>
        <h2 class="section-title">Galerie unserer <em>Wanderungen</em></h2>

        @if($locations->isEmpty())
            <p style="color:#666; margin-top:2rem;">Noch keine Alben vorhanden.</p>
        @else

            <div x-data="gallerySection({{ $locations->toJson() }})">

                {{-- ── РЕЖИМ: список альбомов ── --}}
                <div x-show="mode === 'albums'" x-transition>
                    <p class="section-lead" style="margin-bottom:48px">
                        {{ $locations->count() }} Wanderungen &mdash;
                        {{ $locations->sum(fn($l) => $l->published_photos_count) }} Fotos insgesamt
                    </p>

                    <div class="grid grid-cols-3 gap-6 mt-12">
                        @foreach($locations as $loc)
                            <div @click="openAlbum({{ $loc->id }})"
                                 class="cursor-pointer bg-white rounded-2xl overflow-hidden shadow-sm
                hover:-translate-y-1 hover:shadow-xl transition-all duration-250">

                                {{-- Обложка --}}
                                <div class="relative overflow-hidden bg-cream-dark" style="aspect-ratio:4/3">
                                    @php $cover = $loc->coverPhoto ?? $loc->publishedPhotos->first(); @endphp
                                    @if($cover)
                                        <img src="{{ Storage::url($cover->path) }}"
                                             alt="{{ $loc->name }}"
                                             class="w-full h-full object-cover transition-transform duration-400 hover:scale-105"
                                             style="pointer-events:none">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-5xl">
                                            {{ $loc->city?->state?->emoji ?? '📍' }}
                                        </div>
                                    @endif

                                    {{-- Количество фото --}}
                                    <div class="absolute bottom-2.5 right-2.5 bg-black/55 text-white
                    text-xs font-semibold px-3 py-1 rounded-full backdrop-blur-sm">
                                        {{ $loc->publishedPhotos->count() }} Fotos
                                    </div>
                                </div>

                                {{-- Инфо --}}
                                <div class="p-5">
                                    <div class="font-playfair text-[17px] font-bold text-green-deep mb-2
                    truncate">
                                        {{ $loc->name }}
                                    </div>
                                    <div class="flex gap-3 text-sm text-gray-400 flex-wrap">
                                        @if($loc->date)
                                            <span>📅 {{ $loc->date->locale('de')->isoFormat('D. MMMM YYYY') }}</span>
                                        @endif
                                        @if($loc->city)
                                            <span>{{ $loc->city?->state?->emoji ?? '📍' }} {{ $loc->city->name }}</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- ── РЕЖИМ: открытый альбом ── --}}
                <div x-show="mode === 'album'" x-transition style="display:none">

                    {{-- Назад --}}
                    <button @click="closeAlbum()"
                            class="inline-flex items-center gap-2 bg-transparent border-2 border-cream-dark
               rounded-xl px-5 py-2.5 font-nunito text-sm font-semibold text-green-mid
               cursor-pointer mb-8 hover:border-green-accent transition-all duration-200">
                        ← Zurück zu allen Wanderungen
                    </button>

                    @foreach($locations as $loc)
                        <div x-show="activeAlbumId === {{ $loc->id }}" x-transition>

                            {{-- Заголовок --}}
                            <div class="mb-7">
                                <h3 class="font-playfair text-2xl text-green-deep mb-2">
                                    {{ $loc->city?->state?->emoji ?? '📍' }} {{ $loc->name }}
                                </h3>
                                <div class="flex gap-4 text-sm text-gray-400 flex-wrap">
                                    @if($loc->date)
                                        <span>📅 {{ $loc->date->locale('de')->isoFormat('D. MMMM YYYY') }}</span>
                                    @endif
                                    @if($loc->city)
                                        <span>📍 {{ $loc->city->zip_code ? $loc->city->zip_code.' — ' : '' }}{{ $loc->city->name }}</span>
                                    @endif
                                    <span>{{ $loc->publishedPhotos->count() }} Fotos</span>
                                </div>
                                @if($loc->description)
                                    <p class="text-gray-500 text-sm mt-3 max-w-2xl">{{ $loc->description }}</p>
                                @endif
                            </div>

                            {{-- Сетка фото --}}
                            <div class="gallery-grid">
                                @foreach($loc->publishedPhotos as $photo)
                                    <div class="gallery-item {{ $photo->is_wide ? 'wide' : '' }} group"
                                         @click="openLightbox(
           '{{ Storage::url($photo->path) }}',
           '{{ addslashes($photo->caption ?? '') }}',
           {{ $loop->index }}
         )">
                                        <img src="{{ Storage::url($photo->path) }}"
                                             alt="{{ $photo->caption ?? $loc->name }}"
                                             loading="lazy"
                                             class="group-hover:scale-105 transition-transform duration-400">

                                        {{-- Overlay с иконкой --}}
                                        <div class="g-overlay">
                                            <div class="absolute inset-0 flex items-center justify-center opacity-0
              group-hover:opacity-100 transition-opacity duration-300">
                                                <div class="bg-white/20 backdrop-blur-sm rounded-full p-3 border border-white/40">
                                                    <svg width="24" height="24" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                                        <circle cx="11" cy="11" r="8"/>
                                                        <path d="M21 21l-4.35-4.35"/>
                                                        <line x1="11" y1="8" x2="11" y2="14"/>
                                                        <line x1="8" y1="11" x2="14" y2="11"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            @if($photo->caption)
                                                <span>{{ $photo->caption }}</span>
                                            @endif
                                        </div>

                                    </div>
                                @endforeach
                            </div>

                        </div>
                    @endforeach

                </div>

            </div>
        @endif

    </div>
</section>

{{-- ── LIGHTBOX ── --}}
<div x-data="lightbox()"
     @lightbox-open.window="show($event.detail.src, $event.detail.caption, $event.detail.images)"
     @keydown.escape.window="close()"
     @keydown.arrow-left.window="if(visible) prev()"
     @keydown.arrow-right.window="if(visible) next()"
     @click.self="close()"
     x-show="visible"
     :class="visible ? 'flex' : ''"
     x-transition:enter="transition duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-[999] bg-black/92 items-center justify-center p-6"
     style="display:none">

    <button @click="close()"
            style="position:absolute; top:20px; right:24px; background:none; border:none;
                 color:#fff; font-size:40px; cursor:pointer; opacity:.8; line-height:1">×</button>

    <button @click="prev()" x-show="images.length > 1"
            style="position:absolute; left:20px; top:50%; transform:translateY(-50%);
                 background:rgba(255,255,255,.12); border:none; color:#fff;
                 width:52px; height:52px; border-radius:50%; font-size:26px;
                 cursor:pointer; display:flex; align-items:center; justify-content:center">‹</button>

    <img :src="src" :alt="caption"
         style="max-width:90vw; max-height:85vh; border-radius:12px;
              object-fit:contain; box-shadow:0 32px 80px rgba(0,0,0,.6)">

    <button @click="next()" x-show="images.length > 1"
            style="position:absolute; right:20px; top:50%; transform:translateY(-50%);
                 background:rgba(255,255,255,.12); border:none; color:#fff;
                 width:52px; height:52px; border-radius:50%; font-size:26px;
                 cursor:pointer; display:flex; align-items:center; justify-content:center">›</button>

    <div x-text="caption"
         style="position:absolute; bottom:28px; left:50%; transform:translateX(-50%);
              color:rgba(255,255,255,.8); font-size:14px; text-align:center; max-width:600px">
    </div>

</div>

@push('scripts')
    <script>
        function gallerySection() {
            return {
                mode: 'albums',
                activeAlbumId: null,

                init() {
                    const hash = window.location.hash;
                    if (hash && hash.startsWith('#album-')) {
                        const id = parseInt(hash.replace('#album-', ''));
                        if (id) this.openAlbum(id);
                    }
                },

                openAlbum(id) {
                    this.activeAlbumId = id;
                    this.mode = 'album';
                    window.scrollTo({
                        top: document.getElementById('galerie').offsetTop - 80,
                        behavior: 'smooth'
                    });
                },

                closeAlbum() {
                    this.mode = 'albums';
                    this.activeAlbumId = null;
                    history.pushState(null, '', window.location.pathname);
                },

                openLightbox(src, caption, index) {
                    const images = Array.from(
                        document.querySelectorAll('.gallery-grid .gallery-item img')
                    ).map(img => ({ src: img.src, caption: img.alt }));
                    this.$dispatch('lightbox-open', { src, caption, images, index });
                },
            };
        }

        function lightbox() {
            return {
                visible: false,
                src: '',
                caption: '',
                images: [],
                index: 0,

                show(src, caption, images = []) {
                    this.src     = src;
                    this.caption = caption;
                    this.images  = images;
                    this.index   = images.findIndex(i => i.src === src);
                    if (this.index === -1) this.index = 0;
                    this.visible = true;
                    document.body.style.overflow = 'hidden';
                },

                close() {
                    this.visible = false;
                    document.body.style.overflow = '';
                },

                prev() {
                    if (!this.images.length) return;
                    this.index = (this.index - 1 + this.images.length) % this.images.length;
                    this.src     = this.images[this.index].src;
                    this.caption = this.images[this.index].caption;
                },

                next() {
                    if (!this.images.length) return;
                    this.index = (this.index + 1) % this.images.length;
                    this.src     = this.images[this.index].src;
                    this.caption = this.images[this.index].caption;
                },
            };
        }
    </script>
@endpush
