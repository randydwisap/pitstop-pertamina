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

class SpbuResource extends Resource
{
    protected static ?string $model = Spbu::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-storefront';
    protected static string|UnitEnum|null $navigationGroup  = 'Master Data';
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
            //
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
