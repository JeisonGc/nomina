<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class TypeContract extends Eloquent
{
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'type-contracts';

    protected $fillable = 
    [
        'description',
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
    ];

    public function parameter()
    {
        return $this->belongsTo('parameters');
    }
}

