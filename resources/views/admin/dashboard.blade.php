@extends('layouts.admin')

@section('content')
<div class="flex-1 p-4 bg-gray-50/50 min-h-screen font-sans">
    
    <div class="max-w-7xl mx-auto space-y-8">

        {{-- 1. HEADER: Greeting & Date --}}
        <div class="flex flex-col md:flex-row justify-between items-end gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-[#0f5132] tracking-tight uppercase">Dashboard Overview</h1>
                <p class="text-gray-500 mt-1 text-sm font-medium">Selamat datang kembali, Admin! Pantau performa akademi hari ini.</p>
            </div>
            <div class="px-4 py-2 bg-white rounded-full shadow-sm border border-gray-100 flex items-center gap-2 text-sm text-gray-600 font-medium">
                <i class="bi bi-calendar-week text-[#0f5132]"></i>
                {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
            </div>
        </div>

        {{-- 2. STATS CARDS (5 Kolom) --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            
            {{-- Card 1: Free Trial --}}
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.02)] hover:-translate-y-1 transition-transform duration-300">
                <div class="flex justify-between items-start mb-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center text-orange-600">
                        <i class="bi bi-person-badge-fill text-lg"></i>
                    </div>
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Trials</span>
                </div>
                <h3 class="text-2xl font-black text-gray-800">{{ $totalFreeTrials }}</h3>
                <p class="text-[10px] font-bold text-gray-400 mt-1 uppercase">Pendaftar</p>
            </div>

            {{-- Card 2: Partners --}}
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.02)] hover:-translate-y-1 transition-transform duration-300">
                <div class="flex justify-between items-start mb-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-[#0f5132]">
                        <i class="bi bi-buildings-fill text-lg"></i>
                    </div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Partner</span>
                </div>
                <h3 class="text-2xl font-black text-gray-800">{{ $totalPartners }}</h3>
                <p class="text-[10px] font-bold text-gray-400 mt-1 uppercase">Institusi</p>
            </div>

            {{-- Card 3: Events/Activities --}}
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.02)] hover:-translate-y-1 transition-transform duration-300">
                <div class="flex justify-between items-start mb-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                        <i class="bi bi-calendar-event-fill text-lg"></i>
                    </div>
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Events</span>
                </div>
                <h3 class="text-3xl font-bold text-gray-800">{{ $totalActivities }}</h3>
                <p class="text-xs text-gray-500 mt-1">Seluruh riwayat kegiatan</p>
            </div>

            {{-- Card 4: Projects --}}
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.02)] hover:-translate-y-1 transition-transform duration-300">
                <div class="flex justify-between items-start mb-3">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600">
                        <i class="bi bi-laptop-fill text-lg"></i>
                    </div>
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Works</span>
                </div>
                <h3 class="text-2xl font-black text-gray-800">{{ $totalProjects }}</h3>
                <p class="text-[10px] font-bold text-gray-400 mt-1 uppercase">Showcase</p>
            </div>

            {{-- Card 5: Testimonials --}}
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgba(0,0,0,0.02)] hover:-translate-y-1 transition-transform duration-300">
                <div class="flex justify-between items-start mb-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600">
                        <i class="bi bi-chat-quote-fill text-lg"></i>
                    </div>
                    <span class="text-[10px] font-black text-gray-400 uppercase tracking-wider">Reviews</span>
                </div>
                <h3 class="text-2xl font-black text-gray-800">{{ $totalTestimonials }}</h3>
                <p class="text-[10px] font-bold text-gray-400 mt-1 uppercase">Total</p>
            </div>
        </div>

        {{-- 3. MAIN CONTENT GRID --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- KOLOM KIRI (2/3): AGENDA & PROJECTS --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Upcoming Activities --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-sm font-black text-[#0f172a] uppercase tracking-widest">Agenda Mendatang</h3>
                        <a href="{{ route('admin.activity.index') }}" class="text-[10px] font-black text-gray-400 hover:text-[#0f5132] transition uppercase">Lihat Semua</a>
                    </div>
                    <div class="space-y-4">
                        @forelse($upcomingActivities as $activity)
                            <div class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 border border-gray-100 hover:bg-white hover:shadow-md transition-all duration-200">
                                <div class="flex flex-col items-center justify-center w-14 h-14 bg-white rounded-lg shadow-sm border border-gray-100 shrink-0">
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">{{ \Carbon\Carbon::parse($activity->activity_date)->format('M') }}</span>
                                    <span class="text-xl font-black text-[#0f5132]">{{ \Carbon\Carbon::parse($activity->activity_date)->format('d') }}</span>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-black text-gray-800 text-sm line-clamp-1 uppercase tracking-tight">{{ $activity->title }}</h4>
                                    <p class="text-[10px] font-bold text-gray-400 mt-0.5 uppercase">
                                        <i class="bi bi-building"></i> {{ $activity->partner->name ?? 'Partner' }}
                                    </p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-[9px] font-black bg-blue-50 text-blue-600 border border-blue-100 uppercase">Soon</span>
                            </div>
                        @empty
                            <p class="text-center py-8 text-xs text-gray-400 uppercase font-bold tracking-widest">No upcoming agenda</p>
                        @endforelse
                    </div>
                </div>

                {{-- Recent Projects --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h3 class="text-sm font-black text-[#0f172a] uppercase tracking-widest mb-4">Project Terbaru</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-[10px] text-gray-400 uppercase bg-gray-50/50">
                                <tr>
                                    <th class="px-4 py-3 rounded-l-lg">Murid</th>
                                    <th class="px-4 py-3">Tipe</th>
                                    <th class="px-4 py-3 rounded-r-lg text-right">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @foreach($latestProjects as $project)
                                    <tr>
                                        <td class="px-4 py-4 font-black text-[#0f172a] uppercase text-xs tracking-tight">{{ $project->student_name }}</td>
                                        <td class="px-4 py-4 text-xs text-gray-500">{{ $project->project_type['id'] ?? '-' }}</td>
                                        <td class="px-4 py-4 text-[10px] text-gray-400 text-right uppercase font-bold italic">{{ $project->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- KOLOM KANAN (1/3): AKSI CEPAT & STATUS --}}
            <div class="lg:col-span-1 space-y-6">
                
                {{-- Quick Actions Card --}}
                <div class="bg-[#0f5132] rounded-2xl p-6 shadow-lg text-white relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                    <h3 class="text-xs font-black mb-4 relative z-10 uppercase tracking-widest text-white">Aksi Cepat</h3>
                    <div class="grid grid-cols-2 gap-3 relative z-10">
                        {{-- Semua tombol menggunakan warna hijau emerald saat di-hover --}}
                        <a href="{{ route('admin.partners.create') }}" class="flex flex-col items-center justify-center p-3 bg-white/5 hover:bg-white/20 rounded-xl transition border border-white/5 group">
                            <i class="bi bi-building-add text-xl mb-1"></i>
                            <span class="text-[9px] font-black uppercase tracking-widest">Partner</span>
                        </a>
                        <a href="{{ route('admin.free-trials.index') }}" class="flex flex-col items-center justify-center p-3 bg-white/5 hover:bg-white/20 rounded-xl transition border border-white/5">
                            <i class="bi bi-person-badge text-xl mb-1"></i>
                            <span class="text-[9px] font-black uppercase tracking-widest">Trials</span>
                        </a>
                        <a href="{{ route('admin.projects.create') }}" class="flex flex-col items-center justify-center p-3 bg-white/5 hover:bg-white/20 rounded-xl transition border border-white/5">
                            <i class="bi bi-laptop text-xl mb-1"></i>
                            <span class="text-[9px] font-black uppercase tracking-widest">Project</span>
                        </a>
                        <a href="{{ route('admin.banners.index') }}" class="flex flex-col items-center justify-center p-3 bg-white/5 hover:bg-white/20 rounded-xl transition border border-white/5">
                            <i class="bi bi-images text-xl mb-1"></i>
                            <span class="text-[9px] font-black uppercase tracking-widest">Banner</span>
                        </a>
                    </div>
                </div>

                {{-- System Status --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                    <h3 class="text-[10px] font-black text-gray-400 mb-4 uppercase tracking-[0.2em]">Kesehatan Sistem</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-500 font-bold uppercase flex items-center gap-3">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Server
                            </span>
                            <span class="font-black text-emerald-600 uppercase">Optimal</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-500 font-bold uppercase flex items-center gap-3">
                                <span class="w-2 h-2 rounded-full bg-blue-500"></span> Database
                            </span>
                            <span class="font-black text-gray-700 uppercase">Connected</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection