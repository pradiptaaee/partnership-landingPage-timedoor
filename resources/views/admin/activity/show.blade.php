@extends('layouts.admin')

@section('content')
<h4 class="fw-bold mb-4">Detail Aktivitas</h4>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="fw-bold">{{ $activity->title }}</h5>
        <p class="mb-1"><strong>Partner:</strong> {{ $activity->partner->name }}</p>
        <p class="mb-1"><strong>Tanggal:</strong> {{ $activity->date }}</p>
        <p class="mt-3">{{ $activity->description }}</p>
    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Upload Foto Baru</h5>

        <form action="{{ route('admin.activity-photos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="activity_id" value="{{ $activity->id }}">

            <input type="file" name="photos[]" class="form-control mb-3" multiple>
            <button class="btn btn-primary">Upload</button>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Galeri Foto</h5>

        <div class="row g-3">
            @foreach($activity->photos as $photo)
            <div class="col-md-3">
                <div class="card border-0">
                    <img src="{{ asset('storage/'.$photo->image) }}" class="rounded mb-2 w-100" style="height: 160px; object-fit: cover;">
                    <form action="{{ route('admin.activity-photos.destroy', $photo->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus foto?')" class="btn btn-sm btn-danger w-100">Hapus</button>
                    </form>
                </div>
            </div>
            @endforeach

            @if($activity->photos->isEmpty())
            <p class="text-muted">Belum ada foto kegiatan.</p>
            @endif
        </div>
    </div>
</div>
@endsection
