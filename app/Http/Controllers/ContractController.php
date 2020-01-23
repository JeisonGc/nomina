<?php

namespace App\Http\Controllers;

use App\Contract;
use App\Employee;
use App\Settlement;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Resources\SettlementCollection;

class ContractController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
        $this->middleware('role:contracts');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $settlement = $this->createNewSettlement($request);

        $request['current_settlement'] = $settlement->id;
        $request['settlements'] = [$settlement->id];

        $contract = Contract::create($request->all());

        $employee = $this->assignContract($contract, $request->document_number);

        return response()->json([
            'contract' => $employee,
            'message' => 'resource updated'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param \App\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Contract $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        //
    }

    /**
     * Return a newly created settlement in storage.
     *
     * @return Settlement
     */
    public function createNewSettlement($data)
    {
        $settlement = new Settlement();
        $valuesInitialSettlement = SettlementCollection::getInitial($settlement);

        $valuesInitialSettlement->save();

        return $valuesInitialSettlement;
    }

    public function assignContract($contract, $employeeId)
    {
        $employee = Employee::find($employeeId);

        if (!$employee) {
            return response()->json([
                'message' => 'resource not found'
            ], 404);
        }

        $employee->current_contract = $contract->id;
        $employee->push('contracts', $contract->id);

        return $employee;
    }
}
