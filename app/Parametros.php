<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Parametros extends Eloquent
{
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $collection = 'parametros';
    /*
    protected $casts = [
        'contracts' => 'array',
    ];

    protected $fillable = ['minimum_salary','year','transport_aid','transport_aid_ms','daytime_overtime','night_overtime','sunday_hours_nocomp','daytime_overtime','sunday_night_overtime','night_surcharge'.'contracts'];
    */
}