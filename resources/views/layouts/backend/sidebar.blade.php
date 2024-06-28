<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('admin/dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-dragon"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Rajawali Rent</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Manajemen
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('admin/produk*')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/produk') }}">
            <i class="fas fa-fw fa-car"></i>
            <span>Produk</span></a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ (request()->segment(2) == 'transaksi') ? 'active' : '' }}">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-exchange-alt"></i>
            <span>Transaksi</span>
        </a>
        <div id="collapseOne" class="collapse {{ (request()->segment(2) == 'transaksi') ? 'show' : '' }}" aria-labelledby="headingOne" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item {{ (request()->segment(3) == 'form-transaksi') ? 'active' : '' }}" href="{{ url('admin/transaksi/form-transaksi') }}">Form Transaksi</a>
                <a class="collapse-item {{ (request()->segment(3) == 'data-transaksi') ? 'active' : '' }}" href="{{ url('admin/transaksi/data-transaksi') }}">Data Transaksi</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->segment(2) == 'pelanggan') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/pelanggan') }}">
            <i class="fas fa-fw fa-address-card"></i>
            <span>Pelanggan</span></a>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->segment(2) == 'report') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('admin/report') }}">
            <i class="fas fa-fw fa-file-export"></i>
            <span>Laporan</span></a>
    </li>

    <!-- Heading -->
    <div class="sidebar-heading">
        Setting
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="true" aria-controls="collapsePages1">
            <i class="fas fa-fw fa-users-cog"></i>
            <span>Manajemen Users</span>
        </a>
        <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Manajemen User</a>
                <a class="collapse-item" href="">Manajemen Role</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true" aria-controls="collapsePages2">
            <i class="fas fa-fw fa-photo-video"></i>
            <span>Manajemen Content</span>
        </a>
        <div id="collapsePages2" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ url('admin/about-cms') }}">About</a>
                <a class="collapse-item" href="{{ url('admin/blog-cms') }}">Blog</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages3" aria-expanded="true" aria-controls="collapsePages3">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Setting Website</span>
        </a>
        <div id="collapsePages3" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="">Colors</a>
                <a class="collapse-item" href="">Borders</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>