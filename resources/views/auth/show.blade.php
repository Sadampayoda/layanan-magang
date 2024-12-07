@extends('auth.component.app')

@section('content')
    {{-- @dd($data) --}}
    <div class="body-wrapper">
        <div class="container mt-5 pt-5">
            <h2 class="mb-4">Detail Biodata {{$data->name}}</h2>
            <table class="table table-bordered table-striped">
                @if (empty($data->biodata) )
                    <tbody>
                        <tr>
                            <td class="text-center">Data form mahasiswa {{ $data->name }} belum terisi</td>
                        </tr>
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <th class="w-25">Tempat Lahir</th>
                            <td>{{ $data->biodata->tempat_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ \Carbon\Carbon::parse($data->biodata->tanggal_lahir)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $data->biodata->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</td>
                        </tr>
                        <tr>
                            <th>Nama Sekolah/ Perguruan Tinggi</th>
                            <td>{{ $data->biodata->nama_sekolah }}</td>
                        </tr>
                        <tr>
                            <th>Alamat Sekolah</th>
                            <td>{{ $data->biodata->alamat_sekolah }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>{{ $data->biodata->jurusan }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Magang</th>
                            <td>{{ $data->biodata->jenis_magang }}</td>
                        </tr>
                        <tr>
                            <th>Rentang Waktu Pelaksanaan Magang</th>
                            <td>{{ $data->biodata->waktu_magang }}</td>
                        </tr>
                    </tbody>
                @endif

            </table>
        </div>
    </div>
@endsection
