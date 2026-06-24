<?php

use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\ProjectsController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Halaman projects
Route::get('/projects', [ProjectsController::class, 'index'])->name('projects');
// Halaman detail project
Route::get('/projects/{id}', [ProjectsController::class, 'show'])->name('projects.show');

// Halaman about
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

// Halaman contact
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

// Proses form contact (jika diperlukan)
Route::post('/contact', function () {
    // Logika simpan ke database atau kirim email
    return redirect()->route('contact')->with('success', 'Pesan berhasil dikirim!');
})->name('contact.submit');

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('admin.home');
    })->name('admin.dashboard');

    Route::get('/projects/pdf', [AdminProjectController::class, 'cetakPdf'])->name('projects.pdf');
    Route::get('/projects/pdf/{id}', [AdminProjectController::class, 'cetakByid'])->name('projects.pdf.byid');
    Route::resource('projects', AdminProjectController::class);
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
});