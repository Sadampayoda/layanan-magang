<!-- Sidebar scroll-->

<style>
    .sidebar-item.active {
        background-color: #6084fc;
    }

    .sidebar-item.active .hide-menu {
        color: #fdfdfd;
    }

    .sidebar-item.active .sidebar-link span i {
        color: #fdfdfd;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
</style>

<div>
    <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="" class="text-nowrap logo-img">
            <img src="" width="180" alt="" />
        </a>
        <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
        </div>
    </div>

    <nav class="sidebar-nav scroll-sidebar no-scrollbar" data-simplebar="">
        <ul id="sidebarnav">
            <li class="nav-small-cap">
                <h3 class="text-muted fs-4">Menu</h3>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ $title == 'dashboard' ? 'active' : '' }} text-decoration-none" href="">
                    <i class="ti ti-layout-dashboard fs-6"></i>
                    <h3 class="fs-4 mt-1">Dashboard</h3>
                </a>
            </li>
        </ul>

        <ul id="sidebarnav">
            <li class="nav-small-cap">
                <h3 class="text-muted fs-4">Layanan - Magang</h3>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ $title == 'magang' ? 'active' : '' }} text-decoration-none"
                    href="{{ route('magang.index') }}">
                    <i class="bi bi-clipboard-check fs-4"></i>
                    <h3 class="fs-4 mt-1">{{(auth()->user()->level !== 'mahasiswa' ? 'Pengajuan Magang' : 'Program Magang')}} </h3>
                </a>
            </li>

            @if (auth()->user()->level == 'admin')
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $title == 'user' ? 'active' : '' }} text-decoration-none"
                        href="{{ route('users.index') }}">
                        <i class="bi bi-bell fs-4"></i>
                        <h3 class="fs-4 mt-1">User Manajement</h3>
                    </a>
                </li>
            @endif
            @if (auth()->user()->level !== 'admin')
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $title == 'kegiatan' ? 'active' : '' }} text-decoration-none"
                        href="">
                        <i class="bi bi-calendar-check fs-4"></i>
                        <h3 class="fs-4 mt-1">Kegiatan</h3>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $title == 'notifikasi' ? 'active' : '' }} text-decoration-none"
                        href="">
                        <i class="bi bi-bell fs-4"></i>
                        <h3 class="fs-4 mt-1">Notifikasi</h3>
                    </a>
                </li>
            @endif
            @if (auth()->user()->level == 'mahasiswa')
                <li class="sidebar-item">
                    <a class="sidebar-link {{ $title == 'form' ? 'active' : '' }} text-decoration-none"
                        href="{{route('biodata.index')}}">
                        <i class="bi bi-bell fs-4"></i>
                        <h3 class="fs-4 mt-1">Form data</h3>
                    </a>
                </li>
            @endif

        </ul>

        <ul id="sidebarnav">
            <li class="nav-small-cap">
                <h3 class="text-muted fs-4">Other</h3>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ $title == 'faq' ? 'active' : '' }} text-decoration-none" href="">
                    <i class="bi bi-question-circle fs-4"></i>
                    <h3 class="fs-4 mt-1">FAQ</h3>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ $title == 'about' ? 'active' : '' }} text-decoration-none" href="">
                    <i class="bi bi-info-circle fs-4"></i>
                    <h3 class="fs-4 mt-1">Tentang Kami</h3>
                </a>
            </li>

        </ul>

    </nav>

</div>
