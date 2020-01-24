<?php

namespace App\Http\Controllers;

use App\Parameter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ParametersController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $parameters = Parameter::withTrashed()->get();

        return response()->json($parameters, 200);
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
    */
    public function store(Request $request)
    {        
        $datos = $request->all();        
        $deletedRows = Parameter::where('year', $datos['year'])->delete();
       
        $validator = Validator::make($request->all(), [            
            'year' => 'required|numeric|min:0',
            'daytime_overtime' => 'numeric|min:0',
            'night_overtime' => 'numeric|min:0',
            'sunday_hours_nocomp' => 'numeric|min:0',
            'sunday_overtime' => 'numeric|min:0',
            'sunday_night_overtime' => 'numeric|min:0',
            'night_surcharge' => 'numeric|min:0',
            'parafiscals.smlv' => 'requiredIf:parafiscals.apply,true|numeric',
            'health_exception.smlv' => 'requiredIf:health_exception.apply,true|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $parameter = Parameter::create($request->all());

        return response()->json([
            'data' => $parameter,
            'message' => 'resource created'
        ], 201);
    }

     /**
     * Display the specified resource.
     *
     * @param $year
     * @return JsonResponse
     */
    public function show($year)
    {         
        $parameter = Parameter::get()->where('year','=',$year);
        
        return response()->json([
            'data' => $parameter,
            'message' => 'list of resources'
        ], 200) ;              
    }
}
