<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarMenuLabel">Sipenta</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page" href="/admin-mahasiswa">
              <svg class="bi"><use xlink:href="#house-fill"/></svg>
              Mahasiswa
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/admin-dosen">
              <svg class="bi"><use xlink:href="#file-earmark"/></svg>
              Dosen
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/admin-prodi">
              <svg class="bi"><use xlink:href="#cart"/></svg>
              Prodi
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/admin-ruangan">
              <svg class="bi"><use xlink:href="#people"/></svg>
              Ruangan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/admin-tugas_akhir">
              <svg class="bi"><use xlink:href="#graph-up"/></svg>
                Tugas Akhir
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/admin-sidang">
              <svg class="bi"><use xlink:href="#puzzle"/></svg>
              Sidang
            </a>
          </li>
        </ul>

        {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <svg class="bi"><use xlink:href="#plus-circle"/></svg>
          </a>
        </h6> --}}
        {{-- <ul class="nav flex-column mb-auto">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="#">
              <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="#">
              <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="#">
              <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="#">
              <svg class="bi"><use xlink:href="#file-earmark-text"/></svg>
              Year-end sale
            </a>
          </li>
        </ul> --}}

        <hr class="my-3">

        <ul class="nav flex-column mb-auto">
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="{{ route('profile') }}">
              <svg class="bi"><use xlink:href="#gear-wide-connected"/></svg>
              Settings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2" href="/">
              <svg class="bi"><use xlink:href="#door-closed"/></svg>
              Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
