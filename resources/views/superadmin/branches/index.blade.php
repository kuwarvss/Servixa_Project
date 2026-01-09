{{-- SUCCESS MESSAGE --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-3">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

{{-- ERROR MESSAGE --}}
@if ($errors->any())
    <div class="alert alert-danger mb-3">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="branch-page">

    <div class="d-flex justify-content-between align-item-center mb-3">
        <h4>Branch List</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBranchModal">+ Add Branch</button>
    </div>
</div>

<div class="card branch-card">
    <div class="card-body">
        <table class="table table-hover branch-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Branch Name</th>
                    <th>Branch Code</th>
                    <th>Address</th>
                    <th>Branch Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($branches as $branch)
                    <tr>
                        <td>{{ $branch->id }}</td>
                        <td>{{ $branch->branch_name }}</td>
                        <td>{{ $branch->branch_code }}</td>
                        <td>{{ $branch->branch_address }}</td>
                        <td>{{ $branch->branch_phone }}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('superadmin.branches.edit', $branch->id) }}">
                                            ✏️ Edit
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('superadmin.branches.delete', $branch->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger"
                                                onclick="return confirm('Delete this branch?')">
                                                🗑 Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{--  ADD BRANCH MODAL --}}
<div class="modal fade" id="addBranchModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('superadmin.branches.store') }}">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Branch</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row">

                    <div class="col-md-6 mb-3">
                        <label>Branch Name</label>
                        <input name="branch_name" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Branch Code</label>
                        <input name="branch_code" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Branch Contact</label>
                        <input name="branch_phone" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Address</label>
                        <input name="branch_address" class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select" required>
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Assign Admin</label>
                    <select name="admin_id" class="form-select modern-input" required>
                        <option value="">Select Admin</option>
                        @foreach ($admins as $admin)
                            <option value="{{ $admin->id }}">
                                {{ $admin->name }} ({{ $admin->email }})
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary">Save Branch</button>
                </div>
            </div>
        </form>
    </div>
</div>
