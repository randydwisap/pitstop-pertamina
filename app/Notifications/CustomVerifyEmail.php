<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends BaseVerifyEmail
{
    public function toMail($notifiable): MailMessage
{
    $verificationUrl = $this->verificationUrl($notifiable);

    return (new MailMessage)
        ->subject('Verifikasi Alamat Email Anda')
        ->greeting("Halo, {$notifiable->name}!")
        ->line('Terima kasih telah mendaftar di Pitstop by Pertamina.')
        ->line('Untuk menyelesaikan proses pendaftaran dan mengaktifkan akun Anda, silakan verifikasi alamat email ini dengan mengklik tombol di bawah:')
        ->action('Verifikasi Email Sekarang', $verificationUrl)
        ->line('Tindakan ini membantu kami memastikan bahwa email ini benar-benar milik Anda.')
        ->line('Jika Anda tidak merasa melakukan pendaftaran akun Pitstop, Anda dapat mengabaikan email ini dan tidak perlu melakukan tindakan apa pun.')
        ->salutation("Salam hormat,\nPitstop by Pertamina");
}


    /**
     * Buat URL verifikasi yang sama seperti default Laravel
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(config('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
