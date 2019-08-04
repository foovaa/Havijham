@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-md-12 col-md-offset-2">
                    <div class="card">
                                <div class="card-header" style="margin:20px;"><strong style="margin-top:10px; maargin-left:30px;">Dashboard</strong>

                                    <img src="/storage/avatar/{{ Auth::user()->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin:10px; margin-right:30px;">                    
                                    <div style="margin-top:15px; margin-left:100px; margin-bottom:10px;">
                                    <br> Name: <strong>{{ Auth::user()->name }}</strong><br>
                                    Email Address:<strong> {{ Auth::user()->email }}</strong>
                                </div>
                                    {{ Form::open(['action' => 'DashboardController@update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                                    {{ Form::token() }}
                                    {{-- <div class="form-group">
                                        {{ Form::label('name', 'Name') }}
                                        {{ Form::text('title', $user->name, ['class' => 'form-control', 'placeholder' => 'title'])}}
                                    </div> --}}
                                    {{-- <p>Update your profile image</p> --}}
                                    <div class="form-group">
                                        {{Form::file('avatar')}}
                                    </div>
                                    {{ Form::submit('Update', ['class' => 'btn btn-primary', 'style' => 'float:right; '])}}
                                    {{ Form::close() }}
        
                                </div>

        
        
        
        
                        </div>
                    {{-- </div>
                </div> --}}
        {{-- <div class="col-md-8">
            <div class="card"> --}}

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
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger'])}}
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
</div>
@endsection
