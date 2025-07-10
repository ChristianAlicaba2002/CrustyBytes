<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            // Redirect back with errors
            return redirect()->route('login.view')->with('error', $validator->errors());
        }

        $admin = Admin::where('name', $request->name)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return redirect()->route('login.view')->with('error', 'Invalid credentials');
        }

        if (Auth::guard('admin')->attempt($request->only('name', 'password'))) {
            // Authentication passed
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.view')->with('success', 'Logged out successfully');
    }
}
