<?php

namespace ManiaLab\ManiaPrintLab\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Resource;

class PrintingRecord extends Resource
{
    public static $model = \ManiaLab\ManiaPrintLab\Models\PrintingRecord::class;
    public static $title = 'print_token';
    public static $search = ['print_token', 'print_userid'];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Print Token', 'print_token')
                ->onlyOnIndex(),

            Text::make('User ID', 'print_userid')
                ->onlyOnIndex(),

            DateTime::make('Printed At', 'print_date')
                ->onlyOnIndex(),

            // SHORTCODE field
            Text::make('Shortcode', function () {
                return "[maniaprint badge_token=\"{$this->print_token}\" user_id=\"{$this->print_userid}\"]";
            })
            ->onlyOnIndex()
            ->asHtml()
            ->help('Paste this wherever you need to reference the badge.'),

            // PRINT BUTTON field
            Text::make('Print', function () {
                $url = route('maniaprintlab.print', [
                    $this->print_token,
                    $this->print_userid,
                ]);
                return "<a href=\"{$url}\" target=\"_blank\" class=\"btn btn-primary btn-sm\">Print</a>";
            })
            ->onlyOnIndex()
            ->asHtml()
            ->help('Click to open the print page in a new tab.'),
        ];
    }
}
