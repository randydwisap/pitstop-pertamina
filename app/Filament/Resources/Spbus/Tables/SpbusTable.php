<?php

namespace App\Filament\Resources\Spbus\Tables;
use Filament\Forms\Components\FileUpload;

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
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;

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
        ViewAction::make()
    ->hiddenLabel()
    ->tooltip('Lihat detail SPBU')
    ->color('warning')
    ->icon('heroicon-m-eye')
    ->form(fn ($record) => [
        // === FOTO SPBU ===
        FileUpload::make('foto')
            ->label('Foto SPBU')
            ->image()
            ->directory('spbu')
            ->disk('public')
            ->visibility('public')
            ->imagePreviewHeight('240')
            ->openable()
            ->downloadable()
            ->disabled()
            ->columnSpanFull(),

        // === NOMOR SPBU ===
        TextInput::make('nomor_spbu')
            ->label('Nomor SPBU')
            ->default($record->nomor_spbu)
            ->prefix('SPBU')
            ->disabled()
            ->columnSpanFull(),

        // === TIPE SPBU ===
        TextInput::make('tipe')
            ->label('Tipe SPBU')
            ->default(strtoupper($record->tipe))
            ->disabled()
            ->columnSpanFull(),

        // === KOTA ===
        TextInput::make('kota')
            ->label('Kota / Kab.')
            ->default($record->kota)
            ->disabled()
            ->columnSpanFull(),

        // === KECAMATAN ===
        TextInput::make('kecamatan')
            ->label('Kecamatan')
            ->default($record->kecamatan)
            ->disabled()
            ->columnSpanFull(),

        // === KELURAHAN ===
        TextInput::make('kelurahan')
            ->label('Kelurahan')
            ->default($record->kelurahan)
            ->disabled()
            ->columnSpanFull(),

        // === ALAMAT ===
        Textarea::make('alamat')
            ->label('Alamat')
            ->default($record->alamat)
            ->disabled()
            ->rows(3)
            ->columnSpanFull(),

        // === POTENSI KONSUMEN ===
        TextInput::make('potensi_konsumen')
            ->label('Potensi Konsumen')
            ->default($record->potensi_konsumen)
            ->suffix('kendaraan/hari')
            ->disabled()
            ->columnSpanFull(),

        // === SLOT ===
        TextInput::make('slot')
            ->label('Slot')
            ->default($record->slot)
            ->suffix('slot')
            ->disabled()
            ->columnSpanFull(),

        // === MARGIN ===
        TextInput::make('margin')
            ->label('Sharing Margin')
            ->default($record->margin)
            ->suffix('%')
            ->disabled()
            ->columnSpanFull(),

        // === NAMA PIC ===
        TextInput::make('nama_pic')
            ->label('Nama PIC')
            ->default($record->nama_pic)
            ->disabled()
            ->columnSpanFull(),

        // === NOMOR PIC ===
        TextInput::make('nomor_pic')
            ->label('Nomor PIC')
            ->default($record->nomor_pic)
            ->tel()
            ->disabled()
            ->columnSpanFull(),
            // === DAFTAR PRODUK ===
\Filament\Forms\Components\Placeholder::make('produk_table')
    ->label(fn ($record) => 'Produk Terdaftar (' . $record->produks()->count() . ')')
    ->content(function ($record) {
$produkList = $record->produks()
    ->where('pengajuans.status', 'approved') // filter langsung di hasManyThrough
    ->with('toko')
    ->get(['id', 'toko_id', 'picture', 'nama_produk', 'jenis_produk', 'harga_jual', 'deskripsi']);

    if ($produkList->isEmpty()) {
        return new HtmlString('<p class="text-gray-500 italic">Belum ada produk terdaftar di SPBU ini.</p>');
    }

    $html = '
    <div style="
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        padding: 16px;
        ">
        <div style="display:flex;flex-wrap:wrap;gap:16px;">';

    foreach ($produkList as $produk) {
        $url = $produk->picture
            ? asset('storage/' . $produk->picture)
            : 'https://via.placeholder.com/200x120?text=No+Image';

        $html .= '
        <div style="
            width:280px;
            border:1px solid #e5e7eb;
            border-radius:10px;
            background:white;
            box-shadow:0 1px 3px rgba(0,0,0,0.05);
            overflow:hidden;
            display:flex;
            flex-direction:column;
            ">
            <img src="' . e($url) . '" 
                 style="width:100%;height:160px;object-fit:cover;border-bottom:1px solid #e5e7eb;">
            <div style="padding:10px;display:flex;flex-direction:column;justify-content:space-between;flex-grow:1;">
                <div>
                    <div style="font-weight:600;font-size:14px;color:#111827;">' . e($produk->nama_produk) . '</div>
                    <div style="font-size:12px;color:#6b7280;">' . e(optional($produk->toko)->nama_toko ?? '-') . '</div>
                    <div style="font-size:12px;color:#4b5563;margin-top:4px;">' . e(Str::limit($produk->deskripsi, 70)) . '</div>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;margin-top:6px;">
                    <span style="font-size:12px;background:#f3f4f6;color:#374151;padding:2px 6px;border-radius:6px;">' . e($produk->jenis_produk) . '</span>
                    <span style="font-size:13px;font-weight:600;color:#059669;">Rp' . number_format($produk->harga_jual, 0, ',', '.') . '</span>
                </div>
            </div>
        </div>';
    }

    $html .= '
        </div>
    </div>';

    return new HtmlString($html);
})


    ->columnSpanFull()
    ->extraAttributes(['class' => 'mt-6'])
    ->html(),

    ]),

        EditAction::make()
            ->hiddenLabel()
            ->tooltip('Edit data SPBU')
            ->color('info')
            ->icon('heroicon-m-pencil-square'),

        DeleteAction::make()
            ->hiddenLabel()
            ->tooltip('Hapus SPBU')
            ->color('danger')
            ->icon('heroicon-m-trash'),

        Action::make('ajukanProduk')
            ->label('Ajukan')
            ->tooltip('Ajukan produk ke SPBU ini')
            ->icon('heroicon-m-paper-airplane')
            ->color('success')
            ->visible(function ($record) {
                $user = auth()->user();

                if (! $user?->hasAnyRole(['mitra', 'Mitra'])) {
                    return false;
                }

                $total = (int) $record->slot;
                $terpakai = (int) ($record->approved_pengajuans_count ?? 0);
                return ($total - $terpakai) > 0;
            })
            ->modalHeading(fn ($record) => 'Ajukan Produk ke SPBU ' . ($record->nomor_spbu ?? ''))
            ->form(fn ($record) => [
                Select::make('product_id')
                    ->label('Produk')
                    ->options(function () use ($record) {
                        $userId = auth()->id();

                        return \App\Models\Produk::query()
                            ->where('is_active', true)
                            ->where('user_id', $userId)
                            ->whereNotExists(function ($q) use ($record, $userId) {
                                $q->selectRaw(1)
                                    ->from('pengajuans')
                                    ->whereColumn('pengajuans.product_id', 'produks.id')
                                    ->where('pengajuans.spbu_id', $record->id)
                                    ->where('pengajuans.created_by', $userId)
                                    ->whereNull('pengajuans.deleted_at')
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
            ->action(function ($record, array $data, $livewire) {
                $produk = \App\Models\Produk::query()
                    ->whereKey($data['product_id'] ?? 0)
                    ->where('user_id', auth()->id())
                    ->where('is_active', true)
                    ->first();

                if (! $produk) {
                    $livewire->dispatch('notify', type: 'danger', body: 'Produk tidak valid / bukan milik Anda.');
                    return;
                }

                $slot = (int) ($record->slot ?? 0);
                $terpakai = \App\Models\Pengajuan::query()
                    ->where('spbu_id', $record->id)
                    ->where('status', 'approved')
                    ->count();

                if ($terpakai >= $slot) {
                    $livewire->dispatch('notify', type: 'danger', body: 'Maaf, slot SPBU ini sudah penuh.');
                    return;
                }

                $sudahAda = \App\Models\Pengajuan::query()
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

                \App\Models\Pengajuan::create([
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
    ])
    ->buttonGroup(), // ✅ wajib tutup ActionGroup di sini
        ]); // ✅ tutup recordActions


    }
}



