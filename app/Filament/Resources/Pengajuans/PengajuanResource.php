<?php

namespace App\Filament\Resources\Pengajuans;

use App\Filament\Resources\Pengajuans\Pages\CreatePengajuan;
use App\Filament\Resources\Pengajuans\Pages\EditPengajuan;
use App\Filament\Resources\Pengajuans\Pages\ListPengajuans;
use App\Filament\Resources\Pengajuans\Schemas\PengajuanForm;
use App\Filament\Resources\Pengajuans\Tables\PengajuansTable;
use App\Models\Pengajuan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class PengajuanResource extends Resource
{
    protected static ?string $model = Pengajuan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;
    protected static string|UnitEnum|null $navigationGroup  = 'Operasional';
    protected static ?string $modelLabel = 'Pengajuan';
    protected static ?string $pluralModelLabel = 'Pengajuan';

    public static function form(Schema $schema): Schema
    {
        return PengajuanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PengajuansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }


     public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        // super admin lihat semua
        if ($user && $user->hasAnyRole(['super_admin','Super Admin'])) {
            return parent::getEloquentQuery();
        }

        // user biasa hanya lihat miliknya
        return parent::getEloquentQuery()->where('created_by', $user?->id ?? 0);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => ListPengajuans::route('/'),
            'create' => CreatePengajuan::route('/create'),
            'edit' => EditPengajuan::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
