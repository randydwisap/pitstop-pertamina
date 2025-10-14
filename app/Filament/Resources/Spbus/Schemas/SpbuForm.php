<?php

namespace App\Filament\Resources\Spbus\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class SpbuForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            FileUpload::make('foto')
                ->label('Foto SPBU')
                ->image()
                ->directory('spbu')     // storage/app/public/spbu
                ->disk('public')        // pastikan sudah `php artisan storage:link`
                ->visibility('public')
                ->imagePreviewHeight('220')
                ->imageEditor()
                ->downloadable()
                ->openable()
                ->hint('Unggah foto tampak depan SPBU (opsional).'),

            TextInput::make('nomor_spbu')
                ->label('Nomor SPBU')
                ->placeholder('Mis. 31.123.45')
                ->prefix('SPBU')
                ->required()
                ->maxLength(100)
                ->unique('spbus', 'nomor_spbu', ignoreRecord: true)
                ->helperText('Gunakan format resmi SPBU.'),

            Select::make('tipe')
                ->label('Tipe SPBU')
                ->options([
                    'internal'  => 'Internal',
                    'eksternal' => 'Eksternal',
                ])
                ->native(false)   // dropdown modern
                ->searchable()
                ->default('internal')
                ->required(),       

            Select::make('kota')
                ->label('Kota / Kab.')
                ->placeholder('Cari nama kota…')
                ->searchable()
                ->searchDebounce(500)
                ->loadingMessage('Memuat daftar kota…')
                ->noSearchResultsMessage('Kota tidak ditemukan.')
                ->getSearchResultsUsing(function (string $search) {
                    $response = \Illuminate\Support\Facades\Http::get(
                        'https://alamat.thecloudalert.com/api/kabkota/get/'
                    );

                    if (! $response->successful()) {
                        return [];
                    }

                    $data = collect($response->json()['result']);

                    if ($search !== '') {
                        $data = $data->filter(
                            fn ($item) => stripos($item['text'], $search) !== false
                        );
                    }

                    // gunakan nama kota sebagai value & label
                    return $data->mapWithKeys(fn ($item) => [
                        $item['text'] => $item['text'],
                    ])->toArray();
                })
                ->getOptionLabelUsing(fn ($value): ?string => $value) // WAJIB agar validasi opsi lolos
                ->native(false)
                ->required(),

            TextInput::make('kecamatan')
                ->label('Kecamatan')
                ->placeholder('Nama Kecamatan')
                ->maxLength(100),

            TextInput::make('kelurahan')
                    ->label('Kelurahan')
                    ->placeholder('Nama kelurahan')
                    ->maxLength(100),

            Textarea::make('alamat')
                ->label('Alamat')
                ->placeholder('Nama jalan, nomor, RT/RW…')
                ->rows(3)
                ->autosize()
                ->maxLength(255),    

            TextInput::make('potensi_konsumen')
                ->label('Potensi Konsumen')
                ->placeholder('0')
                ->numeric()
                ->minValue(0)
                ->step(1)
                ->suffix('kendaraan/hari')
                ->helperText('Perkiraan rata-rata kendaraan per hari.'),

            TextInput::make('slot')
                ->label('Slot')
                ->placeholder('0')
                ->numeric()
                ->minValue(0)
                ->step(1)
                ->default(0)
                ->suffix('slot')
                ->helperText('Jumlah slot tersedia untuk layanan Pitstop.'),

            TextInput::make('margin')
                ->label('Sharing Margin')
                ->placeholder('0')
                ->numeric()
                ->minValue(0)
                ->maxValue(100)
                ->step(0.1)
                ->default(0)
                ->suffix('%')
                ->helperText('Persentase bagi hasil (0–100%).'),
        ]);
    }
}
