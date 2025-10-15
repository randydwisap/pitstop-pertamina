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
                        ->label('Approve')->icon('heroicon-m-check-circle')->color('success')
                        ->visible(fn($record)=> $canApprove && $record->status==='pending')
                        ->requiresConfirmation()
                        ->action(function ($record) {
                            $record->status = 'approved';
                            $record->approved_by = auth()->id();
                            $record->approved_at = now();
                            $record->save();
                        }),
                ])->icon('heroicon-m-ellipsis-vertical')->buttonGroup(),
            ])
            ->recordUrl(null)
            ->defaultSort('created_at','desc');
    }
}
