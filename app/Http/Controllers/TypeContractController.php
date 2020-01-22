<?php

namespace App\Http\Controllers;

use App\TypeContract;
use Illuminate\Http\Request;

class TypeContractController extends Controller
{
    public function index()
    {
        $typeContract = TypeContract::all();

        return response()->json([
            $typeContract
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $typeContract = typeContract::create($input);

        return response()->json([
            $typeContract
        ]);
    }


    public function show($id)
    {
        $typeContract = TypeContract::find($id);
  
        if (is_null($typeContract)) {
            return $this->typeContract('typeContract not found.');
        }
   
        return response()->json([
            $typeContract
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
