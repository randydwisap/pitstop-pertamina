<?php

namespace App\Filament\Resources\Produks;

use App\Filament\Resources\Produks\Pages\CreateProduk;
use App\Filament\Resources\Produks\Pages\EditProduk;
use App\Filament\Resources\Produks\Pages\ListProduks;
use App\Filament\Resources\Produks\Schemas\ProdukForm;
use App\Filament\Resources\Produks\Tables\ProduksTable;
use App\Models\Produk;
use App\Models\Toko;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCube;
    protected static string|UnitEnum|null $navigationGroup  = 'Master Data';
    protected static ?string $modelLabel = 'Produk';
    protected static ?string $pluralModelLabel = 'Produk';

    public static function form(Schema $schema): Schema
    {
        return ProdukForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProduksTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        // Super Admin: lihat semua
        if ($user && $user->hasAnyRole(['super_admin', 'Super Admin'])) {
            return parent::getEloquentQuery();
        }

        // Cek apakah user punya Toko (anggap relasi hasOne: $user->toko())
        $hasToko = Toko::where('user_id', $user?->id ?? 0)->exists();

        if (! $hasToko) {
            // Paksa kosong → biar Empty State tampil
            return parent::getEloquentQuery()->whereRaw('1 = 0');
        }

        // Filter produk milik user (pakai user_id — kalau kamu pakai toko_id, ganti sesuai skema)
        return parent::getEloquentQuery()->where('user_id', $user->id);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProduks::route('/'),
            'create' => CreateProduk::route('/create'),
            'edit' => EditProduk::route('/{record}/edit'),
        ];
    }
}
