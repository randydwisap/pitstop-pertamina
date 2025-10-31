<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Spbu;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pengguna', User::count())
                ->description('Jumlah seluruh pengguna terdaftar')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('primary'),

            Stat::make('Total SPBU', Spbu::count())
                ->description('Jumlah seluruh SPBU aktif')
                ->descriptionIcon('heroicon-m-map-pin')
                ->color('success'),
        ];
    }
}
