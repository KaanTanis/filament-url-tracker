<?php

namespace KaanTanis\FilamentUrlTracker\Resources\UrlTrackerResource;

use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use KaanTanis\FilamentUrlTracker\Resources\UrlTrackerResource\Pages\ListUrls;
use KaanTanis\FilamentUrlTracker\Resources\UrlTrackerResource\Pages\ViewUrls;
use KaanTanis\UrlTracker\UrlTracker;

class UrlTrackerResource extends Resource
{
    protected static ?string $model = UrlTracker::class;

    protected static ?string $navigationIcon = 'heroicon-o-table';

    public static function getLabel(): string
    {
        return __('test');
    }

    public static function getPluralLabel(): string
    {
        return __('test');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('created_by')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_by')
            ])
            ->filters([
                //
            ])
            ->bulkActions([
                //
            ]);
    }

    protected static function getNavigationGroup(): ?string
    {
        return 'test';
    }

    protected static function getNavigationSort(): ?int
    {
        return 2;
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUrls::class,
            'view' => ViewUrls::class
        ];
    }
}
