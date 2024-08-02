<?php

namespace App\Filament\Resources\ContentTypeResource\Pages;

use App\Filament\Resources\ContentTypeResource;
use App\Filament\Widgets\NewContentTypeStatWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListContentTypes extends ListRecords
{
    protected static string $resource = ContentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets() : array
    {
        return [
            NewContentTypeStatWidget::class,
        ];
    }
}
