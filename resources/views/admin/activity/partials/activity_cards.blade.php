@foreach($activities as $activity)
{{-- WAJIB: Tambahkan <div class="col"> di sini --}}
<div class="col"> 
    <div class="card h-100 shadow-sm border-0 activity-card">
        <div class="position-relative">
            {{-- Featured Image --}}
            @if($activity->featured_image)
            <img src="{{ asset('storage/' . $activity->featured_image) }}" 
                 class="card-img-top" 
                 alt="{{ $activity->title }}"
                 style="height: 200px; object-fit: cover;">
            @else
            <div class="bg-light d-flex align-items-center justify-content-center" 
                 style="height: 200px;">
                <i class="bi bi-image fa-3x text-muted" style="font-size: 3rem;"></i>
            </div>
            @endif
            
            {{-- Partner Badge --}}
            <div class="position-absolute top-0 start-0 m-2">
                <span class="badge bg-success">{{ $activity->partner->name }}</span>
            </div>

            {{-- Photo Count Badge --}}
            @if($activity->photos && $activity->photos->count() > 0)
            <div class="position-absolute top-0 end-0 m-2">
                <span class="badge bg-dark">
                    <i class="bi bi-images me-1"></i>{{ $activity->photos->count() }}
                </span>
            </div>
            @endif
        </div>

        <div class="card-body d-flex flex-column">
            <h5 class="card-title mb-2">{{ Str::limit($activity->title, 50) }}</h5>
            
            <p class="card-text text-muted small mb-3 flex-grow-1">
                {{ Str::limit($activity->short_description, 100) }}
            </p>

            <div class="mb-3">
                <small class="text-muted">
                    <i class="bi bi-calendar-event me-1"></i>
                    {{ \Carbon\Carbon::parse($activity->activity_date)->format('d M Y') }}
                </small>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.activity.edit', $activity->id) }}" 
                   class="btn btn-sm btn-warning text-white flex-fill">
                    <i class="bi bi-pencil-square me-1"></i>Edit
                </a>
                <form action="{{ route('admin.activity.destroy', $activity->id) }}" 
                      method="POST" 
                      class="flex-fill"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger w-100">
                        <i class="bi bi-trash me-1"></i>Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="card-footer bg-light border-0">
            <small class="text-muted">
                <i class="bi bi-clock me-1"></i>
                Dibuat {{ $activity->created_at->diffForHumans() }}
            </small>
        </div>
    </div>
</div> {{-- WAJIB: Penutup <div class="col"> --}}
@endforeach