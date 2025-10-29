<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SetupTokoReminder extends Notification
{
    use Queueable;

    public function via($notifiable): array
    {
        // pakai database saja (supaya muncul di bell)
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        // URL menuju form buat Toko (fallback kalau nama route tidak ada)
        $url = url('/dashboard/tokos/create');
        if (\Illuminate\Support\Facades\Route::has('filament.dashboard.resources.tokos.create')) {
            $url = route('filament.dashboard.resources.tokos.create');
        }

        return [
            'title' => 'Silakan Atur Toko Terlebih Dahulu',
            'body'  => 'Lengkapi data toko Anda agar proses pengajuan bisa berjalan lancar.',
            'url'   => $url,
        ];
    }
}
