@extends('layouts.admin')

@section('content')
    <section>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-4" style="color: #0C3D8F; font-weight: 700;">User Management</h2>

                    {{-- Memanggil Komponen Livewire --}}
                    @livewire('user-management')
                </div>
            </div>
        </div>
    </section>
    <script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('swal:success', (event) => {
            Swal.fire({
                title: event[0].title,
                text: event[0].text,
                icon: 'success',
                confirmButtonColor: '#0f5132',
                timer: 3000 // Otomatis tutup dalam 3 detik
            });
        });
    });
</script>
@endsection
