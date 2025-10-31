<?php

namespace App\Filament\Resources\Produks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\ViewAction;
use App\Filament\Resources\Tokos\TokoResource;
use Filament\Tables\Columns\Layout\Panel;

class ProduksTable
{
    public static function configure(Table $table): Table
    {
        $user = auth()->user();
        $hasToko = $user?->toko()->exists() ?? false;
        $isSuper = $user?->hasAnyRole(['super_admin','Super Admin']) ?? false;
        return $table
            ->columns([
                     Panel::make([
                    Stack::make([
                        // FOTO PRODUK
                        ImageColumn::make('picture')
                            ->label(' ')
                            ->disk('public')
                            ->imageWidth(150)
                            ->imageHeight(200)
                            ->defaultImageUrl(url('images/default-product.png')) // siapkan file ini
                            ->grow(true),

                        // NAMA PRODUK
                        TextColumn::make('nama_produk')
                            ->label(' ')
                            ->weight('semibold')
                            ->size('sm')
                            ->wrap()
                            ->searchable(),

                        // HARGA
                        TextColumn::make('harga_jual')
                            ->label(' ')
                            ->money('idr', locale: 'id_ID')
                            ->size('sm'),

                        // JENIS (badge kecil)
                        TextColumn::make('jenis_produk')
                            ->label(' ')
                            ->badge()
                            ->color('info')
                            ->size('sm')
                            ->formatStateUsing(function ($state) {
                                $map = [
                                    'minuman' => 'Minuman',
                                    'kering'  => 'Makanan Kering',
                                    'panas'   => 'Makanan Panas',
                                    'lainnya' => 'Lainnya',
                                ];

                                return $map[strtolower((string) $state)] ?? ucfirst((string) $state);
                            }),

                        TextColumn::make('berat_gram')
                            ->label('Berat')
                            ->numeric()
                            ->suffix(' g')   // tampilkan gram
                            ->sortable(),

                        TextColumn::make('ukuran')
                            ->label('Ukuran')
                            ->state(function ($record) {
                                $p = $record->panjang_cm;
                                $l = $record->lebar_cm;
                                $t = $record->tinggi_cm;

                                if (! $p && ! $l && ! $t) {
                                    return null; // biar placeholder yang tampil
                                }

                                // tampilkan hanya yang ada
                                $parts = array_filter([$p, $l, $t], fn ($v) => filled($v));
                                return implode(' × ', $parts) . ' cm';
                            })
                            ->placeholder('-'),

                        TextColumn::make('kadaluarsa')
                            ->label('Kadaluarsa')
                            ->prefix('Expired: ')
                            ->state(function ($record) {
                                if (! $record->kadaluarsa_nilai || ! $record->kadaluarsa_satuan) {
                                    return null;
                                }

                                return $record->kadaluarsa_nilai . ' ' . $record->kadaluarsa_satuan;
                            })
                            ->badge()
                            ->color('warning')
                            ->placeholder('-'),

                        // EKSPEKTASI PENJUALAN / BLN
                        TextColumn::make('ekspektasi_penjualan')
                            ->label(' ')
                            ->numeric()
                            ->suffix(' unit/bln')
                            ->size('sm'),

                        // STATUS AKTIF (toggle inline)
                        ToggleColumn::make('is_active')
                            ->label('Aktif')
                            ->alignRight()
                            ->sortable(),
                        
                        TextColumn::make('toko.nama_toko')
                            ->label('Toko')
                            ->icon('heroicon-m-building-storefront')
                            ->size('sm')
                            ->wrap()
                            ->sortable()
                            ->visible(fn () => auth()->user()?->hasAnyRole(['super_admin', 'Super Admin']) === true),
                    ])->space(0),
                ])
                ->extraAttributes([
                    'class' =>
                        'p-0 rounded-lg border border-emerald-300/80 bg-white shadow-sm overflow-hidden h-full',
                ]),
            ])

            // GRID/LAYOUT KARTU
            ->contentGrid([
                'sm'  => 1,
                'lg'  => 3,
                '2xl' => 4,
            ])

            ->emptyStateIcon('heroicon-o-building-storefront')
            ->emptyStateHeading('Wajib membuat toko')
            ->emptyStateDescription('Untuk mengelola produk, silakan buat toko terlebih dahulu.')
            ->emptyStateActions([
                Action::make('buatToko')
                    ->label('Buat Toko')
                    ->url(TokoResource::getUrl('create'))
                    ->color('primary')
                    ->button()
                    ->visible(! $isSuper && ! $hasToko),
            ])
            // NONAKTIFKAN klik-card ke edit
            ->recordUrl(null)

            // FILTER (opsional)
            ->filters([
                SelectFilter::make('jenis_produk')
                    ->label('Jenis')
                    ->options([
                        'oli'       => 'Oli',
                        'ban'       => 'Ban',
                        'aki'       => 'Aki',
                        'aksesoris' => 'Aksesoris',
                        'lainnya'   => 'Lainnya',
                    ]),
                SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([1 => 'Aktif', 0 => 'Nonaktif']),
            ])

            // AKSI PER RECORD
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()->hiddenLabel()->tooltip('Lihat Produk')->color('warning'),
                    EditAction::make()->hiddenLabel()->color('info')->tooltip('Edit Produk'),
                    DeleteAction::make()->hiddenLabel()->color('danger')->tooltip('Hapus Produk'),
                ])->icon('heroicon-m-ellipsis-vertical')->buttonGroup(),
            ])

            // BULK ACTIONS
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }
}
