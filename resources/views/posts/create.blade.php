@extends('layouts.app')


@section('title')
ایجاد پست جدید
@endsection

@section('content')

    {{-- we use controllers so instead of using 'url' we use 'action' and 'method'  --}}
    {{ Form::open(['action' => 'PostsController@store', 'method' => 'POST']) }}
    {{ Form::token() }}
    <div class="form-group">
        {{ Form::label('title', 'عنوان') }}
        {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'عنوان']) }}
    </div>
    <div class="form-group">
            {{ Form::label('body', 'محتوا') }}
            {{ Form::textarea('body', '', ['class' => 'form-control', 'rows' => '20', 'placeholder' => 'محتوا...']) }}            
            {{-- {{ Form::textarea('body', '', ['class' => 'ckeditor', 'placeholder' => 'Body...']) }} --}}
    </div>
    {{ Form::submit('ارسال', ['class' => 'btn btn-primary'])}}
    {{ Form::close() }}


<pre>
    <div  id="preview">Preview</div>
</pre>

<script>
    $(document).ready(function(){
        var textinput = document.getElementById('body');
    textinput.onkeyup = textinput.onkeypress = function(){
        document.getElementById('preview').innerHTML = this.value;
    }
    });

    // $(document).ready(function(){
    //         $('#body').keyup(function() {
    //             $('#tb2').val($('#body').val());
    //         });
    //     });
</script>
    <div>
</div>
@endsection
