<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Employee;
use App\Settlement;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ContractController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:contracts');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $contracts = Contract::withTrashed()->get();

        return response()->json([
            'contracts' => $contracts,
            'message' => 'resources'
        ], 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $employee = Employee::where('document_Number', $request->document_number)->first();

        if (!$employee) {
            return response()->json([
                'message' => 'employee not found'
            ], 201);
        }

        //create new settlement
        $settlement = Settlement::create(['base_salary' => $request->salary]);
        //assign new settlement to the request
        $request['current_settlement'] = $settlement->id;
        $request['settlements'] = [$settlement->id];

        //create new contract
        $contract = Contract::create($request->all());

        //assign new contract to the employee
        $employee->current_contract = $contract->id;
        $employee->push('contracts', $contract->id);

        return response()->json([
            'contract' => $contract,
            'message' => 'resource created'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Contract $contract
     * @return JsonResponse
     */
    public function show(Contract $contract)
    {
        return response()->json([
            'contracts' => $contract,
            'message' => 'resources'
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        //
    }
}
