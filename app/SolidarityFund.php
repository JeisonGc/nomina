<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class SolidarityFund extends Eloquent
{
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $collection = 'solidarity-funds';

    protected $fillable = 
    array('start_ms',
          'final_ms',
          'percentage',
          'status'
    );
}