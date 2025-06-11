<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Models\Rakitan;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $components = Component::count();
        $users = User::count();
        $rakitans = Rakitan::count();

        $rakitanBuildeds = Rakitan::with('creator')->orderBy('id', 'desc')->limit(5)->get();
        return view('dashboard', compact('components', 'users', 'rakitans', 'rakitanBuildeds'));
    }
}
