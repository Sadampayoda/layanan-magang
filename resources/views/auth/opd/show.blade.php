@extends('auth.component.app')

@section('content')
    {{-- @dd($data) --}}
    <div class="body-wrapper">
        <div class="container mt-5 pt-5">
            <h2 class="mb-4">Detail Biodata OPD {{ $data->user->name }}</h2>
            @include('component.alert')

            <table class="table table-bordered table-striped">
                <tbody>
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
                        <td>{{ $data->alamat }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $data->deskripsi }}</td>
                    </tr>
                    <tr>
                        <th>Kontak</th>
                        <td>{{ $data->kontak }}</td>
                    </tr>
                    <tr>
                        <th>Aksi</th>
                        <td>
                            <button class="btn btn-warning btn-sm rounded-0" data-bs-toggle="modal"
                                data-bs-target="#editModal">Edit</button>
                            <form action="{{ route('opd.destroy', $data->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm rounded-0"
                                    onclick="return confirm('Hapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div class="modal fade" id="editModal" tabindex="-1"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('opd.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit OPD</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" required>{{ $data->alamat }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control">{{ $data->deskripsi }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="kontak" class="form-label">Kontak</label>
                            <input type="text" name="kontak" id="kontak" class="form-control"
                                value="{{ $data->kontak }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
