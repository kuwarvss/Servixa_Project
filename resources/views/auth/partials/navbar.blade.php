<nav class="admin-navbar">

    <!-- LEFT -->
    <div class="nav-left">
        <i class="theme-icon" id="themeToggle">🌙</i>

        <div class="dropdown">
            <button class="dropbtn">
                {{ auth()->user()->name }} ⌄
            </button>
            <div class="dropdown-content">
                <a href="{{ route('admin.change.password') }}">
                    Change Password
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- CENTER -->
    <div class="nav-center">
        <h2>Admin Dashboard</h2>
    </div>

    <!-- RIGHT -->
    <div class="nav-right">
        <img src="{{ asset('admin/images/logo.png') }}" alt="Logo">
    </div>
</nav>

<!-- MENU BAR -->
<div class="menu-bar">

    <!-- Dashboard -->
    <div class="dropdown">
        <button class="dropbtn">Dashboard ⌄</button>
        <div class="dropdown-content">
            <a href="{{ route('admin.dashboard') }}">Overview</a>
        </div>
    </div>

    <!-- Users -->
    <div class="dropdown">
        <button class="dropbtn">Users ⌄</button>
        <div class="dropdown-content">
            <a href="{{ route('admin.users.active') }}">Active Users</a>
            <a href="{{ route('admin.users.inactive') }}">Inactive Users</a>
            <a href="{{ route('admin.users.enquiry') }}">Enquiry</a>
        </div>
    </div>

    <!-- Accounting -->
    <div class="dropdown">
        <button class="dropbtn">Accounting ⌄</button>
        <div class="dropdown-content">
            <a href="#">Coming Soon</a>
        </div>
    </div>

    <!-- Staff -->
    <div class="dropdown">
        <button class="dropbtn">Staff Management ⌄</button>
        <div class="dropdown-content">
            <a href="#">Staff List</a>
        </div>
    </div>

    <!-- Branches -->
    <div class="dropdown">
        <button class="dropbtn">Branches ⌄</button>
        <div class="dropdown-content">
            <a href="#">All Branches</a>
        </div>
    </div>

    <!-- Logs -->
    <div class="dropdown">
        <button class="dropbtn">Logs ⌄</button>
        <div class="dropdown-content">
            <a href="#">System Logs</a>
        </div>
    </div>

</div>
