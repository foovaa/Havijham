@extends('layouts.app')

@section('title')
سلام ادمین   
@endsection

@section('content')
    
<a href="{{ route('pages.admin', Auth::user()->id ) }}" class="btn btn-primary" style="margin-left:40px;">بازگشت</a>
<div style="margin: 20px;">
    <div class="card mx-auto">
        <div class="card-body">
            <span>
                <img src="/storage/avatar/{{ $post->user->avatar }}" style="margin: 10px; width:70px; height:70px; border-radius: 50%;" alt="">
            </span>
            <span style="margin-left: 20px;">
                <strong>{{ $post->user->name }}</strong><br>
                <small>created at {{ $post->created_at }} </small><hr>    
            </span>
            <h2 class="card-title">{{ $post->title }}</h2>
            <p class="card-text">
                    <?php echo nl2br( $post->body ); ?>
                </p>
            <div style="margin: 10px;">
                @auth
                @if (auth()->user()->is_admin)
                <span class="float-left" style="margin:5px; float:inline-end;">
                        <a href="/posts/{{ $post->id }}/post" class="fa fa-check" title="تایید"></a></span>
                        <span class="float-left" style="margin:5px;">
                        {{ Form::open(['action' => ['PostsController@destroyPost', $post->id], 'method' => 'DELETE']) }}
                        <a class="tooltips" data-toggle="tooltip" data-placement="top" title="حذف">
                            <button type="submit" onclick="return confirm('Are you sure to delete this Post ?');" style="border: 0; background: none;">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                        </a>
                        {{ Form::close() }}
                    </span>
                    @endif       
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
