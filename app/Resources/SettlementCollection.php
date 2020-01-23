<?php


namespace App\Resources;


class SettlementCollection
{
    /**
     * Expands arrays with keys that have dot notation
     *
     * @param Array $array
     *
     * @return Array
     */
    public static function getInitial($model)
    {

        $model->cutoff_date = "";
        $model->worked_days = 0;
        $model->base_salary = 0;
        $model->transportation_aid = 0;
        $model->hours = [
            'daytime_overtime' => [
                'cantdad' => 0,
                'monto' => 0
            ],
            'night_overtime' => [
                'cantdad' => 0,
                'monto' => 0
            ],
            'sunday_hours_nocomp' => [
                'cantdad' => 0,
                'monto' => 0
            ],
            'sunday_overtime' => [
                'cantdad' => 0,
                'monto' => 0
            ],
            'sunday_night_overtime' => [
                'cantdad' => 0,
                'monto' => 0
            ],
            'night_surcharge' => [
                'cantdad' => 0,
                'monto' => 0
            ],
            'total_hours' => 0
        ];
        $model->non_salary_bonus = 0;
        $model->total_accrued = 0;
        $model->deductions = [
            'health' => 0,
            'pension' => 0,
            'solidarity_fund_contribution' => 0,
            'source_retention' => 0,
            'others' => 0,
            'loans' => 0,
            'total' => 0
        ];
        $model->total_pay = 0;
        $model->employer_contributions = [
            'health' => 0,
            'pension' => 0,
            'arl' => 0,
            'sena' => 0,
            'icbf' => 0,
            'compensation_box' => 0,
            'total' => 0
        ];
        $model->provisions = [
            'unemployment' => 0,
            'unemployment_interests' => 0,
            'bonus' => 0,
            'vacations' => 0,
            'total' => 0
        ];
        $model->novelties = [];

        return $model;
    }
}
