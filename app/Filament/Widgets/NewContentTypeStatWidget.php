<?php

namespace App\Filament\Widgets;

use App\Models\ContentType;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NewContentTypeStatWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New types of content all the time',
                ContentType::all()
                    ->count()),
        ];
    }
}
