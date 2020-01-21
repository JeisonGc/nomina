<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class RiskClass extends Eloquent
{
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $collection = 'riskClasses';

    protected $fillable = 
    array('class',
          'minimum_value',
          'start_value',
          'max_value',
          'status'
    );
}