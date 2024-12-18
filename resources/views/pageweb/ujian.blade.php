@extends('template-web.layout')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>List Ujian</h1>
                            <p class="mb-0">List Ujian yang tersedia</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">List Ujian</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <section id="blog-posts" class="blog-posts section">
            <div class="container">
                <div class="row gy-4">
                    @foreach ($ujian as $item)
                        <div class="col-lg-4 col-md-6">
                            <article class="card shadow-sm border-0 rounded">
                                <div class="post-img">
                                    <img src="https://img.freepik.com/free-vector/female-student-passing-exam-checking-answers_74855-14022.jpg" alt="Ujian Image" class="img-fluid rounded-top">
                                </div>
                                
                                <div class="card-body">
                                    <p class="post-category text-muted"><span class="badge bg-primary">{{ $item->mataPelajaran->nama_pelajaran }}</span></p>
                                    <p class="post-category text-muted"><span class="badge bg-primary">{{ $item->kelas->nama_kelas }}</span></p>
                                    
                                    <h5 class="title">
                                        <a href="blog-details.html" class="text-dark">{{ $item->nama_ujian }}</a>
                                    </h5>
                                    <p class="post-category text-muted"><span class="badge bg-primary">Tanggal Ujian : {{ \Carbon\Carbon::parse($item->tanggal_ujian)->format('d F Y') }}</span></p>
                                    <p class="post-category text-muted"><span class="badge bg-primary">Waktu Ujian : {{ \Carbon\Carbon::parse($item->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($item->waktu_selesai)->format('H:i') }}</span></p>

                                    <div class="d-flex align-items-center justify-content-between">
                                        @if ($item->status == 'sudah mulai')
                                            <a href="{{ route('web.ujianMulai', $item->id) }}" class="btn btn-success">Mulai Ujian</a>
                                        @else
                                            <a href="#" class="btn btn-warning">Ujian Belum Di Mulai</a>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        </div>
                    @endforeach

                    @if ($ujian->isEmpty())
                        <div class="col-lg-12">
                            <div class="alert alert-info text-center">Ujian belum ada</div>
                        </div>
                    @endif
                </div>
            </div>
        </section>

    </main>
@endsection
