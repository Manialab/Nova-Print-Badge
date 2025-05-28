<?php
namespace ManiaLab\ManiaPrintLab\Tools;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class PrintTool extends Tool
{
    public function boot()
    {
        Nova::script('maniaprintlab-print', __DIR__.'/../../resources/printlab/js/tool.js');
    }

    public function menu(Request $request)
    {
        return MenuSection::make('Print Badges')
            ->path('/maniaprintlab/print')
            ->icon('printer');
    }
}
