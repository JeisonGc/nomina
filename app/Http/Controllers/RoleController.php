<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt', ['except' => ['login']]);
        $this->middleware('role:roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $roles = Role::all();

        return response()->json($roles, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $errors], 422);
        }

        $role = Role::create($request->all());

        return response()->json([
            'data' => $role,
            'message' => 'resource created'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Role $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->fill($request->all());
        $role->save();

        return response()->json([
            'data' => $role,
            'message' => 'resource updated'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();

        return response()->json([
            'message' => 'resource deleted'
        ], 201);
    }
}
