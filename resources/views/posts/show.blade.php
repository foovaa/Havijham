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
                @auth
                    @if (auth()->user()->id == $post->user_id)
                        <span class="float-right"><a href="/posts/{{ $post->id }}/edit" class="btn btn-primary mx-auto" >Edit</a>
                            {{ Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'DELETE', 'class' => 'btn btn_danger']) }}
                                {{-- {{ Form::hidden('_method', 'DELETE') }} --}}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                            {{ Form::close() }}
                        </span>
                    @endif            
                @endauth
            </div>
        </div>
    </div>
</div>

@forelse ($post->comments->all() as $item)
    <div class="card card-body" style="margin:20px">
        <small>{{ $item->creator->name }} says</small>
        @auth
        @if (auth()->user()->id == $item->creator->id)
            <div class="float-right">
                <span><a href="/comment/{{ $item->id }}/edit"><small>Edit</small></a></span>
            <span>
                {{ Form::open(['action' => ['CommentsController@destroy' , $item->id], 'method' => 'DELETE']) }}
                    {{ Form::submit('delete', ['class' => 'btn btn-default']) }}
                {{ Form::close()}}
            </span>
            </div>
        @endif    
        @endauth
        <hr>
        <p style="font-size:15px;">{{ $item->content }}</p>
        <div class="card card"></div>
    </div>    
@empty
    <p>there is no comment</p>
@endforelse


@auth
    <div class="card card-body" style="margin:20px">
        {{ Form::open(['action' => 'CommentsController@store', 'method' => 'POST']) }}
            <div class="form-group">
                {{ Form::label('label', 'نظر شما') }}
                {{ Form::textarea('content', '', ['class' => 'form-control', 'rows' => '5']) }}
                {{ Form::hidden('post_id' , $post->id) }}
                {{ Form::hidden('creator_id' , auth()->user()->id) }}
            </div>
        {{ Form::submit('ارسال نظر', ['class' => 'btn btn-primary'])}}
        {{ Form::close() }}
    </div>
@endauth
@endsection



