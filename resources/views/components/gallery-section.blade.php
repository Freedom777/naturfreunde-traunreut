@props(['locations'])

<section class="py-24 px-10 bg-cream" id="galerie">
    <div class="max-w-6xl mx-auto">

        <div class="section-label">📸 Fotoalbum</div>
        <h2 class="section-title">Galerie unserer <em>Wanderungen</em></h2>
        <p class="section-lead">Eindrücke aus unseren Touren — sortiert nach Wanderung. Klicken zum Vergrößern.</p>

        @if($locations->isEmpty())
            <p style="color:#666; margin-top:2rem;">Noch keine Fotos vorhanden.</p>
        @else

            <div x-data="gallerySection()">

                {{-- Tabs --}}
                <div style="display:flex; flex-wrap:wrap; gap:8px; margin:36px 0 28px">
                    <button class="tab-btn" :class="{ active: activeTab === 'alle' }"
                            @click="setTab('alle')">
                        🗺️ Alle Wanderungen
                    </button>
                    @foreach($locations as $loc)
                        <button class="tab-btn"
                                :class="{ active: activeTab === {{ $loc->id }} }"
                                @click="setTab({{ $loc->id }})">
                            {{ $loc->city?->state?->emoji ?? '📍' }} {{ $loc->name }}
                            @if($loc->date)
                                <span style="font-weight:400; opacity:.7; font-size:11px; margin-left:4px">
                {{ $loc->date->format('m.Y') }}
              </span>
                            @endif
                        </button>
                    @endforeach
                </div>

                {{-- Все фото --}}
                <div x-show="activeTab === 'alle'" x-transition>
                    <div class="gallery-grid">
                        @foreach($locations as $loc)
                            @foreach($loc->publishedPhotos as $photo)
                                @php $idx = $loop->parent->index * 1000 + $loop->index; @endphp
                                <div class="gallery-item {{ $photo->is_wide ? 'wide' : '' }}"
                                     @click="open('{{ Storage::url($photo->path) }}', '{{ addslashes($photo->caption ?? $loc->name) }}')">
                                    <img src="{{ Storage::url($photo->path) }}"
                                         alt="{{ $photo->caption ?? $loc->name }}"
                                         loading="lazy">
                                    <div class="g-overlay"><span>{{ $loc->name }}</span></div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>

                {{-- По альбомам --}}
                @foreach($locations as $loc)
                    <div x-show="activeTab === {{ $loc->id }}"
                         x-transition
                         id="album-{{ $loc->id }}">

                        {{-- Заголовок альбома --}}
                        <div style="display:flex; align-items:center; gap:16px; margin-bottom:20px; flex-wrap:wrap">
                            <h3 style="font-family:'Playfair Display',serif; font-size:22px; color:#1e3a0f">
                                {{ $loc->city?->state?->emoji ?? '📍' }} {{ $loc->name }}
                            </h3>
                            <div style="display:flex; gap:12px; font-size:13px; color:#888; flex-wrap:wrap">
                                @if($loc->date)
                                    <span>📅 {{ $loc->date->locale('de')->isoFormat('D. MMMM YYYY') }}</span>
                                @endif
                                @if($loc->city)
                                    <span>
                  📍 {{ $loc->city->zip_code ? $loc->city->zip_code.' — ' : '' }}{{ $loc->city->name }}
                </span>
                                @endif
                                <span>{{ $loc->publishedPhotos->count() }} Fotos</span>
                            </div>
                        </div>

                        @if($loc->description)
                            <p style="color:#666; font-size:14px; margin-bottom:20px">{{ $loc->description }}</p>
                        @endif

                        <div class="gallery-grid">
                            @foreach($loc->publishedPhotos as $photo)
                                <div class="gallery-item {{ $photo->is_wide ? 'wide' : '' }}"
                                     @click="open('{{ Storage::url($photo->path) }}', '{{ addslashes($photo->caption ?? '') }}')">
                                    <img src="{{ Storage::url($photo->path) }}"
                                         alt="{{ $photo->caption ?? $loc->name }}"
                                         loading="lazy">
                                    <div class="g-overlay">
                                        <span>{{ $photo->caption ?? $loc->name }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                @endforeach

            </div>
        @endif

    </div>
</section>

{{-- ── LIGHTBOX ── --}}
<div x-data="lightbox()"
     x-show="visible"
     x-transition:enter="transition duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @lightbox-open.window="show($event.detail.src, $event.detail.caption)"
     @keydown.escape.window="close()"
     @keydown.arrow-left.window="if(visible) prev()"
     @keydown.arrow-right.window="if(visible) next()"
     @click.self="close()"
     style="display:none; position:fixed; inset:0; z-index:999;
            background:rgba(0,0,0,.92); align-items:center;
            justify-content:center; padding:24px"
     :style="visible ? 'display:flex' : 'display:none'">

    {{-- Close --}}
    <button @click="close()"
            style="position:absolute; top:20px; right:24px; background:none; border:none;
                 color:#fff; font-size:36px; cursor:pointer; opacity:.8; line-height:1">
        ×
    </button>

    {{-- Prev --}}
    <button @click="prev()"
            x-show="images.length > 1"
            style="position:absolute; left:20px; top:50%; transform:translateY(-50%);
                 background:rgba(255,255,255,.12); border:none; color:#fff;
                 width:52px; height:52px; border-radius:50%; font-size:24px;
                 cursor:pointer; display:flex; align-items:center; justify-content:center">
        ‹
    </button>

    {{-- Image --}}
    <img :src="src" :alt="caption"
         style="max-width:90vw; max-height:85vh; border-radius:12px;
              object-fit:contain; box-shadow:0 32px 80px rgba(0,0,0,.6)">

    {{-- Next --}}
    <button @click="next()"
            x-show="images.length > 1"
            style="position:absolute; right:20px; top:50%; transform:translateY(-50%);
                 background:rgba(255,255,255,.12); border:none; color:#fff;
                 width:52px; height:52px; border-radius:50%; font-size:24px;
                 cursor:pointer; display:flex; align-items:center; justify-content:center">
        ›
    </button>

    {{-- Caption --}}
    <div x-text="caption"
         style="position:absolute; bottom:28px; left:50%; transform:translateX(-50%);
              color:rgba(255,255,255,.8); font-size:14px; text-align:center;
              max-width:600px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis">
    </div>

</div>

@push('scripts')
    <script>
        function gallerySection() {
            return {
                activeTab: 'alle',

                setTab(tab) {
                    this.activeTab = tab;
                },

                open(src, caption) {
                    // Собираем все фото текущей вкладки
                    const selector = this.activeTab === 'alle'
                        ? '[x-show] .gallery-item img'
                        : `#album-${this.activeTab} .gallery-item img`;

                    const imgs = Array.from(document.querySelectorAll(selector))
                        .map(img => ({ src: img.src, caption: img.alt }));

                    window.$dispatch('lightbox-open', { src, caption, images: imgs });
                    this.$dispatch('lightbox-open', { src, caption, images: imgs });
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
                    this.visible = true;
                    document.body.style.overflow = 'hidden';
                },

                close() {
                    this.visible = false;
                    document.body.style.overflow = '';
                },

                prev() {
                    if (!this.images.length) return;
                    this.index   = (this.index - 1 + this.images.length) % this.images.length;
                    this.src     = this.images[this.index].src;
                    this.caption = this.images[this.index].caption;
                },

                next() {
                    if (!this.images.length) return;
                    this.index   = (this.index + 1) % this.images.length;
                    this.src     = this.images[this.index].src;
                    this.caption = this.images[this.index].caption;
                },
            };
        }
    </script>
@endpush
