<?php

namespace App\Filament\Resources\Produks\RelationManagers;

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

class SPBUsRelationManager extends RelationManager
{
    protected static string $relationship = 'pengajuans';
    protected static ?string $title = 'SPBU Tujuan';

    /** Form untuk Create/Edit pengajuan di dalam Produk */
    public function form(Schema $schema): Schema
    {
        $user = auth()->user();
        $isApprover = $user && $user->hasAnyRole(['super_admin', 'Super Admin']);

        return $schema->components([
            // product_id otomatis diisi oleh RelationManager, TIDAK perlu field
            Select::make('spbu_id')
                ->label('SPBU Tujuan')
                ->relationship(
                    name: 'spbu',
                    titleAttribute: 'nomor_spbu',
                    modifyQueryUsing: function ($query) {
                        $product = $this->ownerRecord; // produk yang sedang dibuka di halaman edit
                        $query->whereNotIn('id', function ($sub) use ($product) {
                            $sub->select('spbu_id')
                                ->from('pengajuans')
                                ->where('product_id', $product->id)
                                ->whereNull('deleted_at'); // skip soft delete jika masih aktif di model
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

    /** Tabel daftar SPBU yang diajukan untuk produk ini */
    public function table(Table $table): Table
    {
        $user = auth()->user();
        $canApprove = $user && $user->hasAnyRole(['super_admin','Super Admin']);

        return $table
            ->recordTitleAttribute('id')
            ->columns([
                ImageColumn::make('spbu.foto')
                    ->label(' ')
                    ->disk('public')
                    ->imageWidth(96)
                    ->imageHeight(96)
                    ->defaultImageUrl(url('images/default-spbu.png'))
                    ->grow(false),

                TextColumn::make('spbu.nomor_spbu')
                    ->label('Nomor SPBU')
                    ->weight('semibold')
                    ->icon('heroicon-m-identification')
                    ->iconColor('primary')
                    ->wrap(),

                TextColumn::make('spbu.tipe')
                    ->label('Tipe')
                    ->icon('heroicon-m-building-office'),

                TextColumn::make('spbu.alamat')
                    ->label('Alamat')
                    ->limit(50)
                    ->wrap(),

                TextColumn::make('spbu.kelurahan')
                    ->label('Kelurahan'),

                TextColumn::make('spbu.kecamatan')
                    ->label('Kecamatan'),

                TextColumn::make('spbu.kota')
                    ->label('Kota'),

                TextColumn::make('spbu.potensi_konsumen')
                    ->label('Potensi Konsumen')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('spbu.margin')
                    ->label('Margin (%)')
                    ->numeric(2)
                    ->sortable(),

                TextColumn::make('spbu.slot')
                    ->label('Slot Tersedia')
                    ->formatStateUsing(function ($state, $record) {
                        // Hitung jumlah pengajuan approved untuk SPBU ini
                        $approvedCount = Pengajuan::query()
                            ->where('spbu_id', $record->spbu_id)
                            ->where('status', 'approved')
                            ->whereNull('deleted_at')
                            ->count();

                        // Sisa slot = total slot - approvedCount
                        $sisa = max(0, $state - $approvedCount);

                        return "{$sisa} / {$state}";
                    })
                    ->color(fn ($record) => 
                        $record->spbu?->slot && $record->spbu->slot - Pengajuan::where('spbu_id', $record->spbu_id)
                            ->where('status', 'approved')
                            ->count() > 0
                            ? 'success' 
                            : 'danger'
                    ),
                                

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
                    ->label('Ajukan ke SPBU')
                    ->icon('heroicon-m-plus')
                    ->mutateFormDataUsing(function (array $data) {
                        $data['created_by'] = auth()->id();
                        if (! auth()->user()?->hasAnyRole(['super_admin','Super Admin'])) {
                            $data['status'] = 'pending';
                        }
                        return $data;
                    }),
            ])

            // aksi per baris
            ->actions([
                ActionGroup::make([
                    DeleteAction::make()->hiddenLabel()->color('gray'),
                    Action::make('approve')
                        ->label('Approve')
                        ->icon('heroicon-m-check-circle')
                        ->color('success')
                        ->visible(fn ($record) => $canApprove && $record->status === 'pending')
                        ->requiresConfirmation()
                        ->action(function ($record) {
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
