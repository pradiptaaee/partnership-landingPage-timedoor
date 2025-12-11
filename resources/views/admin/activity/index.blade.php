@extends('layouts.admin')

@section('title', 'Manajemen Kegiatan Partner')

@section('content')
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1 text-gray-800">Manajemen Kegiatan Partner</h1>
                <p class="text-muted mb-0">Kelola seluruh kegiatan dan aktivitas partner</p>
            </div>
            <div class="d-flex gap-2">
                {{-- Tombol Kembali ke Partner --}}
                <a href="{{ route('admin.partners.index') }}" class="btn btn-outline-secondary d-flex align-items-center">
                    <i class="bi bi-arrow-left me-2"></i>Kembali ke Partner
                </a>
                {{-- Tombol Tambah Kegiatan --}}
                <a href="{{ route('admin.activity.create') }}" class="btn btn-primary d-flex align-items-center">
                    <i class="bi bi-plus-lg me-2"></i>Tambah Kegiatan
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0 mb-4 rounded-3">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.activity.index') }}" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label small text-muted">Cari Kegiatan</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari judul kegiatan..."
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Partner</label>
                        <select name="partner_id" class="form-select">
                            <option value="">Semua Partner</option>
                            @foreach (\App\Models\Partner::orderBy('name')->get() as $partner)
                                <option value="{{ $partner->id }}"
                                    {{ request('partner_id') == $partner->id ? 'selected' : '' }}>
                                    {{ $partner->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label small text-muted">Urutkan</label>
                        <select name="sort" class="form-select">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                            <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Judul A-Z</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit"
                            class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                            <i class="bi bi-funnel-fill me-1"></i>Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">
           
            @include('admin.activity.partials.activity_cards')
            
        </div>

        {{-- @if ($activities->hasMorePages() || $activities->total() > 0)
            <div id="load-more-section" class="d-flex justify-content-center mb-5 mt-4">
                @if ($activities->hasMorePages())
                    <button id="load-more-btn" class="btn btn-outline-primary px-4 py-2"
                        data-next-page="{{ $activities->nextPageUrl() }}">
                        <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
                        Tampilkan Lebih Banyak Kegiatan
                    </button>
                @else
                    <p class="text-muted small">Semua kegiatan sudah ditampilkan (Total: {{ $activities->total() }}).</p>
                @endif
            </div>
        @endif --}}

        @if ($activities->hasPages())
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Menampilkan {{ $activities->firstItem() }} - {{ $activities->lastItem() }} dari
                    {{ $activities->total() }} kegiatan
                </div>
                <div>
                    {{ $activities->links('pagination::bootstrap-5') }}
                </div>
            </div>
        @endif
    </div>

    <style>
        /* Styling yang sudah ada tetap dipertahankan */
        .activity-card {
            transition: transform 0.2s, box-shadow 0.2s;
            border-radius: 0.5rem;
            overflow: hidden;
        }



        .card-img-top {
            border-radius: 0;
        }

        .badge {
            font-weight: 500;
        }
    </style>
@endsection

{{-- PENTING: Tambahkan blok script ini --}}
{{-- @push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let loadMoreBtn = $('#load-more-btn');
    let nextPageUrl = loadMoreBtn.data('next-page');

    if (loadMoreBtn.length > 0) {
        loadMoreBtn.on('click', function() {
            let button = $(this);
            let spinner = button.find('.spinner-border');
            
            // Nonaktifkan tombol dan tampilkan spinner
            button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Memuat...');

            if (nextPageUrl) {
                $.ajax({
                    url: nextPageUrl,
                    type: 'GET',
                    // Mengirimkan parameter filter saat ini agar hasil load more sesuai filter
                    data: {
                        search: $('input[name="search"]').val(), 
                        partner_id: $('select[name="partner_id"]').val(),
                        sort: $('select[name="sort"]').val(),
                    },
                    success: function(response) {
                        // Masukkan cards baru ke container
                        $('#activity-container').append(response.html);

                        // Update URL halaman selanjutnya
                        nextPageUrl = response.next_page_url;

                        // Cek apakah masih ada halaman selanjutnya
                        if (nextPageUrl) {
                            button.data('next-page', nextPageUrl);
                            button.html('<i class="bi bi-arrow-down-circle me-2"></i>Tampilkan Lebih Banyak Kegiatan');
                        } else {
                            // Jika tidak ada lagi, hapus tombol dan tampilkan status
                            $('#load-more-section').html('<p class="text-muted small">Semua kegiatan sudah ditampilkan.</p>');
                        }
                    },
                    error: function(xhr) {
                        alert('Gagal memuat data. Silakan coba lagi.');
                    },
                    complete: function() {
                        // Aktifkan kembali tombol jika masih ada halaman berikutnya
                        if (nextPageUrl) {
                            button.prop('disabled', false);
                        }
                    }
                });
            }
        });
    }

    // Ketika form filter di submit, tombol Load More harus direset
    $('#filter-form').on('submit', function() {
        // Ini memastikan form berjalan normal saat di-submit untuk mendapatkan paginasi awal
        // Jika Anda ingin filter juga menggunakan AJAX, logikanya akan lebih kompleks
        return true; 
    });
});
</script>
@endpush --}}
