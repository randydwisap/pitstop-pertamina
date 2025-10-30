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
                ->imagePreviewHeight('240')
                ->imageEditor()
                ->downloadable()
                ->openable()
                ->hint('Unggah foto tampak depan SPBU (opsional).')
                ->columnSpanFull(),     // tampil penuh 1 kolom

            TextInput::make('nomor_spbu')
                ->label('Nomor SPBU')
                ->placeholder('Mis. 31.123.45')
                ->prefix('SPBU')
                ->required()
                ->maxLength(100)
                ->unique('spbus', 'nomor_spbu', ignoreRecord: true)
                ->helperText('Gunakan format resmi SPBU.')
                ->columnSpanFull(),

            Select::make('tipe')
                ->label('Tipe SPBU')
                ->options([
                    'coco' => 'COCO',
                    'dodo' => 'DODO',
                    'codo' => 'CODO',
                ])
                ->native(false)
                ->searchable()
                ->default('coco')
                ->required()
                ->columnSpanFull(),

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

                    return $data->mapWithKeys(fn ($item) => [
                        $item['text'] => $item['text'],
                    ])->toArray();
                })
                ->getOptionLabelUsing(fn ($value): ?string => $value)
                ->native(false)
                ->required()
                ->columnSpanFull(),

            TextInput::make('kecamatan')
                ->label('Kecamatan')
                ->placeholder('Nama Kecamatan')
                ->maxLength(100)
                ->columnSpanFull(),

            TextInput::make('kelurahan')
                ->label('Kelurahan')
                ->placeholder('Nama kelurahan')
                ->maxLength(100)
                ->columnSpanFull(),

            Textarea::make('alamat')
                ->label('Alamat')
                ->placeholder('Nama jalan, nomor, RT/RW…')
                ->rows(3)
                ->autosize()
                ->maxLength(255)
                ->columnSpanFull(),

            TextInput::make('potensi_konsumen')
                ->label('Potensi Konsumen')
                ->placeholder('0')
                ->numeric()
                ->minValue(0)
                ->step(1)
                ->suffix('kendaraan/hari')
                ->helperText('Perkiraan rata-rata kendaraan per hari.')
                ->columnSpanFull(),

            TextInput::make('slot')
                ->label('Slot')
                ->placeholder('0')
                ->numeric()
                ->minValue(0)
                ->step(1)
                ->default(0)
                ->suffix('slot')
                ->helperText('Jumlah slot tersedia untuk layanan Pitstop.')
                ->columnSpanFull(),

            TextInput::make('margin')
                ->label('Sharing Margin')
                ->placeholder('0')
                ->numeric()
                ->minValue(0)
                ->maxValue(100)
                ->step(0.1)
                ->default(0)
                ->suffix('%')
                ->helperText('Persentase bagi hasil (0–100%).')
                ->columnSpanFull(),

            TextInput::make('nama_pic')
                ->label('Nama PIC')
                ->placeholder('Nama Penanggung Jawab')
                ->maxLength(100)
                ->required()
                ->helperText('Masukkan nama penanggung jawab SPBU.')
                ->columnSpanFull(),

            TextInput::make('nomor_pic')
                ->label('Nomor PIC')
                ->placeholder('08xxxxxxxxxx')
                ->tel() // gunakan input bertipe telepon
                ->maxLength(20)
                ->columnSpanFull()
                ->helperText('Nomor kontak PIC yang dapat dihubungi.'),
        ]);
    }
}
