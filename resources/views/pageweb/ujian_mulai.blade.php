@extends('template-web.layout')

@section('content')
    <main class="main">

        <!-- Page Title -->
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>{{ $ujian->nama_ujian }}</h1>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">{{ $ujian->nama_ujian }}</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <!-- Starter Section Section -->
        <section id="starter-section" class="starter-section section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>{{ $ujian->nama_ujian }}</h2>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up">
                <form action="{{ route('web.simpanHasilUjian') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ujian_id" value="{{ $ujian->id }}">
                    <input type="hidden" name="guru_id" value="{{ $ujian->guru_id }}">

                    @php
                        $shuffledSoal = $soal;
                        shuffle($shuffledSoal);
                    @endphp
                
                    @if (count($shuffledSoal) > 0)
                        <ul class="list-group">
                            @foreach ($shuffledSoal as $key => $item)
                                <li class="list-group-item">
                                    {{ $key + 1 }} .
                                    @if ($item['gambar'])
                                        <div class="mb-3">
                                            <img src="{{ asset($item['gambar']) }}" alt="Soal Image" class="img-fluid"
                                                style="max-width: 150px; height: auto; border-radius: 8px; object-fit: cover;">
                                        </div>
                                    @endif
                        
                                    <div class="mb-3">
                                        <strong>{{ $item['pertanyaan'] }}</strong>
                                    </div>
                        
                                    <div class="mb-3">
                                        <strong>Pilihan Jawaban:</strong>
                                        <ul>
                                            @foreach (['a', 'b', 'c', 'd'] as $pilihan)
                                                <li>
                                                    <label>
                                                        <input type="radio" name="jawaban[{{ $key }}]" value="{{ $pilihan }}">
                                                        {{ strtoupper($pilihan) }}: {{ $item['pilihan'][$pilihan] }}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                        
                                    <input type="hidden" name="kunci_jawaban[{{ $key }}]" value="{{ $item['jawaban'] }}">
                                </li>
                            @endforeach
                        </ul>
                        <button type="submit" class="btn btn-primary mt-3">Simpan Hasil Ujian</button>
                    @else
                        <p>No soal found.</p>
                    @endif
                </form>
                
            </div>

        </section><!-- /Starter Section Section -->

    </main>
@endsection
