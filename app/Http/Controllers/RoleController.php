<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $roles = Role::withTrashed()->get();

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
            'name' => 'required|unique:roles',
            // 'permissions.*.slug' => 'exists:permissions,slug',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
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
     * @param $name
     * @return JsonResponse
     */
    public function show($name)
    {
        $role = Role::where('name', $name)->first();

        return response()->json($role, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $name
     * @return JsonResponse
     */
    public function update(Request $request, $name)
    {
        $role = Role::where('name', $name)->first();
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
     * @param $name
     * @return JsonResponse
     */
    public function destroy($name)
    {
        $role = Role::where('name', $name)->first();

        if (!$role) {
            return response()->json([
                'message' => 'the resource does not exist'
            ], 404);
        }

        $role->delete();
        return response()->json([
            'message' => 'resource removed'
        ], 201);
    }
}
