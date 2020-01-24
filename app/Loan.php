<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Loan extends Eloquent
{
    use SoftDeletes;
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $collection = 'loans';

    protected $fillable = 
    array( 'number_fees',
        'total_mount',
        'fee_amount',
        'balance',
        'start_date',
        'end_date',
        'payments'
    );
    protected $dates = ['deleted_at'];

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }

}
