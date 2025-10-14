<?php

namespace App\Filament\Resources\Spbus\Pages;

use App\Filament\Resources\Spbus\SpbuResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSpbu extends CreateRecord
{
    protected static string $resource = SpbuResource::class;
    public function getTitle(): string
    {
        return 'Buat SPBU';
    }
}
