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
            $stats = [
                'users' => \App\Models\User::count(),
                'medicines' => \App\Models\Medicine::count(),
                'patients' => \App\Models\Patient::count(),
                'queues_today' => \App\Models\Queue::whereDate('queue_date', date('Y-m-d'))->count(),
            ];

            $lowStockMedicines = \App\Models\Medicine::where('stock', '<', 10)->get();

            return view('dashboard.super_admin', compact('stats', 'lowStockMedicines'));
        })->name('superadmin.dashboard');

        // Manajemen Pengguna
        Route::get('/super-admin/users', [\App\Http\Controllers\SuperAdmin\UserController::class, 'index'])->name('superadmin.users.index');
        Route::get('/super-admin/users/create', [\App\Http\Controllers\SuperAdmin\UserController::class, 'create'])->name('superadmin.users.create');
        Route::post('/super-admin/users', [\App\Http\Controllers\SuperAdmin\UserController::class, 'store'])->name('superadmin.users.store');
        Route::delete('/super-admin/users/{user}', [\App\Http\Controllers\SuperAdmin\UserController::class, 'destroy'])->name('superadmin.users.destroy');
        Route::get('/super-admin/users/{user}/edit', [\App\Http\Controllers\SuperAdmin\UserController::class, 'edit'])->name('superadmin.users.edit');
        Route::put('/super-admin/users/{user}', [\App\Http\Controllers\SuperAdmin\UserController::class, 'update'])->name('superadmin.users.update');

        // Manajemen Obat
        Route::resource('super-admin/medicines', 'App\Http\Controllers\SuperAdmin\MedicineController')->names('superadmin.medicines');
    });

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', function () {
            $today = date('Y-m-d');

            $stats = [
                'total_antrian' => \App\Models\Queue::whereDate('queue_date', $today)->count(),
                'menunggu' => \App\Models\Queue::whereDate('queue_date', $today)->where('status', 'menunggu')->count(),
                'diperiksa' => \App\Models\Queue::whereDate('queue_date', $today)->where('status', 'diperiksa')->count(),
                'selesai' => \App\Models\Queue::whereDate('queue_date', $today)->where('status', 'selesai')->count(),
            ];

            return view('dashboard.admin', compact('stats'));
        })->name('admin.dashboard');

        // Pendaftaran Pasien
        Route::get('/admin/patients', [\App\Http\Controllers\Admin\PatientController::class, 'index'])->name('admin.patients.index');
        Route::get('/admin/patients/create', [\App\Http\Controllers\Admin\PatientController::class, 'create'])->name('admin.patients.create');
        Route::post('/admin/patients', [\App\Http\Controllers\Admin\PatientController::class, 'store'])->name('admin.patients.store');
        Route::get('/admin/patients/{patient}/edit', [\App\Http\Controllers\Admin\PatientController::class, 'edit'])->name('admin.patients.edit');
        Route::put('/admin/patients/{patient}', [\App\Http\Controllers\Admin\PatientController::class, 'update'])->name('admin.patients.update');
        Route::delete('/admin/patients/{patient}', [\App\Http\Controllers\Admin\PatientController::class, 'destroy'])->name('admin.patients.destroy');

        // Antrian Pasien
        Route::get('/admin/queues', [\App\Http\Controllers\Admin\QueueController::class, 'index'])->name('admin.queues.index');
        Route::post('/admin/queues', [\App\Http\Controllers\Admin\QueueController::class, 'store'])->name('admin.queues.store');
        Route::patch('/admin/queues/{queue}/call', [\App\Http\Controllers\Admin\QueueController::class, 'call'])->name('admin.queues.call');
    });

    Route::middleware('role:dokter')->group(function () {
        Route::get('/dokter/dashboard', function () {
            $today = date('Y-m-d');
            $stats = [
                'menunggu' => \App\Models\Queue::where('queue_date', $today)->where('status', 'diperiksa')->count(),
                'selesai_hari_ini' => \App\Models\Queue::where('queue_date', $today)->where('status', 'selesai')->count(),
                'total_pasien' => \App\Models\MedicalRecord::where('user_id', auth()->id())->count(),
            ];
            return view('dashboard.dokter', compact('stats'));
        })->name('dokter.dashboard');

        // Pemeriksaan Pasien
        Route::get('/doctor/dashboard', [App\Http\Controllers\Doctor\ExaminationController::class, 'index'])->name('doctor.index');
        Route::get('/doctor/history', [App\Http\Controllers\Doctor\ExaminationController::class, 'history'])->name('doctor.history');
        Route::get('/doctor/examine/{queue}', [App\Http\Controllers\Doctor\ExaminationController::class, 'create'])->name('doctor.examine');
        Route::post('/doctor/examine/{queue}', [App\Http\Controllers\Doctor\ExaminationController::class, 'store'])->name('doctor.store');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
