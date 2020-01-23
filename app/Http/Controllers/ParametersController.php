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
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
    }


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
