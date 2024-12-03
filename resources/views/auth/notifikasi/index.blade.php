@extends('auth.component.app')

@section('content')
<div class="body-wrapper">
    <div class="container mt-5 pt-5">
        <div class="row">
            <div class="col">
                <h2>Notification</h2>
            </div>
        </div>
        <div class="row mt-3">
            @foreach ($data as $item)
                <div class="col-12 p-4 border-top {{($item->status == 'Rejected') ? 'bg-danger-subtle' : 'bg-success-subtle'}} " >
                    <h5>{{$item->title}}</h5>
                    <span>{{$item->body}}</span> <br>
                    <span>Verifikasi {{$item->created_at->diffForHumans()}}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
