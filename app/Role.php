<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Role extends Eloquent
{
    public $connection = 'mongodb';
    protected $collection = 'roles';
}
