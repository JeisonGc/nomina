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
    

    public function store(Request  $request)
    {      
      

        $input = $request->all();
        $employee = Employee::create($input);
        

        if($employee){
        return response()->json([
            $employee,
            'message' => 'employee created succesfuly'
        ], 201);
      
        }
        
    }



   /*  public function getOne($document){

        $employee = Employee::where('document', '=',(int) $document)->get();

        if($employee){

            return response()->json([
                 $employee,
                'message' => 'employee exist'
            ], 201);

        }else{
            return response()->json([
                $employee,
                'message' => 'employee does not exist'
            ], 404);
        }      

    } */



    public function show(){

        $employee = new Employee(); 
        $employee = Employee::all();

        if (!$employee) {
            return response()->json([
                $employee,
                'message' => 'no employees to show'
            ], 404);
        }else{
            return response()->json([
                $employee,
                'message' => 'successful listing'
            ], 201);
        }      
          
    }


    public function update($documentNumber,Request  $request){ 
        
        $employee = new Employee(); 
        $employee =Employee::where('documentNumber',(string)$documentNumber)
        ->update($request); 
       

        if (!$employee) {
            return response()->json([
                $employee,
                'message' => 'the employee does not exist'
               
            ], 404);
           
        }else {          
            
            return response()->json([
                $employee,
                'message' => 'successfully updated'
                
            ]);            
            
        }      
        
    }


    public function destroy($documentNumber){
        
        $employee =Employee::where('documentNumber',(string)$documentNumber)
        ->update(['status' => true]);
                    
                
        if (!$employee) {
            return response()->json([
                'message' => 'the employee does not exist',
                $employee
            ], 404);
           
        }else {          
            
            return response()->json([
                'message' => 'successfully updated',
                $employee
            ]);
                        
        }
                      
    }

}