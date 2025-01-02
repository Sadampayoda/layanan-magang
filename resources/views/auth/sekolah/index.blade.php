@extends('auth.component.app')

@section('content')
    <div class="body-wrapper">
        <div class="container pt-5 mt-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-4">Daftar Sekolah</h2>
                    @include('component.alert')
                    <a href="{{ route('sekolah.create') }}" class="btn btn-primary rounded-0 mb-3">Tambah Sekolah</a>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Gambar</th>
                                <th>Deskripsi</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $index => $sekolah)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $sekolah->name }}</td>
                                    <td><img src="{{ asset('storage/' . $sekolah->image) }}" alt="{{ $sekolah->name }}"
                                            style="width: 100px; height: auto;"></td>
                                    <td>{{ $sekolah->description }}</td>
                                    <td>{{ $sekolah->alamat }}</td>
                                    <td>
                                        <a href="{{ route('sekolah.show', $sekolah->id) }}"
                                            class="btn btn-success rounded-0 btn-sm">Lihat</a>
                                        <a href="{{ route('sekolah.edit', $sekolah->id) }}"
                                            class="btn btn-warning rounded-0 btn-sm">Edit</a>
                                        <form action="{{ route('sekolah.destroy', $sekolah->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger rounded-0 btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
