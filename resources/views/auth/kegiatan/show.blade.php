@extends('auth.component.app')

@section('content')
    {{-- @dd($data) --}}
    <div class="body-wrapper">
        <div class="container mt-5 pt-5">
            <h2 class="mb-4">Detail Biodata {{ $data->name }}</h2>
            <div class="row d-flex justify-content-center">
                <div class="col-5">
                    <div class="d-grid">
                        <button type="button" class="btn btn-primary rounded-0" data-bs-toggle="modal"
                            data-bs-target="#pdfModal">
                            Lihat CV (PDF)
                        </button>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped">
                @if (empty($data->biodata))
                    <tbody>
                        <tr>
                            <td class="text-center">Data form mahasiswa {{ $data->name }} belum terisi</td>
                        </tr>
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <th>Poto</th>
                            <td><img src="{{ asset('storage/' . $data->biodata->image) }}" alt="Foto Formal"
                                    class="img-fluid " width="200" height="200"></td>
                        </tr>
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
                            <td>{{ $data->biodata->sekolah->name }}</td>
                        </tr>
                        <tr>
                            <th>Poto Sekolah</th>
                            <td><img src="{{ asset('storage/' . $data->biodata->sekolah->image) }}" alt="Foto Formal"
                                    class="img-fluid " width="200" height="200"></td>
                        </tr>
                        <tr>
                            <th>Alamat Sekolah</th>
                            <td>{{ $data->biodata->sekolah->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Deskripsi Sekolah</th>
                            <td>{{ $data->biodata->sekolah->description }}</td>
                        </tr>
                        <tr>
                            <th>Jurusan</th>
                            <td>{{ $data->biodata->jurusan->name }}</td>
                        </tr>
                    </tbody>
                @endif

            </table>
        </div>
    </div>

    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Lihat CV</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <iframe src="{{ asset('cv/' . $data->biodata->cv) }}" width="100%" height="500px"
                        frameborder="0">
                        Your browser does not support PDFs.
                        <a href="{{ asset('cv/' . $data->biodata->cv) }}">Download PDF</a>
                    </iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
