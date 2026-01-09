@extends('superadmin.layouts.app')

@section('content')
    <form method="POST" action="{{ route('superadmin.branches.update', $branch->id) }}">
        @csrf
        @method('PUT')

        <div class="card shadow-sm border-0">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="row g-3">

                    <!-- Branch Name -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Branch Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="branch_name"
                            class="form-control @error('branch_name') is-invalid @enderror"
                            value="{{ old('branch_name', $branch->branch_name) }}">

                        @error('branch_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Branch Code -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">
                            Branch Code <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="branch_code"
                            class="form-control @error('branch_code') is-invalid @enderror"
                            value="{{ old('branch_code', $branch->branch_code) }}">
                    </div>

                    <!-- Phone -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Phone</label>
                        <input type="text" name="branch_phone" class="form-control"
                            value="{{ old('branch_phone', $branch->branch_phone) }}">
                    </div>

                    <!-- Email -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="branch_email" class="form-control"
                            value="{{ old('branch_email', $branch->branch_email) }}">
                    </div>

                    <!-- Address -->
                    <div class="col-12">
                        <label class="form-label fw-semibold">Address</label>
                        <textarea name="branch_address" class="form-control" rows="3">{{ old('branch_address', $branch->branch_address) }}</textarea>
                    </div>

                    <!-- Opening Time -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Opening Time</label>
                        <input type="time" name="opening_time" class="form-control"
                            value="{{ old('opening_time', $branch->opening_time) }}">
                    </div>

                    <!-- Closing Time -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Closing Time</label>
                        <input type="time" name="closing_time" class="form-control"
                            value="{{ old('closing_time', $branch->closing_time) }}">
                    </div>

                    <!-- Capacity -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Capacity</label>
                        <input type="number" name="capacity" class="form-control"
                            value="{{ old('capacity', $branch->capacity) }}">
                    </div>

                    <!-- Status -->
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select">
                            <option value="1" {{ $branch->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $branch->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Admin ID</label>
                        <select name="admin_id" required>
                            @foreach ($admins as $admin)
                                <option value="{{ $admin->id }}"
                                    {{ $branch->admin_id == $admin->id ? 'selected' : '' }}>
                                    {{ $admin->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Update Branch
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection
