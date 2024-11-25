@extends('auth.component.app')


@section('content')
<div class="body-wrapper">
    <div class="container my-5 pt-5">
        <h2 class="text-center mb-4 ">Users Manajement</h2>
        <div class="m-2">
            @include('component.alert')
        </div>
        <button class="btn btn-dark rounded-0 mb-3" data-bs-toggle="modal" data-bs-target="#createModal">Tambah Pengguna</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Level</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->level }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm rounded-0" data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $user->id }}">Edit</button>
                            <button class="btn btn-danger btn-sm rounded-0" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $user->id }}">Hapus</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Data tidak tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>



    </div>
</div>

@include('auth.user.__modal')
@endsection
