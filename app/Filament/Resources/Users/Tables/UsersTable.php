<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\User;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\ActionGroup;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\BulkAction;
use Illuminate\Support\Collection;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('picture')
                    ->label('Foto')
                    ->disk('public')
                    ->circular()
                    ->size(40)
                    ->defaultImageUrl(asset('images/default-avatar.png')), // opsional fallback

                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('roles.name')
                    ->label('Roles')
                    ->badge()
                    ->separator(', ')
                    ->toggleable(),

                TextColumn::make('email_verified_at')
                    ->label('Verified at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                SelectFilter::make('role')
                    ->label('Filter by Role')
                    ->relationship('roles', 'name')
                    ->searchable()
                    ->preload(),
            ])

            // v4: actions per record
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()
                        // hindari self-delete; pakai getKey() agar Intelephense tidak protes
                        ->visible(fn (User $record) => (int) auth()->id() !== (int) $record->getKey()),
                ]),
            ])

            // v4: bulk actions di toolbar
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('delete-selected')
                        ->label('Delete selected')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->action(function (Collection $records) {
                            $selfId = (int) auth()->id();
                            $records
                                ->reject(fn (User $u) => (int) $u->getKey() === $selfId)
                                ->each->delete();
                        })
                        ->deselectRecordsAfterCompletion(),
                ]),
            ]);
    }
}
