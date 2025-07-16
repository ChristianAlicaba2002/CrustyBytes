<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function index() {}


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'uId' => 'required|string',
            'name' => 'required|string|min:5|max:255',
            'email' => 'required|string|min:5|max:255|email',
            'password' => 'nullable|string|min:8',
            'image' => 'nullable',
        ]);

        if ($data->fails()) {
            return response()->json([
                'status' => false,
                'message' => $data->errors()
            ]);
        }

        $user = User::create([
            "uId" => $request->uId,
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password || null,
            "image" => $request->image
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], 201);
    }


    public function show(string $id)
    {
        $user = User::where('uId', $id)->first();

        if ($user) {

            return response()->json([
                'status' => true,
                'data' => $user
            ]);
        }
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, $id)
    {

        $data = Validator::make($request->all(), [
            'phone_number' => 'nullable|string|min:1|max:11',
            'city' => 'nullable|string|max:100',
            'barangay' => 'nullable|string|max:100',
            'purok'  => 'nullable|string|max:100',
        ]);

        if ($data->fails()) {
            return response()->json([
                'status' => false,
                'message' => $data->errors(),
            ]);
        }

        $checkUser = User::where('uId', $id)->first();

        if ($checkUser) {

            $checkUser->phone_number = $request->phone_number;
            $checkUser->city = $request->city;
            $checkUser->barangay = $request->barangay;
            $checkUser->purok = $request->purok;
            $checkUser->save();

            return response()->json([
                'status' => true,
                'message' => 'User Update successfully',
                'data' => $checkUser
            ], 201);
        } else {

            return response()->json([
                'status' => false,
                'message' => "Account not found",
            ]);
        }
    }


    public function destroy(string $id)
    {
        //
    }
}
