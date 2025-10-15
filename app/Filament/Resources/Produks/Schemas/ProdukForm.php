<?php

namespace App\Filament\Resources\Produks\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

class ProdukForm
{
    public static function configure(Schema $schema): Schema
    {
        $user = auth()->user();
        $isSuper = $user?->hasAnyRole(['super_admin', 'Super Admin']) ?? false;

        return $schema
            ->components([
            FileUpload::make('picture')
                ->label('Foto Produk')
                ->image()
                ->disk('public')
                ->directory('products')   // public/storage/products
                ->visibility('public')
                ->imagePreviewHeight('220')
                ->imageEditor()
                ->downloadable()
                ->openable()
                ->multiple(false) // pastikan single
                ->dehydrateStateUsing(fn ($state) => is_array($state) ? ($state[0] ?? null) : $state),

            TextInput::make('nama_produk')
                ->label('Nama Produk')
                ->required()
                ->maxLength(255),

            TextInput::make('harga_jual')
                ->label('Harga Jual')
                ->numeric()
                ->minValue(0)
                ->step(100)
                ->suffix('Rp')
                ->required(),

            Select::make('jenis_produk')
                ->label('Jenis Produk')
                ->options([
                    'oli'       => 'Oli',
                    'ban'       => 'Ban',
                    'aki'       => 'Aki',
                    'aksesoris' => 'Aksesoris',
                    'lainnya'   => 'Lainnya',
                ])
                ->searchable()
                ->native(false),

            TextInput::make('ekspektasi_penjualan')
                ->label('Ekspektasi Penjualan (per bulan)')
                ->numeric()
                ->minValue(0)
                ->step(1),

            Select::make('is_active')
                ->label('Status')
                ->options([1 => 'Aktif', 0 => 'Nonaktif'])
                ->default(1)
                ->native(false),

            // Toko: Super Admin bisa pilih; user biasa auto-isi & disembunyikan
            Select::make('toko_id')
                ->label('Toko')
                ->relationship('toko', 'nama_toko')
                ->searchable()
                ->preload()
                ->required()
                ->native(false)
                ->default(function () use ($user, $isSuper) {
                    if ($isSuper) return null;
                    return \App\Models\Toko::query()->where('user_id', $user?->id)->value('id');
                })
                ->visible($isSuper),

            // User: auto current user (hidden)
            TextInput::make('user_id')
                ->default(fn () => auth()->id())
                ->dehydrated(true)
                ->visible(false),
        ]);
    }
}
