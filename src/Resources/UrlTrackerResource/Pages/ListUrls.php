<?php

namespace KaanTanis\FilamentUrlTracker\Resources\UrlTrackerResource\Pages;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use KaanTanis\FilamentUrlTracker\Resources\UrlTrackerResource;
use KaanTanis\UrlTracker\Http\Controllers\TrackerController;

class ListUrls extends ListRecords
{
    protected static string $resource = UrlTrackerResource::class;

    protected function getTableRecordsPerPageSelectOptions(): array
    {
        return config('filament-url-tracker.per-page-select-options')
            ?? parent::getTableRecordsPerPageSelectOptions();
    }

    protected function getActions(): array
    {
        return [
            \Filament\Pages\Actions\Action::make('Create New')
                ->action(function ($data) {
                    $controller = new TrackerController();

                    $controller->makeShortUrlCode([
                        'tracked_url' => $data['url'],
                        'created_by' => $data['created_by']
                    ]);

                    redirect('');
                })
                ->form(function () {
                    return [
                        Select::make('created_by')
                            ->label('filament-url-tracker::filament-url-tracker.created_by')
                            ->options(function () {
                                $class = config('filament-url-tracker.user-model');
                                $model = new $class;
                                return $model->pluck('name', 'id');
                            })
                            ->searchable()
                            ->translateLabel(),

                        TextInput::make('url')
                            ->label('filament-url-tracker::filament-url-tracker.url')
                            ->translateLabel(),
                    ];
                })
        ];
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
