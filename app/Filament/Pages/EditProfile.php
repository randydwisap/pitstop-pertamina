<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Filament\Facades\Filament;

class EditProfile  extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUser;
    protected static ?string $navigationLabel = 'Profil Saya';
    protected static ?string $title = 'Edit Profil';
    protected static ?string $slug = 'profile';
    protected static bool $shouldRegisterNavigation = false;

    protected string $view = 'filament.pages.edit-my-profile';

    /** Harus sesuai dengan statePath di form() */
    public array $data = [];

    public function mount(): void
    {
        $this->form->fill(auth()->user()->only(['name', 'email', 'picture']));
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                FileUpload::make('picture')
    ->label('Foto Profil')
    ->image()
    ->disk('public')
    ->directory('users/avatars')   // => hasil: users/avatars/xxx.jpg
    ->visibility('public')
    ->multiple(false)              // <- pastikan single file
    ->imageEditor()
    ->openable()
    ->downloadable()
    ->dehydrateStateUsing(function ($state) {
        // normalisasi ke string path
        if (is_array($state)) {
            if ($state === []) return null;

            // Bisa berupa: ['uuid' => 'users/avatars/file.jpg']
            $first = array_values($state)[0];

            // Bisa juga berupa: [['path' => 'users/avatars/file.jpg', ...]]
            return is_array($first)
                ? ($first['path'] ?? $first['name'] ?? null)
                : $first;
        }

        return $state; // sudah string
    }),

                TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()                    
                    ->unique(table: 'users', column: 'email', ignoreRecord: auth()->id()),

                TextInput::make('current_password')
                    ->label('Password Saat Ini')
                    ->password()
                    ->revealable()
                    ->dehydrated(false),

                TextInput::make('new_password')
                    ->label('Password Baru')
                    ->password()
                    ->dehydrated(false)
                    ->minLength(8)
                    ->revealable()
                    ->same('new_password_confirmation'),

                TextInput::make('new_password_confirmation')
                    ->label('Konfirmasi Password Baru')
                    ->password()
                    ->revealable()
                    ->dehydrated(false),
            ]);
    }

    public function save(): void
{
    $user = auth()->user();

    $this->validate([
        'data.name'  => ['required', 'string', 'max:255'],
        'data.email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
    ]);

    $data = $this->data;
    $passwordChanged = false;

    $user->name = $data['name'] ?? $user->name;
    $user->email = $data['email'] ?? $user->email;

    // Handle foto profil
    $picture = $data['picture'] ?? null;
    if (is_array($picture)) {
        $first = array_values($picture)[0] ?? null;
        $picture = is_array($first) ? ($first['path'] ?? $first['name'] ?? null) : $first;
    }
    $user->picture = $picture;

    // Handle perubahan password
    if (! empty($data['new_password'])) {
        if (empty($data['current_password']) || ! Hash::check($data['current_password'], $user->password)) {
            $this->addError('data.current_password', 'Password saat ini salah.');
            return;
        }

        $user->password = Hash::make($data['new_password']);
        $passwordChanged = true;
    }

    $user->save();

    // === Kirim ulang verifikasi email jika email diubah ===
    if (
        $user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&
        $user->isDirty('email')
    ) {
        $user->email_verified_at = null;
        $user->save(); // simpan lagi perubahan verifikasi
        $user->sendEmailVerificationNotification();
    }

    // === Logout hanya jika password berubah ===
    if ($passwordChanged) {
        $panel = Filament::getCurrentPanel();
        $loginUrl = $panel?->getLoginUrl() ?? route('login');

        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        $this->redirect($loginUrl, navigate: true);
    } else {
        // Tampilkan notifikasi berhasil (opsional)
        $this->notify('success', 'Profil berhasil diperbarui.');
    }
}

}
