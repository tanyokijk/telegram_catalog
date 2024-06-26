<?php

namespace App\Enums;

use App\Models\User;

enum UserStatusEnum: string
{
    case Active = 'active';
    case Inactive = 'inactive';
    case Disabled = 'disabled';

    public function getColor(): string
    {
        return match ($this) {
            self::Active => 'green',
            self::Inactive => 'gray',
            self::Disabled => 'red',
        };
    }

    public static function forUser(User $user): UserStatusEnum
    {
        if ($user->disabled) {
            return UserStatusEnum::Disabled;
        }
        if ($user->active) {
            return UserStatusEnum::Active;
        }

        return UserStatusEnum::Inactive;
    }
}
