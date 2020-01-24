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
        'base_salary',
        'cutoff_date',
        'worked_days',
        'base_salary',
        'transportation_aid',
        'hours',
        'non_salary_bonus',
        'total_accrued',
        'deductions',
        'total_pay',
        'employer_contributions',
        'provisions',
        'novelties'
    ];

    protected $dates = ['deleted_at'];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'cutoff_date' => 0,
        'worked_days' => 0,
        'base_salary' => 0,
        'transportation_aid' => 0,
        'hours' => [
            'daytime_overtime' => [
                'quantity' => 0,
                'amount' => 0
            ],
            'night_overtime' => [
                'quantity' => 0,
                'amount' => 0
            ],
            'sunday_hours_nocomp' => [
                'quantity' => 0,
                'amount' => 0
            ],
            'sunday_overtime' => [
                'quantity' => 0,
                'amount' => 0
            ],
            'sunday_night_overtime' => [
                'quantity' => 0,
                'amount' => 0
            ],
            'night_surcharge' => [
                'quantity' => 0,
                'amount' => 0
            ],
            'total_hours' => 0
        ],
        'non_salary_bonus' => 0,
        'total_accrued' => 0,
        'deductions' => [
            'health' => 0,
            'pension' => 0,
            'solidarity_fund_contribution' => 0,
            'source_retention' => 0,
            'others' => 0,
            'loans' => 0,
            'total' => 0
        ],
        'total_pay' => 0,
        'employer_contributions' => [
            'health' => 0,
            'pension' => 0,
            'arl' => 0,
            'sena' => 0,
            'icbf' => 0,
            'compensation_box' => 0,
            'total' => 0
        ],
        'provisions' => [
            'unemployment' => 0,
            'unemployment_interests' => 0,
            'bonus' => 0,
            'vacations' => 0,
            'total' => 0
        ],
        'novelties' => []
    ];
}
