<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function createUser(Request $request)
    {
        $data = Validator::make($request->all(), [
            'uId' => 'required|string',
            'name' => 'required|string|min:5|max:255',
            'email' => 'required|string|min:5|max:255|email|unique:users,email',
            'password' => 'nullable|string|min:8',
        ]);

        if ($data->fails()) {
            return response()->json([
                'status' => false,
                'message' => $data->errors()
            ], 401);
        }

        $user = User::create([
            "uId" => $request->uId,
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password || null
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], 201);
    }
}
