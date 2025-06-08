@extends('layouts.app')

@section('breadcrumbs')
    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalUsers">1,234</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people text-primary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Revenue
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">$45,678</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-currency-dollar text-success" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Orders
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">567</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-cart text-info" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Products
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">89</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-box text-warning" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>001</td>
                                    <td>John Doe</td>
                                    <td>Login</td>
                                    <td>2024-01-15</td>
                                    <td><span class="badge bg-success">Success</span></td>
                                </tr>
                                <tr>
                                    <td>002</td>
                                    <td>Jane Smith</td>
                                    <td>Purchase</td>
                                    <td>2024-01-15</td>
                                    <td><span class="badge bg-primary">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>003</td>
                                    <td>Bob Johnson</td>
                                    <td>Registration</td>
                                    <td>2024-01-14</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="users.html" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Manage Users
                        </a>
                        <button class="btn btn-success" type="button">
                            <i class="bi bi-box me-2"></i>Add Product
                        </button>
                        <button class="btn btn-info" type="button">
                            <i class="bi bi-file-earmark-text me-2"></i>Generate Report
                        </button>
                        <button class="btn btn-warning" type="button">
                            <i class="bi bi-gear me-2"></i>System Settings
                        </button>
                    </div>
                </div>
            </div>

            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">System Status</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Server Load</span>
                            <span>45%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 45%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Memory Usage</span>
                            <span>78%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-warning" style="width: 78%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between">
                            <span>Disk Space</span>
                            <span>23%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-info" style="width: 23%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
