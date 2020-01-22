<?php

namespace App\Http\Controllers;

use App\RiskClass;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class RiskClassController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $riskClass = RiskClass::create($input);

        return response()->json([
            $riskClass
        ]);
    }

    public function show($id)
    {
        $riskClass = RiskClass::find($id);
  
        if (is_null($riskClass)) {
            return $this->riskClass('riskClass not found.');
        }
   
        return response()->json([
            $riskClass
        ]);
    }

    public function update(Request $request, $id)
    {
        $riskClass = RiskClass::find($id);

        $riskClass->class         = $request->input('class');
        $riskClass->minimum_value = $request->input('minimum_value');
        $riskClass->start_value   = $request->input('start_value');
        $riskClass->max_value     = $request->input('max_value');
        $riskClass->save();

        return response()->json([
            $riskClass
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $riskClass = RiskClass::find($id);

        $riskClass->status = $request->input('status');
        $riskClass->save();

        return response()->json([
            $riskClass
        ]);
    }
}