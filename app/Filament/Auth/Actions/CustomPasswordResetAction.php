<?php

namespace App\Filament\Auth\Actions;

use Filament\Auth\Actions\PasswordResetAction;
use App\Filament\Auth\Notifications\CustomFilamentResetPassword;

class CustomPasswordResetAction extends PasswordResetAction
{
    protected function sendResetLinkNotification($user, $token): void
    {
        // Gunakan notifikasi custom
        $user->notify(new CustomFilamentResetPassword($token));
    }
}
