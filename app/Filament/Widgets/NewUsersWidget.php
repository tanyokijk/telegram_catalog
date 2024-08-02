<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NewUsersWidget extends BaseWidget
{
    use InteractsWithPageFilters;
    protected function getStats(): array
    {
        $start = $this->filters['startDate'];
        $end = $this->filters['endDate'];
        return [
            Stat::make('New Users',
                User::when(
                    $start,
                    fn($query) => $query->whereDate('created_at', '>', $start)
                )
                    ->when(
                        $end,
                        fn($query) => $query->whereDate('created_at', '<', $end)
                    )
            ->count())
            ->description('New users that have joined')
            ->descriptionIcon('heroicon-m-user-group')
            ->color('success'),
        ];
    }
}
