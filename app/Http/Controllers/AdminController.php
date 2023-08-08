<?php

namespace App\Http\Controllers;

use App\Models\Ground;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

//class AdminController extends Controller
//{
//public function index()
//{
//$grounds = Ground::all();
//return response()->json($grounds);
//}
//
//public function store(Request $request)
//{
//$ground = Ground::create($request->all());
//return response()->json($ground, 201);
//}
//
//public function show($id)
//{
//$ground = Ground::find($id);
//if (!$ground) {
//return response()->json(['message' => 'Ground not found'], 404);
//}
//return response()->json($ground);
//}
//
//public function update(Request $request, $id)
//{
//$ground = Ground::find($id);
//if (!$ground) {
//return response()->json(['message' => 'Ground not found'], 404);
//}
//$ground->update($request->all());
//return response()->json($ground, 200);
//}
//
//public function destroy($id)
//{
//$ground = Ground::find($id);
//if (!$ground) {
//return response()->json(['message' => 'Ground not found'], 404);
//}
//$ground->delete();
//return response()->json(null, 204);
//}
//
//// Add other methods for handling Admin-specific API requests here
//}


class AdminController extends Controller
{
    // Get all Grounds
    public function index()
    {
//        $grounds =Ground::with('admin:id,username,email')->get();
//        $grounds = DB::table('grounds')->join('users','grounds.admin_id','=','users.id')->select('grounds.groundName','grounds.location','users.username')->get();
        $grounds = DB::table('grounds as g')->join('users as u','g.admin_id','=','u.id')
            ->select('u.groundName','g.location','u.username')
            ->get();
//        $grounds = Ground::all();
        return response()->json($grounds);
    }

    // Create a new Ground
    public function store(Request $request)
    {
        $request->validate([
            'groundName' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            // Add other validation rules as needed
        ]);

        $adminId = Auth::id();
        $ground = Ground::create(
            [
                'admin_id' => $adminId,
                'groundName' => $request->input('groundName'),
                'location' => $request->input('location'),
                'description' => $request->input('description'),
            ]
        );
        return response()->json($ground, 201);
    }

    // Get a single Ground by ID
    public function show($id)
    {
        $ground = Ground::find($id);
        if (!$ground) {
            return response()->json(['message' => 'Ground not found'], 404);
        }
        return response()->json($ground);
    }

    // Update a Ground by ID
    public function update(Request $request, $id)
    {
        $ground = Ground::find($id);
        if (!$ground) {
            return response()->json(['message' => 'Ground not found'], 404);
        }

        $request->validate([
            'groundName' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            // Add other validation rules as needed
        ]);

        $ground->update($request->all());
        return response()->json($ground, 200);
    }

    // Delete a Ground by ID
    public function destroy($id)
    {
        $ground = Ground::find($id);
        if (!$ground) {
            return response()->json(['message' => 'Ground not found'], 404);
        }

        $ground->delete();
        return response()->json(null, 204);
    }
}
