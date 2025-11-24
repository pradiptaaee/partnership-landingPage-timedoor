@extends('layouts.admin')

@section('title', 'Manajemen Partner')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800">Manajemen Partner</h1>
            <p class="text-muted mb-0">Kelola daftar partner dan kegiatan mereka</p>
        </div>
        <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Partner
        </a>
    </div>
    <div class="d-flex">
        <a href="{{ route('admin.activity.index') }}" class="btn btn-success">
           Lihat Kagiatan
        </a>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <!-- Partners Table Card -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Partner</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 10%">Logo</th>
                            <th style="width: 20%">Nama Partner</th>
                            <th style="width: 15%">Kategori</th>
                            <th style="width: 30%">Deskripsi</th>
                            <th style="width: 20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($partners as $partner)
                        <tr>
                            <td class="text-muted">{{ $loop->iteration + ($partners->currentPage() - 1) * $partners->perPage() }}</td>
                            <td>
                                @if($partner->logo)
                                <img src="{{ asset('storage/' . $partner->logo) }}" 
                                     alt="{{ $partner->name }}" 
                                     class="img-thumbnail" 
                                     style="width: 60px; height: 60px; object-fit: contain;">
                                @else
                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                     style="width: 60px; height: 60px; border-radius: 4px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $partner->name }}</strong>
                            </td>
                            <td>
                                <span class="badge bg-info text-dark">{{ $partner->category }}</span>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ Str::limit($partner->description, 80, '...') ?: '-' }}
                                </small>
                            </td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <!-- Lihat Kegiatan Button -->
                                    <a href="{{ route('admin.activity.index', ['partner_id' => $partner->id]) }}" 
                                       class="btn btn-sm btn-success" 
                                       title="Lihat Kegiatan">
                                        <i class="fas fa-calendar-alt me-1"></i>Kegiatan
                                    </a>
                                    
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.partners.edit', $partner->id) }}" 
                                       class="btn btn-sm btn-warning text-white" 
                                       title="Edit Partner">
                                        <i class="fas fa-edit"></i>Edit
                                    </a>
                                    
                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.partners.destroy', $partner->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus partner ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus Partner">
                                            <i class="fas fa-trash"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3"></i>
                                    <p class="mb-0">Belum ada partner yang terdaftar.</p>
                                    <a href="{{ route('admin.partners.create') }}" class="btn btn-sm btn-primary mt-2">
                                        Tambah Partner Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($partners->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Menampilkan {{ $partners->firstItem() }} - {{ $partners->lastItem() }} dari {{ $partners->total() }} partner
                </div>
                <div>
                    {{ $partners->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.table-hover tbody tr:hover {
    background-color: #f8f9fc;
}

.btn-group-sm .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

.card {
    border-radius: 0.5rem;
}

.alert {
    border-radius: 0.5rem;
}
</style>
@endsection