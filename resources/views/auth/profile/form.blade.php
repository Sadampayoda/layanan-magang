@extends('component.app')

@section('content')
    <style>
        .step {
            display: none;
        }

        .step.active {
            display: block;
        }
    </style>
    <div class="container p-5">
        <div class="row p-1">
            <div class="col">
                <h3 class="text-center">Form data mahasiswa/siswa</h3>
            </div>
        </div>
        <div class="row d-flex justify-content-center mb-4">
            <div class="col-3 m-1 p-1 border bg-info rounded-pill">

            </div>
            <div class="col-3 m-1 p-1 border  rounded-pill">

            </div>
            <div class="col-3 m-1 p-1 border  rounded-pill">

            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-9">

                <form id="magangForm">

                    <div class="step active" id="step1">

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control rounded-0 p-2 border-dark" id="nama"
                                name="nama" required>
                        </div>
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
                            <select class="form-control rounded-0 p-2 border-dark" id="jenis_kelamin" name="jenis_kelamin"
                                required>
                                <option value="L">Laki-Laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-dark rounded-0" onclick="nextStep(2)">Selanjutnya</button>
                    </div>


                    <div class="step" id="step2">
                        <div class="mb-3">
                            <label for="nama_sekolah" class="form-label">Nama Sekolah/ Perguruan Tinggi</label>
                            <input type="text" class="form-control rounded-0 p-2 border-dark" id="nama_sekolah"
                                name="nama_sekolah" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat_sekolah" class="form-label">Alamat Sekolah</label>
                            <input type="text" class="form-control rounded-0 p-2 border-dark" id="alamat_sekolah"
                                name="alamat_sekolah" required>
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control rounded-0 p-2 border-dark" id="jurusan"
                                name="jurusan" required>
                        </div>
                        <button type="button" class="btn btn-secondary rounded-0" onclick="prevStep(1)">Kembali</button>
                        <button type="button" class="btn btn-dark rounded-0" onclick="nextStep(3)">Selanjutnya</button>
                    </div>


                    <div class="step" id="step3">
                        <h3>Pilihan Magang</h3>
                        <div class="mb-3">
                            <label for="jenis_magang" class="form-label">Jenis Magang</label>
                            <select class="form-control rounded-0 p-2 border-dark" id="jenis_magang" name="jenis_magang"
                                required>
                                <option value="PKL">PKL</option>
                                <option value="Prakerin">Prakerin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="waktu_magang" class="form-label">Rentang Waktu Pelaksanaan Magang</label>
                            <input type="text" class="form-control rounded-0 p-2 border-dark" id="waktu_magang"
                                name="waktu_magang" required>
                        </div>
                        <button type="button" class="btn btn-secondary rounded-0" onclick="prevStep(2)">Kembali</button>
                        <button type="submit" class="btn btn-success rounded-0">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>

        function nextStep(step) {
            document.querySelector(`#step${step - 1}`).classList.remove('active');
            document.querySelector(`#step${step}`).classList.add('active');
        }


        function prevStep(step) {
            document.querySelector(`#step${step + 1}`).classList.remove('active');
            document.querySelector(`#step${step}`).classList.add('active');
        }


        document.getElementById('magangForm').addEventListener('submit', function(event) {
            event.preventDefault();
            alert('Form Submitted');
        });
    </script>
@endsection
