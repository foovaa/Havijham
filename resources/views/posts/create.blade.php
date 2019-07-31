@extends('layouts.app')

@section('content')
    {{-- we use controllers so instead of using 'url' we use 'action' and 'method'  --}}
    {{ Form::open(['action' => 'PostsController@store', 'method' => 'POST']) }}
    {{ Form::token() }}
    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) }}
    </div>
    <div class="form-group">
            {{ Form::label('body', 'Body') }}
            {{ Form::textarea('body', '', ['class' => 'ckeditor', 'placeholder' => 'Body...']) }}
    </div>
    {{ Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection
