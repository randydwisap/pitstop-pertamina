<?php

namespace App\Filament\Resources\Pengajuans\Pages;

use App\Filament\Resources\Pengajuans\PengajuanResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePengajuan extends CreateRecord
{
    protected static string $resource = PengajuanResource::class;

     protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();

        if (($data['status'] ?? 'pending') === 'approved') {
            $data['approved_by'] = auth()->id();
            $data['approved_at'] = now();
        }

        return $data;
    }
}
