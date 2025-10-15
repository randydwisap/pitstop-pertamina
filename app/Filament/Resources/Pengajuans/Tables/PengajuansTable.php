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
                        TextColumn::make('product.nama_produk')->label('Produk')->weight('semibold'),
                        TextColumn::make('spbu.nomor_spbu')->label('SPBU')->prefix('SPBU '),
                        TextColumn::make('quantity')->label('Jumlah'),
                        TextColumn::make('status')->badge()->color(fn($s)=>$s==='approved'?'success':'warning'),
                        TextColumn::make('creator.name')->label('Diajukan oleh')->toggleable(isToggledHiddenByDefault: true),
                        TextColumn::make('approved_at')->label('Disetujui')->since()->placeholder('-')
                            ->toggleable(isToggledHiddenByDefault: true),
                    ])->space(0),
                ])->extraAttributes([
                    'class'=>'p-3 rounded-lg border border-emerald-300/80 bg-white shadow-sm overflow-hidden h-full',
                ]),
            ])
            ->contentGrid(['sm'=>1,'lg'=>2,'2xl'=>3])
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
