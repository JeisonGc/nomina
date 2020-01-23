<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Settlement extends Eloquent
{
    use SoftDeletes;

    protected $collection = 'settlements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cutoff_date',
        'worked_days',
        'base_salary',
        'transportation_aid',
        'non_salary_bonus',
        'total_accrued',
        'total_pay'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'hours' => 'array',
        'deductions' => 'array',
        'employer_contributions' => 'array',
        'provisions' => 'array',
        'novelties' => 'array'
    ];

    protected $dates = ['deleted_at'];
}
