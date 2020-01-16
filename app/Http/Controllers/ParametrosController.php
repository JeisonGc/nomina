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
        
        //$parametros = Parametros::all();        
        $parametros = Parametros::get()->where('year',$request['year']);
            print_r($parametros); 
        return $parametros->toJson(JSON_PRETTY_PRINT);
        /*
        foreach ($parametros as $params) {
            echo $params->year;
        }*/
    }

    public function add(Request $request)
    {
       // print_r($request['contracts']); die;
       
       
        $deletedRows = Parametros::where('year', $request['data']['year'])->delete();

        $parametros = new Parametros();

        //$parametros = Parametros::create($peticion);
       // $parametros->fill($peticion);


        $parametros->minimum_salary = $request['minimum_salary'];
        $parametros->year = $request['year'];
        $parametros->transport_aid = $request['transport_aid'];
        $parametros->transport_aid_ms = $request['transport_aid_ms'];
        $parametros->daytime_overtime = $request['daytime_overtime'];
        $parametros->night_overtime = $request['night_overtime'];
        $parametros->sunday_hours_nocomp = $request['sunday__nocomp'];
        $parametros->daytime_overtime = $request['sunday_overtime'];
        $parametros->sunday_night_overtime = $request['sunday_night_overtime'];
        $parametros->night_surcharge = $request['night_surcharge'];
        
        $aux_contratos = $request->get('contracts');
        //print_r($aux_contratos); die;
        $parametros->contract = array();
        $parametros->contract = array_merge($parametros->contract, [$aux_contratos]);
        

        $aux_solidarity_fund = $request->get('solidarity_fund');
        $parametros->solidarity_fund = array();
        $parametros->solidarity_fund = array_merge($parametros->solidarity_fund, [$aux_solidarity_fund]);

        $aux_risk = $request->get('risk');
        $parametros->risk = array();
        $parametros->risk = array_merge($parametros->risk, [$aux_risk]);
              
        $parametros->save();      

        return $parametros;
    }
}
