<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\RegisterResource;

class RegisterController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api')
        // ->except(['store']);

    }

    public function index()
    {
        $users = User::all();
        // return response()->json($users);
        return RegisterResource::collection($users);
    }

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found!'], 404);
        }
        // return response()->json($user, 200);
        return RegisterResource::make($user);
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return response()->json($user, 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found!'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'User deleted!'], 200);
    }

}
