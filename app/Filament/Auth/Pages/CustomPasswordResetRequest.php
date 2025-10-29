<?php

namespace App\Filament\Auth\Pages;

use Filament\Auth\Pages\PasswordReset\RequestPasswordReset;
use App\Filament\Auth\Actions\CustomPasswordResetAction;

class CustomPasswordResetRequest extends RequestPasswordReset
{
    /**
     *  Nonaktifkan form bawaan Filament sepenuhnya.
     */
    protected function hasForm(): bool
    {
        return false;
    }

    protected function getForm(): ?object
    {
        return null;
    }

    /**
     *  Hanya tampilkan action custom untuk kirim reset link.
     */
    protected function getFormActions(): array
    {
        return [
            CustomPasswordResetAction::make()
                ->label('Kirim Tautan Reset Password')
                ->modalHeading('Masukkan Kembali Email Anda')
                ->color('primary'),
        ];
    }

    /**
     *  Tambahkan sedikit teks agar tidak terlihat kosong.
     */
    public function getHeading(): string
    {
        return 'Lupa Password Akun Pitstop?';
    }

    public function getSubheading(): string
    {
        return 'Klik tombol di bawah ini untuk mengirim tautan reset password ke email Anda.';
    }
}
