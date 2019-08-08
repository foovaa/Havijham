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
                <div class="card-text" style="margin:15px;">
                    <h4 class="card-title"><strong style="color:blue;">عنوان:</strong> {{ $item->title }}</h4>
                    <hr>
                <small>{{ $item->created_at->format('Y M D') }}</small>
                </div>
            </div>
        </div>
    </div>
@empty
    <h2>پستی وجود ندارد</h2>
@endforelse
{{ $posts->links() }}
@endsection


