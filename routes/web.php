<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LombaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TempatLatihanController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PasswordResetController;


// =====================
// 🌐 USER (PUBLIC)
// =====================
Route::get('/', [LombaController::class, 'index'])->name('landing');
Route::get('/lomba/{id}', [LombaController::class, 'show'])->name('lomba.detail');


// =====================
// 🔐 AUTH (LOGIN ADMIN)
// =====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', [AuthController::class, 'showDashboard'])->name('dashboard');

// =====================
// 👤 USER AUTH (LOGIN/REGISTER)
// =====================
Route::get('/login/user', [AuthController::class, 'showUserLogin'])->name('login.user');
Route::post('/login/user', [AuthController::class, 'userLogin'])->name('login.user.process');
Route::get('/daftar', [AuthController::class, 'showUserRegister'])->name('daftar');
Route::post('/daftar', [AuthController::class, 'userRegister'])->name('daftar');


Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/lomba/create', [AdminController::class, 'create'])->name('lomba.create');
    Route::post('/lomba', [AdminController::class, 'store'])->name('lomba.store');
    Route::get('/lomba/{id}/edit', [AdminController::class, 'edit'])->name('lomba.edit');
    Route::put('/lomba/{id}', [AdminController::class, 'update'])->name('lomba.update');
    Route::delete('/lomba/{id}', [AdminController::class, 'destroy'])->name('lomba.destroy');
});


// ── TEMPAT LATIHAN (Admin) ──────────────────────────────────────────────────
Route::prefix('admin/tempatlatihan')->name('admin.tempatlatihan.')->middleware('admin')->group(function () {
    Route::get('/', [TempatLatihanController::class, 'index'])->name('index');
    Route::get('/create', [TempatLatihanController::class, 'create'])->name('create');
    Route::post('/', [TempatLatihanController::class, 'store'])->name('store');
    Route::get('/{latihan}/edit', [TempatLatihanController::class, 'edit'])->name('edit');
    Route::put('/{latihan}', [TempatLatihanController::class, 'update'])->name('update');
    Route::delete('/{latihan}', [TempatLatihanController::class, 'destroy'])->name('destroy');
});

// share admin dengan user
Route::get('/tempatlatihan', [TempatLatihanController::class, 'publicIndex'])->name('tempatlatihan.index');
Route::get('/tempatlatihan/{latihan}', [TempatLatihanController::class, 'show'])->name('tempatlatihan.show');

// ── FORUM ADMIN ──────────────────────────────────────────────────────────────
Route::prefix('admin/forum')->name('admin.forum.')->middleware('admin')->group(function () {
    Route::get('/', [ForumController::class, 'adminIndex'])->name('index');
    Route::get('/create', [ForumController::class, 'create'])->name('create');
    Route::post('/', [ForumController::class, 'adminStore'])->name('store');
    Route::post('/forum/{id}/pin', [ForumController::class, 'togglePin'])->name('pin');
});

// ── SETTINGS (Admin) ─────────────────────────────────────────────────────────
Route::prefix('admin/settings')->name('admin.settings.')->middleware('admin')->group(function () {
    Route::get('/', [SettingController::class, 'index'])->name('index');
    Route::post('/', [SettingController::class, 'store'])->name('store');
    Route::put('/{id}', [SettingController::class, 'update'])->name('update');
    Route::delete('/{id}', [SettingController::class, 'destroy'])->name('destroy');
});

// ── FORUM (User) ────────────────────────────────────────────────────────────
Route::get('/forum', [ForumController::class, 'index'])
    ->name('forum.index');

Route::post('/forum/store', [ForumController::class, 'store'])
    ->name('forum.store');

Route::get('/forum/{id}', [ForumController::class, 'show'])
    ->name('forum.show');

Route::post('/forum/{id}/comment', [ForumController::class, 'storeComment'])
    ->name('forum.comment.store');

Route::get('/forum/{id}/edit', [ForumController::class, 'edit'])
    ->name('forum.edit');

Route::put('/forum/{id}', [ForumController::class, 'update'])
    ->name('forum.update');

Route::delete('/forum/{id}', [ForumController::class, 'destroy'])
    ->name('forum.destroy');

Route::delete('/forum/comment/{id}', [ForumController::class, 'deleteComment'])
    ->name('forum.comment.delete');

Route::get('/my-forum', [ForumController::class, 'myPosts'])
    ->name('forum.myposts');

// ── NOTIFICATIONS ───────────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::post('/notifications/{id}/read', [NotificationController::class, 'markRead'])
        ->name('notifications.markRead');

    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.markAllRead');

    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])
        ->name('notifications.destroy');

    Route::delete('/notifications/read', [NotificationController::class, 'deleteRead'])
        ->name('notifications.deleteRead');

    Route::get('/notifications/unread-count', [NotificationController::class, 'getUnreadCount'])
        ->name('notifications.unreadCount');

    Route::get('/notifications/latest', [NotificationController::class, 'getLatest'])
        ->name('notifications.latest');

    Route::delete('/notifications/clear-all', [NotificationController::class, 'clearAll'])
        ->name('notifications.clearAll');
});

// =====================
// 👤 USER PROFILE
// =====================
Route::get('/profil', function () {
    return view('profil');
})->name('profil')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    // Halaman edit profil
    Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
    // Proses update profil
    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/update-password', [AuthController::class, 'updatePassword'])->name('profile.update-password');
});

// Lupa Password
Route::get('/lupa-password', [PasswordResetController::class, 'showForgotForm'])->name('password.request');
Route::post('/lupa-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');