<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EmployeesController extends Controller
{
    public function store(Request  $request){  
        $validator = Validator::make($request->all(), [
            'first_Name'         => 'required|unique:employees',
            'email'              => 'required|unique:employees',
            'document_number'    => 'required|unique:employees'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }    

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
            $employee =Employee::where('document_number',(string)$documentNumber)->get(); 
            
            if ($employee) {                      
                return response()->json([
                    'data' => $employee,
                    'message' => 'employee exists'
                    
                ]);             
            }  
        } 
    }

    public function update($documentNumber,Request  $request){
        $validator = Validator::make($request->all(), [
            'first_Name'        => [Rule::unique('employees')->ignore($documentNumber, 'document_number')],
            'email'             => [Rule::unique('employees')->ignore($documentNumber, 'document_number')],
            'document_number'   => [Rule::unique('employees')->ignore($documentNumber, 'document_number')]
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $input = $request->all();

        if ($input) {         
            $employee =Employee::where('document_number',(string)$documentNumber)->first(); 
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
            $employee =Employee::where('document_number',(string)$documentNumber)->first();
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