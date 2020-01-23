<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Employee extends Eloquent
{
    use SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'employees';    

    protected $fillable = ['first_Name','last_Name','document_Type','document_Number','email','cellphone',
    'date_born','current_contract','contracts','social_security','payment_method','learns','transport_Aid'];

    protected $dates = ['deleted_at'];
}

