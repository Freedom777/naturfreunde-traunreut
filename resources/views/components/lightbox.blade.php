{{-- Global lightbox overlay, driven by Alpine.js $dispatch('open-lightbox', {src, caption}) --}}
<div
    x-data="{ open: false, src: '', caption: '', images: [], index: 0 }"
    @open-lightbox.window="
        open = true;
        src = $event.detail.src;
        caption = $event.detail.caption ?? '';
        images = $event.detail.images ?? [];
        index = $event.detail.index ?? 0;
        document.body.style.overflow = 'hidden';
    "
    @keydown.escape.window="if(open) { open=false; document.body.style.overflow=''; }"
    @keydown.arrow-left.window="if(open && images.length) nav(-1)"
    @keydown.arrow-right.window="if(open && images.length) nav(1)"
    x-show="open"
    x-transition:enter="transition duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-[999] bg-black/92 flex items-center justify-center p-6"
    @click.self="open=false; document.body.style.overflow='';"
    style="display:none"
>
    {{-- Close --}}
    <button @click="open=false; document.body.style.overflow='';"
            class="absolute top-5 right-6 text-white text-4xl leading-none opacity-75 hover:opacity-100 transition-opacity">
        ×
    </button>

    {{-- Prev --}}
    <button x-show="images.length > 1" @click="nav(-1)"
            class="absolute left-5 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/12
                   hover:bg-white/25 flex items-center justify-center text-white text-2xl transition-colors">
        ‹
    </button>

    {{-- Image --}}
    <img :src="src" :alt="caption"
         class="max-w-[90vw] max-h-[85vh] rounded-xl object-contain shadow-2xl">

    {{-- Next --}}
    <button x-show="images.length > 1" @click="nav(1)"
            class="absolute right-5 top-1/2 -translate-y-1/2 w-12 h-12 rounded-full bg-white/12
                   hover:bg-white/25 flex items-center justify-center text-white text-2xl transition-colors">
        ›
    </button>

    {{-- Caption --}}
    <div x-text="caption"
         class="absolute bottom-7 left-1/2 -translate-x-1/2 text-white/80 text-sm text-center max-w-lg">
    </div>
</div>

@push('scripts')
<script>
// Extend Alpine component with nav helper
document.addEventListener('alpine:init', () => {
    // nav() is defined inline in x-data via a method — we just need it in scope
});
</script>
@endpush
