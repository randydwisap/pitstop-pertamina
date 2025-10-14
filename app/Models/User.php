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

class User extends Authenticatable implements FilamentUser, HasAvatar
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;
    public function canAccessPanel(Panel $panel): bool
    {
        // izinkan hanya Admin / Super Admin
        return $this->hasAnyRole(['Admin', 'Super Admin', 'super_admin']);
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
}
