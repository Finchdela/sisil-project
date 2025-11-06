<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PeralatanController;
use App\Http\Controllers\Admin\RuanganController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
});

// Laporan Kerusakan Routes - User
Route::middleware(['auth'])->group(function () {
    // ... routes peminjaman lainnya
    
    // Laporan Kerusakan
    Route::get('/laporan-kerusakan', [LaporanKerusakanController::class, 'index'])->name('laporan-kerusakan.index');
    Route::get('/laporan-kerusakan/create', [LaporanKerusakanController::class, 'create'])->name('laporan-kerusakan.create');
    Route::post('/laporan-kerusakan', [LaporanKerusakanController::class, 'store'])->name('laporan-kerusakan.store');
    Route::get('/laporan-kerusakan/{id}', [LaporanKerusakanController::class, 'show'])->name('laporan-kerusakan.show');
});

// Laporan Kerusakan Routes - Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // ... routes admin lainnya
    
    Route::get('/laporan-kerusakan', [LaporanKerusakanController::class, 'adminIndex'])->name('admin.laporan-kerusakan');
    Route::post('/laporan-kerusakan/{id}/update-status', [LaporanKerusakanController::class, 'updateStatus'])->name('admin.laporan-kerusakan.update-status');
});

// Route testing sementara (letakkan di atas route lainnya)
Route::get('/test-auth', function () {
    echo "<h1>Test Authentication</h1>";
    
    // Test admin credentials
    $credentials = ['email' => 'admin@silab.com', 'password' => 'password'];
    
    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        echo "<div style='color: green;'>✓ LOGIN BERHASIL</div>";
        echo "<pre>";
        echo "User ID: " . $user->id . "\n";
        echo "Name: " . $user->name . "\n";
        echo "Email: " . $user->email . "\n";
        echo "Role: " . $user->role . "\n";
        echo "</pre>";
        
        // Test admin middleware
        if ($user->role === 'admin') {
            echo "<div style='color: green;'>✓ ROLE ADMIN VALID</div>";
        } else {
            echo "<div style='color: red;'>✗ ROLE BUKAN ADMIN: " . $user->role . "</div>";
        }
        
        Auth::logout();
    } else {
        echo "<div style='color: red;'>✗ LOGIN GAGAL</div>";
        echo "<p>Periksa:</p>";
        echo "<ul>";
        echo "<li>Email dan password</li>";
        echo "<li>Data di database</li>";
        echo "</ul>";
    }
    
    echo "<br><a href='/login'>Kembali ke Login</a>";
});

// Authentication Routes Manual
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Authenticated Routes
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // Peminjaman Routes - PERBAIKI INI
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
    
    // Kalender
    Route::get('/kalender', [PeminjamanController::class, 'kalender'])->name('kalender');
});

// Admin Only Routes - PERBAIKI INI
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/peminjaman', [AdminController::class, 'peminjaman'])->name('admin.peminjaman');
    Route::post('/peminjaman/{id}/approve', [AdminController::class, 'approvePeminjaman'])->name('admin.peminjaman.approve');
    Route::post('/peminjaman/{id}/reject', [AdminController::class, 'rejectPeminjaman'])->name('admin.peminjaman.reject');

// Route sementara untuk membuat admin (hapus setelah digunakan)
Route::get('/create-admin', function () {
    $admin = App\Models\User::where('email', 'admin@silab.com')->first();
    if (!$admin) {
        App\Models\User::create([
            'name' => 'Admin Laboratorium',
            'email' => 'admin@silab.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
        echo "Admin berhasil dibuat!";
    } else {
        echo "Admin sudah ada!";
    }
});
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // ... routes lainnya
    
    // Routes untuk manajemen ruangan
    Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
    Route::get('/ruangan/create', [RuanganController::class, 'create'])->name('ruangan.create');
    Route::post('/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
    Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
    Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
    Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');
});
});