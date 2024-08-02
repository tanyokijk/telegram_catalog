<?php

namespace App\Filament\Widgets;

use App\Models\Chat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NewChatsStatWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Chats all the time',
                Chat::all()
                    ->count()),
        ];
    }
}
