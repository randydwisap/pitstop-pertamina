<?php

namespace App\Filament\Widgets;

use App\Models\Pengajuan;
use Filament\Widgets\ChartWidget;

class PengajuanChart extends ChartWidget
{
    protected ?string $heading = 'Statistik Pengajuan';


    protected function getData(): array
    {
        // Hitung jumlah pengajuan berdasarkan status
        $total = Pengajuan::count();
        $approved = Pengajuan::where('status', 'approved')->count();
        $pending = Pengajuan::where('status', 'pending')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengajuan',
                    'data' => [$total, $approved, $pending],
                    'backgroundColor' => ['#3B82F6', '#10B981', '#FACC15'], // biru, hijau, kuning
                    'borderColor' => '#ffffff',
                    'borderWidth' => 2,
                ],
            ],
            'labels' => ['Total', 'Approved', 'Pending'],
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Bisa diganti ke 'doughnut' atau 'pie'
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }
}
