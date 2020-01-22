<?php

namespace App\Http\Controllers;

use App\TypeContract;
use App\Parametros;
use Illuminate\Http\Request;

class TypeContractController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->year;
        $p = Parametros::where('year', $year+0)->first();

        $typeContract = $p->typeContracts;

        return response()->json([
            $typeContract
            
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        
        //$year = 2020;
        //$p = Parametros::where('year', $year)->first();

       // $typeContract = new TypeContract($input);

        //$comment = $p->typeContracts()->create($input);

        //$p->typeContracts()->save($typeContract);   

        return response()->json([
            $year
        ]);
    }


    public function show($id)
    {
        $typeContract = TypeContract::find($id);

        if (is_null($typeContract)) {
            return $this->typeContract('typeContract not found.');
        }
   
        return response()->json([
            'contrato' => $typeContract
        ]);
    }


    public function update(Request $request, $id)
    {
        $typeContract = TypeContract::find($id);
        $typeContract->fill($request->all());
        $typeContract->save();

        if ($typeContract) {                      
            return response()->json([
                'data' => $typeContract,
                'message' => 'contract sucesfully updated'
            ]);             
        } 
    }

    public function destroy($id)
    {
        if ($id) {           
            $typeContract =TypeContract::find($id);
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
