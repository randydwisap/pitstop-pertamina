<?php

namespace App\Filament\Auth\Actions;

use App\Filament\Notifications\CustomFilamentResetPassword;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class CustomPasswordResetAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Kirim Tautan Reset Password');

        $this->form([
            TextInput::make('email')
                ->label('Alamat Email')
                ->email()
                ->required(),
        ]);

        $this->action(function (array $data) {
            $status = Password::sendResetLink(
                ['email' => $data['email']],
                function ($user, $token) {
                    // ✅ Gunakan notifikasi custom kamu
                    $user->notify(new CustomFilamentResetPassword($token));
                }
            );

            if ($status !== Password::RESET_LINK_SENT) {
                throw ValidationException::withMessages([
                    'email' => [__($status)],
                ]);
            }

            $this->successNotificationTitle('Email reset password telah dikirim!');
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'customPasswordReset';
    }
}
