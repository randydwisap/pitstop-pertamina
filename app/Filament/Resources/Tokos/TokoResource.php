<?php

namespace App\Filament\Resources\Tokos;

use App\Filament\Resources\Tokos\Pages\CreateToko;
use App\Filament\Resources\Tokos\Pages\EditToko;
use App\Filament\Resources\Tokos\Pages\ListTokos;
use App\Filament\Resources\Tokos\Schemas\TokoForm;
use App\Filament\Resources\Tokos\Tables\TokosTable;
use App\Models\Toko;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Contracts\Support\Htmlable;

class TokoResource extends Resource
{
    protected static ?string $model = Toko::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-shopping-bag';
    
   public static function getNavigationGroup(): UnitEnum|string|null
    {
        $user = auth()->user();

        if ($user && $user->hasAnyRole(['super_admin', 'Super Admin', 'admin', 'Admin'])) {
            return 'Master Data';
        }

        return 'Management';
    }

    protected static ?string $recordTitleAttribute          = 'nama_toko';
        public static function getNavigationLabel(): string
    {
        return 'Manajemen Toko'; // tampil di menu sidebar
    }
    public static function getModelLabel(): string
    {
        return 'Manajemen Toko';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Manajemen Toko';
    }

    public static function getEloquentQuery(): Builder
    {
        $user = auth()->user();

        // Super Admin boleh lihat semua
        if ($user && $user->hasAnyRole(['super_admin', 'Super Admin'])) {
            return parent::getEloquentQuery();
        }

        // Selain itu, hanya lihat toko miliknya
        return parent::getEloquentQuery()
            ->where('user_id', $user?->id ?? 0);
    }

    public static function form(Schema $schema): Schema
    {
        return TokoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TokosTable::configure($table);
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
            'index' => ListTokos::route('/'),
            'create' => CreateToko::route('/create'),
            'edit' => EditToko::route('/{record}/edit'),
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
