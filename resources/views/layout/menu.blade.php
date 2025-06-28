<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo justify-content-between">
        <a href="{{ route('dashboard') }}" class="app-brand-link">
            <img src="{{ asset('aa/assets/img/logo1.jpg') }}" alt="Logo" width="150" />
            <span class="app-brand-text demo menu-text fw-bolder"></span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <!-- Menu untuk Admin -->
        @if (Auth::check() && Auth::user()->role === 'admin')
            <li class="menu-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user-check"></i>
                    <div>Kelola User</div>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('periodes.*') ? 'active' : '' }}">
                <a href="{{ route('periodes.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-calendar"></i>
                    <div>Kelola Periode</div>
                </a>
            </li>
        @endif

        <!-- Menu untuk Admin dan Validator -->
        @if (Auth::check() && in_array(Auth::user()->role, ['admin', 'validator']))
            <li class="menu-item {{ request()->routeIs('sertifikat.index') ? 'active' : '' }}">
                <a href="{{ route('sertifikat.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-task"></i>
                    <div>Daftar Pengajuan</div>
                </a>
            </li>

            <li class="menu-item {{ request()->is('sertifikat/hasil*') ? 'active' : '' }}">
                <a href="{{ route('sertifikat.hasil') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-folder-open"></i>
                    <div>Hasil Validasi</div>
                </a>
            </li>
        @endif

        <!-- Menu untuk Mahasiswa -->
        @if (Auth::check() && Auth::user()->role === 'mahasiswa')
            <li class="menu-item {{ request()->routeIs('pengajuan/*') ? 'active' : '' }}">
                <a href="{{ route('pengajuan') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-task"></i>
                    <div>Pengajuan</div>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('daftar') ? 'active' : '' }}">
                <a href="{{ route('daftar') }}" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-list-check"></i>
                    <div>Daftar Pengajuan</div>
                </a>
            </li>
        @endif
    </ul>
</aside>
