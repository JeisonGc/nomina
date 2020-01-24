<?php

namespace App\Http\Controllers;

use App\Noveltie;
use App\Parameter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoveltiesController extends BaseController
{
    public function index(Request $request)
    {
        $year = $request->year;
        $parameter = Parameter::where('year', $year+0)->first();

        if (!$parameter) {
            return 'Parameter not found.';
        }

        $novelties = $parameter->novelties;

        return response()->json([
            $novelties
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

        $names = array_column(json_decode($parameter->novelties), 'name');

        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                function ($attribute, $value, $fail)use ($request, $names) {
                    $nameExist =  in_array($value, $names);
                    if ($nameExist) {
                        $fail($attribute.' exist.');
                    }
                },
            ],
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $noveltie = $parameter->novelties()->create($input);

        return response()->json([
            $noveltie
        ]);
    }

    public function show(Request $request, $id)
    {
        $year = $request->year;
        $parameter = Parameter::where('year', $year+0)->first();

        if (!$parameter) {
            return 'Parameter not found.';
        }

        $noveltie = $parameter->novelties()->find($id);
        
        if (!$noveltie) {
            return 'Novelties not found.';
        }

        return response()->json([
            $noveltie
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

        $noveltie = $parameter->novelties()->find($id);

        if (!$noveltie) {
            return 'Novelties not found.';
        }


        $noveltie->fill($input);
        $noveltie->save();

        return response()->json([
            $noveltie
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $year = $request->year;
        $parameter = Parameter::where('year', $year+0)->first();

        if (!$parameter) {
            return 'Parameter not found.';
        }

        $noveltie = $parameter->novelties()->find($id);

        if (!$noveltie) {
            return 'Noveltie not found.';
        }

        $noveltie->delete();

        return response()->json([
            $noveltie
        ]);
    }
}