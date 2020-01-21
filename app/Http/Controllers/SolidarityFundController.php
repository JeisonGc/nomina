<?php

namespace App\Http\Controllers;

use App\SolidarityFund;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class SolidarityFundController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        //$this->middleware('jwt', ['except' => ['login']]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $solidarityFund = SolidarityFund::create($input);

        return response()->json([
            $solidarityFund
        ]);
    }

    public function show($id)
    {
        $solidarityFund = SolidarityFund::find($id);
  
        if (is_null($solidarityFund)) {
            return $this->solidarityFund('solidarityFund not found.');
        }
   
        return response()->json([
            $solidarityFund
        ]);
    }

    public function update(Request $request, $id)
    {
        $solidarityFund = SolidarityFund::find($id);

        $solidarityFund->start_ms   = $request->input('start_ms');
        $solidarityFund->final_ms   = $request->input('final_ms');
        $solidarityFund->percentage = $request->input('percentage');
        $solidarityFund->save();

        return response()->json([
            $solidarityFund
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $solidarityFund = SolidarityFund::find($id);

        $solidarityFund->status = $request->input('status');
        $solidarityFund->save();

        return response()->json([
            $solidarityFund
        ]);
    }
}