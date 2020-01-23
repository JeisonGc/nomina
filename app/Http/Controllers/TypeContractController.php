<?php

namespace App\Http\Controllers;

use App\TypeContract;
use App\Parametros;
use Illuminate\Http\Request;

class TypeContractController extends Controller
{
    public function index(Request $request)
    {
        //Ya que los tipos de contratos dependen del parametro, se necesita el año para saber de cual
        // documento de parametro se listaran los contratos.
        $year = $request->year;
        $parameter = Parametros::where('year', $year+0)->first();

        $typeContract = $parameter->typeContracts;

        return response()->json([
            $typeContract
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $year = $request->year;
        $parameter = Parametros::where('year', $year+0)->first();
        $typeContract = $parameter->typeContracts()->create($input);

        return response()->json([
            $typeContract
        ]);
    }


    public function show(Request $request, $id)
    {
        $year = $request->year;
        $parameter = Parametros::where('year', $year+0)->first();

        $typeContract = $parameter->typeContracts()->find($id);

        if (is_null($typeContract)) {
            return $this->typeContract('typeContract not found.');
        }
   
        return response()->json([
            'contract' => $typeContract
        ]);
    }


    public function update(Request $request, $id)
    {
        $input = $request->all();
        $year = $request->year;
        $parameter = Parametros::where('year', $year+0)->first();

        $typeContract = $parameter->typeContracts()->find($id);

        $typeContract->fill($input);
        $typeContract->save();

        if ($typeContract) {                      
            return response()->json([
                'data' => $typeContract,
                'message' => 'contract sucesfully updated'
            ]);             
        } 
    }

    public function destroy(Request $request, $id)
    {
        if ($id) {           
            $year = $request->year;
            $parameter = Parametros::where('year', $year+0)->first();

            $typeContract = $parameter->typeContracts()->find($id);
            $typeContract->delete();
    
            if ($typeContract) {            
                return response()->json([
                    'data' => $typeContract,
                    'message' => 'successfully eliminated'               
                ]);
                            
            }
        }
    }
}
