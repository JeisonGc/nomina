<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Employee extends Eloquent
{
    use SoftDeletes;
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $collection = 'employees';    
    protected $dates = ['deleted_at'];
    protected $fillable = ['firstName','lastName','documentType','documentNumber','email','cellphone',
    'date_born','current_contract','contracts','social_security','payment_method','learns','transportAid','status'];

}

