<?php

namespace App\Http\Controllers;

use App\Parameter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class ParametersController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
    }

    public function show($year)
    {         
        //echo "year= ".$year; die;
        $Parameters = Parameter::get()->where('year','=',$year);    
        return response()->json([
            'data' => $Parameters,
            'message' => 'list of resources'
        ], 200) ;              
    }

    public function store(Request $request)
    {        

        $datos = $request->all();        
        $deletedRows = Parameter::where('year', $datos['year'])->delete();
       
        $parametro = Parameter::create($request->all());
        

        return response()->json([
            'data' => $parametro,
            'message' => 'resource created'
        ], 201);
  

    }
}
