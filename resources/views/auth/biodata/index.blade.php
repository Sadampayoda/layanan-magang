@extends('auth.component.app')

@section('content')
    <style>
        .step {
            display: none;
        }

        .step.active {
            display: block;
        }
    </style>
    <div class="body-wrapper">
        <div class="container mt-5 p-5">
            <div class="row p-1">
                <div class="col">
                    <h3 class="text-center">Form data mahasiswa/siswa</h3>
                </div>
            </div>
            <div class="row d-flex justify-content-center mb-4">
                <div class="col-3 m-1 p-1 border rounded-pill bg-info" id="step-indicator-1"></div>
                <div class="col-3 m-1 p-1 border rounded-pill" id="step-indicator-2"></div>
                <div class="col-3 m-1 p-1 border rounded-pill" id="step-indicator-3"></div>
            </div>
            <div class="row">
                <div class="col">
                    @include('component.alert')
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-9">

                    <form
                        action="{{ $biodata ? route('biodata.update', ['biodatum' => $biodata->id]) : route('biodata.store') }}"
                        method="POST">
                        @csrf
                        @if ($biodata)
                            @method('PUT')
                        @endif
                        {{-- @dd($biodata) --}}
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                        <!-- Step 1 -->
                        <div class="step active" id="step1">
                            <div class="mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control rounded-0 p-2 border-dark" id="tempat_lahir"
                                    name="tempat_lahir" value="{{ $biodata->tempat_lahir ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control rounded-0 p-2 border-dark" id="tanggal_lahir"
                                    name="tanggal_lahir" value="{{ $biodata->tanggal_lahir ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-control rounded-0 p-2 border-dark" id="jenis_kelamin"
                                    name="jenis_kelamin" required>
                                    @if ($biodata)
                                        <option value="L" {{ $biodata->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                            Laki-Laki
                                        </option>
                                        <option value="P" {{ $biodata->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                            Perempuan
                                        </option>
                                    @else
                                        <option value="L">
                                            Laki-Laki
                                        </option>
                                        <option value="P">
                                            Perempuan
                                        </option>
                                    @endif
                                </select>
                            </div>
                            <button type="button" class="btn btn-dark rounded-0" onclick="nextStep(2)">Selanjutnya</button>
                        </div>

                        <!-- Step 2 -->
                        <div class="step" id="step2">
                            <div class="mb-3">
                                <label for="nama_sekolah" class="form-label">Nama Sekolah/ Perguruan Tinggi</label>
                                <input type="text" class="form-control rounded-0 p-2 border-dark" id="nama_sekolah"
                                    name="nama_sekolah" value="{{ $biodata->nama_sekolah ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="alamat_sekolah" class="form-label">Alamat Sekolah</label>
                                <input type="text" class="form-control rounded-0 p-2 border-dark" id="alamat_sekolah"
                                    name="alamat_sekolah" value="{{ $biodata->alamat_sekolah ?? '' }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="jurusan" class="form-label">Jurusan</label>
                                <input type="text" class="form-control rounded-0 p-2 border-dark" id="jurusan"
                                    name="jurusan" value="{{ $biodata->jurusan ?? '' }}" required>
                            </div>
                            <button type="button" class="btn btn-secondary rounded-0"
                                onclick="prevStep(1)">Kembali</button>
                            <button type="button" class="btn btn-dark rounded-0" onclick="nextStep(3)">Selanjutnya</button>
                        </div>

                        <!-- Step 3 -->
                        <div class="step" id="step3">
                            <h3>Pilihan Magang</h3>
                            <div class="mb-3">
                                <label for="jenis_magang" class="form-label">Jenis Magang</label>
                                <select class="form-control rounded-0 p-2 border-dark" id="jenis_magang" name="jenis_magang"
                                    required>
                                    @if ($biodata)
                                        <option value="PKL" {{ $biodata->jenis_magang == 'PKL' ? 'selected' : '' }}>PKL
                                        </option>
                                        <option value="Prakerin"
                                            {{ $biodata->jenis_magang == 'Prakerin' ? 'selected' : '' }}>
                                            Prakerin</option>
                                        <option value="Magang" {{ $biodata->jenis_magang == 'Magang' ? 'selected' : '' }}>
                                            Magang</option>
                                    @else
                                        <option value="PKL">PKL
                                        </option>
                                        <option value="Prakerin">
                                            Prakerin</option>
                                        <option value="Magang">
                                            Magang</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="waktu_magang" class="form-label">Rentang Waktu Pelaksanaan Magang</label>
                                <input type="text" class="form-control rounded-0 p-2 border-dark" id="waktu_magang"
                                    name="waktu_magang" value="{{ $biodata->waktu_magang ?? '' }}" required>
                            </div>
                            <button type="button" class="btn btn-secondary rounded-0"
                                onclick="prevStep(2)">Kembali</button>
                            <button type="submit"
                                class="btn btn-success rounded-0">{{ $biodata ? 'Update' : 'Submit' }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        function updateStepIndicator(step) {
            document.querySelectorAll('.col-3').forEach((indicator, index) => {
                if (index < step) {
                    indicator.classList.add('bg-info');
                } else {
                    indicator.classList.remove('bg-info');
                }
            });
        }

        function nextStep(step) {
            document.querySelector(`#step${step - 1}`).classList.remove('active');
            document.querySelector(`#step${step}`).classList.add('active');
            updateStepIndicator(step);
        }

        function prevStep(step) {
            document.querySelector(`#step${step + 1}`).classList.remove('active');
            document.querySelector(`#step${step}`).classList.add('active');
            updateStepIndicator(step);
        }
    </script>
@endsection
