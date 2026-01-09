<nav class="admin-navbar">

    <!-- LEFT : LOGO -->
    <div class="nav-left">
        <img src="{{ asset('images/logo.png') }}" class="admin-logo" alt="Logo">
    </div>

    <!-- CENTER : EMPTY (future use / spacing balance) -->
    <div class="nav-center">
        <h1 class="admin-name">{{ auth()->user()->name }}</h1>


    </div>

    <!-- RIGHT : ADMIN NAME + ICONS -->
    <div class="nav-right">

        <!-- ACTIVE BRANCH DROPDOWN -->
        <div class="branch-dropdown-wrapper">

            <span class="branch-label">Active Branch</span>

            <div class="branch-box-dark" id="branchToggle">
                <span id="selectedBranch">Robot Square Branch</span>
                <i class="fa-solid fa-chevron-down"></i>
            </div>

            <!-- DROPDOWN LIST -->
            <div class="branch-dropdown-menu" id="branchMenu">
                <div class="branch-option active">Robot Square</div>
                <div class="branch-option">Delhi</div>
                <div class="branch-option">Mumbai</div>
                <div class="branch-option">Pune</div>
                <div class="branch-option">Bangalore</div>
            </div>

        </div>

        <!-- Theme Toggle -->
        <i class="fa-solid fa-moon theme-icon" id="themeToggle"></i>

        <!-- Profile Dropdown -->
        <div class="dropdown">
            <button class="dropbtn">
                <i class="fa-solid fa-user"></i>
            </button>

            <div class="dropdown-content">
                <a href="{{ route('admin.change.password') }}">Change Password</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">Logout</button>
                </form>
            </div>
        </div>
    </div>

</nav>

<!-- MENU TABS -->
<div class="menu-tabs">

    <!-- Dashboard -->
    <a href="{{ route('admin.dashboard') }}" class="menu-tab active">
        <i class="fa-solid fa-gauge"></i> Dashboard
    </a>

    <!-- Users -->
    <div class="menu-dropdown">
        <a href="#" class="menu-tab">
            <i class="fa-solid fa-users"></i> Users
            <i class="fa-solid fa-chevron-down"></i>
        </a>

        <div class="menu-dropdown-content">
            <a href="#">Active Users</a>
            <a href="#">Inactive Users</a>
            <a href="#">Enquiries</a>
        </div>
    </div>

    <!-- Accounting -->
    <div class="menu-dropdown">
        <a href="#" class="menu-tab">
            <i class="fa-solid fa-file-invoice-dollar"></i> Accounting
            <i class="fa-solid fa-chevron-down"></i>
        </a>

        <div class="menu-dropdown-content">
            <a href="#">Invoices</a>
            <a href="#">Payments</a>
        </div>
    </div>

    <!-- Staff -->
    <div class="menu-dropdown">
        <a href="#" class="menu-tab">
            <i class="fa-solid fa-user-tie"></i> Staff
            <i class="fa-solid fa-chevron-down"></i>
        </a>

        <div class="menu-dropdown-content">
            <a href="#">Staff List</a>
            <a href="#">Roles</a>
        </div>
    </div>
     <!-- Branches -->
    <div class="menu-dropdown">
        <a href="#" class="menu-tab">
            <i class="fa-solid fa-code-branch"></i> Branches
            <i class="fa-solid fa-chevron-down"></i>
        </a>

        <div class="menu-dropdown-content">
            <a href="{{ route('admin.branches.index') }}">Branch List</a>
            <a href="{{ route('admin.branches.index') }} #add-branch">Add Branch</a>
            <a href="{{ route('admin.branches.manage') }}">Manage Branches</a>
        </div>
    </div>

    <!-- Logs -->
    <a href="#" class="menu-tab">
        <i class="fa-solid fa-clipboard-list"></i> Logs
    </a>

</div>
