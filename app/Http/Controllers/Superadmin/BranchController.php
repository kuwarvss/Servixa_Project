<?php

namespace App\Http\Controllers\Superadmin;
use App\Models\Branch;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::orderBy('id', 'desc')->get();
        $admins = Admin::where('status', 1)->get();
        return view('superadmin.branches.index', compact('branches', 'admins'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'admin_id' => 'required|exists:admins,id',
            'branch_name' => 'required|string|max:255',
            'branch_code' => 'required|string|max:100|unique:branches,branch_code',
            'branch_phone' => 'nullable|string|max:20',
            'branch_email' => 'nullable|email|max:255',
            'branch_address' => 'nullable|string|max:500',
            'opening_time' => 'nullable|string|max:255',
            'closing_time' => 'nullable|string|max:255',
            'capacity' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        Branch::create([
            'admin_id' => $request->admin_id,
            'branch_name' => $request->branch_name,
            'branch_code' => $request->branch_code,
            'branch_phone' => $request->branch_phone,
            'branch_email' => $request->branch_email,
            'branch_address' => $request->branch_address,
            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
            'capacity' => $request->capacity,
            'status' => $request->status,
        ]);

        return redirect()->route('superadmin.branches.index')->with('success', 'Branch created and assigned successfully.');
    }

    public function edit($id)
    {
        $branch = Branch::findOrFail($id);
        $admins = Admin::where('status', 1)->get();
        return view('superadmin.branches.edit', compact('branch', 'admins'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $branch = Branch::findOrFail($id);

        $request->validate([
            'branch_name' => 'required|string|max:255',
            'branch_code' => 'required|string|max:100|unique:branches,branch_code,' . $branch->id,
            'branch_phone' => 'nullable|string|max:20',
            'branch_email' => 'nullable|email|max:255',
            'branch_address' => 'nullable|string|max:500',
            'status' => 'required|boolean',
            'admin_id' => 'required|exists:admins,id',
        ]);

        $branch->update([
            'branch_name' => $request->branch_name,
            'branch_code' => $request->branch_code,
            'branch_phone' => $request->branch_phone,
            'branch_email' => $request->branch_email,
            'branch_address' => $request->branch_address,
            'status' => $request->status,
            'admin_id' => $request->admin_id,
        ]);

        return redirect()
            ->route('superadmin.dashboard')
            ->with('success', 'Branch updated successfully.');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()
            ->route('superadmin.branches.index')
            ->with('success', 'Branch deleted successfully.');
    }

}
