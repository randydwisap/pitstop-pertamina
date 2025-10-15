<?php

namespace App\Filament\Resources\Tokos\Pages;

use App\Filament\Resources\Tokos\TokoResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions\Action;

class CreateToko extends CreateRecord
{
    protected static string $resource = TokoResource::class;
    protected static bool $canCreateAnother = false;
    public function getTitle(): string
    {
        return 'Tambah Toko';
    }
        protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();   // ← isi otomatis user_id
        return $data;
    }
}

