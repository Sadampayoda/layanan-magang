@extends('auth.component.app')


@section('content')
    <div class="body-wrapper">
        <div class="container pt-5 mt-5">
            <div class="row">
                <div class="col-10">
                    <h2>Ubah password</h2>
                    @include('component.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-10">
                    <form id="changePasswordForm" action="{{ route('change.password') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="currentPassword" class="form-label">Password Lama</label>
                            <input type="password" class="form-control" id="currentPassword" name="current_password"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="newPassword" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="confirmPassword" name="new_password_confirmation"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Ubah Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
