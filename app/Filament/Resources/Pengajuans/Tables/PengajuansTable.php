<?php

namespace App\Filament\Resources\Pengajuans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\Layout\Panel;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\ImageColumn;
use App\Models\Pengajuan;

class PengajuansTable
{
    public static function configure(Table $table): Table
    {
        $user = auth()->user();
        $canApprove = $user && $user->hasAnyRole(['super_admin','Super Admin']);
        return $table
            ->columns([
               Panel::make([
                    Stack::make([
                        ImageColumn::make('product.picture')
                            ->label(' ')
                            ->disk('public')
                            ->imageWidth(150)
                            ->imageHeight(200)
                            ->defaultImageUrl(url('images/default-product.png'))
                            ->grow(true),

                        TextColumn::make('product.nama_produk')
                            ->label('Produk')
                            ->weight('semibold')
                            ->icon('heroicon-m-cube')
                            ->iconColor('primary'),

                        TextColumn::make('spbu.nomor_spbu')
                            ->label('SPBU')
                            ->prefix('SPBU ')
                            ->icon('heroicon-m-map-pin')
                            ->iconColor('warning'),

                        TextColumn::make('quantity')
                            ->label('Jumlah')
                            ->icon('heroicon-m-shopping-bag')
                            ->suffix(' pcs')
                            ->iconColor('gray'),

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

                        TextColumn::make('product.toko.nama_toko')
                            ->label('Toko')
                            ->icon('heroicon-m-building-storefront')
                            ->iconColor('info')
                            ->searchable()
                            ->sortable()
                            ->wrap(),

                        TextColumn::make('creator.name')
                            ->label('Diajukan oleh')
                            ->icon('heroicon-m-user-circle')
                            ->iconColor('gray')
                            ->toggleable(isToggledHiddenByDefault: true),

                        TextColumn::make('approved_at')
                            ->label('Disetujui')
                            ->since()
                            ->placeholder('-')
                            ->icon('heroicon-m-calendar-days')
                            ->iconColor('success')
                            ->toggleable(isToggledHiddenByDefault: true),
                    ])->space(0),
                ])->extraAttributes([
                    'class' => 'p-3 rounded-lg border border-emerald-300/80 bg-white shadow-sm overflow-hidden h-full',
                ]),
            ])
            ->contentGrid([
                'sm'  => 1,
                'lg'  => 3,
                '2xl' => 4,
            ])
            ->filters([
                SelectFilter::make('status')->label('Status')->options([
                    'pending'=>'Pending','approved'=>'Approved',
                ]),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()->hiddenLabel(),
                    EditAction::make()->hiddenLabel()->color('gray'),
                    DeleteAction::make()->hiddenLabel()->color('gray'),
                    Action::make('approve')
    ->label('Approve')
    ->icon('heroicon-m-check-circle')
    ->color('success')
    // 1) Sembunyikan tombol saat slot penuh / bukan pending / bukan admin
    ->visible(function ($record) use ($canApprove) {
        if (! $canApprove) return false;
        if ($record->status !== 'pending') return false;

        $slot = (int) ($record->spbu?->slot ?? 0);

        // Hitung kapasitas terpakai berbasis quantity yang SUDAH approved
        $terpakai = Pengajuan::query()
            ->where('spbu_id', $record->spbu_id)
            ->where('status', 'approved')
            ->sum('quantity'); // kalau 1 pengajuan = 1 slot, ganti ->count()

        // Slot tersisa harus masih cukup untuk quantity pengajuan ini
        $butuh = (int) ($record->quantity ?? 1);

        return ($terpakai + $butuh) <= $slot;
    })
    ->requiresConfirmation()
    // 2) Validasi ulang saat dieksekusi (anti race-condition)
    ->action(function ($record, $livewire) {
        $slot = (int) ($record->spbu?->slot ?? 0);

        $terpakai = Pengajuan::query()
            ->where('spbu_id', $record->spbu_id)
            ->where('status', 'approved')
            ->sum('quantity'); // kalau 1 pengajuan = 1 slot, ganti ->count()

        $butuh = (int) ($record->quantity ?? 1);

        if (($terpakai + $butuh) > $slot) {
            // Slot penuh → beri pesan dan batalkan
            $livewire->dispatch('notify', type: 'danger', body: 'Maaf, slot SPBU sudah penuh.');
            return;
        }

        // Lolos → setujui
        $record->status      = 'approved';
        $record->approved_by = Auth::id();
        $record->approved_at = now();
        $record->save();

        $livewire->dispatch('notify', type: 'success', body: 'Pengajuan disetujui.');
        // refresh tabel biar status langsung berubah
        $livewire->dispatch('$refresh');
    }),
                ])->icon('heroicon-m-ellipsis-vertical')->buttonGroup(),
            ])
            ->recordUrl(null)
            ->defaultSort('created_at','desc');
    }
}
