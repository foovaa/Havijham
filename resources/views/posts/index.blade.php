@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @forelse ($posts as $item)
    @if ($item->approved)
    <div style="margin : 20px;">
        <div class="card card-body" style="direction:rtl !important;"> 
            <a href="/posts/{{ $item->id }}"><h4 class="card-title">{{ $item->title }}</h4></a>
            {{-- <p class="card-text">{{ $item->body }}</p> --}}
            <hr>
            <small style="direction:rtl !important;">در تاریخ {{ $item->created_at }} توسط {{ $item->user->name }} نوشته شده</small>
        </div>
    </div>
    @endif
    @empty
        <h2>there is no posts</h2>
    @endforelse
    {{ $posts->links() }}
@endsection


