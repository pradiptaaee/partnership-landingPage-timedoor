@extends('layouts.admin')

@section('title', 'Manajemen Partner')

@section('content')
    <div class="container-fluid px-4 py-4">

        <h1 class="h2 fw-medium mb-4 text-dark">Manajemen Partner</h1>

        <div class="row g-4 mb-5">

            {{-- Card 1: Total Partner --}}
            <div class="col-md-4">
                <div class="card shadow-sm border-start  h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-people-fill text-success me-3 fs-2"></i>
                            <div>
                                <div class="text-success fw-bold text-uppercase small">Total Partner</div>
                                <div class="h5 mb-0 fw-bolder">{{ $totalPartners ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Card 2: Total Kategori --}}
            <div class="col-md-4">
                <div class="card shadow-sm border-start  h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-tags-fill text-info me-3 fs-2"></i>
                            <div>
                                <div class="text-info fw-bold text-uppercase small">Jumlah Kategori</div>
                                <div class="h5 mb-0 fw-bolder">{{ $totalCategories ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

          {{-- Card 3: Total Kegiatan --}}
            <div class="col-md-4">
                <div class="card shadow-sm border-start  h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-calendar-event-fill text-primary me-3 fs-2"></i>
                            <div>
                                <div class="text-primary fw-bold text-uppercase small">Total Kegiatan</div>
                                <div class="h5 mb-0 fw-bolder">{{ $totalActivities ?? 0 }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-white rounded-3 shadow-sm border">

            {{-- KIRI: Search & Filter --}}
            <div class="d-flex align-items-center gap-3">

                {{-- Placeholder Search --}}
                <div class="input-group" style="width: 300px;">
                    <input type="text" class="form-control" placeholder="Cari Partner..." aria-label="Cari Partner">
                    <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
                </div>

                {{-- Placeholder Filter --}}
                <button class="btn btn-outline-secondary d-flex align-items-center">
                    <i class="bi bi-filter me-1"></i> Filter
                </button>
            </div>

            {{-- KANAN: Tombol Tambah Partner (Add Product) --}}
            <a href="{{ route('admin.partners.create') }}" class="btn btn-primary d-flex align-items-center fw-semibold">
                <i class="bi bi-plus-lg me-2"></i> Tambah Partner
            </a>
        </div>


        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table  table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th style="width: 5%">
                                    <input type="checkbox" class="form-check-input">
                                </th>

                                <th style="width: 20%">Nama Partner</th>
                                <th style="width: 30%">Deskripsi</th>
                                <th style="width: 15%">Kategori</th>
                                <th style="width: 20%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($partners as $partner)
                                <tr>
                                    <td class="text-muted"><input type="checkbox" class="form-check-input"></td>

                                    <td class="fw-semibold text-dark">
                                        @if ($partner->logo)
                                            <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                                style="width: 40px; height: 40px; object-fit: contain; border-radius: 4px;"
                                                class="img-thumbnail p-1 border-0 bg-light">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center"
                                                style="width: 40px; height: 40px; border-radius: 4px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                        {{ $partner->name }}
                                    </td>

                                    <td>
                                        <small class="text-muted">
                                            {{ Str::limit($partner->description, 80, '...') ?: '-' }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-primary-subtle text-primary fw-normal py-2 px-3">
                                            {{ $partner->category }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex gap-2 justify-content-center">

                                            {{-- Lihat Kegiatan Button (Ikon Kalender/Aktivitas) --}}
                                            <a href="{{ route('admin.activity.index', ['partner_id' => $partner->id]) }}"
                                                class="btn btn-icon btn-sm bg-light" title="Lihat Kegiatan">
                                                <i class="bi bi-calendar-event text-success"></i>
                                            </a>

                                            {{-- Edit Button (Ikon Pensil) --}}
                                            <a href="{{ route('admin.partners.edit', $partner->id) }}"
                                                class="btn btn-icon btn-sm bg-light" title="Edit Partner">
                                                <i class="bi bi-pencil text-secondary"></i>
                                            </a>

                                            {{-- Delete Button (Ikon Sampah) --}}
                                            <form action="{{ route('admin.partners.destroy', $partner->id) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus partner ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-sm bg-light"
                                                    title="Hapus Partner">
                                                    <i class="bi bi-trash text-danger"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="bi bi-inbox-fill fs-3 mb-3"></i>
                                            <p class="mb-0">Belum ada partner yang terdaftar.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

            {{-- Pagination (Dipindahkan ke luar body card) --}}
            <div class="card-footer bg-white d-flex justify-content-between align-items-center border-0 py-3">
                @if ($partners->hasPages())
                    <div class="text-muted small">
                        Menampilkan {{ $partners->firstItem() }} - {{ $partners->lastItem() }} dari
                        {{ $partners->total() }} partner
                    </div>
                    <div>
                        {{ $partners->links('pagination::bootstrap-5') }} {{-- Memastikan menggunakan style Bootstrap 5 --}}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        /* CSS Kustom Tambahan untuk Index Content */

        /* Membuat tombol ikon lebih rapih */
        .btn-icon {
            width: 38px;
            height: 38px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px;
        }

        .btn-icon:hover {
            background: #636363;
        }

        /* Styling badge untuk menyerupai status di gambar */
        .bg-primary-subtle {
            background-color: #e7fff0 !important;
            color: #00ee73 !important;
        }

        /* Mengubah warna header table */
        .table thead th {
            border-bottom: 0px;
            color: #888;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
        }

        /* Mengurangi padding di tabel */
        .table> :not(caption)>*>* {
            padding: 1rem 0.75rem;
        }
    </style>
@endsection
