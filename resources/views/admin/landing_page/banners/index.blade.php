@extends('layouts.admin')

@section('content')
    <div class="flex-1 p-8 bg-white min-h-screen font-sans">
        @livewire('admin.banner-index')
    </div>

    {{-- Modal Hapus (Tetap di sini) --}}
    <div id="deleteModal" class="hidden fixed inset-0 z-[60] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
        <div class="bg-white w-full max-w-sm p-8 text-center animate-fadeIn">
            <h3 class="text-lg font-bold mb-2">Hapus Banner?</h3>
            <p class="text-sm text-gray-500 mb-8">Tindakan ini permanen.</p>
            <div class="flex flex-col gap-3">
                <form id="deleteForm" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="w-full py-3 bg-red-600 text-white font-bold">YA, HAPUS</button>
                </form>
                <button onclick="closeModal()" class="w-full py-3 border font-bold">BATAL</button>
            </div>
        </div>
    </div>

    <script>
        function prepareDelete(actionUrl) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        
        form.action = actionUrl; 
        modal.classList.remove('hidden');
        
        // Opsional: Mencegah scroll pada body saat modal buka
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        
        // Kembalikan scroll body
        document.body.style.overflow = 'auto';
    }

    // Menutup modal jika user klik di area backdrop (luar kotak putih)
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target == modal) {
            closeModal();
        }
    }

        let debounceTimer;

        function searchWithDebounce(input) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                const form = document.getElementById('sortForm');
                let hiddenInput = form.querySelector('input[name="search"]');
                if (!hiddenInput) {
                    hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'search';
                    form.appendChild(hiddenInput);
                }
                hiddenInput.value = input.value;
                form.submit();
            }, 600);
        }
    </script>

    <style>
        /* Hapus translate-y dari animasi */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out;
        }
    </style>
@endsection
