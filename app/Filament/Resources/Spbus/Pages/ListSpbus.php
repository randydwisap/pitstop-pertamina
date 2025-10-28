<?php

namespace App\Filament\Resources\Spbus\Pages;

use App\Filament\Resources\Spbus\SpbuResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSpbus extends ListRecords
{
    protected static string $resource = SpbuResource::class;
    public function getTitle(): string
    {
        return 'List SPBU'; // heading H1
    }
    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat SPBU')
                ->icon('heroicon-m-plus')
        ];
    }
}
