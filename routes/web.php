<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use Filament\Notifications\Notification;
use App\Models\User;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/email/verify', function () {
    // tampilkan view yang menjelaskan "cek email"
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill(); // set email_verified_at
    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'Link verifikasi dikirim ulang.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//Reset Password

// Menampilkan form "Lupa Password"
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

// Mengirim link reset password
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

// Menampilkan form reset password (yang dipanggil dari email)
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

// Memproses penyimpanan password baru
Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

Route::middleware(['web', 'auth'])->group(function () {
    Route::post('/notifications/read/{id}', function (string $id) {
        $n = auth()->user()?->notifications()->whereKey($id)->first();
        if ($n && $n->read_at === null) $n->markAsRead();
        return back();
    })->name('notifications.markRead');

    Route::post('/notifications/read-all', function () {
        auth()->user()?->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.markAllRead');
});

Route::get('/test-notif', function () {
    // ambil user yang sedang login; kalau tidak ada, ambil user pertama
    $user = auth()->user() ?: User::first();

    Notification::make()
        ->title('Contoh Notifikasi')
        ->body('Ini notifikasi percobaan. Berhasil!')
        ->sendToDatabase($user);   // <-- masuk ke tabel notifications & muncul di lonceng

    return 'OK';
})->middleware('web');