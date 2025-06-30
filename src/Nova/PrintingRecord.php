<?php

namespace ManiaLab\ManiaPrintLab\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;

class PrintingRecord extends Resource
{
    public static $model  = \ManiaLab\ManiaPrintLab\Models\PrintingRecord::class;
    public static $title  = 'id';
    public static $search = [
        'print_token', 'print_userid'
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make('ID', 'id')->sortable(),

            Text::make('Token',   'print_token')->sortable(),
            Text::make('User ID', 'print_userid'),
            DateTime::make('Created', 'print_created_date'),
            DateTime::make('Printed', 'print_date'),

            Text::make('Shortcode', function () {
                return "[maniaprint badge_token=\"{$this->print_token}\" user_id=\"{$this->print_userid}\"]";
            })
            ->onlyOnIndex()
            ->asHtml()
            ->help('Copy this shortcode to embed the print link.'),

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
