<?php

namespace App\Filament\Resources\Spbus\Tables;

use App\Models\Spbu;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ActionGroup;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Filters\SelectFilter;

class SpbusTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Panel::make([
                    // susunan vertikal: gambar → teks
                    Stack::make([
                        // FOTO ATAS (rasio stabil, full width)
                        ImageColumn::make('foto')
                            ->label(' ')
                            ->disk('public')                        
                            ->imageWidth(150)
                            ->imageHeight(200)
                            ->defaultImageUrl(url('storage/spbu/01K7G9THE78J35TY01G4BRWGQD.png'))
                            ->grow(true),

                        // TEKS
                        TextColumn::make('nomor_spbu')
                            ->label(' ')
                            ->weight('semibold')
                            ->prefix('SPBU ')
                            ->searchable()
                            ->size('sm'),

                        TextColumn::make('kelurahan')
                            ->label(' ')
                            ->prefix('Kelurahan ')
                            ->searchable()
                            ->size('sm'),

                        TextColumn::make('potensi_konsumen')
                            ->label(' ')       
                            ->suffix(' kendaraan/hari')                     
                            ->size('sm'),

                        TextColumn::make('margin')
                            ->label(' ')
                            ->prefix('Share Margin ')      
                            ->suffix('%')                      
                            ->size('sm'),

                        // “Available 5/10” — tebal
                        TextColumn::make('slot')
                            ->label(' ')
                            // ->formatStateUsing(function ($v, $record) {
                            //     // Jika kamu punya kolom total slot (mis. $record->kapasitas_slot), tampilkan “$v/$total”.
                            //     // Jika tidak, tampilkan “$v/10” sebagai default.
                            //     $total = $record->kapasitas_slot ?? 10;
                            //     return 'Available ' . (int) $v . '/' . (int) $total;
                            // })
                            ->weight('semibold')
                            ->prefix('Total Slot ')
                            ->size('sm'),

                        // Spasi kecil lalu kota
                        TextColumn::make('kota')
                            ->label(' ')
                            ->size('sm')
                            ->prefix('Kota ')
                            ->visible(false)
                            ->extraAttributes(['class' => 'mt-2']),
                    ])
                    ->space(0), // rapat seperti contoh
                ])
                // gaya kartu: border hijau tipis + bayangan halus
                ->extraAttributes(['class' => 'p-0 rounded-lg border border-emerald-300/80 bg-white shadow-sm overflow-hidden h-full']),
            ])

            // grid luar: aman di semua zoom (kartu tetap tegak)
            ->contentGrid([
                'sm'  => 1,
                'lg'  => 3,
                '2xl' => 4,
            ])

            ->filters([
                SelectFilter::make('kota')
                    ->label('Kota')
                    ->options(fn () => Spbu::query()
                        ->whereNotNull('kota')
                        ->select('kota')
                        ->distinct()
                        ->orderBy('kota')
                        ->pluck('kota', 'kota')
                        ->toArray()
                    ),
            ])

            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()->label('Lihat'),
                    EditAction::make()->label('Ubah'),
                    DeleteAction::make()->label('Hapus'),
                ])->icon('heroicon-m-ellipsis-vertical'),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
