@extends('layouts.admin')

@section('content')
<div class="p-6 md:p-8 min-h-screen bg-[#050505]">
    
    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white tracking-tight">Dashboard Overview</h1>
        <p class="text-gray-500 text-sm mt-1">Selamat datang kembali, Admin! Berikut ringkasan sistem Anda.</p>
    </div>

    {{-- 1. STATS CARDS (GRID 4 KOLOM) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        {{-- Card 1: Total Partners --}}
        <div class="bg-[#101010] p-6 rounded-2xl border border-white/5 shadow-lg group hover:border-emerald-500/30 transition-colors">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Partners</p>
                    <h3 class="text-3xl font-bold text-white mt-2">{{ $totalPartners }}</h3>
                </div>
                <div class="p-3 bg-emerald-500/10 rounded-xl text-emerald-500 group-hover:bg-emerald-500 group-hover:text-black transition-all">
                    <i class="bi bi-briefcase-fill text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-gray-500">
                <span class="text-emerald-400 font-bold mr-1"><i class="bi bi-arrow-up-right"></i> Active</span>
                <span>sekolah/perusahaan</span>
            </div>
        </div>

        {{-- Card 2: Student Projects --}}
        <div class="bg-[#101010] p-6 rounded-2xl border border-white/5 shadow-lg group hover:border-blue-500/30 transition-colors">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Total Projects</p>
                    <h3 class="text-3xl font-bold text-white mt-2">{{ $totalProjects }}</h3>
                </div>
                <div class="p-3 bg-blue-500/10 rounded-xl text-blue-500 group-hover:bg-blue-500 group-hover:text-black transition-all">
                    <i class="bi bi-mortarboard-fill text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-gray-500">
                <span class="text-blue-400 font-bold mr-1"><i class="bi bi-plus"></i> Showcase</span>
                <span>karya murid</span>
            </div>
        </div>

        {{-- Card 3: Testimonials --}}
        <div class="bg-[#101010] p-6 rounded-2xl border border-white/5 shadow-lg group hover:border-yellow-500/30 transition-colors">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Testimonials</p>
                    <h3 class="text-3xl font-bold text-white mt-2">{{ $totalTestimonials }}</h3>
                </div>
                <div class="p-3 bg-yellow-500/10 rounded-xl text-yellow-500 group-hover:bg-yellow-500 group-hover:text-black transition-all">
                    <i class="bi bi-chat-quote-fill text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-gray-500">
                <span class="text-yellow-400 font-bold mr-1"><i class="bi bi-star-fill"></i> Review</span>
                <span>dari partner</span>
            </div>
        </div>

        {{-- Card 4: Active Banners --}}
        <div class="bg-[#101010] p-6 rounded-2xl border border-white/5 shadow-lg group hover:border-purple-500/30 transition-colors">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-wider">Active Banners</p>
                    <h3 class="text-3xl font-bold text-white mt-2">{{ $totalBanners }}</h3>
                </div>
                <div class="p-3 bg-purple-500/10 rounded-xl text-purple-500 group-hover:bg-purple-500 group-hover:text-black transition-all">
                    <i class="bi bi-images text-xl"></i>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs text-gray-500">
                <span class="text-purple-400 font-bold mr-1"><i class="bi bi-play-circle"></i> Slider</span>
                <span>di landing page</span>
            </div>
        </div>
    </div>

    {{-- 2. CONTENT SECTION (CHART & TABLE) --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- LEFT: Recent Projects Table (2/3 width) --}}
        <div class="lg:col-span-2 bg-[#101010] rounded-2xl border border-white/5 p-6 shadow-lg">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-lg font-bold text-white">Project Terbaru</h3>
                <a href="{{ route('admin.projects.index') }}" class="text-xs text-emerald-500 hover:text-emerald-400 font-semibold uppercase tracking-wider">View All</a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="text-xs font-bold text-gray-500 border-b border-white/5 uppercase tracking-wider">
                            <th class="py-3">Murid</th>
                            <th class="py-3">Tipe Project</th>
                            <th class="py-3">Tanggal Upload</th>
                            <th class="py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        @forelse($recentProjects as $project)
                        <tr class="group border-b border-white/5 hover:bg-white/5 transition-colors">
                            <td class="py-4 flex items-center gap-3">
                                {{-- Thumbnail Kecil --}}
                                <div class="w-10 h-10 rounded-lg bg-gray-800 overflow-hidden">
                                    <img src="{{ Storage::url($project->project_image) }}" class="w-full h-full object-cover">
                                </div>
                                <span class="font-medium text-white">{{ $project->student_name }}</span>
                            </td>
                            <td class="py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-800 text-gray-300 border border-white/5">
                                    {{ $project->project_type }}
                                </span>
                            </td>
                            <td class="py-4 text-gray-400">{{ $project->created_at->format('d M Y') }}</td>
                            <td class="py-4 text-right">
                                <a href="{{ route('admin.projects.edit', $project->id) }}" class="text-gray-500 hover:text-white transition">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-gray-500">Belum ada data project.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- RIGHT: Chart (1/3 width) --}}
        <div class="bg-[#101010] rounded-2xl border border-white/5 p-6 shadow-lg flex flex-col">
            <h3 class="text-lg font-bold text-white mb-2">Sebaran Tipe Project</h3>
            <p class="text-xs text-gray-500 mb-6">Distribusi karya berdasarkan kategori</p>
            
            {{-- Chart Container --}}
            <div class="relative flex-grow flex items-center justify-center">
                <canvas id="projectChart" class="w-full h-64"></canvas>
            </div>
            
            {{-- Legend Manual (Opsional, ChartJS sudah ada tapi ini biar rapi) --}}
            <div class="mt-6 grid grid-cols-2 gap-2 text-xs text-gray-400">
                <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Website</div>
                <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-blue-500"></span> Game</div>
                <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-purple-500"></span> Mobile App</div>
                <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-gray-500"></span> Lainnya</div>
            </div>
        </div>

    </div>
</div>

{{-- SCRIPT CHART.JS --}}
{{-- Load CDN Chart.js dulu --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Ambil data dari Controller Laravel
    const projectData = @json($projectTypes); 
    
    // Siapkan label dan data
    const labels = Object.keys(projectData);
    const dataValues = Object.values(projectData);

    // Konfigurasi Chart
    const ctx = document.getElementById('projectChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut', // Tipe Donat terlihat modern
        data: {
            labels: labels,
            datasets: [{
                data: dataValues,
                backgroundColor: [
                    '#10B981', // Emerald
                    '#3B82F6', // Blue
                    '#A855F7', // Purple
                    '#F59E0B', // Yellow
                    '#EC4899', // Pink
                ],
                borderWidth: 0, // Hilangkan border agar flat
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false // Kita sembunyikan legend bawaan agar bersih
                }
            },
            cutout: '75%', // Lubang tengah donat lebih besar
        }
    });
</script>
@endsection