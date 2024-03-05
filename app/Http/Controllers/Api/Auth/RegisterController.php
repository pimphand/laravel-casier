<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'store_name' => 'required|string|unique:stores,name',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|unique:users,phone|min:10|max:13',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validate->errors(),
            ], 422);
        }

        return DB::transaction(function () use ($request) {
            $store = Store::create([
                'name' => $request->store_name,
                'phone' => $request->phone,
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => Str::slug($request->name."-".$store->id), // 'username' => $request->username
                'password' => bcrypt($request->password),
                'store_id' => $store->id,
            ]);

            $user->userStore()->create([
                'store_id' => $store->id,
            ]);

            Auth::loginUsingId($user->id);
            return response()->json([
                'status' => 'success',
                'message' => 'User has been created',
                'token' => $user->createToken('token-name')->plainTextToken,
            ], 201);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
