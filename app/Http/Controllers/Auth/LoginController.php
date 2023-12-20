<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $request->email)->firstOrFail();
        if(Hash::check($request->password, $user->password)) {
            return response()->json($user, 200);
        } else {
            return response()->json(['message' => 'Password is incorrect!'], 401);
        }
    }

}
