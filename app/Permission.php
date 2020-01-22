<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Permission extends Eloquent
{
    use SoftDeletes;

    public $connection = 'mongodb';
    protected $collection = 'permissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug'];

    protected $dates = ['deleted_at'];
}
