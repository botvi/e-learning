@extends('template-web.layout')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>E-Learning</h1>
                            <p class="mb-0">E-Learning adalah aplikasi atau platform yang dirancang untuk membantu proses
                                ujian secara online.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">E-Learning</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- About Section -->
        <section class="about section" id="about">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>TENTANG<br></h2>
                <p>
                    Tentang SMP N 3 INUMAN
                </p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">
                    <div class="col-lg-6" data-aos-delay="100" data-aos="fade-up">
                        <h3>
                            E-Learning
                        </h3>
                        <img alt="" class="img-fluid rounded-4 mb-4" src="{{ asset('foto1.jpeg') }}">
                        <p>
                            E-Learning adalah aplikasi atau platform yang dirancang untuk membantu proses ujian secara
                            online. E-Learning ini sangat membantu dalam proses belajar mengajar di masa pandemi ini.
                        </p>
                        <p>
                            E-Learning ini sangat membantu dalam proses belajar mengajar di masa pandemi ini. E-Learning
                            ini sangat membantu dalam proses belajar mengajar di masa pandemi ini.
                        </p>
                    </div>
                    <div class="col-lg-6" data-aos-delay="250" data-aos="fade-up">
                        <div class="content ps-0 ps-lg-5">
                            <p class="fst-italic">
                                -
                            </p>

                            <p>
                                -
                            </p>

                            <div class="position-relative mt-4">
                                <img alt="" class="img-fluid rounded-4" src="{{ asset('foto2.jpeg') }}">
                                <a class="glightbox pulsating-play-btn"
                                    href="https://www.youtube.com/watch?v=Y7f98aduVJ8"></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->

    </main>
@endsection
