<div>
    {{-- FLASH MESSAGE --}}
    @if (session()->has('success_message'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success_message') }}
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- FORM --}}
    <div class="card shadow-sm">
        <div class="card-header fw-bold">
            Edit Kegiatan Partner
        </div>

        <div class="card-body">
            <form wire:submit.prevent="update" class="row g-3">

                {{-- PARTNER --}}
                <div class="col-md-6">
                    <label class="form-label">Partner</label>
                    <select wire:model="partner_id" class="form-select">
                        <option value="">-- Pilih Partner --</option>
                        @foreach($partners as $partner)
                            <option value="{{ $partner->id }}">
                                {{ $partner->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('partner_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- TANGGAL --}}
                <div class="col-md-6">
                    <label class="form-label">Tanggal Kegiatan</label>
                    <input type="date"
                           wire:model="activity_date"
                           class="form-control">
                    @error('activity_date') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- JUDUL --}}
                <div class="col-12">
                    <label class="form-label">Judul Kegiatan</label>
                    <input type="text"
                           wire:model="title"
                           class="form-control">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- DESKRIPSI SINGKAT --}}
                <div class="col-12">
                    <label class="form-label">Deskripsi Singkat</label>
                    <textarea wire:model="short_description"
                              class="form-control"
                              rows="2"></textarea>
                    @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- DESKRIPSI LENGKAP --}}
                <div class="col-12">
                    <label class="form-label">Deskripsi Lengkap</label>
                    <textarea wire:model="full_description"
                              class="form-control"
                              rows="5"></textarea>
                    @error('full_description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- FEATURED IMAGE --}}
                <div class="col-md-6">
                    <label class="form-label">Featured Image</label>

                    @if ($activity->featured_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/activity/featured/' . $activity->featured_image) }}"
                                 class="img-thumbnail"
                                 style="max-height: 160px">
                        </div>
                    @endif

                    <input type="file"
                           wire:model="featured_image"
                           class="form-control">

                    @error('featured_image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- UPLOAD FOTO BARU --}}
                <div class="col-md-6">
                    <label class="form-label">
                        Tambah Foto Kegiatan
                        <small class="text-muted">(maks. total 6)</small>
                    </label>

                    <input type="file"
                           wire:model="new_photos"
                           class="form-control"
                           multiple>

                    @error('new_photos') <small class="text-danger">{{ $message }}</small> @enderror
                    @error('new_photos.*') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                {{-- GALERI FOTO --}}
                <div class="col-12">
                    <label class="form-label fw-bold">Foto Kegiatan</label>

                    @if($activity->photos->count())
                        <div class="row g-3">
                            @foreach($activity->photos as $photo)
                                <div class="col-md-3 col-sm-4 col-6">
                                    <div class="position-relative">
                                        <img src="{{ asset('storage/activity/photos/' . $photo->image_path) }}"
                                             class="img-thumbnail w-100"
                                             style="height:150px;object-fit:cover">

                                        <button type="button"
                                                wire:click="deletePhoto({{ $photo->id }})"
                                                class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1"
                                                title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted fst-italic">
                            Belum ada foto kegiatan.
                        </p>
                    @endif
                </div>

                {{-- ACTION --}}
                <div class="col-12 text-end mt-3">
                    <a href="{{ route('admin.activity.index') }}"
                       class="btn btn-secondary me-2">
                        <i class="bi bi-arrow-left"></i>
                    </a>

                    <button class="btn btn-primary"
                            wire:loading.attr="disabled">
                        <span wire:loading.remove>
                            <i class="bi bi-save"></i>
                        </span>
                        <span wire:loading>
                            Menyimpan...
                        </span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

