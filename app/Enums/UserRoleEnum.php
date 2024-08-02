<?php

namespace App\Enums;

enum UserRoleEnum : string
{
    case ADMIN = 'admin';
    case MODERATOR = 'moderator';

    case USER = 'user';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
