@extends('auth.component.app')

@section('content')
    @if (auth()->user()->level !== 'mahasiswa')
        <div class="body-wrapper">
            <div class="container mt-5 pt-5">
                <h2 class="text-center mb-4">Data Pengajuan Magang</h2>
                <div class="m-4">
                    @include('component.alert')
                </div>
                @if (auth()->user()->level == 'admin')
                    <button type="button" class="btn btn-dark rounded-0 mb-3" data-bs-toggle="modal"
                        data-bs-target="#createModal">
                        Tambah Pengajuan
                    </button>
                @endif



                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Pengaju</th>
                            <th>OPD Tujuan</th>
                            <th>Jenis Magang</th>
                            <th>Rentang Waktu</th>
                            <th>Status</th>

                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($magang as $index => $item)
                            @if ($item->status_pengajuan == 'Pending')
                                <tr class="table-warning">
                                @elseif ($item->status_pengajuan == 'Approved')
                                <tr class="table-success">
                                @else
                                <tr class="table-danger">
                            @endif

                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->jenis_magang }}</td>
                            <td>{{ $item->rentang_waktu_mulai }} - {{ $item->rentang_waktu_selesai }}</td>
                            <td>
                                {{ $item->status_pengajuan }}
                            </td>
                            <td>
                                @if (auth()->user()->level == 'admin')
                                    <button class="btn btn-warning btn-sm rounded-0" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $item->id }}">
                                        Edit
                                    </button>

                                    <button class="btn btn-danger btn-sm rounded-0" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $item->id }}">
                                        Hapus
                                    </button>
                                @else
                                    @if ($item->status_pengajuan == 'Pending')
                                        <button class="btn btn-success btn-sm rounded-0" data-bs-toggle="modal"
                                            data-bs-target="#StatusModal{{ $item->id }}">
                                            Verifikasi
                                        </button>
                                    @elseif ($item->status_pengajuan == 'Approved')
                                        <a class="btn btn-success btn-sm rounded-0" href="">
                                            Lihat partisipasi
                                        </a>
                                    @else
                                        <span>Ditolak</span>
                                    @endif
                                @endif
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="body-wrapper">
            <div class="container mt-5 pt-5">
                <h2 class="text-center mb-4">Program Magang</h2>
                <div class="m-4">
                    {{-- @include('component.alert') --}}
                    <div class="alert alert-warning">
                        <div class="text-muted">
                            <p><strong>Peringatan!</strong> Diharapkan untuk mengisi form terlebih dahulu yang sudah disediakan sebelum mendaftarkan program magang. Anda bisa click link <a href="{{route('biodata.index')}}">disini</a> untuk melengkapi data</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    @foreach ($magang as $item)
                        <div class="col-4">
                            <div class="card shadow">
                                <img src="{{ asset('image/magang.jpeg') }}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">Program {{ $item->jenis_magang }}</h5>
                                    <p class="card-text">Pelaksanaan
                                        <br>
                                        <span
                                            class="fs-1 text-muted">{{ \Carbon\Carbon::parse($item->rentang_waktu_mulai)->format('d F Y') }}
                                            -
                                            {{ \Carbon\Carbon::parse($item->rentang_waktu_selesai)->format('d F Y') }}</span>
                                    </p>

                                    <button class="btn btn-info btn-sm rounded-0" data-bs-toggle="modal"
                                        data-bs-target="#ProgramModal{{ $item->id }}">
                                        Daftar sekarang
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif


    @include('auth.magang.__modal')
@endsection
