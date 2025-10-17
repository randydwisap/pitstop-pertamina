<?php

namespace App\Filament\Resources\Spbus;

use App\Filament\Resources\Spbus\Pages\CreateSpbu;
use App\Filament\Resources\Spbus\Pages\EditSpbu;
use App\Filament\Resources\Spbus\Pages\ListSpbus;
use App\Filament\Resources\Spbus\Schemas\SpbuForm;
use App\Filament\Resources\Spbus\Tables\SpbusTable;
use App\Models\Spbu;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;

class SpbuResource extends Resource
{
    protected static ?string $model = Spbu::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-storefront';

    public static function getNavigationGroup(): UnitEnum|string|null
    {
        $user = auth()->user();

        if ($user && $user->hasAnyRole(['super_admin', 'Super Admin', 'admin', 'Admin'])) {
            return 'Master Data';
        }

        return 'Operasional';
    }
    protected static ?string $recordTitleAttribute          = 'nomor_spbu';

    public static function getNavigationSort(): ?int
    {
        return 1;
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationLabel(): string
    {
        return 'SPBU'; // tampil di menu sidebar
    }
    public static function getModelLabel(): string
    {
        return 'SPBU';
    }

    public static function getPluralModelLabel(): string
    {
        return 'SPBU';
    }
    public static function form(Schema $schema): Schema
    {
        return SpbuForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SpbusTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            \App\Filament\Resources\Spbus\RelationManagers\PengajuansRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSpbus::route('/'),
            'create' => CreateSpbu::route('/create'),
            'edit' => EditSpbu::route('/{record}/edit'),
        ];
    }
}
