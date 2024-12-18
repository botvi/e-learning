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
                            <li class="breadcrumb-item active" aria-current="page">Master Ujian</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <!--breadcrumb-->
            <h6 class="mb-0 text-uppercase">Data Master Ujian</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('ujian.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                    <div class="table-responsive">
                        <table id="example2" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Kode Ujian</th>
                                    <th>Nama Ujian</th>
                                    <th>Tanggal Ujian</th>
                                    <th>Waktu Ujian</th>
                                    <th>Status</th>
                                    <th>Soal Ujian</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ujians as $index => $ujian)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $ujian->mataPelajaran->nama_pelajaran }}</td>
                                        <td>{{ $ujian->kelas->nama_kelas }}</td>
                                        <td>{{ $ujian->kode_ujian }}</td>
                                        <td>{{ $ujian->nama_ujian }}</td>
                                        <td>{{ $ujian->tanggal_ujian }}</td>
                                        <td>{{ $ujian->waktu_mulai }} - {{ $ujian->waktu_selesai }}</td>
                                        <td>
                                            <a href="{{ route('ujian.updateStatus', $ujian->id) }}"
                                                class="btn btn-sm btn-success">Ubah Status</a>
                                            <span
                                                class="badge {{ $ujian->status == 'sudah mulai' ? 'bg-success' : 'bg-danger' }}">{{ $ujian->status }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('ujian.viewSoal', $ujian->id) }}"
                                                class="btn btn-sm btn-info">Lihat Soal</a>
                                        </td>
                                        <td>

                                            <a href="{{ route('ujian.edit', $ujian->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('ujian.destroy', $ujian->id) }}" method="POST"
                                                style="display:inline;" class="delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Kelas</th>
                                    <th>Kode Ujian</th>
                                    <th>Nama Ujian</th>
                                    <th>Tanggal Ujian</th>
                                    <th>Waktu Ujian</th>
                                    <th>Status</th>
                                    <th>Soal Ujian</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data ini akan dihapus secara permanen!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection



{{-- @if (isset($soal['gambar']))
    <img src="{{ asset('soal-gambar/' . $soal['gambar']) }}" alt="Gambar Soal" class="img-fluid">
@endif --}}
