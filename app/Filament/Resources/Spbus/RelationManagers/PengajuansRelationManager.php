<?php

namespace App\Filament\Resources\Spbus\RelationManagers;

use App\Models\Pengajuan;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Infolists\Components\TextEntry;

class PengajuansRelationManager extends RelationManager
{
    protected static string $relationship = 'pengajuans';
    protected static ?string $title = 'Pengajuan';

    /** Form untuk Create/Edit pengajuan di dalam SPBU */
    public function form(Schema $schema): Schema
    {
        $user = auth()->user();
        $isApprover = $user && $user->hasAnyRole(['super_admin', 'Super Admin']);

        return $schema->components([
            Select::make('product_id')
                ->label('Produk')
                ->relationship(
                    name: 'product',
                    titleAttribute: 'nama_produk',
                    modifyQueryUsing: function ($query) {
                        $user = auth()->user();
                        $spbu = $this->ownerRecord;

                        $query->where('is_active', true);

                        if (! $user?->hasAnyRole(['super_admin', 'Super Admin'])) {
                            $query->where('user_id', $user?->id ?? 0);
                        }

                        $query->whereNotIn('id', function ($sub) use ($spbu) {
                            $sub->select('product_id')
                                ->from('pengajuans')
                                ->where('spbu_id', $spbu->id)
                                ->whereNull('deleted_at');
                        });
                    }
                )
                ->searchable()
                ->preload()
                ->native(false)
                ->required(),

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

            Select::make('status')
                ->label('Status')
                ->options(['pending' => 'Pending', 'approved' => 'Approved'])
                ->default('pending')
                ->native(false)
                ->disabled(! $isApprover),
        ]);
    }

