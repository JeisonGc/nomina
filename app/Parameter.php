<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Parameter extends Eloquent
{
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $collection = 'parameters';
    
    

    protected $fillable = ['minimum_salary','year','transport_aid','daytime_overtime','night_overtime','sunday_hours_nocomp','sunday_overtime','sunday_night_overtime','night_surcharge','parafiscals','health_exception','contracts','solidarity_fund','risk_class','novelties']; 
    
}