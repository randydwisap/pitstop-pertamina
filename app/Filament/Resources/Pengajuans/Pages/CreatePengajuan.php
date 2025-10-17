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
        // Set creator
        $data['created_by'] = auth()->id();

        // VALIDASI: hanya 1 pending utk kombinasi (product_id, spbu_id)
        $exists = Pengajuan::query()
            ->where('product_id', $data['product_id'] ?? null)
            ->where('spbu_id', $data['spbu_id'] ?? null)
            ->where('status', 'pending')
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'product_id' => 'Sudah ada pengajuan PENDING untuk produk & SPBU ini. Silakan tunggu diproses atau ubah pilihan.',
            ]);
        }

        return $data;
    }
}
