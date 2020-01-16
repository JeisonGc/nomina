<?php

namespace App\Http\Controllers;

use App\Employees;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class EmployeesController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function add(Request  $request)
    {      
       
        $employee = new Employees(); 
        $employee = Employees::create($request['data']);       
        return $employee;

        
        /* return response()->json([
            'employee' => $employee,
            'message' => 'employee created succesfuly'
        ], 201);
       */
        
    }



    public function getOne($document){

        $employee = Employees::where('document', '=',(int) $document)->get();

        if($employee){

            return response()->json([
                'employee' => $employee,
                'message' => 'employee exist'
            ], 201);

        }else{
            return response()->json([
                'employee' => $employee,
                'message' => 'employee does not exist'
            ], 404);
        }      

    }
    public function getAll(){

        $employee = new Employees(); 
        $employee = Employees::all();

        if (!$employee) {
            return response()->json([
                'employe' => $employee,
                'message' => 'no employees to show'
            ], 404);
        }else{
            return response()->json([
                'employe' => $employee,
                'message' => 'successful listing'
            ], 201);
        }      
          
    }


    public function update($document,Request  $request){ 
        
        $employee = new Employees(); 
        $employee =Employees::where('document',(int)$document)->update($request['data']); 
       

        if (!$employee) {
            return response()->json([
                'message' => 'the employee does not exist',
                'employe' => $employee
            ], 404);
           
        }else {          
            
            return response()->json([
                'message' => 'successfully updated',
                'employe' => $employee
            ]);            
            
        }      
        
    }


    public function destroy($document){
        
        $employee =Employees::where('document',(int)$document)->update(['status' => 2]);              
                
        if (!$employee) {
            return response()->json([
                'message' => 'the employee does not exist',
                'employe' => $employee
            ], 404);
           
        }else {          
            
            return response()->json([
                'message' => 'successfully updated',
                'employe' => $employee
            ]);
                        
        }
                      
    }

}