@props(['locations'])

<section class="gallery-section py-24 px-10 bg-cream" id="galerie">
  <div class="max-w-6xl mx-auto">

    <div class="section-label">📸 Fotoalbum</div>
    <h2 class="section-title">Galerie unserer <em>Wanderungen</em></h2>
    <p class="section-lead">Eindrücke aus unseren Touren — sortiert nach Ort. Klicken zum Vergrößern.</p>

    {{-- Location Tabs --}}
    <div class="flex flex-wrap gap-2 mt-9 mb-8" x-data="galleryTabs()" x-init="init()">

      <button class="tab-btn" :class="{ active: activeTab === 'alle' }"
              @click="setTab('alle')">
        🗺️ Alle Orte
      </button>

      @foreach($locations as $loc)
      <button class="tab-btn" :class="{ active: activeTab === '{{ $loc->slug }}' }"
              @click="setTab('{{ $loc->slug }}')">
        {{ $loc->emoji }} {{ $loc->name }}
      </button>
      @endforeach

      {{-- ── ALL PHOTOS ── --}}
      <div x-show="activeTab === 'alle'" x-transition class="w-full mt-2">
        <div class="gallery-grid">
          @foreach($locations as $loc)
            @foreach($loc->publishedPhotos as $photo)
              <div class="gallery-item {{ $photo->featured ? 'wide' : '' }}"
                   @click="openLightbox('{{ $photo->url }}', '{{ addslashes($photo->caption ?? '') }}', $el)">
                <img src="{{ $photo->url }}" alt="{{ $photo->caption }}" loading="lazy">
                <div class="g-overlay"><span>{{ $loc->name }}</span></div>
              </div>
            @endforeach
          @endforeach
        </div>
      </div>

      {{-- ── PER LOCATION ── --}}
      @foreach($locations as $loc)
      <div x-show="activeTab === '{{ $loc->slug }}'" x-transition class="w-full mt-2">
        <div class="flex items-center gap-4 mb-5">
          <h3 class="font-playfair text-2xl text-green-deep">
            {{ $loc->emoji }} {{ $loc->name }}
          </h3>
          <span class="text-sm text-gray-400">
            {{ $loc->photo_count }} Fotos
            @if($loc->latest_photo_date)
              · Zuletzt: {{ $loc->latest_photo_date }}
            @endif
          </span>
        </div>

        @if($loc->description)
          <p class="text-sm text-gray-500 mb-5">{{ $loc->description }}</p>
        @endif

        <div class="gallery-grid">
          @foreach($loc->publishedPhotos as $photo)
            <div class="gallery-item {{ $photo->featured ? 'wide' : '' }}"
                 @click="openLightbox('{{ $photo->url }}', '{{ addslashes($photo->caption ?? '') }}', $el)">
              <img src="{{ $photo->url }}" alt="{{ $photo->caption }}" loading="lazy">
              <div class="g-overlay">
                <span>{{ $photo->caption ?? $loc->name }}</span>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      @endforeach

    </div>{{-- /x-data --}}

  </div>
</section>

@push('scripts')
<script>
function galleryTabs() {
  return {
    activeTab: 'alle',
    lightboxOpen: false,
    lbSrc: '',
    lbCaption: '',
    lbImages: [],
    lbIndex: 0,

    init() {
      // keyboard navigation
      document.addEventListener('keydown', e => {
        if (!this.lightboxOpen) return;
        if (e.key === 'Escape') this.closeLightbox();
        if (e.key === 'ArrowLeft') this.lbNav(-1);
        if (e.key === 'ArrowRight') this.lbNav(1);
      });
    },

    setTab(tab) {
      this.activeTab = tab;
    },

    openLightbox(src, caption, clickedEl) {
      // Collect all visible images in this tab
      const section = clickedEl.closest('[x-show]');
      this.lbImages = Array.from(section.querySelectorAll('.gallery-item img'));
      this.lbIndex  = this.lbImages.findIndex(img => img.src === clickedEl.querySelector('img').src);
      this.lbSrc     = src;
      this.lbCaption = caption;
      this.lightboxOpen = true;
      document.body.style.overflow = 'hidden';
    },

    closeLightbox() {
      this.lightboxOpen = false;
      document.body.style.overflow = '';
    },

    lbNav(dir) {
      this.lbIndex = (this.lbIndex + dir + this.lbImages.length) % this.lbImages.length;
      const img = this.lbImages[this.lbIndex];
      this.lbSrc = img.src;
      this.lbCaption = img.alt;
    },
  };
}
</script>
@endpush
