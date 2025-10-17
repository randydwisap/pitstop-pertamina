<?php

namespace App\Filament\Resources\Pengajuans\Pages;

use App\Filament\Resources\Pengajuans\PengajuanResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;
use App\Models\Pengajuan;

class CreatePengajuan extends CreateRecord
{
    protected static string $resource = PengajuanResource::class;

protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['created_by'] = auth()->id(); // WAJIB

    // Validasi aplikasi (biar UX jelas):
    $exists = \App\Models\Pengajuan::query()
        ->where('product_id', $data['product_id'] ?? null)
        ->where('spbu_id', $data['spbu_id'] ?? null)
        ->where('created_by', $data['created_by'])
        ->where('status', 'pending')
        ->exists();

    if ($exists) {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'product_id' => 'Kamu sudah punya 1 pengajuan PENDING untuk Produk & SPBU ini.',
        ]);
    }

    return $data;
}
}
