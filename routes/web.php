<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('users/get-list', [\App\Http\Controllers\UserController::class, 'getDataList'])->name('users.getDataList');
    Route::resource('users', \App\Http\Controllers\UserController::class);

    Route::get('component-type/get-list', [\App\Http\Controllers\ComponentTypeController::class, 'getDataList'])->name('component-type.getDataList');
    Route::resource('component-type', \App\Http\Controllers\ComponentTypeController::class);

    Route::get('component/get-list', [\App\Http\Controllers\ComponentController::class, 'getDataList'])->name('component.getDataList');
    Route::resource('component', \App\Http\Controllers\ComponentController::class);

    Route::get('clasification/get-list', [\App\Http\Controllers\ClasificationController::class, 'getDataList'])->name('clasification.getDataList');
    Route::resource('clasification', \App\Http\Controllers\ClasificationController::class);

    Route::get('category/get-list', [\App\Http\Controllers\CategoryController::class, 'getDataList'])->name('category.getDataList');
    Route::resource('category', \App\Http\Controllers\CategoryController::class);

    Route::get('rakitan/get-list', [\App\Http\Controllers\RakitanController::class, 'getDataList'])->name('rakitan.getDataList');
    Route::resource('rakitan', \App\Http\Controllers\RakitanController::class);

    Route::get('rule/get-list', [\App\Http\Controllers\RuleController::class, 'getDataList'])->name('rule.getDataList');
    Route::resource('rule', \App\Http\Controllers\RuleController::class);
});

require __DIR__ . '/auth.php';
