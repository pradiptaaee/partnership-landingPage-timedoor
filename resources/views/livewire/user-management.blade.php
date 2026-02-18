{{-- PEMBUNGKUS UTAMA (ROOT ELEMENT) --}}
<div class="space-y-6">
    {{-- HEADER & SEARCH --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-2">
        <div class="relative flex-1 max-w-md">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                <i class="bi bi-search"></i>
            </span>
            <input wire:model.live="search" type="text"
                class="block w-full pl-10 pr-3 py-2.5 border border-gray-100 rounded-xl bg-white shadow-sm focus:ring-2 focus:ring-emerald-500/20 focus:border-[#0f5132] text-sm transition-all"
                placeholder="Cari nama atau email user...">
        </div>
        {{-- Tombol Tambah --}}
        <button wire:click="openModal"
            class="inline-flex items-center px-4 py-2.5 bg-[#0f5132] text-white text-sm font-bold rounded-xl hover:bg-[#0a3a24] transition-all shadow-sm">
            <i class="bi bi-plus-lg me-2"></i> Tambah User
        </button>
    </div>

    {{-- TABLE CONTAINER --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_15px_rgba(0,0,0,0.03)] overflow-hidden">
        @if ($users->count())
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider w-16">No
                            </th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Username
                            </th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Email
                            </th>
                            <th class="px-6 py-4 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Role /
                                Status</th>
                            <th
                                class="px-6 py-4 text-center text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50 text-sm">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                <td class="px-6 py-4 text-gray-400 font-mono">
                                    {{ $loop->iteration + ($users->firstItem() - 1) }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-gray-800 group-hover:text-[#0f5132] transition-colors">
                                        {{ $user->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                        Administrator
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <button wire:click="edit({{ $user->id }})"
                                            class="p-2 text-gray-400 hover:text-[#0f5132] hover:bg-emerald-50 rounded-lg transition">
                                            <i class="bi bi-pencil-square text-lg"></i>
                                        </button>
                                        <button type="button"
                                            wire:click="confirmUserDeletion({{ $user->id }})"
                                            class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                            title="Hapus User">
                                            <i class="bi bi-trash3 text-lg"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-gray-50 bg-white">
                {{ $users->links('component.pagination') }}
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-20 text-center">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mb-4 text-gray-300">
                    <i class="bi bi-people text-3xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800">Belum Ada User</h3>
                <p class="text-gray-500 text-sm mt-1">Silakan tambahkan data user baru.</p>
            </div>
        @endif
    </div>

    {{-- MODAL FORM - Dipastikan berada di dalam root div --}}
    @if ($showModal)
        <div class="fixed inset-0 z-[999] overflow-y-auto" role="dialog">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">

                {{-- Overlay abu-abu --}}
                <div class="fixed inset-0  bg-gray-800 opacity-20 backdrop-blur-sm transition-opacity" wire:click="closeModal"></div>

                {{-- Trick agar modal di tengah secara vertikal --}}
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                {{-- Form Card --}}
                <div
                    class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full z-[1000]">
                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}">
                        <div class="bg-white px-6 pt-6 pb-4">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="text-lg font-bold text-gray-800">
                                    {{ $isEdit ? 'Edit Data User' : 'Tambah User Baru' }}</h3>
                                <button type="button" wire:click="closeModal"
                                    class="text-gray-400 hover:text-gray-600 transition">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Nama
                                        Lengkap</label>
                                    <input type="text" wire:model="name" autocomplete="off"
                                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500/20 focus:border-[#0f5132] outline-none transition-all text-sm">
                                    @error('name')
                                        <span class="text-red-500 text-[10px] mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label
                                        class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Alamat
                                        Email</label>
                                    <input type="email" wire:model="email" autocomplete="new-password"
                                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500/20 focus:border-[#0f5132] outline-none transition-all text-sm">
                                    @error('email')
                                        <span class="text-red-500 text-[10px] mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">
                                        Password {{ $isEdit ? '(Kosongkan jika tidak diubah)' : '' }}
                                    </label>
                                    <input type="password" wire:model="password"
                                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:ring-2 focus:ring-emerald-500/20 focus:border-[#0f5132] outline-none transition-all text-sm">
                                    @error('password')
                                        <span class="text-red-500 text-[10px] mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 px-6 py-4 flex flex-row-reverse gap-2">
                            <button type="submit"
                                class="px-6 py-2.5 bg-[#0f5132] text-white text-sm font-bold rounded-xl hover:bg-[#0a3a24] transition-all shadow-sm">
                                {{ $isEdit ? 'Simpan Perubahan' : 'Daftarkan User' }}
                            </button>
                            <button type="button" wire:click="closeModal"
                                class="px-6 py-2.5 bg-white text-gray-600 text-sm font-bold rounded-xl border border-gray-200 hover:bg-gray-50 transition-all">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- DELETE MODAL --}}
    @if ($confirmingUserDeletion)
       
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-white/80 backdrop-blur-sm animate-fadeIn">
            <div class="bg-white w-full max-w-sm p-8 border border-gray-200 shadow-2xl animate-scaleIn text-center rounded-none">
                <h3 class="text-lg font-bold text-gray-900 mb-2">Hapus User?</h3>
                <p class="text-sm text-gray-500 leading-relaxed mb-8">
                    Tindakan ini permanen. Lanjutkan?
                </p>
                <div class="flex flex-col gap-3">
                    <button wire:click="deleteUser"
                            class="w-full px-4 py-3 bg-red-600 text-white text-sm font-bold hover:bg-red-700 transition">
                        YA, HAPUS
                    </button>
                    <button wire:click="$set('confirmingUserDeletion', false)" 
                            class="w-full px-4 py-3 bg-white border border-gray-200 text-gray-900 text-sm font-bold hover:bg-gray-50 transition">
                        BATAL
                    </button>
                </div>
            </div>
        </div>
   
    @endif


</div>

{{-- <script>
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "User " + name + " akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0f5132', // Warna hijau senada tema Anda
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Memanggil fungsi delete di component Livewire
                @this.call('delete', id);
            }
        })
    }
</script> --}}
