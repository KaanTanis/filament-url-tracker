<?php

namespace KaanTanis\FilamentUrlTracker;

use Filament\Navigation\UserMenuItem;
use Filament\PluginServiceProvider;
use KaanTanis\FilamentUrlTracker\Resources\UrlTrackerResource;
use Spatie\LaravelPackageTools\Package;

class FilamentUrlTrackerServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-url-tracker';

    protected array $resources = [
        UrlTrackerResource::class,
    ];

    protected array $pages = [
         //
    ];

    protected array $widgets = [
        //
    ];

    protected array $styles = [
        'plugin-filament-url-tracker' => __DIR__ . '/../resources/dist/filament-url-tracker.css',
    ];

    protected array $scripts = [
        'plugin-filament-url-tracker' => __DIR__ . '/../resources/dist/filament-url-tracker.js',
    ];

    // protected array $beforeCoreScripts = [
    //     'plugin-filament-url-tracker' => __DIR__ . '/../resources/dist/filament-url-tracker.js',
    // ];

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasConfigFile()
            ->hasTranslations();
    }
}
