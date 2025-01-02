@extends('auth.component.app')

@section('content')
    {{-- @dd($opds) --}}
    <div class="body-wrapper">
        <div class="container pt-5 mt-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-4">Daftar OPD</h2>
                    @include('component.alert')
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama OPD</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($opds as $index => $opd)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $opd->name }}</td>

                                    <td>
                                        @if ($opd->opd)
                                            <a class="btn btn-success btn-sm rounded-0" href="{{ route('opd.show', $opd->id) }}">Show</a>
                                        @else
                                            <button class="btn btn-primary rounded-0 btn-sm " data-bs-toggle="modal"
                                                data-bs-target="#createModal-{{ $opd->id }}">Tambah OPD</button>
                                        @endif


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    @include('auth.opd.__modal')
@endsection
