@extends('auth.component.app')

@section('content')
    <div class="body-wrapper">
        <div class="container mt-5 pt-5">
            @if (auth()->user()->level == 'mahasiswa')
                <div class="row">
                    <div class="col">
                        <h2>Kegiatan magang</h2>
                        @include('component.alert')
                    </div>
                </div>
                <div class="row mt-3">
                    @foreach ($data as $item)
                        @if ($item->status == 'Rejected')
                            @php
                                $status = 'bg-danger-subtle';
                            @endphp
                        @elseif ($item->status == 'Approved')
                            @php
                                $status = 'bg-success-subtle';
                            @endphp
                        @else
                            @php
                                $status = 'bg-warning-subtle';
                            @endphp
                        @endif
                        <div class="col-12 p-4 border-top {{ $status }} ">
                            <div class="row">
                                <div class="col-4">
                                    <img src="{{ asset('image/magang.jpeg') }}" class="card-img-top" alt="...">
                                </div>
                                <div class="col-7">
                                    <h5>Pelaksanaan {{ $item->magang->jenis_magang }} - <span>{{ $item->status }}</span>
                                    </h5>
                                    <span>{{ $item->magang->description }}</span> <br>
                                    <span>Dilaksanakan
                                        {{ \Carbon\Carbon::parse($item->magang->rentang_waktu_mulai)->format('d F Y') }}
                                        -
                                        {{ \Carbon\Carbon::parse($item->magang->rentang_waktu_selesai)->format('d F Y') }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="row">
                    <div class="col">
                        <h2>Kegiatan magang</h2>
                        @include('component.alert')
                    </div>
                </div>
                <div class="row mt-3">
                    {{-- @dd($data) --}}
                    @foreach ($data as $item)
                        {{-- @if ($item->magang->user_id == auth()->user()->id) --}}
                            <div class="col-12 p-4 border-top bg-light ">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="{{ asset('image/magang.jpeg') }}" class="card-img-top" alt="...">
                                    </div>
                                    <div class="col-7">
                                        <h5>Pelaksanaan {{ $item->jenis_magang }}
                                        </h5>
                                        <span>{{ $item->description }}</span> <br>
                                        <span>Dilaksanakan
                                            {{ \Carbon\Carbon::parse($item->rentang_waktu_mulai)->format('d F Y') }}
                                            -
                                            {{ \Carbon\Carbon::parse($item->rentang_waktu_selesai)->format('d F Y') }}</span>
                                        <a class="btn btn-success btn-sm rounded-0"
                                            href="{{ route('kegiatan.edit', $item->id) }}">
                                            Lihat partisipasi
                                        </a>
                                    </div>
                                </div>
                            </div>
                        {{-- @endif --}}
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
