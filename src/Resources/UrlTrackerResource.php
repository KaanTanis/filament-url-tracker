<?php

namespace KaanTanis\FilamentUrlTracker\Resources;

use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use KaanTanis\FilamentUrlTracker\Resources\UrlTrackerResource\Pages\CreateUrls;
use KaanTanis\FilamentUrlTracker\Resources\UrlTrackerResource\Pages\ListUrls;
use KaanTanis\FilamentUrlTracker\Resources\UrlTrackerResource\Pages\EditUrls;
use KaanTanis\FilamentUrlTracker\Resources\UrlTrackerResource\RelationManager\UrlLogsRelationManager;
use KaanTanis\UrlTracker\Models\UrlTrackerTable;

class UrlTrackerResource extends Resource
{
    protected static ?string $model = UrlTrackerTable::class;

    protected static ?string $navigationIcon = 'heroicon-o-table';

    public static function getLabel(): string
    {
        return __('filament-url-tracker::filament-url-tracker.label');
    }

    public static function getPluralLabel(): string
    {
        return __('filament-url-tracker::filament-url-tracker.plural_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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

                Placeholder::make('short_url')
                    ->hiddenOn('create')
                    ->formatStateUsing(fn($record) => isset($record->placeholder) ? route('url-tracker.generated-url', [
                        'placeholder' => $record->placeholder
                    ]) : null)
                    ->label('filament-url-tracker::filament-url-tracker.short_url')
                    ->translateLabel(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_by')
                    ->label('filament-url-tracker::filament-url-tracker.created_by')
                    ->searchable()
                    ->sortable()
                    ->translateLabel(),

                TextColumn::make('url')
                    ->label('filament-url-tracker::filament-url-tracker.url')
                    ->searchable()
                    ->translateLabel(),

                TextColumn::make('placeholder')
                    ->label('filament-url-tracker::filament-url-tracker.url_placeholder')
                    ->searchable()
                    ->translateLabel(),

                BadgeColumn::make('count')
                    ->label('filament-url-tracker::filament-url-tracker.count')
                    ->color(fn($record) => match (true) {
                        $record->count >= 1000 => 'success',
                        $record->count >= 100 => 'primary',
                        default => 'secondary'
                    })
                    ->translateLabel()
                    ->sortable()
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
        if (config('filament-url-tracker.nav-group')) {
            return __('filament-url-tracker::filament-url-tracker.nav_group');
        }

        return null;
    }

    protected static function getNavigationSort(): ?int
    {
        return config('filament-url-tracker.nav-sort');
    }

    public static function getRelations(): array
    {
        return [
            UrlLogsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUrls::route('/'),
            'edit' => EditUrls::route('/{record}/edit'),
            'create' => CreateUrls::route('/create')
        ];
    }
}
