@extends('auth.component.app')

@section('content')
    @if (auth()->user()->level != 'mahasiswa')
        <div class="body-wrapper">
            <div class="container mt-5 pt-5">
                <h2 class="mb-4">Detail Syarat {{ $data->title }}</h2>
                @include('component.alert')

                @if (auth()->user()->level == 'admin')
                    <button type="button" class="btn btn-dark rounded-0 mb-3" data-bs-toggle="modal"
                        data-bs-target="#createModal">
                        Tambah Syarat
                    </button>
                @endif

                <!-- Tabel data syarat -->
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Deskripsi</th>
                            @if (auth()->user()->level == 'admin')
                                <th>Aksi</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->syarat as $item)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->description }}</td>
                                @if (auth()->user()->level == 'admin')
                                    <td>

                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $item->id }}">Edit</button>


                                        <form action="{{ route('syarat.destroy', $item->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Hapus data ini?')">Hapus</button>

                                        </form>
                                    </td>
                                @endif
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('syarat.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Syarat
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="description{{ $item->id }}"
                                                        class="form-label">Deskripsi</label>
                                                    <textarea name="description" id="description{{ $item->id }}" class="form-control" required>{{ $item->description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <div class="body-wrapper">
            <div class="container mt-5 pt-5">
                <h1>{{ $data->title }}</h1>

                <!-- Tabel informasi magang -->
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <th>Jenis Magang</th>
                            <td>{{ $data->jenis_magang }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ $data->description }}</td>
                        </tr>
                        <tr>
                            <th>Rentang Waktu</th>
                            <td>{{ \Carbon\Carbon::parse($data->rentang_waktu_mulai)->format('d F Y') }} -
                                {{ \Carbon\Carbon::parse($data->rentang_waktu_selesai)->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Mulai Pendaftaran</th>
                            <td>{{ \Carbon\Carbon::parse($data->mulai_pendaftaran)->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Tutup Pendaftaran</th>
                            <td>{{ \Carbon\Carbon::parse($data->tutup_pendaftaran)->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td><img src="{{ asset('storage/' . $data->image) }}" alt="{{ $data->title }}" width="200" height="200" class="img-fluid rounded"></td>
                        </tr>
                        <tr>
                            <th>Persyaratan</th>
                            <td><ul>
                                @foreach ($data->syarat as $syarat)
                                    <li class="mb-1"> - {{ $syarat->description }}</li>
                                @endforeach
                            </ul></td>
                        </tr>
                        <tr>
                            <th class="text-center" colspan="2">Informasi OPD</th>
                        </tr>
                        <tr>
                            <th class="w-25">Nama OPD</th>
                            <td>{{ $data->user->name }}</td>
                        </tr>
                        <tr>
                            <th>Email OPD</th>
                            <td>{{ $data->user->email }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ @$data->user->opd->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{{ @$data->user->opd->deskripsi }}</td>
                        </tr>
                        <tr>
                            <th>Kontak</th>
                            <td>{{ @$data->user->opd->kontak }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    @endif

    <!-- Modal Create -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('syarat.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Syarat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <input type="hidden" name="magang_id" value="{{ $data->id }}">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
