<?php

namespace App\Filament\Resources\Tokos\Pages;

use App\Filament\Resources\Tokos\TokoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use App\Models\Toko;

class ListTokos extends ListRecords
{
    protected static string $resource = TokoResource::class;

     protected function getHeaderActions(): array
    {
        $user = auth()->user();

        // User boleh create kalau:
        // - Punya permission create_toko (admin), atau
        // - Belum memiliki toko sama sekali.
        $canCreate = $user?->can('create_toko')
            || ! Toko::where('user_id', $user?->id)->exists();

        return [
            CreateAction::make()
                ->label('Buat Toko')
                ->icon('heroicon-m-plus')
                ->visible(fn () => $canCreate),
        ];
    }
    public function mount(): void
    {
        parent::mount();

        $user = auth()->user();

        if (! $user?->can('view_any_toko')) {
            $toko = Toko::where('user_id', $user?->id)->first();

            if ($toko) {
                $this->redirect(TokoResource::getUrl('edit', ['record' => $toko]));
            }
        }
    }
    public function getTitle(): string
    {
        return 'Daftar Toko';
    }
}
