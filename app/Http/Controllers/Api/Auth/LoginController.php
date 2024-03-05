<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function store(Request $request)  {
        Log::info('LoginController@store');
        $validated = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validated->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->Active()->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
            ], 401);
        }

        $user->tokens()->delete();
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'success' => true,
            "data" => $user->load('store'),
        ]);
    }
}
