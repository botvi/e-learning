@extends('template-admin.layout')

@section('content')
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Forms</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Hasil Ujian</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--breadcrumb-->
            <h6 class="mb-0 text-uppercase">Data Hasil Ujian</h6>
            <hr />
            <!-- Filter Form -->
            <div class="card mb-3">
                <div class="card-body">
                    <form action="{{ route('hasilUjian.index') }}" method="GET" class="row g-3">
                        <div class="col-md-4">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select name="kelas" id="kelas" class="form-select">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelasList as $kelas)
                                    <option value="{{ $kelas->id }}" {{ request('kelas') == $kelas->id ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="mataPelajaran" class="form-label">Mata Pelajaran</label>
                            <select name="mataPelajaran" id="mataPelajaran" class="form-select">
                                <option value="">-- Pilih Mata Pelajaran --</option>
                                @foreach ($mataPelajaranList as $pelajaran)
                                    <option value="{{ $pelajaran->id }}" {{ request('mataPelajaran') == $pelajaran->id ? 'selected' : '' }}>
                                        {{ $pelajaran->nama_pelajaran }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 align-self-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('hasilUjian.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Filter Form -->

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-end mb-3">
                        <button onclick="printTable()" class="btn btn-success">
                            <i class="bx bx-printer"></i> Print Tabel
                        </button>
                    </div>
                    
                    <div class="table-responsive">
                        <table id="table-hasil-ujian" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
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
                                @foreach ($hasilUjian as $index => $h)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $h->siswa->nama }}</td>
                                        <td>{{ $h->ujian->mataPelajaran->nama_pelajaran }}</td>
                                        <td>{{ $h->ujian->kelas->nama_kelas }}</td>
                                        <td><span class="badge bg-primary">{{ $h->total_soal }}</span></td>
                                        <td><span class="badge bg-success">{{ $h->benar }}</span></td>
                                        <td><span class="badge bg-danger">{{ $h->salah }}</span></td>
                                        <td>
                                            @php
                                                // Pastikan tidak membagi dengan nol
                                                $nilai = $h->total_soal > 0 ? ($h->benar / $h->total_soal) * 100 : 0;
                                            @endphp
                                            {{ number_format($nilai, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    function printTable() {
        // Ambil elemen tabel
        const printContent = document.querySelector('.table-responsive').innerHTML;
        const originalContent = document.body.innerHTML;

        // Ganti konten body dengan hanya tabel
        document.body.innerHTML = `
            <div style="text-align: center;">
                <h2>Data Hasil Ujian</h2>
            </div>
            ${printContent}
        `;

        // Cetak halaman
        window.print();

        // Kembalikan konten asli
        document.body.innerHTML = originalContent;
        location.reload(); // Reload halaman untuk mengembalikan script
    }
</script>
<script>
    $(document).ready(function() {
        // Initialize DataTable for the second table without search functionality
        var table = $('#table-hasil-ujian').DataTable({
            lengthChange: false,
            paging: false,  
            searching: false, // Disable search
            // buttons: ['copy', 'excel', 'pdf', 'print']
        });

        table.buttons().container()
            .appendTo('#table-hasil-ujian_wrapper .col-md-6:eq(0)');
    });
</script>

@endsection
