@extends('component.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-6"
                style="
                background-image: url({{ asset('image/validate/login.jpg') }});
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;  ">
            </div>
            <div class="col-6">
                <div class="row d-flex vh-100 justify-content-center align-items-center">
                    <div class="col-7">
                        <form action="{{ route('register.authentication') }}" method="POST">
                            <h1 class="border-bottom pb-3 text-center">Registrasi Magang</h1>
                            @csrf
                            @include('component.alert')
                            <!-- Input Name -->
                            <div class="mb-3 mt-5">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control rounded-0 p-2" id="name" name="name"
                                    placeholder="Masukkan nama" required>
                            </div>

                            <!-- Input Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control rounded-0 p-2" id="email" name="email"
                                    placeholder="Masukkan email" required>
                            </div>

                            <!-- Input Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control rounded-0 p-2" id="password" name="password"
                                    placeholder="Masukkan password" required>
                            </div>

                            <!-- Input Konfirmasi Password -->
                            <div class="mb-5">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control rounded-0 p-2" id="password_confirmation"
                                    name="password_confirmation" placeholder="Masukkan ulang password" required>
                            </div>


                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark rounded-0">Register</button>
                            </div>


                            <p class="text-center mt-3 border-top p-3">
                                Sudah punya akun?
                                <a href="{{ route('login') }}" class="text-decoration-none">Silahkan Login</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
