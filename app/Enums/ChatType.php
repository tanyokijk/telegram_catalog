<?php

namespace App\Enums;

enum ChatType: string
{
    case CHANNEL = 'channel';
    case BOT = 'bot';
    case CHAT = 'chat';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
    /*public function isChannel(): bool
    {
        return $this === ChatType::CHANNEL;
    }

    public function isBot(): bool
    {
        return $this === ChatType::BOT;
    }

    public function isChat(): bool
    {
        return $this === ChatType::CHAT;
    }*/
}
