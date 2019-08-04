@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @forelse ($posts as $item)
    @if ($item->approved)
    <div style="margin : 20px;">
        <div class="card card-body"> 
            <a href="/posts/{{ $item->id }}"><h4 class="card-title">{{ $item->title }}</h4></a>
            {{-- <p class="card-text">{{ $item->body }}</p> --}}
            <small><hr>created at {{ $item->created_at}} by {{ $item->user->name }}</small>
        </div>
    </div>
    @endif
    @empty
        <h2>there is no posts</h2>
    @endforelse
    {{ $posts->links() }}
@endsection


