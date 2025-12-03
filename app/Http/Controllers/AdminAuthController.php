<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAuthController extends Controller
{
    
     public function login(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        // Check if password matches the key-password
        if ($request->password === config('app.admin_key_password')) {
            // Create a temporary admin session or use a system admin account
            $adminUser = User::where('type', 'admin')->first();
            
            if (!$adminUser) {
                // Create a temporary admin user if none exists
                $adminUser = User::create([
                    'name' => 'Temporary Admin',
                    'email' => 'temp_admin_' . time() . '@system.local',
                    'password' => Hash::make(uniqid()),
                    'user_type' => 'admin',
                ]);
            }
            
            Auth::login($adminUser);
            
            return redirect()->route('admin.register');
        }

        return back()->withErrors(['password' => 'Invalid admin key password']);
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the new admin user
        $newAdmin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type' => 'admin',
        ]);

        // Logout from the temporary session
        Auth::logout();
        
        // Login with the new admin account
        Auth::login($newAdmin);

        $request->session()->regenerate();

        return redirect('/dashboard'); // or wherever you want to redirect
    }
}

