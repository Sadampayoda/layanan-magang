@foreach ($opds as $opd)
    <div class="modal fade" id="createModal-{{$opd->id}}" tabindex="-1" aria-labelledby="createModalLabel-{{ $opd->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('opd.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel-{{ $opd->id }}">Tambah OPD</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                            <input name="user_id" type="hidden" id="user_id" class="form-control" value="{{ $opd->id }}"
                                required>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="kontak" class="form-label">Kontak</label>
                            <input type="text" name="kontak" id="kontak" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary rounded-0">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>




@endforeach
