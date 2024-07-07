<!-- Sidebar Start -->
<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/admin-backend" class="text-nowrap logo-img">
                <img src="{{ asset('dashboard') }}/images/TI.png" width="200" height="75" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar=>
            <ul id="sidebarnav">
                <!-- Kaprodi -->
                @if (Auth::check() && Auth::user()->role == 'kaprodi')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('admin-dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-layout"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('admin-mahasiswa') ? 'active' : '' }}"
                            href="{{ route('admin.mahasiswa.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="hide-menu">Mahasiswa</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('admin-dosen') ? 'active' : '' }}"
                            href="{{ route('admin.dosen.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user"></i>
                            </span>
                            <span class="hide-menu">Dosen</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('admin-prodi') ? 'active' : '' }}"
                            href="{{ route('admin.prodi.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-list"></i>
                            </span>
                            <span class="hide-menu">Prodi</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('admin-ruangan') ? 'active' : '' }}"
                            href="{{ route('admin.ruangan.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-home"></i>
                            </span>
                            <span class="hide-menu">Ruangan</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.tugas_akhir.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-book"></i>
                            </span>
                            <span class="hide-menu">Daftar Sidang</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('admin-sidang') ? 'active' : '' }}"
                            href="{{ route('admin.sidang.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-book"></i>
                            </span>
                            <span class="hide-menu">Penjadwalan Sidang</span>
                        </a>
                    </li>
                    @php
                        // Cek apakah ada data untuk validasi_ta
                        $hasValidasiTA = \App\Models\ValidasiTA::count() > 0;
                        // Cek apakah ada data untuk validasi_proposal
                        $hasValidasiProposal = \App\Models\ValidasiProposal::count() > 0;
                    @endphp
                    @if ($hasValidasiTA)
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('validasi_ta.index') }}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-book"></i>
                                </span>
                                <span class="hide-menu">Validasi Tugas Akhir</span>
                            </a>
                        </li>
                    @endif

                    @if ($hasValidasiProposal)
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('validasi_proposal.index') }}"
                                aria-expanded="false">
                                <span>
                                    <i class="ti ti-book"></i>
                                </span>
                                <span class="hide-menu">Validasi Proposal</span>
                            </a>
                        </li>
                    @endif
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('admin-penilaian') ? 'active' : '' }}"
                            href="{{ route('admin.penilaian.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-book"></i>
                            </span>
                            <span class="hide-menu">Penilaian</span>
                        </a>
                    </li>
                @endif

                <!-- Admin -->
                @if (Auth::check() && Auth::user()->role == 'admin')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="/admin-user" aria-expanded="false">
                            <span>
                                <i class="ti ti-login"></i>
                            </span>
                            <span class="hide-menu">User</span>
                        </a>
                    </li>
                @endif

                <!-- Dosen -->
                @if (Auth::check() && Auth::user()->role == 'dosen')

                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('admin-dashboard') ? 'active' : '' }}"
                            href="{{ route('dosen.home') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-layout"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.tugas_akhir.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-book"></i>
                            </span>
                            <span class="hide-menu">Daftar Sidang</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('admin-sidang') ? 'active' : '' }}"
                            href="{{ route('admin.sidang.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-book"></i>
                            </span>
                            <span class="hide-menu">Penjadwalan Sidang</span>
                        </a>
                    </li>
                    @php
                    // Cek apakah ada data untuk validasi_ta
                    $hasValidasiTA = \App\Models\ValidasiTA::count() > 0;
                    // Cek apakah ada data untuk validasi_proposal
                    $hasValidasiProposal = \App\Models\ValidasiProposal::count() > 0;
                @endphp
                @if ($hasValidasiTA)
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('validasi_ta.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-book"></i>
                            </span>
                            <span class="hide-menu">Validasi Tugas Akhir</span>
                        </a>
                    </li>
                @endif

                @if ($hasValidasiProposal)
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('validasi_proposal.index') }}"
                            aria-expanded="false">
                            <span>
                                <i class="ti ti-book"></i>
                            </span>
                            <span class="hide-menu">Validasi Proposal</span>
                        </a>
                    </li>
                @endif
                    {{-- <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('validasi_ta.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-book"></i>
                        </span>
                        <span class="hide-menu">Validasi Tugas Akhir</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('validasi_proposal.index') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-book"></i>
                        </span>
                        <span class="hide-menu">Validasi Proposal</span>
                    </a>
                </li> --}}
                    {{-- <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('admin-penilaian') ? 'active' : '' }}"
                            href="{{ route('admin.penilaian.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-book"></i>
                            </span>
                            <span class="hide-menu">Penilaian</span>
                        </a>
                    </li> --}}
                @endif

                <!-- Mahasiswa -->
                @if (Auth::check() && Auth::user()->role == 'mahasiswa')
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Home</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('admin/dashboard/mahasiswa') ? 'active' : '' }}"
                            href="{{ route('mahasiswa.home') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-layout"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('admin.tugas_akhir.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-book"></i>
                            </span>
                            <span class="hide-menu">Daftar Sidang</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ request()->is('admin-sidang') ? 'active' : '' }}"
                            href="{{ route('admin.sidang.index') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-book"></i>
                            </span>
                            <span class="hide-menu">Penjadwalan Sidang</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- Sidebar End -->
