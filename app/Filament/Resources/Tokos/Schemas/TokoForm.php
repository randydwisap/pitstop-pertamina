<?php

namespace App\Filament\Resources\Tokos\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;

class TokoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
        ->columns(1)
            ->components([
                 FileUpload::make('foto')
                    ->label('Foto Toko')
                    ->image()
                    ->disk('public')
                    ->directory('tokos')
                    ->visibility('public')
                    ->imagePreviewHeight('260')
                    ->imageEditor()
                    ->panelLayout('compact') // tampil ringkas (kalau tersedia di v4)
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(2048)
                    ->downloadable()
                    ->openable()
                    ->dehydrateStateUsing(fn ($state) => is_array($state) ? ($state[0] ?? null) : $state)
                    ->helperText('Gunakan foto tampak depan atau logo, rasio 16:9. Maks 2MB.'),
                
                // NAMA TOKO — auto-trim & kapitalisasi awal kata biar rapi
                TextInput::make('nama_toko')
                    ->label('Nama Toko')
                    ->placeholder('Mis. Pitstop Snack')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (callable $set, ?string $state) {
                        $set('nama_toko', collect(explode(' ', trim((string) $state)))
                            ->filter()
                            ->map(fn ($w) => mb_convert_case($w, MB_CASE_TITLE, 'UTF-8'))
                            ->implode(' '));
                    })
                    ->helperText('Nama yang tampil ke admin. Gunakan huruf kapital yang rapi.'),

                // ALAMAT — textarea rapi, auto-size
                Textarea::make('alamat_toko')
                    ->label('Alamat Lengkap')
                    ->placeholder('Nama jalan, nomor, RT/RW, kelurahan/kecamatan, kota')
                    ->rows(4)
                    ->autosize()
                    ->maxLength(500)
                    ->helperText('Cantumkan alamat lengkap agar mudah ditemukan.')
                    ->columnSpanFull(),

                // USER ID — otomatis milik user login, disimpan tapi disembunyikan
                Select::make('user_id')
                    ->label('Pemilik (User)')
                    ->relationship('user', 'name')
                    ->default(fn () => auth()->id())
                    ->dehydrated(true)
                    ->hidden(),
            ]);
    }
}
