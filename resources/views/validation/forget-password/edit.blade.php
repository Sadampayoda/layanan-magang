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
                        <form action="{{ route('forget-password.update') }}" method="POST">
                            <h1 class="border-bottom pb-3 text-center">Reset password</h1>
                            @csrf
                            @include('component.alert')
                            <input type="hidden" name="token" value="{{$token}}">
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="newPassword" name="new_password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="confirmPassword" name="new_password_confirmation"
                                    required>
                            </div>
                            <div class="d-grid ">
                                <button type="submit" class="btn btn-dark rounded-0">Ubah password</button>
                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
