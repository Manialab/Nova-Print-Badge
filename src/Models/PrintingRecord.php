<?php

namespace ManiaLab\ManiaPrintLab\Models;

use Illuminate\Database\Eloquent\Model;

class PrintingRecord extends Model
{
    protected $table = 'printing';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'print_token',
        'print_userid',
        'print_created_date',
        'print_date',
    ];
}
