<?php

namespace KaanTanis\FilamentUrlTracker\Resources\UrlTrackerResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Http;
use KaanTanis\FilamentUrlTracker\Resources\UrlTrackerResource;

class CreateUrls extends CreateRecord
{
    protected static string $resource = UrlTrackerResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $short_url = Http::asForm()->post(route('url-tracker.generate-url'), [
            'tracked_url' => $data['url']
        ]);
        
        // todo: self post

        dd($short_url);
    }
}
