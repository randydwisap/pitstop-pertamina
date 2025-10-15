<?php

namespace App\Filament\Resources\Produks\Pages;

use App\Filament\Resources\Produks\ProdukResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProduk extends CreateRecord
{
    protected static string $resource = ProdukResource::class;
    
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // pastikan user current
        $data['user_id'] = auth()->id();

        // jika bukan super admin & toko_id kosong, set toko miliknya
        if (empty($data['toko_id']) && ! auth()->user()?->hasAnyRole(['super_admin','Super Admin'])) {
            $data['toko_id'] = \App\Models\Toko::query()
                ->where('user_id', auth()->id())
                ->value('id');
        }

        return $data;
    }
}
