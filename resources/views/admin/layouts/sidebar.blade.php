<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Sipenta</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                @if (
                    (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'mahasiswa'|| Auth::user()->role == 'dosen')) ||
                        Auth::user()->role == 'kaprodi')
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 {{ request()->is('admin-dashboard') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            <svg class="bi">
                                <use xlink:href="#house-fill" />
                            </svg>
                            Dashboard
                        </a>
                @endif
                </li>
                @if (
                    (Auth::check() && (Auth::user()->role == 'dosen' || Auth::user()->role == 'admin')) ||
                        Auth::user()->role == 'kaprodi')
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 {{ request()->is('admin-mahasiswa') ? 'active' : '' }}"
                            href="{{ route('admin.mahasiswa.index') }}">
                            <svg class="bi">
                                <use xlink:href="#house-fill" />
                            </svg>
                            Mahasiswa
                        </a>
                    </li>
                @endif
                @if (
                    (Auth::check() && Auth::user()->role == 'dosen') ||
                        Auth::user()->role == 'admin' ||
                        Auth::user()->role == 'kaprodi')
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 {{ request()->is('admin-prodi') ? 'active' : '' }}"
                            href="{{ route('admin.prodi.index') }}">
                            <svg class="bi">
                                <use xlink:href="#cart" />
                            </svg>
                            Prodi
                        </a>
                    </li>
                @endif
                @if (
                    (Auth::check() && Auth::user()->role == 'admin') ||
                        Auth::user()->role == 'kaprodi')
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 {{ request()->is('admin-ruangan') ? 'active' : '' }}"
                            href="{{ route('admin.ruangan.index') }}">
                            <svg class="bi">
                                <use xlink:href="#people" />
                            </svg>
                            Ruangan
                        </a>
                    </li>
                @endif
                @if (
                    (Auth::check() && Auth::user()->role == 'admin') ||
                        Auth::user()->role == 'kaprodi')
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 {{ request()->is('admin-dosen') ? 'active' : '' }}"
                            href="{{ route('admin.dosen.index') }}">
                            <svg class="bi">
                                <use xlink:href="#people" />
                            </svg>
                            Dosen
                        </a>
                    </li>
                @endif
                @if (
                    (Auth::check() && Auth::user()->role == 'dosen') ||
                        Auth::user()->role == 'admin' ||
                        Auth::user()->role == 'mahasiswa')
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 {{ request()->is('admin-tugas_akhir') ? 'active' : '' }}"
                            href="{{ route('tugas_akhir.index') }}">
                            <svg class="bi">
                                <use xlink:href="#graph-up" />
                            </svg>
                            Tugas Akhir
                        </a>
                    </li>
                @endif
                @if (
                    (Auth::check() && Auth::user()->role == 'dosen') ||
                        Auth::user()->role == 'admin' ||
                        Auth::user()->role == 'kaprodi')
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 {{ request()->is('admin-sidang') ? 'active' : '' }}"
                            href="{{ route('admin.sidang.index') }}">
                            <svg class="bi">
                                <use xlink:href="#puzzle" />
                            </svg>
                            Sidang
                        </a>
                    </li>
                @endif
                @if (
                    (Auth::check() && Auth::user()->role == 'dosen') ||
                        Auth::user()->role == 'admin' ||
                        Auth::user()->role == 'kaprodi')
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2 {{ request()->is('admin-validasi_ta') ? 'active' : '' }}"
                            href="{{ route('validasi_ta.index') }}">
                            <svg class="bi">
                                <use xlink:href="#puzzle" />
                            </svg>
                            Validasi Tugas Akhir
                        </a>
                    </li>
                @endif
            </ul>

            <hr class="my-3">

            <ul class="nav flex-column mb-auto">
                @if (Auth::check() && Auth::user()->role == 'admin')
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="{{ route('admin.user.index') }}">
                            <svg class="bi">
                                <use xlink:href="#puzzle" />
                            </svg>
                            User
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"">

                        <svg class="bi">
                            <use xlink:href="#door-closed" />
                        </svg>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
