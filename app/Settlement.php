<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\HybridRelations;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Settlement extends Eloquent
{
    use SoftDeletes;
    use HybridRelations;
    protected $connection = 'mongodb';
    protected $collection = 'settlements';
    protected $dates = ['deleted_at'];
    protected $fillable = ['cutoff_date','worked_days','cutoff_date','base_salary','transportation_aid','hours','non_salary_bonus','total_accrued','deductions','total_pay','employer_contributions','provisions','novelties'];
   
}
