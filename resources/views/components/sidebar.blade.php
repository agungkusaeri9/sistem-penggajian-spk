<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
        </div>
        <div class="sidebar-brand-text mx-3">Sistem Penggajian</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link my-0 pb-1" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link my-0 pb-1" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Data User</span></a>
    </li>


    <li class="nav-item">
        <a class="nav-link my-0 pb-1" href="{{ route('karyawan.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Karyawan</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Master Data</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('jabatan.index') }}">Jabatan</a>
                <a class="collapse-item" href="{{ route('divisi.index') }}">Divisi</a>
                <a class="collapse-item" href="{{ route('golongan-gaji.index') }}">Golongan Gaji</a>
                <a class="collapse-item" href="{{ route('tunjangan.index') }}">Tunjangan</a>
                <a class="collapse-item" href="{{ route('bank.index') }}">Bank</a>
            </div>
        </div>
    </li>

</ul>
<!-- End of Sidebar -->
