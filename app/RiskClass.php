<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class RiskClass extends Eloquent
{
    protected $collection = 'risk_classes';

    protected $fillable = 
    array('class',
          'minimum_value',
          'start_value',
          'max_value',
          'status'
    );
}