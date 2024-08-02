<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\NewChatsStatWidget;
use App\Filament\Widgets\NewContentTypeStatWidget;
use App\Filament\Widgets\NewUsersChartWidget;
use App\Filament\Widgets\NewUsersStatWidget;
use App\Filament\Widgets\NewUsersWidget;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\HasFilters;

class Dashboard extends \Filament\Pages\Dashboard
{
    use HasFiltersForm;

    public function filtersForm(Form $form) : Form
    {
        return $form->schema([
            Section::make('View user statistics for a specific period')->schema([
                DatePicker::make('startDate'),
                DatePicker::make('endDate'),
            ])
                ->columns(2),
        ]);
    }
    public function getWidgets(): array
    {
        $widgets = [];


        $widgets[] = NewUsersChartWidget::class;
        $widgets[] = NewUsersWidget::class;
        $widgets[] = NewUsersStatWidget::class;
        $widgets[] = NewChatsStatWidget::class;
        $widgets[] = NewContentTypeStatWidget::class;



        return $widgets;
    }
}
