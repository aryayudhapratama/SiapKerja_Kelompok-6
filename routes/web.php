<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserJobController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AdminJobController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\SuperUserController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\SuperadminAppController;
use App\Http\Controllers\SuperadminJobController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/hallo', function () {
//     return view('admin.adminjobs1');
// });

// Halaman Sebelum Login
Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');
Route::get('/detail/{id}', [WelcomeController::class, 'show'])->name('detail.show');

// Dashboard untuk semua pengguna
Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    if ($role === 'user') {
        return redirect()->route('userjobs.index');
    } elseif ($role === 'admin') {
        return redirect()->route('admin.index');
    } elseif ($role === 'superadmin') {
        return redirect()->route('superadmin.dashboard');
    }

    return abort(403, 'Unauthorized'); // Jika role tidak dikenali
})->middleware(['auth', 'verified'])->name('dashboard');

// Route berdasarkan role
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/userjobs', [UserJobController::class, 'index'])->name('userjobs.index');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
});

// Route untuk Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// SuperAdmin
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    // Dashboard
    Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin.index');
    Route::get('/superadmin/jobs', [SuperAdminController::class, 'jobs'])->name('superadmin.jobs');
    Route::get('/superadmin/users', [SuperAdminController::class, 'users'])->name('superadmin.users');
    Route::get('/superadmin/applicants', [SuperAdminController::class, 'applicants'])->name('superadmin.applicants');

    // User
    Route::get('/superusers', [SuperUserController::class, 'index'])->name('superusers.index');
    Route::get('/superusers/create', [SuperUserController::class, 'create'])->name('superusers.create');
    Route::post('/superusers', [SuperUserController::class, 'store'])->name('superusers.store');
    Route::get('/superusers/{id}/edit', [SuperUserController::class, 'edit'])->name('superusers.edit');
    Route::delete('/superusers/{id}', [SuperUserController::class, 'destroy'])->name('superusers.destroy');
    Route::put('/superusers/{id}', [SuperUserController::class, 'update'])->name('superusers.update');
    Route::resource('superusers', SuperUserController::class);

    // Jobs
    Route::put('/superjobs/{id}', [SuperadminJobController::class, 'update'])->name('superjobs.update');
    Route::get('/superjobs', [SuperadminJobController::class, 'index'])->name('superjobs.index');
    Route::get('/superjobs/{id}/edit', [SuperadminJobController::class, 'edit'])->name('superjobs.edit');
    Route::put('/superjobs/{id}', [SuperadminJobController::class, 'update'])->name('superjobs.update');
    Route::delete('/superjobs/{id}', [SuperadminJobController::class, 'destroy'])->name('superjobs.destroy');
    // Applicants
    Route::get('superapps', [SuperadminAppController::class, 'index'])->name('superapps.index');
    Route::get('/superapps/{id}/edit', [SuperadminAppController::class, 'edit'])->name('superapps.edit');
    Route::put('/superapps/{id}', [SuperadminAppController::class, 'update'])->name('superapps.update');
    Route::delete('/superapps/{id}', [SuperadminAppController::class, 'destroy'])->name('superapps.destroy');
    
});

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    // AdminJob
    Route::get('/adminjobs', [AdminJobController::class, 'index'])->name('adminjobs.index');
    Route::get('/adminjobs/create', [AdminJobController::class, 'create'])->name('adminjobs.create');
    Route::post('/adminjobs', [AdminJobController::class, 'store'])->name('adminjobs.store');
    Route::get('/adminjobs/{id}', [AdminJobController::class, 'show'])->name('adminjobs.show');
    Route::get('/adminjobs/{id}/edit', [AdminJobController::class, 'edit'])->name('adminjobs.edit');
    Route::put('/adminjobs/{id}', [AdminJobController::class, 'update'])->name('adminjobs.update');
    Route::delete('/adminjobs/{id}', [AdminJobController::class, 'destroy'])->name('adminjobs.destroy');
    // Applicants
    Route::get('applicants', [ApplicantController::class, 'index'])->name('applicants.index');
    Route::get('/applicants/{id}/edit', [ApplicantController::class, 'edit'])->name('admin.applicant.edit');
    Route::put('/applicants/{id}', [ApplicantController::class, 'update'])->name('admin.applicant.update');
    Route::delete('/applicants/{id}', [ApplicantController::class, 'destroy'])->name('admin.applicant.destroy');
});

// User
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/userjobs', [UserJobController::class, 'index'])->name('userjobs.index');
    Route::get('/userjobs1/{id}', [UserJobController::class, 'show'])->name('userjobs1.show');
    Route::get('/userjobs/{id}/create', [UserJobController::class, 'create'])->name('userjobs.create');
    Route::post('/userjobs/{id}/apply', [UserJobController::class, 'store'])->name('userjobs.store');
    Route::get('/history', [UserJobController::class, 'history'])->name('history');
    Route::get('/userjobs/{id}', [UserController::class, 'show'])->name('userjobs.show');
});
