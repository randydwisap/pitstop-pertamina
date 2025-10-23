<?php

namespace App\Filament\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class CustomFilamentResetPassword extends ResetPassword
{
    public function toMail($notifiable)
    {
        $url = url(route('filament.dashboard.auth.password-reset.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]));

        return (new MailMessage)
            ->subject('🔑 Reset Password Akun Pitstop by Pertamina')
            ->greeting('Halo, ' . $notifiable->name . '!')
            ->line('Kami menerima permintaan untuk mereset password akun Anda.')
            ->action('Reset Password', $url)
            ->line('Jika Anda tidak meminta reset password, abaikan email ini.')
            ->salutation("Salam hormat,\nPitstop by Pertamina");
;
    }
}
