<?php

namespace ManiaLab\ManiaPrintLab;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Nova;
// Import **your** Nova resources:
use ManiaLab\ManiaPrintLab\Nova\Configuration;
use ManiaLab\ManiaPrintLab\Nova\BadgeDetail;
use ManiaLab\ManiaPrintLab\Nova\PrintingRecord;
// Import your tool class:
use ManiaLab\ManiaPrintLab\Tools\PrintTool;

class ManiaPrintLabServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish migrations when running in console
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations/' => database_path('migrations'),
            ], 'maniaprintlab-migrations');
        }

        // Load your print route
        $this->loadRoutesFrom(__DIR__ . '/routes/print.php');

        // Load your print view namespace
        $this->loadViewsFrom(__DIR__ . '/../resources/printlab', 'maniaprintlab');

        // Register **your** Nova resources
        Nova::resources([
            Configuration::class,
            BadgeDetail::class,
            PrintingRecord::class,
        ]);

        // Register the Print Badges tool
        Nova::tools([
            new PrintTool,
        ]);
    }
}
