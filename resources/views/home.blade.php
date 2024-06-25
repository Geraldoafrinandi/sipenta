@extends('layouts.main')
@section('content')
    <section id="hero" class="hero d-flex align-items-center section-bg">
        <div class="container">
            <div class="container px-4 px-lg-5 h-100">
                <div data-aos="fade-up" class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <br>
                        <h2 class="text-white font-weight-bold russo-one-regular">SISTEM INFORMASI PENJADWALAN TUGAS AKHIR
                        </h2>
                        <hr class="divider text-white" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class="text-black-75 mb-5 cabin"> Jurusan Teknologi Informasi <br> Politeknik Negeri Padang</p>
                        <button>
                            <a href="#main" style="text-decoration-line: none">Explore</a>
                        </button>
                    </div>
                </div>
            </div>
    </section><!-- End Hero Section -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section class="py-4 col row" id="home" data-aos="fade-up">
            <h1 style="text-align: center">Program Studi Teknologi Informasi</h1>
            <div class="container col-lg-8">
                <div class="carousel-container">
                    <div class="carousel-row">
                        <div class="card mt-4 mx-3 shadow" style="width: 18rem; border: solid; border-radius: 10%">
                            <img src="/landing_page/images/trpl.png" class="card-img-top mt-3" alt="...">
                            <div class="card-body">
                                <h5 class="card-text">D-IV Teknologi Rekayasa Perangkat Lunak</h5>
                            </div>
                        </div>
                        <div class="card mt-4 mx-4 shadow" style="width: 18rem; border: solid; border-radius: 10%">
                            <img src="/landing_page/images/mi.png" class="card-img-top mt-3" alt="...">
                            <div class="card-body">
                                <h5 class="card-text">D-III Manajemen Informatika</h5>
                            </div>
                        </div>
                        <div class="card mt-4 mx-4 shadow" style="width: 18rem; border: solid; border-radius: 10%;">
                            <img src="{{ asset('landing_page') }}/images/tekom.png" class="card-img-top mt-3" alt="...">
                            <div class="card-body">
                                <h5 class="card-text">D-III Teknik Komputer</h5>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-row">
                        <div class="card mt-4 mx-3 shadow" style="width: 18rem; border: solid; border-radius: 10%">
                            <img src="/landing_page/images/animasi.png" class="card-img-top mt-3 " alt="...">
                            <div class="card-body">
                                <h5 class="card-text">D-IV Animasi</h5>
                            </div>
                        </div>
                        <div class="card mt-4 mx-4 shadow" style="width: 18rem; border: solid; border-radius: 10%; ">
                            <img src="/landing_page/images/si.png" class="card-img-top mt-3" alt="...">
                            <div class="card-body">
                                <h5 class="card-text">D-III Sistem Informasi</h5>
                            </div>
                        </div>
                        <div class="card mt-4 mx-4 shadow" style="width: 18rem; border: solid; border-radius: 10%;">
                            <img src="/landing_page/images/jaringan.jpg" class="card-img-top mt-3" alt="...">
                            <div class="card-body">
                                <h5 class="card-text">D-II Administrasi Jaringan Komputer</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section id="cara-mendaftar-ta" class="py-5" data-aos="fade-up">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <img src="/landing_page/images/ta.png" class="img-fluid" alt="Buku" style="max-width: 450px;">
            </div>
            <div class="col-lg-6">
                <div class="border-0">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Cara Mendaftar Tugas Akhir</h2>
                        <hr class="divider my-4">
                        <ol class="list-unstyled">
                            <li class="mb-3">
                                <h5>Langkah 1: Persiapkan Dokumen</h5>
                                <p>Persiapkan dokumen yang diperlukan untuk pendaftaran Tugas Akhir.</p>
                            </li>
                            <li class="mb-3">
                                <h5>Langkah 2: Isi Formulir Pendaftaran</h5>
                                <p>Isi formulir pendaftaran Tugas Akhir secara lengkap dan benar.</p>
                            </li>
                            <li class="mb-3">
                                <h5>Langkah 3: Verifikasi Persyaratan</h5>
                                <p>Verifikasi persyaratan yang diperlukan oleh dosen pembimbing.</p>
                            </li>
                            <li class="mb-3">
                                <h5>Langkah 4: Pengajuan Proposal</h5>
                                <p>Ajukan proposal Tugas Akhir sesuai dengan jadwal yang ditentukan.</p>
                            </li>
                            <li class="mb-3">
                                <h5>Langkah 5: Ujian Tugas Akhir</h5>
                                <p>Lakukan ujian Tugas Akhir sesuai dengan jadwal yang telah ditetapkan.</p>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


        <script>
            var cards = document.querySelectorAll('.card');
            var currentIndex = 0;
            var totalCards = cards.length;

            function slideCarousel() {
                // Set opacity dan scale untuk semua card
                cards.forEach((card, index) => {
                    var scale = index === currentIndex ? 1 : 0.8; // Skala card yang aktif adalah 1, sedangkan yang lain adalah 0.8
                    var opacity = index === currentIndex ? 1 : 0.5; // Opacity card yang aktif adalah 1, sedangkan yang lain adalah 0.5
                    var boxShadow = index === currentIndex ? '0 8px 16px rgba(0,0,0,0.2)' : '0 4px 6px rgba(0,0,0,0.1)'; // Shadow yang aktif adalah lebih tebal
                    card.style.transform = `scale(${scale})`; // Set transform scale
                    card.style.opacity = opacity; // Set opacity
                    card.style.boxShadow = boxShadow; // Set box shadow
                });

                // Pindahkan currentIndex ke card selanjutnya
                currentIndex++;
                if (currentIndex >= totalCards) {
                    currentIndex = 0;
                }
            }

            setInterval(slideCarousel, 1000); // Jalankan fungsi slideCarousel setiap 3 detik
        </script>

        <style>
          .card {
    background-color: transparent;
    border: 1px solid #dee2e6;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.5s ease, opacity 0.9s ease, box-shadow 0.3s ease, border-color 0.3s ease;
}

.card-img-top {
    max-width: 100%;
    height: auto;
}

.card-body {
    padding: 20px;
    text-align: center;
}

.carousel-container {
    overflow: hidden;
    width: 100%;
}

.carousel-row {
    display: flex;
}

.active {
    opacity: 1 !important;
    transform: scale(1) !important;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2) !important;
    border-color: #007bff !important; /* Warna border untuk card aktif */
}

.card:not(.active) {
    opacity: 0.9; /* Transparansi untuk card tidak aktif */
    box-shadow: none; /* Hapus bayangan untuk card tidak aktif */
    border-color: #dee2e6; /* Warna border untuk card tidak aktif */
}

            body {
                overflow-x: hidden;
            }

            #cara-mendaftar-ta {
                background-color: #f8f9fa;
            }

            .divider {
                width: 50px;
                height: 3px;
                background-color: #343a40;
                margin: 20px auto;
            }

            .card {
                background-color: transparent;
                border: 1px solid #dee2e6;
                border-radius: 10px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            .card-title {
                color: #343a40;
                font-size: 2.5rem;
                font-weight: bold;
            }

            .card-body {
                padding: 40px;
            }

            .card-body h5 {
                color: #343a40;
                font-size: 1.2rem;
                font-weight: bold;
            }

            .card-body p {
                color: #6c757d;
                font-size: 1.2rem;
            }
        </style>
