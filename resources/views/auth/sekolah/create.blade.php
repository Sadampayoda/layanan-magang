@extends('auth.component.app')

@section('content')
<div class="body-wrapper">
    <div class="container pt-5 mt-5">
        <h2 class="mb-4">Tambah Sekolah</h2>
        @include('component.alert')
        <form action="{{ route('sekolah.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Sekolah</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar Sekolah</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}" required>
            </div>
            <button type="submit" class="btn btn-primary rounded-0">Simpan</button>
            <a href="{{ route('sekolah.index') }}" class="btn btn-secondary rounded-0">Batal</a>
        </form>
    </div>
</div>
@endsection
