<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PermissionController extends Controller
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
        $permissions = Permission::withTrashed()->get();

        return response()->json($permissions, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $name
     * @return JsonResponse
     */
    public function destroy($name)
    {
        $permission = Permission::where('name', $name)->first();

        if (!$permission) {
            return response()->json([
                'message' => 'the resource does not exist'
            ], 404);
        }

        $permission->delete();
        return response()->json([
            'message' => 'resource removed'
        ], 201);
    }
}
