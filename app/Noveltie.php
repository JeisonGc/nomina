<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class Noveltie extends Eloquent
{
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $collection = 'novelties';

    protected $fillable = 
    array('id',
          'name',
          'start_value',
          'type',
          'formula',
          'status'
    );
}