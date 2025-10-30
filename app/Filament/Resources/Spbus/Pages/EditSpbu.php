<?php

namespace App\Filament\Resources\Spbus\Pages;

use App\Filament\Resources\Spbus\SpbuResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSpbu extends EditRecord
{
    protected static string $resource = SpbuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
            ->tooltip('Hapus SPBU')
,
        ];
    }
    public function getTitle(): string
    {
        return 'Ubah SPBU';
    }
}
