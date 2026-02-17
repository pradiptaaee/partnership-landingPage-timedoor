{{-- resources/views/livewire/admin/trial-badge.blade.php --}}
<div wire:poll.15s>
    @if($count > 0)
        @if($type == 'main')
            {{-- Badge angka untuk menu utama Landing Page --}}
            <span class="absolute right-12 flex items-center justify-center min-w-[18px] h-4.5 px-1 text-[9px] font-black text-white bg-red-600 rounded-full shadow-sm">
                {{ $count }}
            </span>
        @else
            {{-- Badge angka untuk sub-menu Trial Bookings --}}
            <span class="flex items-center justify-center min-w-[20px] h-5 px-1 text-[10px] font-black text-white bg-red-600 rounded-full shadow-sm">
                {{ $count }}
            </span>
        @endif
    @endif
</div>