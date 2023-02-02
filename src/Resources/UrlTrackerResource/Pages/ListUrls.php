<?php

namespace KaanTanis\FilamentUrlTracker\Resources\UrlTrackerResource\Pages;

use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use KaanTanis\FilamentUrlTracker\Resources\UrlTrackerResource;

class ListUrls extends ListRecords
{
    protected static string $resource = UrlTrackerResource::class;

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return config('filament-url-tracker.per-page-select-options')
            ?? parent::getTableRecordsPerPageSelectOptions();
    }

    protected function getTableActions(): array
    {
        return [
            EditAction::make(),
            Action::make(__('filament-url-tracker::filament-url-tracker.copy_url'))
                ->icon('heroicon-o-duplicate')
                ->action(function () {
                    // todo
                })
        ];
    }
}
