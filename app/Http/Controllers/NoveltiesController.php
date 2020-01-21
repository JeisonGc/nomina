<?php

namespace App\Http\Controllers;

use App\Noveltie;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class NoveltiesController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        //$this->middleware('jwt', ['except' => ['login']]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $noveltie = Noveltie::create($input);

        return response()->json([
            $noveltie
        ]);
    }

    public function show($id)
    {
        $noveltie = Noveltie::find($id);
  
        if (is_null($noveltie)) {
            return $this->noveltie('noveltie not found.');
        }
   
        return response()->json([
            $noveltie
        ]);
    }

    public function update(Request $request, $id)
    {
        $noveltie = Noveltie::find($id);

        $noveltie->id           = $request->input('id');
        $noveltie->name         = $request->input('name');
        $noveltie->start_value  = $request->input('start_value');
        $noveltie->type         = $request->input('type');
        $noveltie->formula      = $request->input('formula');
        $noveltie->save();

        return response()->json([
            $noveltie
        ]);
    }

    public function destroy(Request $request, $id)
    {
        $noveltie = Noveltie::find($id);

        $noveltie->status = $request->input('status');
        $noveltie->save();

        return response()->json([
            $noveltie
        ]);
    }
}