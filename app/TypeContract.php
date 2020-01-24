<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class TypeContract extends Eloquent
{
    use SoftDeletes;
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $collection = 'typeContracts';

    protected $fillable = 
    array('description',
          'worker_health_contribution',
          'employer_health_contribution',
          'worker_pension_contribution',
          'employer_pension_contribution',
          'unemployment',
          'unemployment_interest',
          'bonus',
          'vacations',
          'sena',
          'icbf',
          'arl',
          'compensation_box',
          'apply_overtime'
    );

}

