<?php

namespace App\Filament\Resources\Pengajuans\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\HtmlString;
use App\Models\Produk;
use App\Models\Spbu;


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
            $query->where('is_active', true);
            if (! $user?->hasAnyRole(['super_admin', 'Super Admin'])) {
                $query->where('user_id', $user?->id ?? 0);
            }
        },
    )
    ->searchable()
    ->preload()
    ->native(false)
    ->required()
    ->reactive(), // ⬅️ penting: agar preview update saat dipilih

      Select::make('spbu_id')
    ->label('SPBU')
    ->relationship(
        name: 'spbu',
        titleAttribute: 'nomor_spbu',
        modifyQueryUsing: function ($query) {
            // Hanya tampilkan SPBU yang masih punya slot kosong
            $query->whereRaw("
                (
                    SELECT COUNT(*)
                    FROM pengajuans
                    WHERE pengajuans.spbu_id = spbus.id
                      AND pengajuans.status = 'approved'
                      AND pengajuans.deleted_at IS NULL
                ) < spbus.slot
            ");
        },
    )
    ->reactive()
    ->searchable()
    ->preload()
    ->native(false)
    ->required(),

// PREVIEW FOTO PRODUK (muncul setelah ada pilihan)
Placeholder::make('product_preview')
    ->label('Preview Produk')
    ->content(function ($get) {
        $id = $get('product_id');
        if (! $id) return new HtmlString('—');

        $product = \App\Models\Produk::find($id);
        if (! $product) return new HtmlString('—');

        $url   = $product->picture
            ? Storage::disk('public')->url($product->picture)
            : asset('images/default-product.png');

        $harga = 'Rp ' . number_format((float) $product->harga_jual, 0, ',', '.');

        $html = <<<HTML
            <div style="display:flex; gap:.75rem; align-items:flex-start">
                <img src="{$url}" alt="{$product->nama_produk}" style="height:96px; width:auto; border-radius:.5rem; object-fit:cover;">
                <div style="line-height:1.2">
                    <div style="font-weight:600;">{$product->nama_produk}</div>
                    <div style="opacity:.7;">{$harga}</div>
                </div>
            </div>
        HTML;

        return new HtmlString($html);
    })
    ->hidden(fn ($get) => ! $get('product_id'))
   ->columnSpan(1),

          

            // PREVIEW SPBU
            Placeholder::make('spbu_preview')
                ->label('Preview SPBU')
                ->content(function ($get) {
                    $id = $get('spbu_id');
                    if (! $id) return new HtmlString('—');

                    /** @var Spbu|null $spbu */
                    $spbu = Spbu::query()
                        ->withCount(['pengajuans as approved_count' => fn ($q) => $q->where('status', 'approved')])
                        ->find($id);

                    if (! $spbu) return new HtmlString('—');

                    $foto = $spbu->foto
                        ? Storage::disk('public')->url($spbu->foto)
                        : asset('images/default-product.png');

                    $sisa = max(0, (int) $spbu->slot - (int) $spbu->approved_count);
                    $alamat = trim(implode(', ', array_filter([$spbu->alamat, $spbu->kelurahan, $spbu->kota])));

                    $html = <<<HTML
                        <div style="display:flex; gap:.75rem; align-items:flex-start">
                            <img src="{$foto}" alt="SPBU {$spbu->nomor_spbu}" style="height:96px; width:auto; border-radius:.5rem; object-fit:cover;">
                            <div style="line-height:1.2">
                                <div style="font-weight:600;">SPBU {$spbu->nomor_spbu}</div>
                                <div style="opacity:.9;">{$alamat}</div>
                                <div style="margin-top:.25rem;">
                                    <span style="display:inline-block; padding:.125rem .5rem; border-radius:.375rem; background:#ecfdf5; color:#065f46; font-size:.85rem;">
                                        Sisa Slot: {$sisa} / {$spbu->slot}
                                    </span>
                                </div>
                            </div>
                        </div>
                    HTML;

                    return new HtmlString($html);
                })
                ->hidden(fn ($get) => ! $get('spbu_id'))
                ->columnSpan(1),

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
