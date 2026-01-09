<div class="topbar-gradient">
    <div class="container-fluid h-100">
        <div class="d-flex align-items-center justify-content-between h-100">

            <!-- LEFT -->
            <div class="d-flex align-items-center gap-2">
                <div class="logo-circle">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </div>
                <span class="logo-text">Servixa</span>
            </div>

            <!-- CENTER -->
            <div class="d-none d-md-block">
                <span class="text-white-50 small">Super Admin</span>
            </div>

            <!-- RIGHT -->
            <div class="d-flex align-items-center gap-2">
                <button class="icon-circle" title="Toggle Theme">
                    <i class="fa-solid fa-moon"></i>
                </button>

                <form id="superadminLogoutForm"
                      action="{{ route('superadmin.logout') }}"
                      method="POST" class="d-none">
                    @csrf
                </form>

                <button class="icon-circle logout"
                        onclick="document.getElementById('superadminLogoutForm').submit();">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </div>

        </div>
    </div>
</div>
