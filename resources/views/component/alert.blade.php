@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@if (session()->has('failed'))
    <div class="alert alert-danger">
        <div class="text-muted">
            {{ session('failed') }}
        </div>
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success">
        <div class="text-muted">
            {{ session('success') }}
        </div>
    </div>
@endif
