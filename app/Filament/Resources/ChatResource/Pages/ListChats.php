<?php

namespace App\Filament\Resources\ChatResource\Pages;

use App\Filament\Resources\ChatResource;
use App\Filament\Widgets\NewChatsStatWidget;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChats extends ListRecords
{
    protected static string $resource = ChatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets() : array
    {
        return [
            NewChatsStatWidget::class,
        ];
    }
}
