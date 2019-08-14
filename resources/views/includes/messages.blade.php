@if (count($errors) > 0)
    @foreach ($errors->all() as $item)
        <div class="alert alert-danger">
            {{ $item }}
        </div>
    @endforeach
@endif

@if (session('message'))
        <div class="alert alert-message">
            {{session('message')}}
        </div>
@endif


@if (session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
@endif


@if (session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
@endif
