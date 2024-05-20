@extends('layouts.main')
@section('content')
<section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
        <div class="container px-4 px-lg-5 h-100">
            <div data-aos="fade-up" class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-8 align-self-end">
                   <br> <h2 class="text-white font-weight-bold russo-one-regular">SISTEM INFORMASI PENJADWALAN TUGAS AKHIR</h2>
                    <hr class="divider text-white" />
                </div>
                <div class="col-lg-8 align-self-baseline">
                    <p class="text-white-75 mb-5 cabin"> Jurusan Teknologi Informasi <br> Politeknik Negeri Padang</p>
                    <button>
                      <a href="#main" style="text-decoration-line: none">Explore</a>
                    </button>
                </div>
            </div>
        </div>
  </section><!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section class="py-4 col row" id="home" data-aos="fade up">
        <h1 style="text-align: center">Program Studi Teknologi Informasi</h1>
        <div class="container col-lg-8">
            <div class="row row-cols-1 ">
                <div class="card mt-4 mx-3" style="width: 18rem; border: solid; border-radius: 10%">
                    <img src="/landing_page/images/trpl.png" class="card-img-top mt-3" alt="...">
                    <div class="card-body">
                        <h5 class="card-text">D-IV Teknologi Rekayasa Perangkat Lunak
                        </h5>
                    </div>
                </div>
                <div class="card mt-4 mx-4 " style="width: 18rem; border: solid; border-radius: 10%">
                    <img src="/landing_page/images/mi.png" class="card-img-top mt-3" alt="...">
                    <div class="card-body">
                        <h5 class="card-text">D-III Manajemen Informatika</h5>
                    </div>
                </div>
                <div class="card mt-4 mx-4" style="width: 18rem; border: solid; border-radius: 10%">
                    <img src="{{asset('landing_page')}}/images/tekom.png" class="card-img-top mt-3" alt="...">
                    <div class="card-body">
                        <h5 class="card-text">D-III Teknik Komputer</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
