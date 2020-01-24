<?php

namespace App\Http\Controllers;

use App\SolidarityFund;
use App\Parameter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class SolidarityFundController extends BaseController
{
    public function index(Request $request)
    {
        $year = $request->year;
        $parameter = Parameter::where('year', $year+0)->first();

        if (!$parameter) {
            return 'Parameter not found.';
        }

        $solidarityFunds = $parameter->solidarity_fund;

        return response()->json([
            $solidarityFunds
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $year = $request->year;
        $parameter = Parameter::where('year', $year+0)->first();

        if (!$parameter) {
            return 'Parameter not found.';
        }

        $solidarityFund = $parameter->solidarity_fund()->create($input);

        return response()->json([
            $solidarityFund
        ]);
    }

    public function show(Request $request, $id)
    {
        $year = $request->year;
        $parameter = Parameter::where('year', $year+0)->first();

        if (!$parameter) {
            return 'Parameter not found.';
        }

        $solidarityFund = $parameter->solidarity_fund()->find($id);
        
        if (!$solidarityFund) {
            return 'solidarityFund not found.';
        }
   
        return response()->json([
            $solidarityFund
        ]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $year = $request->year;
        $parameter = Parameter::where('year', $year+0)->first();

        if (!$parameter) {
            return 'Parameter not found.';
        }

        $solidarityFund = $parameter->solidarity_fund()->find($id);

        if (!$solidarityFund) {
            return 'SolidarityFund not found.';
        }

        $solidarityFund->fill($input);
        $solidarityFund->save();

        return response()->json([
            $solidarityFund
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $year = $request->year;
        $parameter = Parameter::where('year', $year+0)->first();

        if (!$parameter) {
            return 'Parameter not found.';
        }

        $solidarityFund = $parameter->solidarity_fund()->find($id);

        if (!$solidarityFund) {
            return 'SolidarityFund not found.';
        }

        $solidarityFund->delete();

        return response()->json([
            $solidarityFund
        ]);
    }
}