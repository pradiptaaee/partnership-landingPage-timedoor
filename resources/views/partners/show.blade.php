@extends('layouts.app')

@section('title', $data['title'])

@section('content')
<div class="container py-5">

    <div class="card shadow-sm border-0 p-4">
        <img src="{{ $data['image'] }}"
            alt="{{ $data['title'] }}"
            class="img-fluid rounded mb-4"
            style="max-height: 350px; object-fit: cover; width: 100%;">

        <h2 class="fw-bold text-primary">{{ $data['title'] }}</h2>
        <p class="text-success fw-semibold">{{ $data['date'] }}</p>

        <p class="text-muted" style="font-size: 16px;">
            {{ $data['description'] }}
        </p>

        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-4">
            ← Kembali
        </a>
    </div>

</div>
@endsection