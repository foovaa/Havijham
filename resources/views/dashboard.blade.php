@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hello {{ Auth::user()->name }}!
                    <div style="margin:10px;">
                        <div class="float-right">
                            <a href="/posts/create" class="btn btn-primary">Create Post</a>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <tr>
                            <td>Title</td>
                            <td></td>
                            <td></td>
                        </tr>
                        @forelse ($posts as $item)
                        <tr>
                            <td class="card-title">{{ $item->title }}</td>
                            <td><a href="/posts/{{ $item->id }}/edit" class="btn btn-primary">Edit</a></td>
                            <td>
                                {{ Form::open(['action' => ['PostsController@destroy', $item->id], 'method' => 'DELETE']) }}
                                {{ Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                {{ Form::close() }}
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
