<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class ConfigurationClient extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'configuration_clients';
    protected $fillable = array('name','url_icon','title','connection','email');
}
