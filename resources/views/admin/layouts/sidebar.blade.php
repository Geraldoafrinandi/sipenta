<header>
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/backend">
                <div class="sidebar-brand-icon rotate-n-5">
                    <img src="{{ asset('landing_page') }}/images/logoTI.jpg" alt=""
                        style="max-width: 35px; max-height: 35px; ; border-radius: 20px">
                </div>
                <div class="sidebar-brand-text mx-3">Sipenta</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Menu Penjadwalan -->
            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Penjadwalan</span></a>
            </li>

            <!-- Menu Mahasiswa -->
            <li class="nav-item">
                <a class="nav-link" href="/mahasiswa">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Mahasiswa</span></a>
            </li>

            <!-- Menu Dosen -->
            <li class="nav-item">
                <a class="nav-link" href="/datadosen">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Dosen</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
            {{-- <div class="sidebar-card d-none d-lg-flex">
                <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
                <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
                <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
            </div> --}}
            <form method="POST" action="/logout">
                @csrf
                <button class="btn btn-danger text-light mx-5 mt-3" type="submit">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </button>
            </form>

        </ul>




</header>

<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
