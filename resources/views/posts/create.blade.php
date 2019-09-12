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
        <select multiple class="form-control" size="4" tabindex="1" name="tags[]" >
            @foreach ($tags as $item)
                <option value="{{ $item->id }}"> {{ $item->tag }} </option>
            @endforeach
        </select>
    </div>
{{-- 
    <select class="form-control" multiple="multiple" name="tag_id">
        @foreach ($tags as $key => $value)
          <option value="{{ $key }}"> 
              {{ $value->tag }} 
          </option>
        @endforeach    
      </select> --}}

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


<script>
    $('select').select2({
        maximumInputLength: 30 , // only allow terms up to 20 characters long
        tags: true ,
    });
    
    $(document).ready(function(){
        var textinput = document.getElementById('body');
    textinput.onkeyup = textinput.onkeypress = function(){
        document.getElementById('preview').innerHTML = this.value;
        }   
    });
    </script>
    

@endsection
