@extends('layouts.app')

@section('content')
    {{-- 
        for editing the posts we must change action to the 'update'  
        and pass the post_id for update function
    --}}
    {!! Form::open(['action' => ['PostsController@update', $post->id ], 'method' => 'POST']) !!}
    {{ Form::token() }}
    <div class="form-group">
        {{ Form::label('title', 'عنوان') }}
        {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'عنوان']) }}
    </div>
    <div class="form-group">
            {{ Form::label('body', 'محتوا') }}
            {{ Form::textarea('body', $post->body, ['class' => 'form-control', 'rows' => '20']) }}            
            {{-- {{ Form::textarea('body', $post->body, ['class' => 'ckeditor', 'placeholder' => 'Body...']) }} --}}
    </div>
    {{-- the Form::hidden added for set method to 'PUT' or 'PATCH' --}}
    {{ Form::hidden('_method', 'PUT')}}
    {{ Form::submit('بروزرسانی', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
@endsection
