
@extends('layouts.app')

@section('content')

<div class="d-flex gap-6">
    @foreach ($partners as $partner)
        <a href="{{ route('partners.show', $partner->slug) }}" class="block p-4 border bg-white shadow rounded">
            <img src="{{ asset('storage/' . $partner->image) }}" class="h-20 mx-auto mb-3">
            <h3 class="font-bold text-center">{{ $partner->name }}</h3>
            <p class="text-sm text-center text-gray-600">{{ ucfirst($partner->category) }}</p>
        </a>
    @endforeach
</div>
{{ $partners->links() }}

@endsection