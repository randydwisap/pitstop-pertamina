<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\FileUpload;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            FileUpload::make('picture')
                ->label('Foto Profil')
                ->image()
                ->imageEditor()          // crop/rotate
                ->imageCropAspectRatio('1:1')
                ->imagePreviewHeight('220')
                ->directory('users/avatars') // -> storage/app/public/users/avatars
                ->disk('public')
                ->visibility('public')
                ->openable()
                ->downloadable()
                ->helperText('Unggah foto square agar tampak maksimal.')
                ->columnSpanFull(),      // kalau ingin full width (opsional)

            TextInput::make('name')
                ->label('Name')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label('Email address')
                ->email()
                ->required()
                ->unique(ignoreRecord: true),

            DateTimePicker::make('email_verified_at')
                ->label('Verified At'),

            // Password + confirm (auto-hash & hanya dehydrate jika diisi)
            TextInput::make('password')
                ->label('Password')
                ->password()
                ->revealable()
                ->dehydrateStateUsing(fn (?string $state) => filled($state) ? Hash::make($state) : null)
                ->dehydrated(fn (?string $state) => filled($state))
                ->required(fn (string $operation) => $operation === 'create'),

            TextInput::make('password_confirmation')
                ->label('Confirm Password')
                ->password()
                ->revealable()
                ->same('password')
                ->dehydrated(false),

            // Assign roles (Spatie HasRoles -> relationship "roles")
            Select::make('roles')
                ->label('Roles')
                ->relationship('roles', 'name')
                ->multiple()
                ->preload()
                ->searchable(),
        ]);
    }
}
