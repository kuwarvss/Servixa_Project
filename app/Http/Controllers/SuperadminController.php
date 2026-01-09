<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Branch;
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
            'branches' => Branch::latest()->get(),
        ]);
    }

    


    public function superAdmin_create_admin()
    {
        
        
        return view('superadmin.dashboard');
    }

    public function superAdmin_create_admin_data_save(Request $request)
    {
        //dd($request->all());
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'mobile_no' => 'required|digits:10|unique:admins,mobile_no',
            //'password' => 'required|string|min:6|confirmed',
            'status' => 'required|boolean',
            'admin_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'id_type' => 'nullable|string|max:100',
            'id_number' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:500',
        ]);

        // Generate a random password
        $plainPassword = Str::random(10);

        // Image Upload
        $imagePath = null;
        if ($request->hasFile('admin_image')) {
            $imagePath = $request->file('admin_image')
                ->store('admins', 'public');
        }
        // Save Admin
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'password' => Hash::make($plainPassword),
            'status' => $request->status,
            'admin_image' => $imagePath,
            'id_type' => $request->id_type,
            'id_number' => $request->id_number,
            'address' => $request->address,
            'force_password_change' => 1,
        ]);

        //Temporary: log password 
        \Log::info('Admin Created: ', ['email' => $admin->email, 'password' => $plainPassword]);

        return redirect()
            ->route('superadmin.dashboard')
            ->with('status', 'New admin created successfully.');
    }

    public function superAdmin_manage_admin()
    {
        $admins = Admin::latest()->get();

        return view('superadmin.manage_admin', compact('admins'));
    }

    public function superAdmin_edit_admin($id)
    {
        $admin = Admin::findOrFail($id);

        return view('superadmin.edit_admin', compact('admin'));
    }

    public function superAdmin_update_admin(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'mobile_no' => 'required|digits:10|unique:admins,mobile_no,' . $admin->id,
            'status' => 'required|boolean',
            'admin_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'id_type' => 'nullable|string|max:100',
            'id_number' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:500',
        ]);

        // Image Upload
        if ($request->hasFile('admin_image')) {
            $imagePath = $request->file('admin_image')
                ->store('admins', 'public');
            $admin->admin_image = $imagePath;
        }

        // Update Admin
        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
            'status' => $request->status,
            'id_type' => $request->id_type,
            'id_number' => $request->id_number,
            'address' => $request->address,
        ]);

        return redirect()
            ->route('superadmin.admin.manage')
            ->with('status', 'Admin updated successfully.');
    }

    public function superAdmin_delete_admin($id)
    {
        $admin = Admin::findOrFail($id);
        $admin->delete();

        return redirect()
            ->route('superadmin.dashboard')
            ->with('status', 'Admin deleted successfully.');
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
