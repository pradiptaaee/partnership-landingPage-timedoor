@extends('layouts.admin')

@section('content')
<div class="flex-1 p-4 bg-gray-50/50 min-h-screen font-sans">
    
    <div class="max-w-7xl mx-auto space-y-8">

        {{-- 1. HEADER: Greeting & Date --}}
        <div class="flex flex-col md:flex-row justify-between items-end gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-[#0f5132] tracking-tight">Dashboard</h1>
                <p class="text-gray-500 mt-1 text-sm">Selamat datang, Admin! Berikut ringkasan performa Academy hari ini.</p>
            </div>
            <div class="px-4 py-2 bg-white rounded-full shadow-sm border border-gray-100 flex items-center gap-2 text-sm text-gray-600 font-medium">
                <i class="bi bi-calendar-week text-[#0f5132]"></i>
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
        </div>

        {{-- 2. STATS CARDS (4 Kolom) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            {{-- Card 1: Partners --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.02)] hover:-translate-y-1 transition-transform duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center text-[#0f5132]">
                        <i class="bi bi-buildings-fill text-lg"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Partner</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalPartners }}</h3>
                <p class="text-xs text-gray-500 mt-1">Perusahaan & Sekolah</p>
            </div>

            {{-- Card 2: Activities This Month --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.02)] hover:-translate-y-1 transition-transform duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                        <i class="bi bi-calendar-event-fill text-lg"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Kegiatan</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalActivities }}</h3>
                <p class="text-xs text-gray-500 mt-1">Seluruh riwayat kegiatan</p>
            </div>

            {{-- Card 3: Projects --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.02)] hover:-translate-y-1 transition-transform duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-10 h-10 rounded-full bg-purple-50 flex items-center justify-center text-purple-600">
                        <i class="bi bi-laptop-fill text-lg"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Etalase</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalProjects }}</h3>
                <p class="text-xs text-gray-500 mt-1">Karya Siswa</p>
            </div>

            {{-- Card 4: Testimonials --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.02)] hover:-translate-y-1 transition-transform duration-300">
                <div class="flex justify-between items-start mb-4">
                    <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-600">
                        <i class="bi bi-chat-quote-fill text-lg"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Review</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalTestimonials }}</h3>
                <p class="text-xs text-gray-500 mt-1">Total Testimoni</p>
            </div>
        </div>

        {{-- 3. MAIN CONTENT GRID (Agenda & Quick Action) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- KOLOM KIRI (2/3): AGENDA KEGIATAN --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Upcoming Activities Panel --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-[#0f5132]">Agenda Mendatang</h3>
                        <a href="{{ route('admin.activity.index') }}" class="text-xs font-semibold text-gray-400 hover:text-[#0f5132] transition">Lihat Semua</a>
                    </div>

                    <div class="space-y-4">
                        @forelse($upcomingActivities as $activity)
                            <div class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 border border-gray-100 hover:bg-white hover:shadow-md transition-all duration-200">
                                {{-- Date Badge --}}
                                <div class="flex flex-col items-center justify-center w-14 h-14 bg-white rounded-lg shadow-sm border border-gray-100 shrink-0">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase">{{ \Carbon\Carbon::parse($activity->activity_date)->format('M') }}</span>
                                    <span class="text-xl font-bold text-[#0f5132]">{{ \Carbon\Carbon::parse($activity->activity_date)->format('d') }}</span>
                                </div>
                                
                                {{-- Content --}}
                                <div class="flex-1">
                                    <h4 class="font-bold text-gray-800 text-sm line-clamp-1">{{ $activity->title }}</h4>
                                    <p class="text-xs text-gray-500 mt-0.5 flex items-center gap-1">
                                        <i class="bi bi-building"></i> {{ $activity->partner->name ?? 'Partner' }}
                                    </p>
                                </div>

                                {{-- Status (Visual Only) --}}
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold bg-blue-50 text-blue-600 border border-blue-100">
                                    Segera
                                </span>
                            </div>
                        @empty
                            <div class="text-center py-8 text-gray-400">
                                <i class="bi bi-calendar-x text-3xl mb-2 block"></i>
                                <span class="text-sm">Tidak ada agenda dalam waktu dekat.</span>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Recent Projects Added (Log Simpel) --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h3 class="text-lg font-bold text-[#0f5132] mb-4">Project Siswa Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-gray-400 uppercase bg-gray-50/50">
                                <tr>
                                    <th class="px-4 py-3 rounded-l-lg">Murid</th>
                                    <th class="px-4 py-3">Tipe</th>
                                    <th class="px-4 py-3 rounded-r-lg text-right">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($latestProjects as $project)
                                    <tr>
                                        <td class="px-4 py-3 font-medium text-gray-800">{{ $project->student_name }}</td>
                                        <td class="px-4 py-3 text-gray-500">{{ $project->project_type }}</td>
                                        <td class="px-4 py-3 text-gray-400 text-right">{{ $project->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            {{-- KOLOM KANAN (1/3): QUICK ACTION & SYSTEM STATUS --}}
            <div class="lg:col-span-1 space-y-6">
                
                {{-- Quick Actions Card --}}
                <div class="bg-[#0f5132] rounded-2xl p-6 shadow-lg text-white relative overflow-hidden">
                    {{-- Decorative Circle --}}
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    
                    <h3 class="text-lg font-bold mb-4 relative z-10">Aksi Cepat</h3>
                    <div class="grid grid-cols-2 gap-3 relative z-10">
                        <a href="{{ route('admin.partners.create') }}" class="flex flex-col items-center justify-center p-3 bg-white/10 hover:bg-white/20 rounded-xl transition backdrop-blur-sm border border-white/5">
                            <i class="bi bi-building-add text-xl mb-1"></i>
                            <span class="text-[10px] font-medium">Partner</span>
                        </a>
                        <a href="{{ route('admin.activity.create') }}" class="flex flex-col items-center justify-center p-3 bg-white/10 hover:bg-white/20 rounded-xl transition backdrop-blur-sm border border-white/5">
                            <i class="bi bi-calendar-plus text-xl mb-1"></i>
                            <span class="text-[10px] font-medium">Kegiatan</span>
                        </a>
                        <a href="{{ route('admin.projects.create') }}" class="flex flex-col items-center justify-center p-3 bg-white/10 hover:bg-white/20 rounded-xl transition backdrop-blur-sm border border-white/5">
                            <i class="bi bi-laptop text-xl mb-1"></i>
                            <span class="text-[10px] font-medium">Project</span>
                        </a>
                        <a href="{{ route('admin.banners.index') }}" class="flex flex-col items-center justify-center p-3 bg-white/10 hover:bg-white/20 rounded-xl transition backdrop-blur-sm border border-white/5">
                            <i class="bi bi-images text-xl mb-1"></i>
                            <span class="text-[10px] font-medium">Banner</span>
                        </a>
                    </div>
                </div>

                {{-- System Status / Info --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h3 class="text-sm font-bold text-gray-800 mb-4 uppercase tracking-wider">Status Sistem</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Server Status
                            </span>
                            <span class="font-semibold text-emerald-600">Online</span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-500 flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span> Database
                            </span>
                            <span class="font-semibold text-gray-700">Connected</span>
                        </div>
                
                    </div>

                    <div class="mt-6 pt-4 border-t border-gray-50">
                        <p class="text-xs text-gray-400 text-center">
                            Last login: {{ now()->subMinutes(12)->diffForHumans() }}
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection