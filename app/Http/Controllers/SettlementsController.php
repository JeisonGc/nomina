<?php

namespace App\Http\Controllers;

use App\Settlement;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class SettlementsController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settlement = Settlement::withTrashed()->get();
        if ($settlement) {           
            return response()->json([
                'data' => $settlement,
                'message' => 'successful listing'
            ], 201);
        }
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datos = $request->all();                
       
        $settlement = Settlement::create($request->all());
        

        return response()->json([
            'data' => $settlement,
            'message' => 'resource created'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Settlement  $settlement
     * @return \Illuminate\Http\Response
     */
    public function show($settlement_id)
    {        
        if ($settlement_id) {         
            $settlement = Settlement::find($settlement_id);           
            if ($settlement) {                      
                return response()->json([
                    'data' => $settlement,
                    'message' => 'settlement exists'                    
                ]);             
            }  
        } 
    }

    public function update($settlement_id,Request $request)
    {
        $input = $request->all();
        if ($input) {         
            $settlement = Settlement::find($settlement_id);           
            $settlement->fill($request->all());
            $settlement->save();

            if ($settlement) {                      
                return response()->json([
                    'data' => $settlement,
                    'message' => 'settlement successfully updated'
                    
                ]);             
            }  
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Settlement  $settlement
     * @return \Illuminate\Http\Response
     */
    public function destroy($settlement_id)
    {
        if ($settlement_id) {           
            $settlement = Settlement::find($settlement_id);           
            $settlement->delete();       
                                        
            if ($settlement) {            
                return response()->json([
                    'data' => $settlement,
                    'message' => 'settlement successfully eliminated'               
                ]);
                            
            }
        }
    }
}
