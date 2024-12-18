@extends('template-web.layout')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Modul Pembelajaran</h1>
                            <p class="mb-0">Modul pembelajaran adalah kumpulan materi pembelajaran yang dapat diakses oleh siswa.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">Modul Pembelajaran</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <section id="blog-posts" class="blog-posts section">

            <div class="container">
              <div class="row gy-4">
                @foreach ($modul as $item)
                <div class="col-lg-4">
                  <article>
      
                    <div class="post-img">
                      <img src="https://st2.depositphotos.com/7341970/11081/v/450/depositphotos_110818782-stock-illustration-e-learning-education-and-university.jpg" alt="" class="img-fluid">
                    </div>
                    <h2 class="title">
                      <a href="blog-details.html">{{ $item->nama_modul }}</a>
                    </h2>
      
                    <p class="post-category"><span class="badge bg-primary">{{ $item->kelas->nama_kelas }}</span></p>
                    <p class="post-category"><span class="badge bg-primary">{{ $item->mata_pelajaran->nama_pelajaran }}</span></p>
      
      
                    <div class="d-flex align-items-center">
                      @if (Auth::check())
                      <a href="{{ asset('modul/' . $item->file) }}" target="_blank" class="btn btn-success">Lihat Modul</a>
                      @else
                      <a href="{{ route('login') }}" class="btn btn-success">Login untuk melihat modul</a>
                      @endif
                    </div>

                  </article>
                </div>
                @endforeach
                @if ($modul->isEmpty())
                <div class="col-lg-12">
                  <div class="alert alert-info">Modul belum ada</div>
                </div>
                @endif
      
              </div>
            </div>

        </section>

    </main>
@endsection
