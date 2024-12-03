@foreach ($data as $item)
    <div class="modal fade" id="StatusModal{{ $item->user->id }}" tabindex="-1"
        aria-labelledby="deleteModalLabel{{ $item->user->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('kegiatan.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- <input type="hidden" name="name" value="{{auth()->user()->name}}"> --}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Verifikasi Pengajuan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="status" class="form-label">Apakah menyetujuin mahasiswa {{$item->user->name}}?</label>
                            <select name="status" class="form-select" required>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-0"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success rounded-0">Verifikasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endforeach

