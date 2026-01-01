<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
class SuperadminController extends Controller
{

    //helper functions for superadmin
    private function checkSuperAdmin()
    {
        if (!session('superadmin_logged_in')) {
            return redirect()->route('superadmin')->withErrors([
                'mobile_no' => 'Please login first.',
            ]);
        }
        return null;
    }

    public function showLoginForm()
    {
        return view('superadmin.login');
    }

    public function superAdminLogin(Request $request)
    {
        $request->validate([
            'mobile_no' => 'required|digits:10',
            'password' => 'required|string',
        ]);

        // Hardcoded credentials
        $hardcodedMobile = '9876543210';
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
        if($redirect = $this->checkSuperAdmin()) {
            return $redirect;
        }

        // Dashboard data hare
        $totalAdmins = Admin::count();
        $activeAdmins = Admin::where('status', 1)->count();
        $inactiveAdmins = Admin::where('status', 0)->count();

        // System health and pending requests can be calculated as needed
        if($activeAdmins === 0) {
            $systemHealth = 'Critical';
        } elseif($inactiveAdmins > $activeAdmins) {
            $systemHealth = 'Warning';
        } else {
            $systemHealth = 'Healthy';
        }

        return view('superadmin.dashboard',[
            'totalAdmins' => Admin::count(),
            'activeAdmins' => Admin::where('status', 1)->count(),
            'inactiveAdmins' => Admin::where('status', 0)->count(),
            'systemHealth' => $systemHealth,
            'admins' => Admin::latest()->get(),
        ]);
    }

    


    public function superAdmin_create_admin()
    {
        // Check if superadmin is logged in
        if (!session('superadmin_logged_in')) {
            return redirect()->route('superadmin')->withErrors([
                'mobile_no' => 'Please login to access this page.',
            ]);
        }

        return view('superadmin.dashboard');
    }

    public function superAdmin_create_admin_data_save(Request $request)
    {
        //dd($request->all());
        // Superadmin check
        if (!session('superadmin_logged_in')) {
            return redirect()->route('superadmin')->withErrors([
                'mobile_no' => 'Please login to access this page.',
            ]);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'mobile_no' => 'required|digits:10|unique:admins,mobile_no',
            'password' => 'required|string|min:6|confirmed',
            'status' => 'required|boolean',
            'admin_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'id_type' => 'nullable|string|max:100',
            'id_number' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:500',
        ]);

        // Image Upload
        $imagePath = null;
        if ($request->hasFile('admin_image')) {
            $imagePath = $request->file('admin_image')
                ->store('admins', 'public');
        }

        // Save Admin
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'password' => Hash::make($request->password),
            'status' => $request->status,
            'admin_image' => $imagePath,
            'id_type' => $request->id_type,
            'id_number' => $request->id_number,
            'address' => $request->address,
        ]);

        return redirect()
            ->route('superadmin.create_admin')
            ->with('status', 'New admin created successfully.');
    }

    public function superAdmin_manage_admin()
    {
        // Check if superadmin is logged in
        if($redirect = $this->checkSuperAdmin()) {
            return $redirect;
        }

        $admins = Admin::latest()->get();

        return view('superadmin.manage_admin', compact('admins'));
    }

    public function superAdminLogout()
    {
        // Clear the superadmin session
        session()->forget('superadmin_logged_in');
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('superadmin.login')->with('status', 'Logged out successfully.');
    }
}
