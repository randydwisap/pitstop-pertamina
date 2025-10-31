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
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Models\Pengajuan;

class PengajuansTable
{
    public static function configure(Table $table): Table
    {
        $user = auth()->user();
        $canApprove = $user && $user->hasAnyRole(['super_admin', 'Super Admin']);

        return $table
            ->columns([
                ImageColumn::make('product.picture')
                    ->label('Gambar')
                    ->disk('public')
                    ->circular()
                    ->size(60)
                    ->defaultImageUrl(url('images/default-product.png')),

                TextColumn::make('product.nama_produk')
                    ->label('Produk')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->icon('heroicon-m-cube')
                    ->iconColor('primary'),

                TextColumn::make('spbu.nomor_spbu')
                    ->label('SPBU')
                    ->prefix('SPBU ')
                    ->icon('heroicon-m-map-pin')
                    ->iconColor('warning')
                    ->sortable(),

                TextColumn::make('quantity')
                    ->label('Estimasi')
                    ->suffix(' pcs')
                    ->alignRight()
                    ->icon('heroicon-m-shopping-bag')
                    ->iconColor('gray'),

                TextColumn::make('product.toko.nama_toko')
                    ->label('Toko')
                    ->formatStateUsing(function ($state, $record) {
                        $telephone = $record->product?->toko?->telephone ?? '-';

                        return new \Illuminate\Support\HtmlString('
                            <div class="flex flex-col leading-tight">
                                <div>🏬 <span class="font-semibold text-gray-900 dark:text-gray-100">'
                                    . e($state) . '</span></div>
                                <div>📞 <span class="text-sm text-gray-600 dark:text-gray-400">'
                                    . e($telephone) . '</span></div>
                            </div>
                        ');
                    })
                    ->html()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('creator.name')
                    ->label('Diajukan oleh')
                    ->icon('heroicon-m-user-circle')
                    ->iconColor('gray')
                    ->sortable(),

                TextColumn::make('approved_at')
                    ->label('Disetujui')
                    ->since()
                    ->placeholder('-')
                    ->icon('heroicon-m-calendar-days')
                    ->iconColor('success')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->alignCenter()
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
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending'  => 'Pending',
                        'approved' => 'Approved',
                    ]),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()
                        ->hiddenLabel()
                        ->tooltip('Lihat Pengajuan')
                        ->color('warning'),

                    EditAction::make()
                        ->hiddenLabel()
                        ->color('info')
                        ->tooltip('Edit Pengajuan'),

                    DeleteAction::make()
                        ->hiddenLabel()
                        ->color('danger')
                        ->tooltip('Hapus Pengajuan'),

                    Action::make('approve')
                        ->label('Approve')
                        ->tooltip('Setujui Pengajuan')
                        ->icon('heroicon-m-check-circle')
                        ->color('success')
                        ->visible(function ($record) use ($canApprove) {
                            if (!$canApprove) return false;
                            if ($record->status !== 'pending') return false;

                            $slot = (int) ($record->spbu?->slot ?? 0);
                            $terpakai = \App\Models\Pengajuan::query()
                                ->where('spbu_id', $record->spbu_id)
                                ->where('status', 'approved')
                                ->count();

                            return $terpakai < $slot;
                        })
                        ->action(function ($record, $livewire) {
                            $slot = (int) ($record->spbu?->slot ?? 0);
                            $terpakai = \App\Models\Pengajuan::query()
                                ->where('spbu_id', $record->spbu_id)
                                ->where('status', 'approved')
                                ->count();

                            if ($terpakai >= $slot) {
                                $livewire->dispatch('notify', type: 'danger', body: 'Maaf, slot SPBU sudah penuh.');
                                return;
                            }

                            $record->status = 'approved';
                            $record->approved_by = auth()->id();
                            $record->approved_at = now();
                            $record->save();

                            $livewire->dispatch('notify', type: 'success', body: 'Pengajuan disetujui.');
                            $livewire->dispatch('$refresh');
                        })
                        ->requiresConfirmation(),
                ])->icon('heroicon-m-ellipsis-vertical')->buttonGroup(),
            ])
            ->defaultSort('created_at', 'desc')
            ->striped()
            ->paginated([10, 25, 50])
            ->recordUrl(null);
    }
}
