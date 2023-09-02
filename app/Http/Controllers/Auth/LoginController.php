<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Members;
class LoginController extends Controller
{   
    public function login(Request $request)
    {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $member = Auth::user();
        $token = $member->createToken('API Token')->accessToken;
        return response()->json(['token' => $token], 200);
    }

    return response()->json(['error' => 'Unauthorized'], 401);
}
}
