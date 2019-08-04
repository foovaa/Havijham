@extends('layouts.app')

@section('content')
<h1>Not Approved  </h1><br>
<h2>Posts</h2>
{{-- @forelse ($posts->all() as $item) --}}
<table class="table table-striped">
        <tr class="row">
            <td class="w-50">Title</td>
            <td class="w-25">Date</td>
            <td class="w-25"></td>
        </tr>
@forelse ($data['posts']->all() as $item)
@if (!$item->approved)
        <tr class="row">
            <td class="card-title w-50"><strong>{{ $item->title }}</strong></td>
            <td class="w-25">{{ $item->created_at }}</td>
            <td class="w-25">
                <span class="float-right" style="margin:5px; float:inline-end;">
                    <p>{{ $item->id }}</p>
                <a href="/dashboard/{{ $item->id }}/show" class="btn btn-primary">View</a></span>
                {{-- <span class="float-right" style="margin:5px; float:inline-end;">
                <a href="/dashboard/{{ $item->id }}/post" class="fa fa-check"></a></span>
                <span class="float-right" style="margin:5px;">
                {{ Form::open(['action' => ['DashboardController@destroyPost', $item->id], 'method' => 'DELETE']) }}
                <a class="tooltips" data-toggle="tooltip" data-placement="top" title="Delete">
                    <button type="submit" onclick="return confirm('Are you sure to delete this Post ?');" style="border: 0; background: none;">
                    {{-- {{ Form::submit('Delete', ['class' => 'btn btn-danger'])}} 
                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                    </button>
                </a>
                {{ Form::close() }}
            </span>
            </td>
        </tr> --}}
        @endif
        @empty
            <td>There is no post</td>
        @endforelse
    </table>


{{-- <div style="margin : 20px;">
    <div class="card card-body"> 
        <a href="/posts/{{ $item->id }}"><h4 class="card-title">{{ $item->title }}</h4></a>
        <p class="card-text">{{ $item->body }}</p> 
        <small><hr>created at {{ $item->created_at}} by {{ $item->user->name }}</small>
    </div>
</div>
@endif
@empty
    <h2>there is no posts</h2>
@endforelse --}}


<br><br>
<h2>Comments</h2>


@forelse ($data['comments']->all() as $item)
    @if (! $item->approved)
        <div class="card" style="margin:20px">
            <div class="card card-body">
                <small class="float-left">{{ $item->creator->name }} says</small>
                        {{ Form::open(['action' => ['DashboardController@destroyComment' , $item->id], 'method' => 'POST']) }}
                        {{ Form::hidden('_method', 'DELETE')}}
                            <span class="float-right mx-auto"> 
                                <a class="tooltips" data-toggle="tooltip" data-placement="top" title="Delete">
                                    <button type="submit" onclick="return confirm('Are you sure to delete this comment ?');" style="border: 0; background: none;">
                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </button>
                            
                                </a>
                        {{ Form::close()}}
                                <a href="/dashboard/{{ $item->id }}/comment" class="fa fa-check"></a>
                            </span>
                <hr>
                    <p style="font-size:15px;">{!! $item->content !!}</p>
            </div>
        </div>
@endif
        @empty
    <small style="direction:rtl; float:right;"></small>
@endforelse


{{-- {{ $posts->links() }} --}}
@endsection