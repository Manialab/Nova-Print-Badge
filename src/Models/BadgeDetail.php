<?php

namespace ManiaLab\ManiaPrintLab\Models;

use Illuminate\Database\Eloquent\Model;

class BadgeDetail extends Model
{
    protected $table = 'badges_details';
    protected $primaryKey = 'bd_id';
    public $timestamps = false;

    protected $fillable = [
        'bd_type_id',
        'bd_width',
        'bd_height',
        'bd_name_show',
        'bd_name_position',
        'bd_country_show',
        'bd_country_position',
        'bd_company_show',
        'bd_company_position',
        'bd_position_show',
        'bd_position_position',
        'bd_type_show',
        'bd_type_position',
        'bd_code_show',
        'bd_code_position',
        'bd_name_positionx',
        'bd_country_positionx',
        'bd_company_positionx',
        'bd_position_positionx',
        'bd_type_positionx',
        'bd_code_positionx',
        'bd_profile_show',
        'bd_profile_position',
        'bd_profile_positionx',
        'bd_profile_width',
        's_font',
        'bd_rotatename',
        'db_rotatetype',
        'db_rotatecompany',
        'db_rotatecountry',
        'db_rotatposition',
        'companyfont',
        'positionfont',
        'typefont',
        'tick_type',
        'bd_qr_width',
        'bd_margin',
        'db_color',
        'bg_color',
        'font_color',
    ];
}
