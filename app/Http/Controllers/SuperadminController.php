<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    public function showLoginForm()
    {
        return view('superadmin.login');
    }

    public function superAdminLogin(Request $request)
    {
        $request->validate([
            'mobile_no' => 'required|digits:10',
            'password'  => 'required|string',
        ]);

        // Hardcoded credentials
        $hardcodedMobile   = '9876543210';
        $hardcodedPassword = '12345';

        if (
            $request->mobile_no === $hardcodedMobile &&
            $request->password === $hardcodedPassword
        ) {
            // Store session to mark superadmin as logged in
            session(['superadmin_logged_in' => true]);

            return redirect()->route('superadmin.dashboard');
        }

        return back()->withErrors([
            'mobile_no' => 'Invalid mobile number or password.',
        ])->withInput();
    }

    public function superAdminDashboard()
    {
        // Check if superadmin is logged in
        if (!session('superadmin_logged_in')) {
            return redirect()->route('superadmin')->withErrors([
                'mobile_no' => 'Please login to access the dashboard.',
            ]);
        }

        return view('superadmin.dashboard');
    }

    public function superAdminLogout()
    {
        // Clear the superadmin session
        session()->forget('superadmin_logged_in');

        return redirect()->route('superadmin')->with('status', 'Logged out successfully.');
    }


    public function superAdmin_create_admin()
    {
        // Check if superadmin is logged in
        if (!session('superadmin_logged_in')) {
            return redirect()->route('superadmin')->withErrors([
                'mobile_no' => 'Please login to access this page.',
            ]);
        }

        return view('superadmin.create_admin');
    }

    public function superAdmin_create_admin_data_save(Request $request)
    {
        // Check if superadmin is logged in
        if (!session('superadmin_logged_in')) {
            return redirect()->route('superadmin')->withErrors([
                'mobile_no' => 'Please login to access this page.',
            ]);
        }

        // Validate the incoming request data
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:admins,email',
            'mobile_no'  => 'required|digits:10|unique:admins,mobile_no',
            'password'   => 'required|string|min:6|confirmed',
        ]);

        // Save the new admin data to the database
        // Admin::create([
        //     'name'      => $request->name,
        //     'email'     => $request->email,
        //     'mobile_no' => $request->mobile_no,
        //     'password'  => Hash::make($request->password),
        // ]);

        return redirect()->route('superadmin.create_admin')->with('status', 'New admin created successfully.');
    }

    public function superAdmin_manage_admin()
    {
        // Check if superadmin is logged in
        if (!session('superadmin_logged_in')) {
            return redirect()->route('superadmin')->withErrors([
                'mobile_no' => 'Please login to access this page.',
            ]);
        }

        // Retrieve all admins from the database
        // $admins = Admin::all();

        return view('superadmin.manage_admin'/*, compact('admins')*/);
    }
}
