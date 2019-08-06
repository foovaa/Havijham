@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-primary">Go Back</a>
<div style="margin: 20px;">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ $comment->post->title }}</h2>
            <p class="card-text">{!! $comment->post->body !!}</p>
            <div style="margin: 10px;"><hr>
                <small>created at {{ $comment->post->created_at }} by {{ $comment->post->user->name }}</small>
                @auth
                    @if (auth()->user()->id == $comment->post->user_id)
                        <span class="float-right"><a href="/posts/{{ $comment->post->id }}/edit" class="btn btn-primary mx-auto" >Edit</a>
                            {{ Form::open(['action' => ['PostsController@destroy', $comment->post->id], 'method' => 'DELETE', 'class' => 'btn btn_danger']) }}
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

@forelse ($comment->post->comments->all() as $item)
@if ($item->approved)
    <div class="card card-body" style="margin:20px">
        <small>{{ $item->creator->name }} says</small>
        @auth
        @if (auth()->user()->id == $item->creator->id)
            {{ Form::open(['action' => ['CommentsController@destroy' , $item->id], 'method' => 'DELETE']) }}
                <span class="float-right mx-auto"> 
                    <a class="tooltips" data-toggle="tooltip" data-placement="top" title="Delete">
                        <button type="submit" onclick="return confirm('Are you sure to delete this comment ?');" style="border: 0; background: none;">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </button>
                
                    </a>
            {{ Form::close()}}
                    <a href="/comment/{{ $item->id }}/edit" class="fa fa-edit"></a>
                </span>
        @endif    
    @endauth
        {{-- @auth
        @if (auth()->user()->id == $item->creator->id)
            <span class="float-right">
                <a href="/comment/{{ $item->id }}/edit"><small>Edit</small></a>
                {{ Form::open(['action' => ['CommentsController@destroy' , $item->id], 'method' => 'DELETE']) }}
                    {{ Form::submit('delete') }}
                {{ Form::close()}}
            </span>
        @endif    
        @endauth --}}
        <hr>
        <p style="font-size:15px;">{{ $item->content }}</p>
        {{-- <div class="card card"></div> --}}
    </div>    
    @endif
@empty
    <p>there is no comment</p>
@endforelse


@auth
    <div class="card card-body" style="margin:20px">
        {{ Form::open(['action' => ['CommentsController@update', $comment->id], 'method' => 'POST']) }}
            <div class="form-group">
                {{ Form::label('label', 'نظر شما') }}
                {{ Form::textarea('content', $comment->content, ['class' => 'form-control', 'rows' => '5']) }}
                {{ Form::hidden('post_id' , $comment->post->id) }}
                {{ Form::hidden('creator_id' , auth()->user()->id) }}
                {{ Form::hidden('_method', 'PUT') }}
            </div>
        {{ Form::submit('اصلاح', ['class' => 'btn btn-primary'])}}
        {{ Form::close() }}
    </div>
@endauth
@endsection



