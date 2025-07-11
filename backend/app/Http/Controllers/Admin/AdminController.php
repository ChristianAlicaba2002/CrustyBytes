<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
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
            return redirect()->route('login')->with('error', $validator->errors());
        }

        $admin = $request->only('name', 'password');

        if (Auth::guard('admin')->attempt($admin, $request->boolean('remember'))) {
            // Authentication passed
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('login')->with('error', 'Invalid credentials');

    }

    public function logout(Request $request)
    {
        Session::flush();
        Auth::guard('admin')->logout();

        return redirect()->route('login')->with('success', 'Logged out successfully');
    }
}
