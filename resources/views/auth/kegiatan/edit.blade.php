@extends('auth.component.app')

@section('content')
    <div class="body-wrapper">
        <div class="container mt-5 pt-5">
            <h2 class="text-center mb-4">Verifikasi Mahasiswa </h2>
            <div class="m-4">
                @include('component.alert')
            </div>
            <table class="table table-bordered ">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Berkas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @dd($data) --}}
                    @foreach ($data as $item)
                        {{-- @dd($item) --}}
                        @if ($item->status == 'Pending')
                            <tr class="table-warning">
                            @elseif ($item->status == 'Approved')
                            <tr class="table-success">
                            @else
                            <tr class="table-danger">
                        @endif

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->user->email }}</td>
                        <td>
                            <a class="btn btn-success btn-sm rounded-0" href="{{ route('kegiatan.show', $item->user->id) }}">
                                Form data
                            </a>
                        </td>
                        <td>
                            {{ $item->status }}
                        </td>
                        <td>


                            @if ($item->status == 'Pending')
                                <button class="btn btn-success btn-sm rounded-0" data-bs-toggle="modal"
                                    data-bs-target="#StatusModal{{ $item->user->id }}">
                                    Verifikasi
                                </button>
                            @elseif ($item->status == 'Approved')
                                <span>Diterima</span>
                            @else
                                <span>Ditolak</span>
                            @endif

                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('auth.kegiatan.__model')
@endsection
