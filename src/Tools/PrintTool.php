<?php

namespace ManiaLab\ManiaPrintLab\Tools;

use Laravel\Nova\Tool;
use Laravel\Nova\Nova;
use Laravel\Nova\Menu\MenuSection;
use Illuminate\Http\Request; // ← correct import

class PrintTool extends Tool
{
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // If you have JS to load for your tool, otherwise you can remove this line
        Nova::script('maniaprintlab-print', __DIR__ . '/../../resources/printlab/js/tool.js');
    }

    /**
     * Build the menu for the Nova sidebar.
     */
    public function menu(Request $request)
    {
        return MenuSection::make('Print Badges')
            ->path('/nova-vendor/maniaprintlab/print')  // make sure this matches your route
            ->icon('printer');
    }
}
