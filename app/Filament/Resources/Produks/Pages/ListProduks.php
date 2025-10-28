<?php

namespace App\Filament\Resources\Produks\Pages;

use App\Filament\Resources\Produks\ProdukResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProduks extends ListRecords
{
    protected static string $resource = ProdukResource::class;

protected function getHeaderActions(): array
    {
        $user    = auth()->user();
        $hasToko = $user?->toko()->exists() ?? false;
        $isSuper = $user?->hasAnyRole(['super_admin','Super Admin']) ?? false;

        return [
            CreateAction::make()
                ->visible($isSuper || $hasToko)
                ->label('Buat Produk')
                ->icon('heroicon-m-plus')
                ->mutateFormDataUsing(function (array $data) use ($user) {
                    // auto isi pemilik
                    $data['user_id'] = $user->id;

                    // kalau kamu simpan toko_id juga: 
                    if (method_exists($user, 'toko') && $user->toko) {
                        $data['toko_id'] = $user->toko->id;
                    }

                    return $data;
                }),
        ];
    }

    public function getTitle(): string
    {
        return 'Produk';
    }
}
