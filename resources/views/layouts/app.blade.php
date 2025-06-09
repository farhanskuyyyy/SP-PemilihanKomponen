<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('css')
</head>

<body>
    <!-- Navbar section -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container-fluid">
            <button class="btn btn-outline-light me-3 sidebar-toggle" type="button" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>
            <a class="navbar-brand" href="{{ route('dashboard') }}">SP Pemilihan Komponen</a>

            <div class="navbar-nav ms-auto">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle me-2"></i>
                        <span id="userDisplayName">{{ auth()->user()->email }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                        {{-- <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a></li> --}}
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        this.closest('form').submit();"><i
                                        class="bi bi-box-arrow-right me-2"></i>{{ __('Log Out') }}</a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    <!-- Sidebar -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main class="main-content">
        <div class="container-fluid">
            <!-- Page Header -->
            <div class="row">
                <div class="col-12">
                    @yield('breadcrumbs')
                </div>
            </div>

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer bg-light">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <span class="text-muted">&copy; 2025 Farhan Arfianto. All rights reserved.</span>
                </div>
                <div class="col-md-6 text-end">
                    <span class="text-muted">Version 1.0.0</span>
                </div>
            </div>
        </div>
    </footer>

    @yield('js')
</body>

</html>
