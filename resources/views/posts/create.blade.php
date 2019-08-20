@extends('layouts.app')


@section('title')
ایجاد پست جدید
@endsection

@section('content')

    {{ Form::open(['action' => 'PostsController@store', 'method' => 'POST']) }}
    {{ Form::token() }}
    <div class="form-group">
        {{ Form::label('title', 'عنوان') }}
        {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'عنوان']) }}
    </div>


    <div class="form-group" style="border:0px;">
        {{ Form::label('tags', 'تگ ها')}}
        <select multiple="multiple" class="form-control" aria-placeholder="تگ ها" >
            @foreach ($tags as $item)
                <option value="{{ $item->id }}"> {{ $item->tag }} </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
            {{ Form::label('body', 'محتوا') }}
            {{ Form::textarea('body', '', ['class' => 'form-control', 'rows' => '20', 'placeholder' => 'محتوا...']) }}            
            {{-- {{ Form::textarea('body', '', ['class' => 'ckeditor', 'placeholder' => 'Body...']) }} --}}
    </div>
    {{ Form::submit('ارسال', ['class' => 'btn btn-primary']) }}
    {{ Form::close() }}


<pre>
    <div id="preview" style="min-height: 60px;">پیش نمایش</div>
</pre>



@endsection
