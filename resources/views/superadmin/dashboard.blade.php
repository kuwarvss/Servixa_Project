<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Super Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/superAdmin-dashboard.css') }}" rel="stylesheet">
</head>

<body>

    <!-- ================= TOP NAVBAR ================= -->
    <div class="topbar-gradient">
        <div class="container-fluid h-100">
            <div class="d-flex align-items-center justify-content-between h-100">

                <!-- LEFT : LOGO -->
                <div class="d-flex align-items-center gap-2">
                    <div class="logo-circle">
                        <!-- IMPORTANT: ICON LOGO ONLY -->
                        <img src="{{ asset('images/logo.png') }}" alt="Logo">
                    </div>
                    <span class="logo-text">Servixa</span>
                </div>

                <!-- CENTER : PAGE TITLE (optional) -->
                <div class="d-none d-md-block">
                    <span class="text-white-50 small">Super Admin</span>
                </div>

                <!-- RIGHT : ICONS -->
                <div class="d-flex align-items-center gap-2">
                    <button class="icon-circle" data-bs-toggle="tooltip" title="Toggle Theme">
                        <i class="fa-solid fa-moon"></i>
                    </button>
                    <form id="superadminLogoutForm" action="{{ route('superadmin.logout') }}" method="POST"
                        class="d-none">
                        @csrf
                    </form>

                    <button type="button" class="icon-circle logout" data-bs-toggle="tooltip" title="Logout"
                        onclick="document.getElementById('superadminLogoutForm').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>

                </div>

            </div>
        </div>
    </div>

    <!-- ================= MAIN CONTENT ================= -->
    <div class="container-fluid mt-4">

        <!-- TABS -->
        <ul class="nav nav-pills modern-tabs mb-4">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#analytics">
                    <i class="fa-solid fa-chart-line me-1"></i> Analytics
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#create-admin">
                    <i class="fa-solid fa-user-plus me-1"></i> Create Admin
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#manage-admins">
                    <i class="fa-solid fa-users-gear me-1"></i> Manage Admins
                </button>
            </li>
        </ul>

        <div class="tab-content">

            <!-- ================= ANALYTICS ================= -->
            <div class="tab-pane fade show active" id="analytics">
                <div class="row g-4">

                    <div class="col-md-3 col-sm-6">
                        <div class="stat-card gradient-1">
                            <h6>Total Admins</h6>
                            <h2>{{ $totalAdmins }}</h2>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="stat-card gradient-2">
                            <h6>Active Sessions</h6>
                            <h2>{{ $activeAdmins }}</h2>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="stat-card gradient-3">
                            <h6>Inactive Admins</h6>
                            <h2>{{ $inactiveAdmins }}</h2>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="stat-card gradient-4">
                            <h6>System Health</h6>
                            @if ($systemHealth === 'Critical')
                                <h2 class="text-danger">Critical</h2>
                            @elseif($systemHealth === 'Warning')
                                <h2 class="text-warning">Warning</h2>
                            @else
                                <h2 class="text-success">Healthy</h2>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="glass-card mt-4 chart-box">
                    <h6 class="mb-3">Admin activity Overview</h6>
                    <div class="chart-wrapper">
                        <canvas id="adminChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- ================= CREATE ADMIN ================= -->
            <div class="tab-pane fade" id="create-admin">
                <div class="glass-card">
                    {{-- ✅ SUCCESS MESSAGE HERE --}}
                    @if (session('status'))
                        <div class="alert alert-success mb-3">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- ❌ ERROR MESSAGE --}}
                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Create New Admin</h5>

                        <!-- TOP RIGHT SAVE BUTTON -->
                        <button type="submit" form="createAdminForm" class="btn gradient-btn">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Save
                        </button>
                    </div>
                    <form id="createAdminForm" method="POST" action="{{ route('superadmin.admin.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input class="form-control modern-input" type="text" name="name"
                                    placeholder="Full Name" required>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control modern-input" type="email" name="email"
                                    placeholder="Email Address" required>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control modern-input" type="tel" name="mobile_no"
                                    maxlength="10" placeholder="Mobile Number">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control modern-input" type="password" name="password"
                                    placeholder="Password">
                            </div>
                            <div class="col-md-6">
                                <input class="form-control modern-input" type="password" name="password_confirmation"
                                    placeholder="Password Confirmation">
                            </div>
                            <div class="col-md-6">
                                <select class="form-select modern-input" name="status" required>
                                    <option selected disabled>Select Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select modern-input">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-select modern-input" name="id_type">
                                    <option value="">ID Proof</option>
                                    <option value="Adhar Card">Adhar Card</option>
                                    <option value="PAN Card">PAN Card</option>
                                    <option value="Voter Id">Voter Id</option>
                                    <option value="Driving License">Driving License</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="id_number" class="form-control modern-input"
                                    placeholder="ID Number">
                            </div>

                            <div class="col-md-6">
                                <input type="text" name="address" class="form-control modern-input"
                                    placeholder="Address">
                            </div>

                            {{-- <div class="col-md-6">
                                <select class="form-select modern-input">
                                    <option selected disabled>Select Role</option>
                                    <option>Super Admin</option>
                                    <option>Admin</option>
                                </select>
                            </div> --}}
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Profile Picture</label>

                                <input type="file" name="admin_image" class="form-control modern-input"
                                    accept="image/png, image/jpeg, image/jpg">

                                <small class="text-muted">
                                    JPG, PNG allowed (Max 2MB)
                                </small>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn gradient-btn">
                                    <i class="fa-solid fa-plus me-1"></i> Create Admin
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- ================= MANAGE ADMINS ================= -->
            <div class="tab-pane fade" id="manage-admins">
                <div class="glass-card">
                    <h5 class="mb-3">Manage Admins</h5>
                    <div class="table-responsive">
                        <table class="table modern-table align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Mobile Number</th>
                                    <th>Email</th>
                                    <th>ID Proof</th>
                                    {{-- <th>Role</th> --}}
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->id }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->mobile_no }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->id_type ?? '-' }}</td>
                                        <td class="text-end">
                                            <div class="dropdown d-inline-block">
                                                <!-- 3 DOT BUTTON -->
                                                <button class="action-btn more" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end action-dropdown">
                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="fa-solid fa-pen me-2"></i> Edit Admin Details
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item text-danger" href="#">
                                                            <i class="fa-solid fa-trash me-2"></i> Remove Admin
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>

                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="fa-solid fa-credit-card me-2"></i> Payment
                                                            Details
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="fa-solid fa-toggle-on me-2"></i> Admin Status
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a class="dropdown-item" href="#">
                                                            <i class="fa-solid fa-chart-line me-2"></i> Activity Logs
                                                        </a>
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
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
            .forEach(el => new bootstrap.Tooltip(el));


        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(e1 => e1.remove());
        }, 3000);
    </script>

</body>

</html>
