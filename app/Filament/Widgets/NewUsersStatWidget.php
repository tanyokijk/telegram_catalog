<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NewUsersStatWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Users all the time',
                User::all()
                ->count())
                ->description('New users that have joined')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),
        ];
    }
}
