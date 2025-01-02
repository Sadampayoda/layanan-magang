@foreach ($data as $index => $user)
    <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1"
        aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit Pengguna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $user->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <select class="form-control" id="level" name="level" required>
                                <option value="mahasiswa" {{ $user->level == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa
                                </option>
                                <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>
                                    Admin</option>
                                <option value="opd" {{ $user->level == 'opd' ? 'selected' : '' }}>OPD
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-0"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success border-0">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1"
        aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Hapus Pengguna
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus pengguna <strong>{{ $user->name }}</strong>?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-0"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger rounded-0">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="resetPasswordModal{{$user->id}}" tabindex="-1" aria-labelledby="resetPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resetPasswordModalLabel">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('reset.password') }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <div class="mb-3">
                            <label for="new-password" class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="new-password" name="new_password"
                                placeholder="Masukkan password baru" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="confirm-password"
                                name="confirm_password" placeholder="Konfirmasi password baru" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary rounded-0">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" required>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select class="form-control" id="level" name="level" required>
                            <option value="mahasiswa">Mahasiswa</option>
                            <option value="admin">Admin</option>
                            <option value="opd">OPD</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success rounded-0">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
