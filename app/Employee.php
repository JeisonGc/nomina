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

    protected $fillable = ['first_Name','last_Name','document_type','document_number','email','cellphone',
    'date_born','current_contract','contracts','social_security','payment_method','learns','transport_aid'];

    protected $dates = ['deleted_at'];

    public function loans()
    {
        return $this->hasMany('App\Loan');
    }
}

