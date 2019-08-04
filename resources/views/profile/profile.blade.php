@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-2">
            <div class="card">
                    <div class="card-header">
                            <img src="/storage/avatar/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin:10px;">                    
                            <strong>{{ $user->name }}'s Profile</strong>

                            {{ Form::open(['action' => 'ProfileController@update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                            {{ Form::token() }}
                            {{-- <div class="form-group">
                                {{ Form::label('name', 'Name') }}
                                {{ Form::text('title', $user->name, ['class' => 'form-control', 'placeholder' => 'title'])}}
                            </div> --}}
                            <div class="form-group">
                                {{Form::file('avatar')}}
                            </div>
                            {{ Form::submit('Submit', ['class' => 'btn btn-primary', 'style' => 'float:right; '])}}
                            {{ Form::close() }}



                    </div>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
