<?php

namespace App\Filament\Resources\Pengajuans\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class PengajuanForm
{
    public static function configure(Schema $schema): Schema
    {
         $user = auth()->user();
        $isApprover = $user && $user->hasAnyRole(['super_admin','Super Admin']);
        return $schema
        
            ->components([
               Select::make('product_id')
                ->label('Produk')
                ->relationship(
                    name: 'product',
                    titleAttribute: 'nama_produk',
                    modifyQueryUsing: function ($query) {
                        $user = auth()->user();

                        // hanya produk aktif
                        $query->where('is_active', true);

                        // kalau BUKAN super admin, batasi ke produk milik user
                        if (! $user?->hasAnyRole(['super_admin', 'Super Admin'])) {
                            $query->where('user_id', $user?->id ?? 0);
                        }
                    },
                )
                ->searchable()
                ->preload()
                ->native(false)
                ->required(),

            Select::make('spbu_id')
                ->label('SPBU')
                ->relationship('spbu', 'nomor_spbu')
                ->searchable()->preload()->native(false)->required(),

            TextInput::make('quantity')
                ->label('Jumlah')->numeric()->minValue(1)->default(1)->required(),

            Textarea::make('notes')->label('Catatan')->rows(3)->autosize(),

            Select::make('status')
                ->label('Status')
                ->options(['pending'=>'Pending','approved'=>'Approved'])
                ->default('pending')
                ->native(false)
                ->disabled(! $isApprover),
        ]);
    }
}
