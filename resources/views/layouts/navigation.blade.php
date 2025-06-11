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
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if (auth()->user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
                            href="#masterDataMenu" role="button" aria-expanded="false" aria-controls="masterDataMenu">
                            <span>
                                <i class="bi bi-folder"></i>
                                <span>Master Data</span>
                            </span>
                            <i class="bi bi-chevron-down small"></i>
                        </a>
                        <div class="collapse {{ request()->routeIs('users.*') || request()->routeIs('component-type.*') || request()->routeIs('component.*') || request()->routeIs('clasification.*') || request()->routeIs('category.*') ? 'show' : '' }}"
                            id="masterDataMenu">
                            <ul class="navbar-nav ms-3">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
                                        href="{{ route('users.index') }}">
                                        <i class="bi bi-people"></i>
                                        <span>Users</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('component-type.*') ? 'active' : '' }}"
                                        href="{{ route('component-type.index') }}">
                                        <i class="bi bi-tags"></i>
                                        <span>Tipe Komponen</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('component.*') ? 'active' : '' }}"
                                        href="{{ route('component.index') }}">
                                        <i class="bi bi-cpu"></i>
                                        <span>Komponen</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('clasification.*') ? 'active' : '' }}"
                                        href="{{ route('clasification.index') }}">
                                        <i class="bi bi-list-check"></i>
                                        <span>Klasifikasi</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('category.*') ? 'active' : '' }}"
                                        href="{{ route('category.index') }}">
                                        <i class="bi bi-collection"></i>
                                        <span>Kategori</span>
                                    </a>
                                </li>
                                <!-- Tambahkan child menu lain di sini jika perlu -->
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('rakitan.*') ? 'active' : '' }}"
                            href="{{ route('rakitan.index') }}">
                            <i class="bi bi-pc-display"></i>
                            <span>Rakitan PC</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('rule.*') ? 'active' : '' }}"
                            href="{{ route('rule.index') }}">
                            <i class="bi bi-gear"></i>
                            <span>Rules</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('konsultasi.*') ? 'active' : '' }}"
                        href="{{ route('konsultasi.index') }}">
                        <i class="bi bi-chat-dots"></i>
                        <span>Konsultasi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('simulasi.*') ? 'active' : '' }}"
                        href="{{ route('simulasi.index') }}">
                        <i class="bi bi-laptop"></i>
                        <span>Simulasi</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Mobile Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>
