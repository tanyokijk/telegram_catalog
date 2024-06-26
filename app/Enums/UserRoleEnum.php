<?php

namespace App\Enums;

enum UserRoleEnum :string
{
    case Admin = 'admin';
    case Moderator = 'moderator';
    case User = 'user';

    public function isAdmin(): bool
    {
        return $this === UserRoleEnum::Admin;
    }

    public function isModerator(): bool
    {
        return $this === UserRoleEnum::Moderator;
    }
}
