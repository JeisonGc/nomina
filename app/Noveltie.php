<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Noveltie extends Eloquent
{
    use SoftDeletes;
    protected $collection = 'novelties';

    protected $fillable = 
    [   'id',
        'name',
        'start_value',
        'type',
        'formula'
    ];

    public function parameter()
    {
        return $this->belongsTo('parameters');
    }
}