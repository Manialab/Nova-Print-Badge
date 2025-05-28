<?php

namespace ManiaLab\ManiaPrintLab\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'maniaprintlab_configurations';

    protected $fillable = [
        'name',
        'font_family',
        'background_image',
        'show_background',
    ];
}
