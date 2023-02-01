<?php

namespace KaanTanis\FilamentUrlTracker\Resources\UrlTrackerResource\Pages;

use Filament\Resources\Pages\ListRecords;
use KaanTanis\FilamentUrlTracker\Resources\UrlTrackerResource\UrlTrackerResource;

class ListUrls extends ListRecords
{
    protected static string $resource = UrlTrackerResource::class;

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return [5, 10, 25, 50, -1] ?? parent::getTableRecordsPerPageSelectOptions();
    }
}
