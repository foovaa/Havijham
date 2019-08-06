@extends('layouts.app')

@section('content')
    {{-- we use controllers so instead of using 'url' we use 'action' and 'method'  --}}
    {{ Form::open(['action' => 'PostsController@store', 'method' => 'POST']) }}
    {{ Form::token() }}
    <div class="form-group">
        {{ Form::label('title', 'عنوان') }}
        {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'عنوان']) }}
    </div>
    <div class="form-group">
            {{ Form::label('body', 'محتوا') }}
            {{ Form::textarea('body', '', ['class' => 'form-control', 'rows' => '20', 'placeholder' => 'محتوا...']) }}            
            {{-- {{ Form::textarea('body', '', ['class' => 'ckeditor', 'placeholder' => 'Body...']) }} --}}
    </div>
    {{ Form::submit('ارسال', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection
