<aside id="sidebar-admin" class=" shadow-lg d-flex flex-column border-end" style="background: white;">
    {{-- Header Sidebar (Logo/Nama Aplikasi) --}}
    <div class="p-4 border-bottom d-flex align-items-center">
        <img src="{{ asset('images/logo-TA.svg') }}" alt="Timedoor Academy" width="150">
    </div>

    {{-- Navigasi Utama --}}
    <nav class="flex-grow-1 overflow-auto py-3">
        <ul class="nav flex-column px-3">
            
            {{-- Bagian Utama --}}
            <li class="nav-item">
                <a href="#" class="nav-link text-dark sidebar-link p-3 rounded-2">
                    <i class="bi bi-grid-fill me-3 fs-5"></i>
                    Dashboard
                </a>
            </li>

            {{-- Bagian Products (Untuk Kustomisasi Anda) --}}
            <li class="nav-item mt-3">
                <span class="text-secondary text-uppercase small fw-semibold ps-3">Partnership</span>
            </li>
            {{-- Menu AKTIF: Flash Sales (diganti Partners) --}}
            <li class="nav-item">
                <a href="{{ route('admin.partners.index') }}" class="nav-link p-3 rounded-2 sidebar-link ">
                    <i class="bi bi-lightning-charge-fill me-3 fs-5"></i>
                    Partners
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.activity.index') }}" class="nav-link text-dark sidebar-link p-3 rounded-2">
                    <i class="bi bi-box me-3 fs-5"></i>
                    Activity Partner
                </a>
            </li>

            

            {{-- Menu Customers (Untuk Kustomisasi Anda) --}}
            <li class="nav-item mt-3">
                <span class="text-secondary text-uppercase small fw-semibold ps-3">Customers</span>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link text-dark sidebar-link p-3 rounded-2">
                    <i class="bi bi-people-fill me-3 fs-5"></i>
                    Customers
                </a>
            </li>
            
            <li class="nav-item">
                <a href="#" class="nav-link text-dark sidebar-link p-3 rounded-2">
                    <i class="bi bi-bar-chart-fill me-3 fs-5"></i>
                    Analytics
                </a>
            </li>
            
            <li class="nav-item">
                <a href="#" class="nav-link text-dark sidebar-link p-3 rounded-2">
                    <i class="bi bi-bell-fill me-3 fs-5"></i>
                    Notifications
                </a>
            </li>

        </ul>
    </nav>

    {{-- Bagian Logout di Bawah --}}
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-link text-decoration-none">
        <i class="bi bi-box-arrow-right me-2"></i> Log out
    </button>
</form>
</aside>