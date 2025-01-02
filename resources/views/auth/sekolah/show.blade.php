@extends('auth.component.app')

@section('content')
<div class="body-wrapper">
    <div class="container pt-5 mt-5">
        <h2 class="mb-4">Detail Sekolah: {{ $sekolah->name }}</h2>
        <div class="row">
            <div class="col-12 mb-4">
                <table class="table table-bordered">
                    <tr>
                        <th>Nama Sekolah</th>
                        <td>{{ $sekolah->name }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $sekolah->description }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $sekolah->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Gambar</th>
                        <td>
                            <img src="{{ asset('storage/' . $sekolah->image) }}" alt="{{ $sekolah->name }}" style="width: 300px; height: auto;">
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <h3 class="mt-4 mb-3">Daftar Jurusan</h3>
        <div class="mb-3">
            <button class="btn btn-primary rounded-0" data-bs-toggle="modal" data-bs-target="#createJurusanModal">Tambah Jurusan</button>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Jurusan</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sekolah->jurusan as $index => $jurusans)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $jurusans->name }}</td>
                        <td>{{ $jurusans->description }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm rounded-0" data-bs-toggle="modal" data-bs-target="#editJurusanModal{{ $jurusans->id }}">Edit</button>
                            <form action="{{ route('jurusan.destroy', $jurusans->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm rounded-0" onclick="return confirm('Yakin ingin menghapus jurusan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>


                    <div class="modal fade" id="editJurusanModal{{ $jurusans->id }}" tabindex="-1" aria-labelledby="editJurusanModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editJurusanModalLabel">Edit Jurusan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('jurusan.update', $jurusans->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nama Jurusan</label>
                                            <input type="text" class="form-control" name="name" value="{{ $jurusans->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" name="description" rows="4" required>{{ $jurusans->description }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary rounded-0">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada jurusan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="createJurusanModal" tabindex="-1" aria-labelledby="createJurusanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createJurusanModalLabel">Tambah Jurusan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('jurusan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="sekolah_id" value="{{ $sekolah->id }}">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Jurusan</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="description" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary rounded-0">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
