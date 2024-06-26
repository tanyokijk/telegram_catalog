<?php

namespace App\Enums;

enum AccessType: string
{
    case PUBLIC = 'public';
    case PRIVATE = 'private';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
