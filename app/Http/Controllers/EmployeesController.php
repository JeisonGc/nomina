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
    public function store(Request  $request){      
        $input = $request->all();

        if ($input){           
            $employee = Employee::create($input);        
            if($employee){
                return response()->json([
                    'data' => $employee,
                    'message' => 'employee created succesfuly'
                ], 201);
            }
        }
    }   

    public function index(){
        $employee = Employee::withTrashed()->get();

        if ($employee) {           
            return response()->json([
                'data' => $employee,
                'message' => 'successful listing'
            ], 201);
        }      
    }

    public function show($documentNumber){ 
        if ($documentNumber) {         
            $employee =Employee::where('document_Number',(string)$documentNumber)->get(); 
            
            if ($employee) {                      
                return response()->json([
                    'data' => $employee,
                    'message' => 'employee exists'
                    
                ]);             
            }  
        } 
    }

    public function update($documentNumber,Request  $request){ 
        $input = $request->all();

        if ($input) {         
            $employee =Employee::where('document_Number',(string)$documentNumber)->first(); 
            $employee->fill($request->all());
            $employee->save();

            if ($employee) {                      
                return response()->json([
                    'data' => $employee,
                    'message' => 'employee successfully updated'
                    
                ]);             
            }  
        }         
    }

    public function destroy($documentNumber){
        if ($documentNumber) {           
            $employee =Employee::where('document_Number',(string)$documentNumber)->first();
            $employee->delete(); 
                  
            if ($employee) {            
                return response()->json([
                    'data' => $employee,
                    'message' => 'successfully eliminated'               
                ]);
            }
        }
    }
}