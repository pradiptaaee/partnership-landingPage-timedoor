@extends('layouts.admin')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">{{ $activity->title }}</h3>
        <a href="{{ route('admin.activity.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Featured Image --}}
    @if($activity->featured_image)
        <div class="mb-4">
            <img src="{{ asset('storage/activity/featured/' . $activity->featured_image) }}"
                 class="img-fluid rounded shadow-sm"
                 alt="{{ $activity->title }}" width="300">
        </div>
    @endif

    {{-- Informasi Utama --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="fw-semibold">Informasi Kegiatan</h5>
            <p><strong>Partner:</strong> {{ $activity->partner->name ?? '-' }}</p>
            <p><strong>Tanggal:</strong> {{ $activity->activity_date }}</p>
            <p><strong>Deskripsi Singkat:</strong> {{ $activity->short_description }}</p>
        </div>
    </div>

    {{-- Deskripsi Lengkap --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="fw-semibold">Deskripsi Lengkap</h5>
            <div>{!! nl2br(e($activity->full_description)) !!}</div>
        </div>
    </div>

    {{-- Gallery Photo --}}
    <h5 class="fw-semibold mb-2">Foto Kegiatan</h5>

    @if($activity->photos->count() > 0)
        <div class="row">
            @foreach($activity->photos as $photo)
                <div class="col-md-3 mb-3">
                    <img src="{{ asset('storage/activity/photos/' . $photo) }}"
                         class="img-fluid rounded-3 shadow-sm">
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted">Tidak ada foto tambahan.</p>
    @endif

</div>
@endsection
