<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Partnership</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Bootstrap Icons CSS (WAJIB DITAMBAHKAN) --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Vite Assets (CSS Kustom Anda) --}}
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
    
    {{-- CSS Kustom untuk Sidebar (Agar Fixed dan Profil di Bawah) --}}
    <style>
        /* Lebar sidebar sesuai kode sebelumnya */
       

        /* Mengatur agar konten utama tidak tertutup sidebar */
        .content-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background-color: #f8f9fa; /* Warna latar belakang konten */
        }

        /* Styling untuk link navigasi */
        .sidebar-link {
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
        }

        /* Efek hover yang lebih jelas */
        .sidebar-link:hover {
            color: #fff !important;
            background-color: #495057; 
        }
    </style>
</head>

<body>

    <div class="d-flex">
        
        {{-- MEMANGGIL FILE SIDEBAR DI SINI --}}
        {{-- Asumsi: File sidebar Anda berada di 'admin.partials.sidebar' --}}
        @include('admin.partials.sidebar') 

        {{-- Konten Utama --}}
        <main class="content-wrapper w-100">
            <div class="p-4">
                @yield('content')
            </div>
        </main>
        
    </div>

    {{-- Bootstrap JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>