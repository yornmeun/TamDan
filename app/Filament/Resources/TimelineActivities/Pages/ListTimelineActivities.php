<?php

namespace App\Filament\Resources\TimelineActivities\Pages;

use App\Filament\Resources\TimelineActivities\TimelineActivityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTimelineActivities extends ListRecords
{
    protected static string $resource = TimelineActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