    /** Tabel daftar pengajuan untuk SPBU ini */
    public function table(Table $table): Table
    {
        $user = auth()->user();
        $canApprove = $user && $user->hasAnyRole(['super_admin','Super Admin']);

        return $table
            ->recordTitleAttribute('id')
            ->columns([
                ImageColumn::make('product.picture')
                    ->label(' ')
                    ->disk('public')
                    ->imageWidth(96)
                    ->imageHeight(96)
                    ->defaultImageUrl(url('images/default-product.png'))
                    ->grow(false),

                TextColumn::make('product.nama_produk')
                    ->label('Produk')
                    ->weight('semibold')
                    ->icon('heroicon-m-cube')
                    ->iconColor('primary')
                    ->wrap(),

                TextColumn::make('creator.name')
                    ->label('Diajukan oleh')
                    ->icon('heroicon-m-user-circle')
                    ->iconColor('gray')
                    ->description(
                        fn ($record) => $record->product?->toko?->nama_toko
                            ? 'Toko: ' . $record->product->toko->nama_toko
                            : null,
                        position: 'below'
                    )
                    ->extraAttributes(['class' => 'leading-tight'])
                    ->searchable(['creator.name', 'product.toko.nama_toko'])
                    ->sortable(query: function ($query, string $direction) {
                        $query->join('users as creators', 'creators.id', '=', 'pengajuans.created_by')
                            ->orderBy('creators.name', $direction)
                            ->select('pengajuans.*');
                    }),

                TextColumn::make('quantity')
                    ->label('Jumlah')
                    ->icon('heroicon-m-shopping-bag')
                    ->suffix(' pcs'),

                TextColumn::make('status')
                    ->label('Status')
                    ->formatStateUsing(fn (?string $state) => $state ? ucfirst($state) : '-')
                    ->color(fn (?string $state): string => match ($state) {
                        'approved' => 'success',
                        'pending'  => 'warning',
                        default    => 'gray',
                    })
                    ->icon(fn (?string $state): ?string => match ($state) {
                        'approved' => 'heroicon-m-check-badge',
                        'pending'  => 'heroicon-m-clock',
                        default    => 'heroicon-m-question-mark-circle',
                    })
                    ->iconColor(fn (?string $state): string => match ($state) {
                        'approved' => 'success',
                        'pending'  => 'warning',
                        default    => 'gray',
                    }),

                TextColumn::make('approved_at')
                    ->label('Disetujui')
                    ->since()
                    ->placeholder('-')
                    ->icon('heroicon-m-calendar-days')
                    ->iconColor('success')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordUrl(null)
            ->defaultSort('created_at', 'desc')

            // tombol Create di header
            ->headerActions([
                CreateAction::make()
                    ->label('Ajukan Produk')
                    ->icon('heroicon-m-plus')
                    ->mutateFormDataUsing(function (array $data) {
                        $data['created_by'] = auth()->id();
                        if (! auth()->user()?->hasAnyRole(['super_admin','Super Admin'])) {
                            $data['status'] = 'pending';
                        }
                        return $data;
                    })
                    ->visible(function () {
                        $spbu = $this->ownerRecord;
                        $slot = (int) ($spbu->slot ?? 0);
                        $terpakai = Pengajuan::query()
                            ->where('spbu_id', $spbu->id)
                            ->where('status', 'approved')
                            ->count();

                        return $terpakai < $slot;
                    }),
            ])

            ->actions([
                Action::make('lihat_produk')
                    ->icon('heroicon-o-eye')
                    ->label('')
                    ->iconButton()
                    ->color('info')
                    ->tooltip('Lihat detail produk')
                    ->modalHeading('Detail Pengajuan & Produk')
                    ->modalWidth('3xl')
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup')
                    ->form(function ($record) {
                        $produk = $record->product;

                        return [
                            // === Field dari tabel Pengajuans ===
                            \Filament\Forms\Components\TextInput::make('nama_toko')
                                ->label('Nama Toko')
                                ->default($produk?->toko?->nama_toko ?? '-')
                                ->disabled(),

                            \Filament\Forms\Components\TextInput::make('quantity')
                                ->label('Jumlah')
                                ->suffix(' pcs')
                                ->default($record->quantity ?? 0)
                                ->disabled(),

                            \Filament\Forms\Components\TextInput::make('status')
                                ->label('Status')
                                ->default(ucfirst($record->status ?? '-'))
                                ->disabled(),

                            // === Gambar Produk ===
                            \Filament\Forms\Components\Placeholder::make('picture')
                                ->label('Gambar Produk')
                                ->content(function ($record) {
                                    $path = $record->product?->picture;
                                    $url = $path ? asset('storage/' . $path) : url('images/default-product.png');

                                    return '<img src="' . $url . '" 
                                            alt="Gambar Produk"
                                            style="width: 200px; height: 200px; object-fit: contain; border-radius: 12px; border: 1px solid #ccc;">';
                                })
                                ->columnSpanFull()
                                ->extraAttributes(['class' => 'text-center'])
                                ->html(),

                            // === Field dari tabel Products ===
                            \Filament\Forms\Components\TextInput::make('nama_produk')
                                ->label('Nama Produk')
                                ->default($produk->nama_produk ?? '-')
                                ->disabled(),

                            \Filament\Forms\Components\TextInput::make('jenis_produk')
                                ->label('Jenis Produk')
                                ->default($produk->jenis_produk ?? '-')
                                ->disabled(),

                            \Filament\Forms\Components\TextInput::make('harga_jual')
                                ->label('Harga Jual')
                                ->prefix('Rp')
                                ->numeric()
                                ->default($produk->harga_jual ?? 0)
                                ->disabled(),

                            \Filament\Forms\Components\TextInput::make('berat_gram')
                                ->label('Berat (gram)')
                                ->default($produk->berat_gram ?? '-')
                                ->disabled(),

                            \Filament\Forms\Components\TextInput::make('panjang_cm')
                                ->label('Panjang (cm)')
                                ->default($produk->panjang_cm ?? '-')
                                ->disabled(),

                            \Filament\Forms\Components\TextInput::make('lebar_cm')
                                ->label('Lebar (cm)')
                                ->default($produk->lebar_cm ?? '-')
                                ->disabled(),

                            \Filament\Forms\Components\TextInput::make('tinggi_cm')
                                ->label('Tinggi (cm)')
                                ->default($produk->tinggi_cm ?? '-')
                                ->disabled(),

                            \Filament\Forms\Components\Textarea::make('deskripsi')
                                ->label('Deskripsi Produk')
                                ->default($produk->deskripsi ?? '-')
                                ->disabled()
                                ->rows(3)
                                ->columnSpanFull(),
                        ];
                    }),

                // 🗑️ DELETE (tetap sama)
                DeleteAction::make()
                    ->hiddenLabel()
                    ->color('gray')
                    ->button(),

                // ✅ APPROVE (tanpa perubahan)
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-m-check-circle')
                    ->color('success')
                    ->visible(function ($record) use ($canApprove) {
                        if (! $canApprove) return false;
                        if ($record->status !== 'pending') return false;

                        $spbu = $this->ownerRecord;
                        $slot = (int) ($spbu->slot ?? 0);
                        $terpakai = Pengajuan::query()
                            ->where('spbu_id', $spbu->id)
                            ->where('status', 'approved')
                            ->count();

                        return $terpakai < $slot;
                    })
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $spbu = $this->ownerRecord;
                        $slot = (int) ($spbu->slot ?? 0);
                        $terpakai = Pengajuan::query()
                            ->where('spbu_id', $spbu->id)
                            ->where('status', 'approved')
                            ->count();

                        if ($terpakai >= $slot) {
                            $this->dispatch('notify', type: 'danger', body: 'Maaf, slot SPBU sudah penuh.');
                            return;
                        }

                        $record->status      = 'approved';
                        $record->approved_by = auth()->id();
                        $record->approved_at = now();
                        $record->save();

                        $this->dispatch('notify', type: 'success', body: 'Pengajuan disetujui.');
                        $this->dispatch('$refresh');
                    }),
            ]);



    }
}
