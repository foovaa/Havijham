@extends('layouts.app')


@section('title')
هویج هام
@endsection


@section('content')
    <h1>پست ها</h1>
    @forelse ($posts as $item)
    <div style="margin : 20px;">
        <div class="card">
            <div class="wrapper">
                <div>
                    <figure>
                        <img src="/storage/avatar/{{ $item->user->avatar }}" style="width:70px; height:70px; margin:5px; border-radius:50%;" alt="">
                        <figcaption>
                            {{ $item->user->name }}              
                        </figcaption>
                    </figure>
                </div>
                <div class="card-text">
                    <small>{{ $item->created_at->format('Y M D') }}</small>
                <hr><?php 
                    if(strlen($item->title) > 120) {
                        echo substr($item->title, 0, 119).'...';
                          } else {
                            echo $item->title;
                        }
                        ?>
                    <span class="float-left" style="margin:5px; float:inline-end;">
                        <a href="/posts/{{ $item->id }}" class="btn btn-primary">مشاهده</a></span>
                </div>
            </div>
        </div>
    </div>
@empty
    <h2>پستی وجود ندارد</h2>
@endforelse
<ul class="pagination">
        {{ $posts->links() }}
</ul>
@endsection


