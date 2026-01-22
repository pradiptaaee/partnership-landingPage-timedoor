@extends('layouts.admin')

@section('content')
    <div class="p-6">
        
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Edit Hero Section</h1>
                <p class="text-gray-500 mt-1 text-sm">Upload gambar banner untuk 7 bahasa.</p>
            </div>
             {{-- Tombol Kembali --}}
            <a href="{{ route('admin.hero.index') }}" class="btn-back-style...">Kembali</a>
        </div>

        <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- 
               KITA HAPUS BAGIAN INPUT TEKS DI SINI.
               JADI ADMIN TIDAK BISA MENGGANGGU TEKSNYA.
            --}}

            {{-- HANYA TAMPILKAN UPLOAD GAMBAR (Full Width) --}}
            <div class="w-full">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                        <h2 class="text-lg font-bold text-gray-800 flex items-center">
                            <span class="bg-white border border-gray-200 text-[#0f5132] w-8 h-8 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                                <i class="fas fa-images text-sm"></i>
                            </span>
                            Upload Gambar Per Bahasa
                        </h2>
                    </div>

                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @php
                            $languages = [
                                ['code' => 'id', 'name' => 'Indonesia', 'flag' => '🇮🇩'],
                                ['code' => 'en', 'name' => 'Inggris (Default)', 'flag' => '🇺🇸'],
                                ['code' => 'ja', 'name' => 'Jepang', 'flag' => '🇯🇵'],
                                ['code' => 'ar', 'name' => 'Arab', 'flag' => '🇸🇦'],
                                ['code' => 'bn', 'name' => 'Bengali', 'flag' => '🇧🇩'],
                                ['code' => 'fil', 'name' => 'Filipino', 'flag' => '🇵🇭'],
                                ['code' => 'ms', 'name' => 'Melayu', 'flag' => '🇲🇾'],
                            ];
                        @endphp

                        @foreach ($languages as $lang)
                            @php 
                                $col = 'image_' . $lang['code']; 
                                $currentImage = $hero->{$col};
                                $inputId = "input_" . $lang['code'];
                                $previewId = "preview_" . $lang['code'];
                            @endphp

                            <div class="border border-gray-200 rounded-xl p-4 hover:border-[#0f5132]/50 transition-colors bg-gray-50/30 group">
                                <div class="flex justify-between items-center mb-3">
                                    <label for="{{ $inputId }}" class="font-bold text-gray-700 text-sm cursor-pointer hover:text-[#0f5132]">
                                        <span class="text-lg mr-1">{{ $lang['flag'] }}</span> {{ $lang['name'] }}
                                    </label>
                                    <span class="text-[10px] font-mono text-gray-400 uppercase bg-gray-100 px-1.5 py-0.5 rounded">{{ $lang['code'] }}</span>
                                </div>
                                
                                <div class="aspect-video bg-gray-200 rounded-lg overflow-hidden mb-3 relative border border-gray-300 shadow-inner">
                                    @if ($currentImage)
                                        <img id="{{ $previewId }}" src="{{ asset('storage/' . $currentImage) }}" class="w-full h-full object-cover">
                                    @else
                                        <img id="{{ $previewId }}" src="" class="w-full h-full object-cover hidden">
                                        <div id="{{ $previewId }}_placeholder" class="flex flex-col items-center justify-center h-full text-gray-400 p-4 text-center">
                                            <i class="fas fa-image text-2xl mb-2 opacity-50"></i>
                                            <span class="text-[10px]">Belum ada gambar.</span>
                                        </div>
                                    @endif
                                </div>

                                <input type="file" id="{{ $inputId }}" name="{{ $col }}" accept="image/*"
                                       class="block w-full text-xs text-slate-500
                                       file:mr-4 file:py-2 file:px-4
                                       file:rounded-full file:border-0
                                       file:text-xs file:font-semibold
                                       file:bg-[#0f5132]/10 file:text-[#0f5132]
                                       hover:file:bg-[#0f5132]/20 cursor-pointer"
                                       onchange="previewImage(event, '{{ $previewId }}')">
                            </div>
                        @endforeach
                    </div>

                    <div class="p-6 border-t border-gray-100">
                        <button type="submit" class="w-full text-white bg-[#0f5132] hover:bg-[#0a3622] font-bold rounded-xl text-sm px-5 py-3.5 shadow-md flex items-center justify-center">
                            <i class="fas fa-save mr-2"></i> Simpan Gambar
                        </button>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <script>
        function previewImage(event, previewId) {
            const file = event.target.files[0];
            const previewImg = document.getElementById(previewId);
            const placeholder = document.getElementById(previewId + '_placeholder');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.classList.remove('hidden');
                    if(placeholder) placeholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection