@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-primary">Go Back</a>
<div style="margin: 20px;">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            <p class="card-text">{!! $post->body !!}</p>
            <div style="margin: 10px;"><hr>
                <small>created at {{ $post->created_at }} by {{ $post->user->name }}</small>
                @if (!Auth::guest())
                    @if (auth()->user()->id == $post->user_id)
                        <span class="float-right"><a href="/posts/{{ $post->id }}/edit" class="btn btn-primary mx-auto" >Edit</a>
                            {{ Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'DELETE', 'class' => 'btn btn_danger']) }}
                                {{-- {{ Form::hidden('_method', 'DELETE') }} --}}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                            {{ Form::close() }}
                        </span>
                    @endif            
                @endif
            </div>
        </div>
    </div>
</div>

@forelse ($post->comments->all() as $item)
    <div class="card card-body" style="margin:20px">
    <small>{{ $item->creator->name }} says</small>
    <hr>
    <p style="font-size:15px;">{{ $item->content }}</p>
    {{-- <div class="card card"></div> --}}
    </div>    
@empty
    <p>there is no comment</p>
@endforelse



<div class="card card-body" style="margin:20px">
    {{ Form::open(['action' => 'CommentsController@store', 'method' => 'POST']) }}
    <div class="form-group">
        {{ Form::label('body', 'نظر شما') }}
        {{ Form::textarea('body', '', ['class' => 'form-control', 'rows' => '5']) }}
    </div>
    {{ Form::submit('ارسال نظر', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}
</div>

@endsection



