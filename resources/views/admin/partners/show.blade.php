@extends('layouts.admin')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0">Detail Partner</h3>
        <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row mb-4">
                <div class="col-md-4 text-center">
                    @if($partner->gambar)
                        <img src="{{ asset('storage/' . $partner->gambar) }}" 
                             class="img-fluid rounded border" 
                             alt="Logo {{ $partner->nama }}">
                    @else
                        <div class="text-muted fst-italic">Tidak ada gambar</div>
                    @endif
                </div>

                <div class="col-md-8">
                    <table class="table table-borderless">
                        <tr>
                            <th width="180">Nama Partner</th>
                            <td>{{ $partner->nama }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            <td>{{ $partner->category }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>{{ $partner->slug }}</td>
                        </tr>
                        <tr>
                            <th>Dibuat Pada</th>
                            <td>{{ $partner->created_at->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Diupdate Pada</th>
                            <td>{{ $partner->updated_at->format('d M Y') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr>

            <h5>Deskripsi Partnership</h5>
            <p class="text-muted">{{ $partner->deskripsi }}</p>

            @if($partner->deskripsi_kegiatan)
                <h5 class="mt-4">Deskripsi Kegiatan</h5>
                <p class="text-muted">{{ $partner->deskripsi_kegiatan }}</p>
            @endif

        </div>
    </div>

</div>
@endsection
