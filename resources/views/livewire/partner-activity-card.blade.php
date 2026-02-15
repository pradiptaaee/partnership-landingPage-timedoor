<div>
    <!-- ========== SEARCH & FILTER ========== -->
    <div class="container my-5">
        <div class="search-wrapper mx-auto py-3 px-4 shadow-sm" style="border-radius: 15px; background: #ffffff;">

            <div class="d-flex gap-3">
                <!-- SEARCH INPUT -->
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text" wire:model.live.debounce.300ms="search" class="form-control border-start-0"
                        placeholder="Cari kegiatan spesifik..." style="box-shadow:none;">
                </div>

                <!-- FILTER DROPDOWN -->
                <div class="dropdown">
                    <button class="btn btnFilter px-4 dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false" style="border-radius: 10px; border:1px solid #10A300; color:#10A300;">
                        Filter
                    </button>

                    <ul class="dropdown-menu p-3 shadow-sm" style="width: 250px;">
                        <li>
                            <label class="form-label fw-semibold">Jenis Kegiatan</label>
                            <select wire:model.live="category" class="form-select mb-3">
                                <option value="">Semua</option>
                                <option value="Workshop">Workshop</option>
                                <option value="Seminar">Seminar</option>
                                <option value="Pelatihan">Pelatihan</option>
                            </select>
                        </li>

                        <li>
                            <label class="form-label fw-semibold">Tahun Kegiatan</label>
                            <select wire:model.live="year" class="form-select mb-3">
                                <option value="">Semua Tahun</option>
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                            </select>
                        </li>

                        <li class="mt-2 text-end">
                            <button type="button" wire:click="resetFilters" class="btn btn-outline-secondary btn-sm"
                                style="border-radius: 10px;">
                                Reset
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== LOADING INDICATOR ========== -->
    <div wire:loading class="text-center my-4">
        <div class="spinner-border text-success" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- ========== CONTAINER + ROW untuk CARDS ========== -->
    <div class="container" wire:loading.remove>
        <div class="row g-4">
            @forelse ($activities as $activity)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden">
                        <div class="position-relative">
                            <div class="position-absolute top-0 start-0 m-3 z-1">
                                <span class="badge px-3 py-2 shadow-sm"
                                    style="background-color: rgba(144, 249, 163, 0.442); backdrop-filter: blur(4px); border-radius: 10px; font-weight: 600;">
                                    <i class="bi bi-building me-1"></i>
                                    {{ $activity->partner->name ?? '' }}
                                </span>
                            </div>

                            @if ($activity->featured_image_url)
                                <img src="{{ $activity->featured_image_url }}" class="card-img-top"
                                    alt="{{ $activity->title }}" style="height: 200px; object-fit: cover;">
                            @else
                                <div class="card-img-top d-flex align-items-center justify-content-center bg-light border-bottom"
                                    style="height: 200px;">
                                    <div class="text-center">
                                        <i class="bi bi-image text-secondary" style="font-size: 3rem;"></i>
                                        <p class="text-muted small mb-0">No Image</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column p-4">
                            <div>
                                <p style="color: #10A300; font-size: 14px; font-weight: 600;">
                                    {{ $activity->activity_date->translatedFormat('d F Y') }}
                                </p>

                                <h5 style="font-weight: 700; font-size: 18px; color: #0C3D8F;">
                                    {{ $activity->title }}
                                </h5>

                                <p class="text-muted description-clamp">
                                    {{ \Illuminate\Support\Str::words(strip_tags($activity->full_description), 8, '...') }}
                                </p>
                            </div>

                            <div class=" mt-auto">
                                <a href="{{ route('partnership.show', $activity->slug) }}" class="btn btn-primary mt-3 w-full"
                                    style="background: linear-gradient(135deg, #10A300 0%, #0d8500 100%); border: none; border-radius: 25px; padding: 10px 25px;">
                                    <i class="bi bi-eye me-2"></i>Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                    <p class="text-muted mt-3">Tidak ada kegiatan ditemukan.</p>
                </div>
            @endforelse
        </div>

        <!-- ========== PAGINATION ========== -->
        @if ($activities->hasPages())
            <div class="mt-5 d-flex justify-content-between">
                {{ $activities->links('component.pagination') }}
            </div>
        @endif
    </div>
</div>
