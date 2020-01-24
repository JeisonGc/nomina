<?php

namespace App\Http\Controllers;

use App\ConfigurationClient;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;
use DB;

class ConfigurationClientController extends BaseController
{   
    public function __construct()
    {
       // $this->middleware('jwt', ['except' => ['login']]);
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function client(Request $request)
    {   
        
       $token= $request->jwt;
        return response()->json($token, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bd=Auth::user()->clientBD();
       // $client = ConfigurationClient::find($token);

        return response()->json(array(
            'bd'=>$bd
        ), 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input = $request->all();  
        if ($input) {
            $client = ConfigurationClient::create($input); 
        if($client){
        return response()->json([
            'data' => $client,
            'connection active'=> $cli->getConnection()->getName(),
            'message' => 'client created succesfuly'
        ], 201);
        }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function show(configuration $configuration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function edit(configuration $configuration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, configuration $configuration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\configuration  $configuration
     * @return \Illuminate\Http\Response
     */
    public function destroy(configuration $configuration)
    {
        //
    }
}
