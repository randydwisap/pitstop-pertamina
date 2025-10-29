<?php

namespace App\Filament\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomFilamentResetPassword extends Notification
{
    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via($notifiable): array
    {
        return ['mail']; // langsung kirim tanpa queue
    }

    public function toMail($notifiable): MailMessage
    {
        \Log::info('✅ CustomFilamentResetPassword digunakan untuk '.$notifiable->email);

        $url = url(route('filament.dashboard.auth.password-reset.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]));

        return (new MailMessage)
            ->subject('🔑 Reset Password Akun Pitstop by Pertamina')
            ->greeting('Halo, ' . ($notifiable->name ?? 'Pengguna') . '!')
            ->line('Kami menerima permintaan untuk mereset password akun Anda.')
            ->action('Reset Password', $url)
            ->line('Jika Anda tidak meminta reset password, abaikan email ini.')
            ->salutation("Salam hormat,\nPitstop by Pertamina");
    }
}
