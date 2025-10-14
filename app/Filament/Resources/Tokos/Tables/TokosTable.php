<?php

namespace App\Filament\Resources\Tokos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\ImageColumn;

class TokosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    ImageColumn::make('foto')
                        ->label('')
                        ->disk('public')
                        ->height(160)
                        ->extraImgAttributes([
                            'class' => 'w-full h-40 object-cover rounded-xl',
                        ]),

                    TextColumn::make('nama_toko')
                        ->label('Nama Toko')
                        ->weight('bold')
                        ->size('lg')
                        ->searchable()
                        ->sortable(),

                    TextColumn::make('alamat_toko')
                        ->label('Alamat')
                        ->icon('heroicon-m-map-pin')
                        ->wrap()
                        ->limit(100),

                    TextColumn::make('user.name')
                        ->label('Pemilik')
                        ->icon('heroicon-m-user')
                        ->color('gray'),
                ])
                ->space(2)
                ->extraAttributes([
                    // kartu yang rapi
                    'class' => 'p-4 rounded-2xl border bg-white shadow-sm dark:bg-gray-900',
                ]),
            ])
            ->contentGrid([
                'md' => 2,
                'xl' => 3,
            ])
            ->recordActions([
                EditAction::make('kelola')
                    ->label('Kelola')
                    ->icon('heroicon-m-pencil-square')
                    ->color('primary')
                    ->button()
                    ->visible(fn ($record) =>
                        auth()->user()?->can('update_toko') ||
                        $record->user_id === auth()->id()
                    ),
            ])
            ->emptyStateHeading('Belum ada data toko')
            ->emptyStateDescription('Tambahkan data toko Anda terlebih dahulu.')
            ->emptyStateIcon('heroicon-o-building-storefront');
    }
}
