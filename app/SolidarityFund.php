<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class SolidarityFund extends Eloquent
{
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'solidarity-funds';

    protected $fillable = 
    [
        'start_ms',
        'final_ms',
        'percentage'
    ];

    public function parameter()
    {
        return $this->belongsTo('parameters');
    }
}