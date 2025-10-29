<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;

class ImmediateEmailVerification
{
    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        // Kirim email verifikasi langsung tanpa masuk queue
        $event->user->sendEmailVerificationNotification();
    }
}
