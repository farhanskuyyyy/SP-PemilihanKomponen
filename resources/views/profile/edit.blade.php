@extends('layouts.app')

@section('breadcrumbs')
    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-12 col-md-8 col-lg-6 mx-auto">
                    <div class="p-4 bg-white shadow rounded">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="col-12 col-md-8 col-lg-6 mx-auto">
                    <div class="p-4 bg-white shadow rounded">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                {{-- <div class="col-12 col-md-8 col-lg-6 mx-auto">
                    <div class="p-4 bg-white shadow rounded">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
