<?php

namespace ManiaLab\ManiaPrintLab\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class BadgeDetail extends Resource
{
    public static $model  = \ManiaLab\ManiaPrintLab\Models\BadgeDetail::class;
    public static $title  = 'bd_id';
    public static $search = [
        'bd_id', 'bd_type_id'
    ];

    public function fields(Request $request): array
    {
        return [
            ID::make('ID', 'bd_id')->sortable(),

            Number::make('Type ID',        'bd_type_id'),
            Number::make('Width',          'bd_width'),
            Number::make('Height',         'bd_height'),

            Number::make('Name Show',      'bd_name_show'),
            Number::make('Name Position',  'bd_name_position'),
            Number::make('Country Show',   'bd_country_show'),
            Number::make('Country Position','bd_country_position'),
            Number::make('Company Show',   'bd_company_show'),
            Number::make('Company Position','bd_company_position'),
            Number::make('Position Show',  'bd_position_show'),
            Number::make('Position Pos',    'bd_position_position'),
            Number::make('Type Show',      'bd_type_show'),
            Number::make('Type Pos',        'bd_type_position'),
            Number::make('Code Show',      'bd_code_show'),
            Number::make('Code Pos',        'bd_code_position'),

            Number::make('Name PosX',       'bd_name_positionx'),
            Number::make('Country PosX',    'bd_country_positionx'),
            Number::make('Company PosX',    'bd_company_positionx'),
            Number::make('Position PosX',   'bd_position_positionx'),
            Number::make('Type PosX',       'bd_type_positionx'),
            Number::make('Code PosX',       'bd_code_positionx'),

            Number::make('Profile Show',    'bd_profile_show'),
            Number::make('Profile Pos',      'bd_profile_position'),
            Number::make('Profile PosX',     'bd_profile_positionx'),
            Number::make('Profile Width',    'bd_profile_width'),

            Number::make('Font Size',       's_font'),
            Number::make('Rotate Name',     'bd_rotatename'),
            Number::make('Rotate Type',     'db_rotatetype'),
            Number::make('Rotate Company',  'db_rotatecompany'),
            Number::make('Rotate Country',  'db_rotatecountry'),
            Number::make('Rotate Position', 'db_rotatposition'),

            Number::make('Company Font',     'companyfont'),
            Number::make('Position Font',    'positionfont'),
            Number::make('Type Font',        'typefont'),
            Number::make('Tick Type',        'tick_type'),
            Number::make('QR Width',         'bd_qr_width'),
            Number::make('Margin',           'bd_margin'),

            Text::make('Color', 'db_color'),
        ];
    }
}
