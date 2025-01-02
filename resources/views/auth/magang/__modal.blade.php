@foreach ($magang as $index => $item)
    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
        aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('magang.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Magang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                        <div class="mb-3">
                            <label for="user_id" class="form-label">OPD Tujuan</label>
                            <select name="user_id" class="form-select" required>
                                @foreach ($opd as $o)
                                    <option value="{{ $o->id }}"
                                        {{ $item->user_id == $o->id ? 'selected' : '' }}>{{ $o->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul</label>
                            <input type="text" name="title" class="form-control" value="{{ $item->title }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">
                            @if ($item->image)
                                <small class="text-muted">File saat ini: <a href="{{ Storage::url($item->image) }}"
                                        target="_blank">Lihat Gambar</a></small>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="jenis_magang" class="form-label">Jenis Magang</label>
                            <select name="jenis_magang" class="form-select" required>
                                <option value="Magang" {{ $item->jenis_magang == 'Magang' ? 'selected' : '' }}>Magang
                                </option>
                                <option value="PKL" {{ $item->jenis_magang == 'PKL' ? 'selected' : '' }}>PKL
                                </option>
                                <option value="Prakerin" {{ $item->jenis_magang == 'Prakerin' ? 'selected' : '' }}>
                                    Prakerin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="rentang_waktu_mulai" class="form-label">Tanggal Mulai</label>
                            <input type="date" name="rentang_waktu_mulai" class="form-control"
                                value="{{ $item->rentang_waktu_mulai }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="rentang_waktu_selesai" class="form-label">Tanggal Selesai</label>
                            <input type="date" name="rentang_waktu_selesai" class="form-control"
                                value="{{ $item->rentang_waktu_selesai }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="mulai_pendaftaran" class="form-label">Mulai Pendaftaran</label>
                            <input type="date" name="mulai_pendaftaran" class="form-control"
                                value="{{ $item->mulai_pendaftaran }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="tutup_pendaftaran" class="form-label">Selesai Pendaftaran</label>
                            <input type="date" name="tutup_pendaftaran" class="form-control"
                                value="{{ $item->tutup_pendaftaran }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ $item->description }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-0"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary rounded-0">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal fade" id="infoModal{{$item->id}}" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel">Informasi Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Image -->
                    <div class="mb-3 text-center">
                        <img id="modalImage" src="{{asset('storage/'.$item->image)}}" alt="Image" class="img-fluid rounded" style="max-height: 200px;">
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="modalDescription" class="form-label">Deskripsi</label>
                        <textarea id="modalDescription" class="form-control" rows="3" disabled>{{$item->description}}</textarea>
                    </div>

                    <!-- Mulai Pendaftaran -->
                    <div class="mb-3">
                        <label for="modalMulaiPendaftaran" class="form-label">Mulai Pendaftaran</label>
                        <input type="date" id="modalMulaiPendaftaran" class="form-control" value="{{$item->mulai_pendaftaran}}" disabled>
                    </div>

                    <!-- Tutup Pendaftaran -->
                    <div class="mb-3">
                        <label for="modalTutupPendaftaran" class="form-label">Tutup Pendaftaran</label>
                        <input type="date" id="modalTutupPendaftaran" class="form-control" value="{{$item->tutup_pendaftaran}}" disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
        aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('magang.destroy', $item->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    {{-- <input type="hidden" name="name" value="{{auth()->user()->name}}"> --}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Hapus Pengajuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus pengajuan ini?
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






    <div class="modal fade" id="ProgramModal{{ $item->id }}" tabindex="-1"
        aria-labelledby="ProgramModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('kegiatan.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="magang_id" value="{{ $item->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ProgramModalLabel{{ $item->id }}">Program
                            {{ $item->jenis_magang }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="rentang_waktu_mulai" class="form-label">Tanggal Mulai</label>
                            <input disabled type="date" name="rentang_waktu_mulai" class="form-control"
                                value="{{ $item->rentang_waktu_mulai }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="rentang_waktu_selesai" class="form-label">Tanggal Selesai</label>
                            <input disabled type="date" name="rentang_waktu_selesai" class="form-control"
                                value="{{ $item->rentang_waktu_selesai }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea disabled class="form-control" name="description" id="description" cols="30" rows="10">{{ $item->description }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-0"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success rounded-0">Daftar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('magang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Tambah Magang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                    <div class="mb-3">
                        <label for="user_id" class="form-label">OPD Tujuan</label>
                        <select name="user_id" class="form-select" required>
                            @foreach ($opd as $o)
                                <option value="{{ $o->id }}">{{ $o->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_magang" class="form-label">Jenis Magang</label>
                        <select name="jenis_magang" class="form-select" required>
                            <option value="Magang">Magang</option>
                            <option value="PKL">PKL</option>
                            <option value="Prakerin">Prakerin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="rentang_waktu_mulai" class="form-label">Tanggal Mulai</label>
                        <input type="date" name="rentang_waktu_mulai" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="rentang_waktu_selesai" class="form-label">Tanggal Selesai</label>
                        <input type="date" name="rentang_waktu_selesai" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="mulai_pendaftaran" class="form-label">Mulai Pendaftaran</label>
                        <input type="date" name="mulai_pendaftaran" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tutup_pendaftaran" class="form-label">Selesai Pendaftaran</label>
                        <input type="date" name="tutup_pendaftaran" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
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
