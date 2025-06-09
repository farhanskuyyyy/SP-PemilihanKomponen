<div class="sidebar-nav show" id="sidebar">
    {{-- <div class="sidebar-header d-none d-md-block">
        <div class="sidebar-brand">
            <i class="bi bi-speedometer2 me-2"></i>
            <span class="brand-text">Admin</span>
        </div>
    </div> --}}
    <div class="sidebar-content">
        <nav class="navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <i class="bi bi-people"></i>
                        <span>Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('component-type.*') ? 'active' : '' }}" href="{{ route('component-type.index') }}">
                        <i class="bi bi-tags"></i>
                        <span>Tipe Komponen</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="roles.html">
                        <i class="bi bi-shield-check"></i>
                        <span>Roles</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="komponen.html">
                        <i class="bi bi-cpu"></i>
                        <span>Komponen</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rakitan.html">
                        <i class="bi bi-pc-display"></i>
                        <span>Rakitan PC</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="klasifikasi.html">
                        <i class="bi bi-list-check"></i>
                        <span>Klasifikasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kategori.html">
                        <i class="bi bi-collection"></i>
                        <span>Kategori</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rules.html">
                        <i class="bi bi-gear"></i>
                        <span>Rules</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Mobile Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>
