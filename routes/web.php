<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminStaffController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VeraController; 
use App\Http\Controllers\MskiController; 
use App\Http\Controllers\PdController; 
use App\Http\Controllers\BankController; 
Route::get('/', function () {
    return view('welcome');
});

// Route untuk dashboard umum dengan middleware auth dan verified
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    $role = auth()->user()->role;

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'staff' => redirect()->route('staff.dashboard'),
        'user' => redirect()->route('user.dashboard'),
        default => redirect('/'),
    };
})->name('dashboard');

// Group route yang memerlukan autentikasi
Route::middleware('auth')->group(function () {

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route dashboard admin dengan middleware role:admin
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        // CRUD akun admin
        Route::resource('/admin/admins', AdminUserController::class)->names('admin.admins');
        // CRUD staff
        Route::resource('/admin/staffs', AdminStaffController::class)->names('admin.staffs');
    });

    // Route dashboard staff dengan middleware role:staff
    Route::middleware('role:staff')->group(function () {
        Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');
    });

    // Route dashboard user dengan middleware role:user
    Route::middleware('role:user')->group(function () {
        Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

        // ✅ Tambahkan route layanan Vera untuk user
        Route::get('/user/layanan-vera/create', [VeraController::class, 'create'])->name('vera.create');
        Route::post('/user/layanan-vera', [VeraController::class, 'store'])->name('vera.store');

        Route::get('/user/layanan-mski/create', [MskiController::class, 'create'])->name('mski.create');
        Route::post('/user/layanan-mski', [MskiController::class, 'store'])->name('mski.store');

        Route::get('/user/layanan-pd/create', [PdController::class, 'create'])->name('pd.create');
        Route::post('/user/layanan-pd', [PdController::class, 'store'])->name('pd.store');

        Route::get('/user/layanan-bank/create', [BankController::class, 'create'])->name('bank.create');
        Route::post('/user/layanan-bank', [BankController::class, 'store'])->name('bank.store');



    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route untuk login dan register
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::get('/register', [AuthController::class, 'registerView'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

require __DIR__ . '/auth.php';
