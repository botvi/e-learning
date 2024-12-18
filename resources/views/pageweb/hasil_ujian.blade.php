@extends('template-web.layout')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Hasil Ujian Anda</h1>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="/">Home</a></li>
                        <li class="current">Hasil Ujian Anda</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Hasil Ujian Section -->
        <section id="hasil-ujian-section" class="hasil-ujian-section section">
            <div class="container" data-aos="fade-up">
                <h2 class="text-center mb-4">Hasil Ujian Anda</h2>

                @if ($hasilUjian->isEmpty())
                    <div class="alert alert-info text-center">
                        <p>Belum ada hasil ujian yang tersedia.</p>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nama Siswa</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Total Soal</th>
                                    <th>Jawaban Benar</th>
                                    <th>Jawaban Salah</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hasilUjian as $key => $hasil)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $hasil->siswa->nama }}</td>
                                        <td>{{ $hasil->ujian->mataPelajaran->nama_pelajaran }}</td>
                                        <td>{{ $hasil->ujian->kelas->nama_kelas }}</td>
                                        <td><span class="badge bg-primary">{{ $hasil->total_soal }}</span></td>
                                        <td><span class="badge bg-success">{{ $hasil->benar }}</span></td>
                                        <td><span class="badge bg-danger">{{ $hasil->salah }}</span></td>
                                        <td>
                                            @php
                                                $nilai = ($hasil->benar / $hasil->total_soal) * 100;
                                            @endphp
                                            {{ number_format($nilai, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </section><!-- /Hasil Ujian Section -->

    </main>
@endsection
