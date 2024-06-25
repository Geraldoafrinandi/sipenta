

<header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white custom-font" href="/admin-dashboard">
        <img src="{{ asset('landing_page/images/logoTI.jpg') }}" alt="Logo" class="logo me-2">
        SIPENTA</a>

    <ul class="navbar-nav flex-row d-md-none">
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch"
                aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">
                <svg class="bi">
                    <use xlink:href="#search" />
                </svg>
            </button>
        </li>
        <li class="nav-item text-nowrap">
            <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                aria-label="Toggle navigation">
                <svg class="bi">
                    <use xlink:href="#list" />
                </svg>
            </button>
        </li>
    </ul>

    <div id="navbarSearch" class="navbar-search w-100 collapse">
        <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
    </div>

   <!-- Dropdown untuk profile -->
   <ul class="navbar-nav ms-auto mx-3">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center text-white" href="#" id="userDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">

            {{ Auth::user()->name }}
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a></li>
        </ul>
    </li>
   </ul>

<style>
/* Import Google Font */
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap');

/* CSS for the logo */
.logo {
    width: 32px; /* Adjust the width as needed */
    height: 32px; /* Ensure height is the same as width to keep it square */
    border-radius: 50%; /* Make it a circle */
    object-fit: cover; /* Ensure the image covers the circle area */
    border: 2px solid white; /* Optional: add a border around the circle */
    margin-right: 8px; /* Space between the logo and the text */
}

/* CSS for the custom font */
.custom-font {
    font-family: 'Roboto', sans-serif; /* Use the custom font */
    font-size: 1.25rem; /* Adjust the font size */
}

/* CSS untuk dropdown profile pada navbar */
.dropdown-menu {
    background-color: #343a40; /* Warna latar belakang dropdown */
    border: none; /* Hapus border bawaan */
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15); /* Shadow dropdown */
    padding: 0.5rem 0; /* Padding di dalam dropdown */
    font-size: 0.875rem; /* Ukuran teks */
    width: 12rem; /* Lebar dropdown */
    position: absolute !important; /* Posisi absolut agar tidak terpengaruh oleh posisi relatif navbar */
    top: 100%; /* Atur dropdown di bawah navbar */
    left: 0; /* Atur dropdown mulai dari kiri navbar */
    z-index: 1000; /* Tingkatkan z-index agar dropdown tetap tampil di atas konten lain */
    opacity: 0; /* Opacity awal dropdown */
    visibility: hidden; /* Visibility awal dropdown */
    transform: translateY(-10px); /* Translasi awal dropdown */
    transition: opacity 0.3s ease, visibility 0.3s ease, transform 0.3s ease; /* Transisi smooth */
}

/* Dropdown muncul saat ditekan */
.dropdown-menu.show {
    opacity: 1; /* Ubah opacity menjadi 1 */
    visibility: visible; /* Ubah visibility menjadi visible */
    transform: translateY(0); /* Hilangkan translasi */
}

/* CSS untuk tombol profile pada navbar */
.navbar .nav-link.dropdown-toggle {
    color: #fff; /* Warna teks tombol */
    transition: color 0.3s; /* Transisi smooth warna teks */
    position: relative; /* Posisi relatif */
}

/* Efek smooth saat tombol profile ditekan */
.navbar .nav-link.dropdown-toggle:focus, .navbar .nav-link.dropdown-toggle:hover {
    color: #adb5bd; /* Warna teks saat ditekan */
}

/* Gambar profil */
.profile-picture {
    width: 32px; /* Ukuran gambar profil */
    height: 32px; /* Ukuran gambar profil */
    border-radius: 50%; /* Lingkaran untuk gambar profil */
    object-fit: cover; /* Objek gambar yang terlihat sempurna */
    margin-right: 8px; /* Jarak kanan antara gambar dan teks nama */
}
    </style>


    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</header>
