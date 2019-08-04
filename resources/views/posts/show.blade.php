@extends('layouts.app')

@section('content')
<a href="/posts" class="btn btn-primary" style="margin-left:40px;">بازگشت</a>
<div style="margin: 20px;">
    <div class="card mx-auto">
        <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            <p class="card-text">{{ $post->body }}</p>
            <div style="margin: 10px;"><hr>
                <small>created at {{ $post->created_at }} by {{ $post->user->name }}</small>
                @auth
                    @if (auth()->user()->id == $post->user_id)
                        <span class="float-right"><a href="/posts/{{ $post->id }}/edit" class="btn btn-primary mx-auto" >ویرایش</a>
                            {{ Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'DELETE', 'class' => 'btn btn_danger']) }}
                                {{-- {{ Form::hidden('_method', 'DELETE') }} --}}
                                {{ Form::submit('حذف', ['class' => 'btn btn-danger'])}}
                            {{ Form::close() }}
                        </span>
                    @endif            
                @endauth
            </div>
        </div>
    </div>
</div>

@forelse ($post->comments->all() as $item)
    <div class="card" style="margin:20px">
        <div class="card card-body">
            <small class="float-left">{{ $item->creator->name }} says</small>
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
            <hr>
                <p style="font-size:15px;">{{ $item->content }}</p>
        </div>
    </div>
@empty
    <small style="direction:rtl; float:right;">نظری نوشته نشده...</small>
@endforelse

@auth
    <div class="card col-md-10" style="margin-top:20px; margin-left:80px;">
        <div class="card-body">
        {{ Form::open(['action' => 'CommentsController@store', 'method' => 'POST']) }}
            <div class="form-group">
                {{ Form::label('label', 'نظر شما', ['class' => 'float-right']) }}
                {{ Form::textarea('content', '', ['class' => 'form-control', 'rows' => '5']) }}
                {{ Form::hidden('post_id' , $post->id) }}
                {{ Form::hidden('creator_id' , auth()->user()->id) }}
            </div>
        {{ Form::submit('ارسال نظر', ['class' => 'btn btn-primary float-right'])}}
        {{ Form::close() }}
    </div>
</div>
@endauth
@endsection



