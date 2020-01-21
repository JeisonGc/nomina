<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class EmployeesController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    

    public function store(Request  $request){      
      
        $input = $request->all();        
        if ($input) {           
        $employee = Employee::create($input);        
        if($employee){
        return response()->json([
            'data' => $employee,
            'message' => 'employee created succesfuly'
        ], 201);
        }

        }else {

        return response()->json([            
            'message' => 'enter data'
        ]);


       }
        
    }   


    public function show(){

       
        $employee = Employee::all();
        if (!$employee) {
            return response()->json([
                'data' => $employee,
                'message' => 'no employees to show'
            ], 404);
        }else{
            return response()->json([
                'data' => $employee,
                'message' => 'successful listing'
            ], 201);
        }      
          
    }


    public function update($documentNumber,Request  $request){ 
        
        $input = $request->all();
        if ($input) {         
        $employee =Employee::where('documentNumber',(string)$documentNumber)->first(); 
        $employee->fill($request->all());
        $employee->save();

        if (!$employee) {
            return response()->json([
                'data' => $employee,
                'message' => 'the employee does not exist'
               
            ], 404);
           
        }else {           
            return response()->json([
                'data' => $employee,
                'message' => 'employee successfully updated'
                
            ]);             
        }  
        } else {

        return response()->json([            
            'message' => 'enter data'
        ]);


        }
        
    }


    public function destroy($documentNumber){

        if ($documentNumber) {           
        $employee =Employee::where('documentNumber',(string)$documentNumber)
        ->update(['status' => false]);
                    
                
        if (!$employee) {
            return response()->json([
                'data' => $employee,
                'message' => 'the employee does not exist'
               
            ], 404);
           
        }else {          
            
            return response()->json([
                'data' => $employee,
                'message' => 'successfully updated'
               
            ]);
                        
        }
        }else {

        return response()->json([            
            'message' => 'enter data'
        ]);


    }
                      
    }

}