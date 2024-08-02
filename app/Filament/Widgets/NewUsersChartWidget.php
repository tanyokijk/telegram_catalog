<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Illuminate\Support\Carbon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
class NewUsersChartWidget extends ChartWidget
{
    use InteractsWithPageFilters;
    protected int | string | array $columnSpan =1;

    protected static ?string $heading = 'New users';

    protected function getData(): array
    {
        $start = $this->filters['startDate'];
        $end = $this->filters['endDate'];

        $data = Trend::model(User::class)
            ->between(
                start: $start ? Carbon::parse($start) : Carbon::now()->subMonths(6),
                end: $end ? Carbon::parse($end) : Carbon::now(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'New users',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
