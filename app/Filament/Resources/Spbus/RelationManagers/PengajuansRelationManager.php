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
            // spbu_id otomatis diisi oleh RelationManager, TIDAK perlu field
            Select::make('product_id')
                ->label('Produk')
                ->relationship(
                    name: 'product',
                    titleAttribute: 'nama_produk',
                    modifyQueryUsing: function ($query) {
                        $user = auth()->user();

                        // hanya produk aktif
                        $query->where('is_active', true);

                        // kalau BUKAN super admin → produk milik user sendiri
                        if (! $user?->hasAnyRole(['super_admin', 'Super Admin'])) {
                            $query->where('user_id', $user?->id ?? 0);
                        }
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
                    // Tampilkan nama toko di baris bawah:
                    ->description(
                        fn ($record) => $record->product?->toko?->nama_toko
                            ? 'Toko: ' . $record->product->toko->nama_toko
                            : null,
                        position: 'below'
                    )
                    ->extraAttributes(['class' => 'leading-tight'])
                    // cari di dua field terkait:
                    ->searchable(['creator.name', 'product.toko.nama_toko'])
                    // urutkan berdasarkan nama creator (opsional):
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
                            ->formatStateUsing(fn (?string $state) => $state ? ucfirst($state) : '-') // tampilkan "Approved/Pending"
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
                        // set created_by + paksa status pending utk non-approver
                        $data['created_by'] = auth()->id();
                        if (! auth()->user()?->hasAnyRole(['super_admin','Super Admin'])) {
                            $data['status'] = 'pending';
                        }
                        return $data;
                    })
                    // sembunyikan create jika slot SPBU penuh (1 pengajuan = 1 slot)
                    ->visible(function () {
                        $spbu = $this->ownerRecord; // SPBU saat ini
                        $slot = (int) ($spbu->slot ?? 0);
                        $terpakai = Pengajuan::query()
                            ->where('spbu_id', $spbu->id)
                            ->where('status', 'approved')
                            ->count();

                        return $terpakai < $slot;
                    }),
            ])

            // aksi per baris
            ->actions([
                ActionGroup::make([
                    DeleteAction::make()->hiddenLabel()->color('gray'),
                    // APPROVE
                    Action::make('approve')
                        ->label('Approve')
                        ->icon('heroicon-m-check-circle')
                        ->color('success')
                        ->visible(function ($record) use ($canApprove) {
                            if (! $canApprove) return false;
                            if ($record->status !== 'pending') return false;

                            // cek slot SPBU (1 pengajuan = 1 slot)
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
                            // re-check anti race-condition
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
                ])->icon('heroicon-m-ellipsis-vertical')->buttonGroup(),
            ]);
    }
}
