<div x-data="{ open: @entangle('open') }" class="mt-12">

    <h3 class="font-bold mb-6 text-[#001D7A] text-xl">
        {{ __('Galeri Dokumentasi') }}
    </h3>

    <!-- Masonry Style Grid -->
    <div class="columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">

        @foreach ($activity->photos as $i => $photo)
            <div class="break-inside-avoid overflow-hidden rounded-lg shadow-sm">
                <img
                    src="{{ asset('storage/activity/photos/'.$photo->image_path) }}"
                    alt="Dokumentasi Kegiatan"
                    class="w-full cursor-pointer hover:scale-105 transition duration-300"
                    @click="$wire.openLightbox({{ $i }})"
                >
            </div>
        @endforeach

    </div>

    <!-- LIGHTBOX -->
    <div
        x-show="open"
        x-transition
        x-cloak
        @click.self="$wire.closeLightbox()"
        class="fixed inset-0 bg-black/90 flex items-center justify-center z-50"
    >

        <!-- Prev -->
        <button
            class="absolute left-4 text-white text-4xl px-4 py-2 hover:opacity-70"
            @click.stop="$wire.prev()"
        >
            ‹
        </button>

        <!-- Image -->
        <img
            src="{{ isset($activity->photos[$activeIndex])
                ? asset('storage/activity/photos/'.$activity->photos[$activeIndex]->image_path)
                : '' }}"
            class="max-h-[85vh] max-w-[90vw] object-contain rounded-lg shadow-lg"
        >

        <!-- Next -->
        <button
            class="absolute right-4 text-white text-4xl px-4 py-2 hover:opacity-70"
            @click.stop="$wire.next()"
        >
            ›
        </button>

        <!-- Close -->
        <button
            class="absolute top-6 right-6 text-white text-2xl hover:opacity-70"
            @click="$wire.closeLightbox()"
        >
            ✕
        </button>

    </div>

    <style>
        [x-cloak] {
        display: none !important;
    }
    </style>
</div>
