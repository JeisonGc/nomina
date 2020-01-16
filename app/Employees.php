<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Employees extends Eloquent
{
    use SoftDeletes;
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $collection = 'employees';    
    protected $dates = ['deleted_at'];
    protected $fillable = ['name','last_name','document_type','document','salary',
    'contract_type','risk','eps','transport','status','news'];

}