<?php

namespace App\Http\Controllers;

use App\Settlement;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class SettlementsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settlement = Settlement::withTrashed()->get();
        if ($settlement) {           
            return response()->json([
                'data' => $settlement,
                'message' => 'successful listing'
            ], 200);
        }
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->all();                
       
        $validator = Validator::make($request->all(), [            
            'cutoff_date' => 'required|date',
            'worked_days' => 'required|numeric|min:0',
            'base_salary' => 'numeric|min:0',
            'transportation_aid' => 'numeric|min:0',
            
                    'hours.daytime_overtime.cantdad' => 'numeric|min:0',
                    'hours.daytime_overtime.monto' => 'numeric|min:0',
                    
                    'hours.night_overtime.cantdad' => 'numeric|min:0',
                    'hours.night_overtime.monto' => 'numeric|min:0',

                    'hours.sunday_hours_nocomp.cantdad' => 'numeric|min:0',
                    'hours.sunday_hours_nocomp.monto' => 'numeric|min:0',

                    'hours.sunday_overtime.cantdad' => 'numeric|min:0',
                    'hours.sunday_overtime.monto' => 'numeric|min:0',

                    'hours.sunday_night_overtime.cantdad' => 'numeric|min:0',
                    'hours.sunday_night_overtime.monto' => 'numeric|min:0',

                    'hours.night_surcharge.cantdad' => 'numeric|min:0',
                    'hours.night_surcharge.monto' => 'numeric|min:0',

                'hours.total_hours' => 'numeric|min:0',
                    
            'non_salary_bonus' => 'numeric|min:0',
            'total_accrued' => 'numeric|min:0',

                'deductions.health' => 'numeric|min:0',
                'deductions.pension' => 'numeric|min:0',
                'deductions.solidarity_fund_contribution' => 'numeric|min:0',
                'deductions.source_retention' => 'numeric|min:0',
                'deductions.others' => 'numeric|min:0',
                'deductions.loans' => 'numeric|min:0',
                'deductions.total' => 'numeric|min:0',

            'total_pay' => 'numeric|min:0',
            
                'employer_contributions.health' => 'numeric|min:0',
                'employer_contributions.pension' => 'numeric|min:0',
                'employer_contributions.arl' => 'numeric|min:0',
                'employer_contributions.sena' => 'numeric|min:0',
                'employer_contributions.icbf' => 'numeric|min:0',
                'employer_contributions.compensation_box' => 'numeric|min:0',
                'employer_contributions.total' => 'numeric|min:0',

                'provisions.unemployment' => 'numeric|min:0',
                'provisions.unemployment_interests' => 'numeric|min:0',
                'provisions.bonus' => 'numeric|min:0',
                'provisions.vacations' => 'numeric|min:0',
                'provisions.total' => 'numeric|min:0',
            
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $settlement = Settlement::create($request->all());        

        return response()->json([
            'data' => $settlement,
            'message' => 'resource created'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Settlement  $settlement
     * @return \Illuminate\Http\Response
     */
    public function show($settlement_id)
    {        
        if ($settlement_id) {         
            $settlement = Settlement::find($settlement_id);           
            if ($settlement) {                      
                return response()->json([
                    'data' => $settlement,
                    'message' => 'settlement exists'                    
                ]);             
            }  
        } 
    }

    public function update($settlement_id,Request $request)
    {
        $input = $request->all();
        if ($input) {         
            $settlement = Settlement::find($settlement_id);           
            $settlement->fill($request->all());
            $settlement->save();

            if ($settlement) {                      
                return response()->json([
                    'data' => $settlement,
                    'message' => 'settlement successfully updated'
                    
                ]);             
            }  
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Settlement  $settlement
     * @return \Illuminate\Http\Response
     */
    public function destroy($settlement_id)
    {
        if ($settlement_id) {           
            $settlement = Settlement::find($settlement_id);           
            $settlement->delete();       
                                        
            if ($settlement) {            
                return response()->json([
                    'data' => $settlement,
                    'message' => 'settlement successfully eliminated'               
                ]);
                            
            }
        }
    }
}
