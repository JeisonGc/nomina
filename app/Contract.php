<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Contract extends Eloquent
{
    use SoftDeletes;

    protected $collection = 'contracts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'salary',
        'contract_type',
        'risk_class',
        'start_date',
        'end_date',
        'undefined',
        'current_settlement',
        'settlements'
    ];

    protected $dates = ['deleted_at'];
}
