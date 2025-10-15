<?php

namespace App\Filament\Resources\Pengajuans\Pages;

use App\Filament\Resources\Pengajuans\PengajuanResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
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
        if (($data['status'] ?? null) === 'approved') {
            $this->record->approved_by ??= auth()->id();
            $this->record->approved_at ??= now();
        } else {
            $this->record->approved_by = null;
            $this->record->approved_at = null;
        }

        return $data;
    }
}
