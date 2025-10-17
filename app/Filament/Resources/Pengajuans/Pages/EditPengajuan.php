<?php

namespace App\Filament\Resources\Pengajuans\Pages;

use App\Filament\Resources\Pengajuans\PengajuanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Illuminate\Validation\ValidationException;
use App\Models\Pengajuan;
use Filament\Resources\Pages\EditRecord;

class EditPengajuan extends EditRecord
{
    protected static string $resource = PengajuanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }

 protected function mutateFormDataBeforeSave(array $data): array
{
    $exists = \App\Models\Pengajuan::query()
        ->where('product_id', $data['product_id'] ?? null)
        ->where('spbu_id', $data['spbu_id'] ?? null)
        ->where('created_by', $this->record->created_by)
        ->where('status', 'pending')
        ->whereKeyNot($this->record->getKey())
        ->exists();

    if ($exists) {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'product_id' => 'Kamu sudah punya pengajuan PENDING untuk Produk & SPBU ini.',
        ]);
    }

    return $data;
}
}
