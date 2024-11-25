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
                    <div class="col-8">
                        <form action="" method="POST">
                            <h1 class="border-bottom pb-3 text-center">Login Magang</h1>

                            <!-- Input Email -->
                            <div class="mb-3 mt-5">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control rounded-0 p-2" id="email" name="email"
                                    placeholder="Masukkan email" required>
                            </div>

                            <!-- Input Password -->
                            <div class="mb-5">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control rounded-0 p-2" id="password" name="password"
                                    placeholder="Masukkan password" required>
                            </div>

                            <!-- Button Login -->
                            <div class="d-grid ">
                                <button type="submit" class="btn btn-dark rounded-0">Login</button>
                            </div>

                            <!-- Link ke Register -->
                            <p class="text-center mt-3 border-top p-3">
                                Belum punya akun?
                                <a href="{{ route('register') }}" class="text-decoration-none">Silahkan Register</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
