<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class SuperAdminController extends Controller
{
    // Get all admins (SuperAdmins and regular Admins)
    public function indexAdmins()
    {
        $admins = User::where('role', 'Admin')->get();
        return response()->json($admins);
    }

    // Create a new admin (SuperAdmin or regular Admin)
    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:SuperAdmin,Admin',
        ]);

        $admin = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role'),
        ]);

        return response()->json($admin, 201);
    }

    // Get a specific admin by ID (SuperAdmin or regular Admin)
    public function showAdmin($id)
    {
        $admin = User::where('role', 'Admin')->find($id);
        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

        return response()->json($admin);
    }

    // Update an admin by ID (SuperAdmin or regular Admin)
    public function update( $id,Request $request)
    {
        $admin = User::where('role', 'Admin')->find($id);
//        return  $admin;
        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

//        $request->validate([
//            'name' => 'required|string|max:255',
//            'email' => 'required|email|unique:users,email,' . $id,
//            'role' => 'required|in:SuperAdmin,Admin',
//        ]);
//        return $admin;

        $admin->update([
            'username' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
        ]);

        return response()->json($admin, 200);
    }

    // Delete an admin by ID (SuperAdmin or regular Admin)
    public function destroyAdmin($id)
    {
        $admin = User::where('role', 'Admin')->find($id);
        if (!$admin) {
            return response()->json(['message' => 'Admin not found'], 404);
        }

        $admin->delete();

        return response()->json(null, 204);
    }
}

