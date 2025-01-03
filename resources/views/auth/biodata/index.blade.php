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
                    <h3 class="text-center">Form Data Mahasiswa/Siswa</h3>
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

                    <form action="{{ route('biodata.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Step 1 -->
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <div class="step active" id="step1">
                            <div class="mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control rounded-0 p-2 border-dark" id="tempat_lahir"
                                    name="tempat_lahir" required>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control rounded-0 p-2 border-dark" id="tanggal_lahir"
                                    name="tanggal_lahir" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-control rounded-0 p-2 border-dark" id="jenis_kelamin"
                                    name="jenis_kelamin" required>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-dark rounded-0" onclick="nextStep(2)">Selanjutnya</button>
                        </div>

                        <!-- Step 2 -->
                        <div class="step" id="step2">
                            <div class="mb-3">
                                <label for="sekolah_id" class="form-label">Nama Sekolah/ Perguruan Tinggi</label>
                                <select class="form-select rounded-0 p-2 border-dark" id="sekolah_id" name="sekolah_id"
                                    required>
                                    <option value="" disabled selected>Pilih Sekolah</option>
                                    @foreach ($sekolahs as $sekolah)
                                        <option value="{{ $sekolah->id }}">{{ $sekolah->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="jurusan_id" class="form-label">Jurusan</label>
                                <select class="form-select rounded-0 p-2 border-dark" id="jurusan_id" name="jurusan_id" disabled
                                    required>
                                    <option value="" disabled selected>Pilih Jurusan</option>
                                </select>
                            </div>
                            <button type="button" class="btn btn-secondary rounded-0"
                                onclick="prevStep(1)">Kembali</button>
                            <button type="button" class="btn btn-dark rounded-0" onclick="nextStep(3)">Selanjutnya</button>
                        </div>

                        <!-- Step 3 -->
                        <div class="step" id="step3">
                            <h3>Foto dan CV</h3>
                            <div class="mb-3">
                                <label for="jenis_magang" class="form-label">Foto formal</label>
                                <input type="file" name="image" id="image"
                                    class="form-control rounded-0 p-2 border-dark">
                            </div>
                            <div class="mb-3">
                                <label for="cv" class="form-label">Upload Cv / Berkas pendukung</label>
                                <input type="file" class="form-control rounded-0 p-2 border-dark" id="cv"
                                    name="cv" required>
                            </div>
                            <button type="button" class="btn btn-secondary rounded-0"
                                onclick="prevStep(2)">Kembali</button>
                            <button type="submit" class="btn btn-success rounded-0">Tambah</button>
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



        document.addEventListener('DOMContentLoaded', function() {
            const sekolahSelect = document.getElementById('sekolah_id');
            const jurusanSelect = document.getElementById('jurusan_id');

            sekolahSelect.addEventListener('change', function() {
                const sekolahId = this.value;
                // alert(sekolahId)
                jurusanSelect.innerHTML = '<option value="" disabled selected>Pilih Jurusan</option>';
                jurusanSelect.disabled = true;
                fetch(`/api/sekolah/${sekolahId}/jurusan`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            jurusanSelect.disabled = false;
                            data.forEach(jurusan => {
                                const option = document.createElement('option');
                                option.value = jurusan.id;
                                option.textContent = jurusan.name;
                                jurusanSelect.appendChild(option);
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching jurusan:', error);
                    });
            });
        });
    </script>
@endsection
