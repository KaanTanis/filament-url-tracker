<?php

namespace KaanTanis\FilamentUrlTracker\Resources\UrlTrackerResource\RelationManager;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;

class UrlLogsRelationManager extends RelationManager
{
    protected static string $relationship = 'trackerLog';

    protected static ?string $recordTitleAttribute = 'id';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ip_address')
                    ->label('filament-url-tracker::filament-url-tracker.ip_address')
                    ->translateLabel(),

                TextColumn::make('user_agent')
                    ->label('filament-url-tracker::filament-url-tracker.user_agent')
                    ->translateLabel(),

                TextColumn::make('referer')
                    ->label('filament-url-tracker::filament-url-tracker.referer')
                    ->translateLabel(),

                TextColumn::make('method')
                    ->label('filament-url-tracker::filament-url-tracker.method')
                    ->translateLabel(),
            ]);
    }
}
