<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Support\Facades\Storage;
use Filament\Models\Contracts\HasAvatar; 
use Spatie\Permission\Models\Role;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Notifications\CustomVerifyEmail; // Pastikan import di atas file


class User extends Authenticatable implements FilamentUser, HasAvatar, MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;
    public function canAccessPanel(Panel $panel): bool
    {
        // ⬅️ Pastikan 'mitra' bisa akses panel ini (kalau memang diizinkan)
        return $this->hasAnyRole(['Admin', 'Super Admin', 'super_admin', 'mitra']);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'picture'
    ];

    // custom email verif

    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new CustomVerifyEmail);
    }


    public function toko(): HasOne
    {
        return $this->hasOne(Toko::class, 'user_id');
    }

    public function getPictureUrlAttribute(): ?string
    {
        if ($this->picture) {
            return \Storage::disk('public')->url($this->picture);
        }
        return asset('images/default-avatar.png');
    }

    public function getFilamentAvatarUrl(): ?string
    {
        if ($this->picture) {
            return Storage::disk('public')->url($this->picture);
        }
        
        return asset('images/default-avatar.png');
    }

    protected static function booted(): void
    {
        static::created(function (User $user) {
            // Pastikan role 'mitra' ada
            Role::findOrCreate('mitra');

            // Kalau belum punya, assign
            if (! $user->hasRole('mitra')) {
                $user->assignRole('mitra');
            }
        });
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function pengajuansApproved(): HasMany
    {
        return $this->hasMany(Pengajuan::class, 'approved_by');
    }

    public function produks(): HasMany
    {
        return $this->hasMany(Produk::class);
    }
}
