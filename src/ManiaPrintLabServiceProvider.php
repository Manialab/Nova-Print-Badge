<?php

namespace ManiaLab\ManiaPrintLab;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;
use Laravel\Nova\Menu\MenuSection;

class ManiaPrintLabServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 1) Publish migrations for the configuration table
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations/' => database_path('migrations'),
            ], 'maniaprintlab-migrations');
        }

        // 2) Load routes for the print tool
        $this->loadRoutesFrom(__DIR__ . '/routes/print.php');

        // 3) Load views for the print tool
        $this->loadViewsFrom(__DIR__ . '/../resources/printlab', 'maniaprintlab');

        // 4) Register Nova Resources
        Nova::resources([
            Nova\Configuration::class,
            Nova\BadgeDetail::class,
            Nova\PrintingRecord::class,
        ]);

        // 5) Register the Print Tool menu
        Nova::tools([
            new Tools\PrintTool,
        ]);
    }
}
