<?php

namespace App\Filament\Resources\Spbus\Tables;

use App\Models\Spbu;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ActionGroup;
use Filament\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use App\Models\Produk;
use App\Models\Pengajuan;

class SpbusTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                $query->withCount([
                    'pengajuans as approved_pengajuans_count' => function ($q) {
                        $q->where('status', 'approved');
                    },
                ]);
            })
            ->columns([
                Panel::make([
                    // susunan vertikal: gambar → teks
                    Stack::make([
                        // FOTO ATAS (rasio stabil, full width)
                        ImageColumn::make('foto')
                            ->label(' ')
                            ->disk('public')                        
                            ->imageWidth(150)
                            ->imageHeight(200)
                            ->defaultImageUrl(url('storage/spbu/01K7G9THE78J35TY01G4BRWGQD.png'))
                            ->grow(true),

                        // TEKS
                        TextColumn::make('nomor_spbu')
                            ->label(' ')
                            ->weight('semibold')
                            ->prefix('SPBU ')
                            ->searchable()
                            ->size('sm'),

                        TextColumn::make('kelurahan')
                            ->label(' ')
                            ->prefix('Kelurahan ')
                            ->searchable()
                            ->size('sm'),

                        TextColumn::make('potensi_konsumen')
                            ->label(' ')       
                            ->suffix(' kendaraan/hari')                     
                            ->size('sm'),

                        TextColumn::make('margin')
                            ->label(' ')
                            ->prefix('Share Margin ')      
                            ->suffix('%')                      
                            ->size('sm'),

                        TextColumn::make('sisa_slot')
                    ->label(' ')
                    ->state(function ($record) {
                        $total  = (int) $record->slot;
                        $terpakai = (int) ($record->approved_pengajuans_count ?? 0);
                        $sisa   = max($total - $terpakai, 0);

                        return "Sisa Slot {$sisa}/{$total}";
                    })
                    ->badge()
                    ->color(function ($record) {
                        $total  = (int) $record->slot;
                        $terpakai = (int) ($record->approved_pengajuans_count ?? 0);
                        $sisa   = max($total - $terpakai, 0);

                        if ($sisa <= 0) return 'danger';         // penuh
                        if ($sisa <= max(1, floor($total * 0.2))) return 'warning'; // hampir penuh
                        return 'success';                          // masih banyak
                    })
                    ->size('sm'),
                        // Spasi kecil lalu kota
                        TextColumn::make('kota')
                            ->label(' ')
                            ->size('sm')
                            ->prefix('Kota ')
                            ->visible(false)
                            ->extraAttributes(['class' => 'mt-2']),
                    ])
                    ->space(0), // rapat seperti contoh
                ])
                // gaya kartu: border hijau tipis + bayangan halus
                ->extraAttributes(['class' => 'p-0 rounded-lg border border-emerald-300/80 bg-white shadow-sm overflow-hidden h-full']),
            ])

            // grid luar: aman di semua zoom (kartu tetap tegak)
            ->contentGrid([
                'sm'  => 1,
                'lg'  => 3,
                '2xl' => 4,
            ])

            ->filters([
                SelectFilter::make('kota')
                    ->label('Kota')
                    ->options(fn () => Spbu::query()
                        ->whereNotNull('kota')
                        ->select('kota')
                        ->distinct()
                        ->orderBy('kota')
                        ->pluck('kota', 'kota')
                        ->toArray()
                    ),
            ])

            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()->label('Lihat'),
                    EditAction::make()->label('Ubah'),
                    DeleteAction::make()->label('Hapus'),
                    // === AJUKAN PRODUK (khusus mitra) ===
                   Action::make('ajukanProduk')
    ->label('Ajukan Produk')
    ->icon('heroicon-m-paper-airplane')
    ->visible(function ($record) {
        $user = auth()->user();

        // hanya role mitra & masih ada sisa slot
        if (! $user?->hasAnyRole(['mitra', 'Mitra'])) {
            return false;
        }

        $total     = (int) $record->slot;
        $terpakai  = (int) ($record->approved_pengajuans_count ?? 0);

        return ($total - $terpakai) > 0;
    })
    ->modalHeading(fn (Spbu $record) => 'Ajukan Produk ke SPBU ' . ($record->nomor_spbu ?? ''))
    // ⬇️ form pakai closure supaya dapat $record (SPBU yang dipilih)
    ->form(fn (Spbu $record) => [
        Select::make('product_id')
            ->label('Produk')
            ->options(function () use ($record) {
                $userId = auth()->id();

                return Produk::query()
                    ->where('is_active', true)
                    ->where('user_id', $userId)
                    // ⬇️ HANYA produk yang BELUM diajukan ke SPBU ini oleh user
                    ->whereNotExists(function ($q) use ($record, $userId) {
                        $q->selectRaw(1)
                          ->from('pengajuans')
                          ->whereColumn('pengajuans.product_id', 'produks.id')
                          ->where('pengajuans.spbu_id', $record->id)
                          ->where('pengajuans.created_by', $userId)
                          ->whereNull('pengajuans.deleted_at')
                          // anggap "pernah diajukan" = ada pengajuan status pending ATAU approved
                          ->whereIn('pengajuans.status', ['pending', 'approved']);
                    })
                    ->orderBy('nama_produk')
                    ->pluck('nama_produk', 'id');
            })
            ->searchable()
            ->preload()
            ->native(false)
            ->required()
            ->helperText('Hanya produk aktif Anda yang belum diajukan ke SPBU ini.'),

        TextInput::make('quantity')
            ->label('Jumlah')
            ->numeric()
            ->minValue(1)
            ->default(1)
            ->required(),

        Textarea::make('notes')
            ->label('Catatan')
            ->rows(3)
            ->autosize(),
    ])
    ->action(function (Spbu $record, array $data, $livewire) {
        // validasi produk masih milik user & aktif
        $produk = Produk::query()
            ->whereKey($data['product_id'] ?? 0)
            ->where('user_id', auth()->id())
            ->where('is_active', true)
            ->first();

        if (! $produk) {
            $livewire->dispatch('notify', type: 'danger', body: 'Produk tidak valid / bukan milik Anda.');
            return;
        }

        // Cek slot SPBU (1 pengajuan = 1 slot)
        $slot = (int) ($record->slot ?? 0);
        $terpakai = Pengajuan::query()
            ->where('spbu_id', $record->id)
            ->where('status', 'approved')
            ->count();

        if ($terpakai >= $slot) {
            $livewire->dispatch('notify', type: 'danger', body: 'Maaf, slot SPBU ini sudah penuh.');
            return;
        }

        // Cegah duplikat pending/approved ke SPBU yang sama oleh user ini
        $sudahAda = Pengajuan::query()
            ->where('product_id', $produk->id)
            ->where('spbu_id', $record->id)
            ->where('created_by', auth()->id())
            ->whereIn('status', ['pending', 'approved'])
            ->whereNull('deleted_at')
            ->exists();

        if ($sudahAda) {
            $livewire->dispatch('notify', type: 'warning', body: 'Produk ini sudah diajukan ke SPBU tersebut.');
            return;
        }

        Pengajuan::create([
            'product_id' => $produk->id,
            'spbu_id'    => $record->id,
            'status'     => 'pending',
            'created_by' => auth()->id(),
            'quantity'   => (int) ($data['quantity'] ?? 1),
            'notes'      => $data['notes'] ?? null,
        ]);

        $livewire->dispatch('notify', type: 'success', body: 'Pengajuan berhasil dibuat & menunggu persetujuan.');
        $livewire->dispatch('$refresh');
    }),
                ])->icon('heroicon-m-ellipsis-vertical'),
            ]);
    }
}
