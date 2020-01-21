<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Role extends Eloquent
{
    use SoftDeletes;

    public $connection = 'mongodb';
    protected $collection = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'permissions'];

    protected $dates = ['deleted_at'];
}
