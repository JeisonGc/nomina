<?php

namespace App\Http\Controllers;

use App\Loan;
use App\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Validator;


class LoanController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
    }

    public function index(Request $request)
    {
        //Trae todo los loans sin importar el empleado
        $loans = Loan::withTrashed()->get();
        if($loans) {
            return response()->json([
                'data' => $loans,
                'message' => 'successful listing'
            ], 200);
        }     
    }

    //Obtener todos los prestamos de un solo empleado, para esto se recibe el Id del empleado
    public function getLoansPerEmployee($id_employee){     
        
        if ($id_employee) {
            $employee = Employee::find($id_employee);
            $loans = $employee->loans;

            return response()->json([
                $loans
            ], 200) ;   
        }
    }

    public function store(Request $request)
    {
        $input = $request->except('employee');
        $id_employee = $request->employee;

        $validator = Validator::make($input, [            
            'number_fees' => 'required|numeric|min:0',
            'total_mount' => 'numeric|min:0',
            'free_amount' => 'numeric|min:0',
            'balance' => 'numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'payments' => 'array'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($input && $id_employee){
            $employee = Employee::find($id_employee);
            if($employee){

                $loan = Loan::create($input);
                DB::collection('employees')->where('_id', $id_employee)->push('loans', $loan->id);
                $employee->loans()->save($loan);
                $employee->save();

                return response()->json([
                    'data' => $loan,
                    'message' => 'resource created'
                ], 201) ; 
            }
        }
       

    }

    public function show($id)
    {
        if ($id) {
            $loan = Loan::find($id);

            if($loan){
                return response()->json([
                    'data' => $loan              
                ], 200); 
            }
        }

    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validator = Validator::make($input, [            
            'number_fees' => 'required|numeric|min:0',
            'total_mount' => 'numeric|min:0',
            'free_amount' => 'numeric|min:0',
            'balance' => 'numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'payments' => 'array'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($input) {         
            $loan = Loan::find($id);
            $loan->fill($input);
            $loan->save();

            if ($loan) {                      
                return response()->json([
                    'data' => $loan,
                    'message' => 'sucecessfully updated'
                ]);             
            }  
        }  
    }

    public function destroy($id)
    {
        if ($id) {           
            $loan =Loan::find($id);
            $loan->delete();       
                                        
            if ($loan) {  
               
                return response()->json([
                    'data' => $loan,
                    'message' => 'successfully eliminated'               
                ]);
                            
            }
            }
    }
}
