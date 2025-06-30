<?php

namespace ManiaLab\ManiaPrintLab\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Boolean;
use Illuminate\Http\Request;

class Configuration extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \ManiaLab\ManiaPrintLab\Models\Configuration::class;

    /**
     * The single value that should be used to represent the resource.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searchable.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->rules('required', 'max:255'),

            File::make('Font Family', 'font_family')
                ->help('Upload your .ttf/.otf file here'),

            File::make('Background Image', 'background_image')
                ->help('Upload the badge background image'),

            Boolean::make('Show Background', 'show_background')
                ->trueValue(1)
                ->falseValue(0)
                ->help('Whether to display the background by default'),
        ];
    }
}
