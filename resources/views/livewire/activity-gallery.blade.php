<div x-data="{ open: @entangle('open') }" class="mt-5">

    <h3 class="fw-bold mb-4" style="color:#001D7A">Galeri Dokumentasi</h3>

    <div class="gallery-masonry">
        @foreach ($activity->photos as $i => $photo)
            <div class="gallery-item">
                <img
                    src="{{ asset('storage/activity/photos/'.$photo->image_path) }}"
                    alt="Dokumentasi Kegiatan"
                    @click="$wire.openLightbox({{ $i }})"
                >
            </div>
        @endforeach
    </div>

    {{-- LIGHTBOX --}}
    <div
        x-show="open"
        x-transition
        @click.self="$wire.closeLightbox()"
        class="lightbox-overlay"
    >
        <button class="lightbox-btn left" @click.stop="$wire.prev()">‹</button>

        <img
            src="{{ isset($activity->photos[$activeIndex])
                ? asset('storage/activity/photos/'.$activity->photos[$activeIndex]->image_path)
                : '' }}"
            class="lightbox-image"
        >

        <button class="lightbox-btn right" @click.stop="$wire.next()">›</button>
        <button class="lightbox-close" @click="$wire.closeLightbox()">✕</button>
    </div>

</div>
