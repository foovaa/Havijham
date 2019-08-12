@extends('layouts.app')

@section('title')
بلاگ | پست ها
@endsection


@section('content')

{{-- This part showes the Post title and body --}}
<a href="/posts" class="btn btn-primary" style="margin-left:40px;">بازگشت</a>
<div style="margin: 20px;">
    <div class="card mx-auto">
        <div class="card-body">
            <span>
                <img src="/storage/avatar/{{ $post->user->avatar }}" style="margin: 10px; width:70px; height:70px; border-radius: 50%;" alt="">
            </span>
            <span style="margin-left: 20px;">
                <strong>{{ $post->user->name }}</strong><br>
                <small>ساخته نوشته شده {{ $post->created_at }} :در تاریخ</small>
                @auth
                <span style="float:left;">
                    <a href="#" class="like" data-postid="{{ $post->id }}">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ?
                     Auth::user()->likes()->where('post_id', $post->id)->first()->like == true ? 'شما این پست رو دوست داشتید' : 'دوست داشتم' : 'دوست داشتم' }}</a> |  
                    <a href="#" class="like" data-postid="{{ $post->id }}">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ?
                    Auth::user()->likes()->where('post_id', $post->id)->first()->like == false ? 'شما این پست رو دوست نداشتید' : 'دوست نداشتم' : 'دوست نداشتم' }}</a>    
            </span>
            @endauth
                <hr style="margin-top: 40px;">    
            </span>
            <h1 class="card-title">{{ $post->title }}</h1>
            <p class="card-text">
                <?php echo nl2br( $post->body ); ?>
            </p>

            <div style="margin: 10px;">
                @auth
                    @if (auth()->user()->id == $post->user_id)
                        <span class="float-left"><a href="/posts/{{ $post->id }}/edit" class="btn btn-primary"  style='margin-right:10px;'>ویرایش</a></span>
                            {{ Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'DELETE']) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <span class="float-left">    {{ Form::submit('حذف', ['class' => 'btn btn-danger'])}} </span>
                            {{ Form::close() }}
                    @endif            
                @endauth
            </div>
        </div>
    </div>
</div>


{{-- This section is for showing Comments --}}
@forelse ($post->comments->all() as $item)
    @if ($item->approved == true)
        <div class="card" style="margin:20px">
            <div class="card card-body">
                <small class="float-right">{{ $item->creator->name }} نوشته</small>
                @auth
                    @if (auth()->user()->id == $item->creator->id)
                        {{ Form::open(['action' => ['CommentsController@destroy' , $item->id], 'method' => 'DELETE']) }}
                            <span class="float-left mx-auto"> 
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
                    <p style="font-size:15px;">{!! $item->content !!}</p>
            </div>
        </div>
@endif
        @empty
    <small style="margin-right:20px;">نظری نوشته نشده...</small>
@endforelse


{{-- This section is for create Comments --}}
@auth
    {{-- <div class="card col-md-10" style="margin-top:20px; margin-left:80px;"> --}}
            <div class="card" style="margin:20px;">
        {{ Form::open(['action' => 'CommentsController@store', 'method' => 'POST']) }}
        <div class="form-group">
                <div class="card-body">
                {{ Form::label('label', 'نظر شما', ['class' => 'float-right']) }}
                {{ Form::textarea('content', '', ['class' => 'form-control', 'rows' => '3'])}}
                {{ Form::hidden('post_id' , $post->id) }}
                {{ Form::hidden('creator_id' , auth()->user()->id) }}
    </div>

        {{ Form::submit('ارسال نظر', ['class' => 'btn btn-primary float-left', 'style' => 'margin:10px'])}}
</div>

        {{ Form::close() }}
</div>
@endauth
@endsection

<script>
    var token = '{{ Session::token() }}';
    var likeUrl = '{{ route('like') }}';
</script>

