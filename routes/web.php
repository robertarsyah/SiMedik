<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        $role = auth()->user()->role;
        if ($role === 'super_admin') {
            return redirect()->route('superadmin.dashboard');
        } elseif ($role === 'dokter') {
            return redirect()->route('dokter.dashboard');
        }
        return redirect()->route('admin.dashboard');
    })->name('dashboard');

    Route::middleware('role:super_admin')->group(function () {
        Route::get('/super-admin/dashboard', function () {
            return view('dashboard.super_admin');
        })->name('superadmin.dashboard');

        Route::get('/super-admin/users', [\App\Http\Controllers\SuperAdmin\UserController::class, 'index'])->name('superadmin.users.index');
        Route::get('/super-admin/users/create', [\App\Http\Controllers\SuperAdmin\UserController::class, 'create'])->name('superadmin.users.create');
        Route::post('/super-admin/users', [\App\Http\Controllers\SuperAdmin\UserController::class, 'store'])->name('superadmin.users.store');
        Route::delete('/super-admin/users/{user}', [\App\Http\Controllers\SuperAdmin\UserController::class, 'destroy'])->name('superadmin.users.destroy');
        Route::get('/super-admin/users/{user}/edit', [\App\Http\Controllers\SuperAdmin\UserController::class, 'edit'])->name('superadmin.users.edit');
        Route::put('/super-admin/users/{user}', [\App\Http\Controllers\SuperAdmin\UserController::class, 'update'])->name('superadmin.users.update');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('dashboard.admin');
        })->name('admin.dashboard');
    });

    Route::middleware('role:dokter')->group(function () {
        Route::get('/dokter/dashboard', function () {
            return view('dashboard.dokter');
        })->name('dokter.dashboard');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
