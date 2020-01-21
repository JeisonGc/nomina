<?php

namespace App\Http\Controllers;

use App\Parametros;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class ParametrosController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
    }

    public function index(Request $request)
    {
        $nd = getdate();
        $year = $nd['year'];
        if(isset($request['year'])&&$request['year']!=''){
            $year = $request['year'];
        }    
        $parametros = Parametros::get()->where('year',$year);            
        return $parametros->toJson(JSON_PRETTY_PRINT);        
    }

    public function add(Request $request)
    {
        

        $datos = $request->all();        
        $deletedRows = Parametros::where('year', $datos['year'])->delete();
       
        $parametro = Parametros::create($request->all());
        

        return response()->json([
            'data' => $parametro,
            'message' => 'resource created'
        ], 201);
  

    }
}
