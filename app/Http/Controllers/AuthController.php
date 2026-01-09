<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle the login request.
     */
    public function login(Request $request)
    {   
        $request->validate([
            'mobile_no' => 'required|digits_between:8,15',
            'password' => 'required|string|min:6',
        ]);

        if (
            Auth::guard('admin')->attempt([
                'mobile_no' => $request->mobile_no,
                'password' => $request->password,
            ])
        ) {
             

            $request->session()->regenerate();

            $admin = Auth::guard('admin')->user();
          
            if ($admin->status == 0) {
                Auth::guard('admin')->logout();
                return back()->withErrors(['mobile_no' => 'Account inactive']);
            }else{

            // if ($admin->force_password_change) {
            //     return redirect()->route('admin.change.');
            // }

                return redirect()->route('admin.dashboard');
            }
        }

        // return back()->withErrors([
        //     'mobile_no' => 'Invalid login credentials',
        // ]);
    }



    /**
     * Handle the logout request.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        return redirect('/');
    }

    public function adminDashboard()
    {
        return view('auth.dashboard');
    }

    // public function changepassworddata(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'current_password' => 'required|string',
    //         'new_password' => 'required|string|min:6|confirmed',
    //     ]);
    //     dd(Auth::guard('admin')->check(), Auth::guard('admin')->user());
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     $admin = Auth::guard('admin')->user();        
    //     if (!Hash::check($request->current_password, $admin->password)) {
    //         return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect'])->withInput();
    //     }

    //     $admin->password = Hash::make($request->new_password);
    //     // $admin->force_password_change = false; // Reset the flag
    //     $admin->save();

    //     return redirect()->back()->with('success', 'Password changed successfully');
    // }
    

    public function changepassworddata(Request $request)
    {   
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $admin = Auth::guard('admin')->user();
        if (!Hash::check($request->current_password, $admin->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $admin->password = Hash::make($request->new_password);
        $admin->force_password_change = 0;
        $admin->password_created_at = now();
        $admin->save();

        Auth::guard('admin')->login($admin);

        // Regenerate session
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard')->with('success', 'Password changed successfully');
        // return back()->with('success', 'Password changed successfully');
        // return redirect()->route('admin.dashboard');
    }
}