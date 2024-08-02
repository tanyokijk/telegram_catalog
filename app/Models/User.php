<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserRoleEnum;
use App\Enums\UserStatusEnum;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, HasUuids, Notifiable;


    public function canAccessPanel(Panel $panel) : bool
    {
        return $this->isAdmin() || $this->isModerator();
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'telegram_id',
        'username',
        'avatar_url',
        'first_name',
        'last_name',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'role' => UserRoleEnum::class,
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin()
    {
        return $this['role'] === UserRoleEnum::ADMIN;
    }

    public function isModerator()
    {
        return $this['role'] === UserRoleEnum::MODERATOR;
    }

    public function getStatusAttribute(): UserStatusEnum
    {
        return UserStatusEnum::forUser($this);
    }

}
