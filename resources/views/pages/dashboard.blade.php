@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-2">
            {{-- This Profile shower --}}
            <div class="card">
                <div class="card-header" style="margin:20px;"><strong style="margin-top:10px; maargin-left:30px;">Dashboard</strong>
                    <img src="/storage/avatar/{{ Auth::user()->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin:10px; margin-right:30px;">                    
                    <div style="margin-top:15px; margin-left:100px; margin-bottom:10px;">
                    <br> Name: <strong>{{ Auth::user()->name }}</strong><br>
                    Email Address:<strong> {{ Auth::user()->email }}</strong>
                    @if ($user->is_admin)
                    <div style="float:right;">
                            <a href="/dashboard/{{ $user->id }}/admin" class="btn btn-success">Admin</a>
                            {{-- <a href="/dashboard/comments" class="btn btn-success">Comments</a> --}}
                    </div>
                @endif
                </div>
                    {{ Form::open(['action' => 'DashboardController@update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                    {{ Form::token() }}
                    <div class="form-group">
                        {{Form::file('avatar')}}
                    </div>
                    {{ Form::submit('Update', ['class' => 'btn btn-primary', 'style' => 'float:right; '])}}
                    {{ Form::close() }}
                </div>
            </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div style="margin:10px;">
                    <div class="float-right" style="margin-bottom:20px;">
                        <a href="/posts/create" class="btn btn-primary">Create Post</a>
                    </div>
                </div>

                {{-- This section is Posts Table --}}
                <table class="table table-striped">
                    <tr class="row">
                        <td class="w-50">Title</td>
                        <td class="w-25">Date</td>
                        <td class="w-25"></td>
                    </tr>
                    @forelse ($user->posts as $item)
                    <tr class="row">
                        <td class="card-title w-50"><strong>{{ $item->title }}</strong></td>
                        <td class="w-25">{{ $item->created_at }}</td>
                        <td class="w-25">
                            <span class="float-right" style="margin:5px; float:inline-end;">
                            <a href="/posts/{{ $item->id }}" class="btn btn-warning">View</a></span>
                            <span class="float-right" style="margin:5px; float:inline-end;">
                            <a href="/posts/{{ $item->id }}/edit" class="btn btn-primary">Edit</a></span>
                            <span class="float-right" style="margin:5px;">
                            {{ Form::open(['action' => ['PostsController@destroy', $item->id], 'method' => 'DELETE']) }}
                            <a class="tooltips" data-toggle="tooltip" data-placement="top" title="Delete">
                                <button type="submit" onclick="return confirm('Are you sure to delete this Post ?');" style="border: 0; background: none;">
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                {{-- <i class="fa fa-trash-o" aria-hidden="true"></i> --}}
                                </button>
                            </a>
                            {{ Form::close() }}
                        </span>
                        </td>
                    </tr>
                    @empty
                        <td>There is no post</td>
                    @endforelse
                </table>
            </div>

            

        </div>
    </div>
</div>

@endsection
