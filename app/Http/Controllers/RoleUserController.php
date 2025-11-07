<?php

namespace App\Http\Controllers;

use App\Models\RoleUser;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function index()
    {
        $roleUsers = RoleUser::with(['user', 'role'])->get();
        return response()->json($roleUsers, 200);
    }

    public function show($id)
    {
        $roleUser = RoleUser::with(['user', 'role'])->find($id);

        if (!$roleUser) {
            return response()->json(['message' => 'RoleUser not found'], 404);
        }

        return response()->json($roleUser, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'users_iduser' => 'required|exists:users,iduser',
            'roles_idrole' => 'required|exists:roles,idrole',
        ]);

        $roleUser = RoleUser::create($validated);

        return response()->json($roleUser, 201);
    }

    public function update(Request $request, $id)
    {
        $roleUser = RoleUser::find($id);

        if (!$roleUser) {
            return response()->json(['message' => 'RoleUser not found'], 404);
        }

        $validated = $request->validate([
            'users_iduser' => 'sometimes|exists:users,iduser',
            'roles_idrole' => 'sometimes|exists:roles,idrole',
        ]);

        $roleUser->update($validated);

        return response()->json($roleUser, 200);
    }

    public function destroy($id)
    {
        $roleUser = RoleUser::find($id);

        if (!$roleUser) {
            return response()->json(['message' => 'RoleUser not found'], 404);
        }

        $roleUser->delete();

        return response()->json(['message' => 'RoleUser deleted successfully'], 200);
    }
}
