@extends('layouts.app')


@section('title')
ادمین         
@endsection

@section('content')
@if (Auth::user()->is_admin) 

    <h1>لیست تایید نشده ها</h1><br>
    <h2>پست ها</h2>
    {{-- @forelse ($posts->all() as $item) --}}
            @if (count($data['posts']->all()) == 0)
            <strong>پستی وجود ندارد</strong>
            @else
            <table class="table table-striped">
                    <tr class="row">
                            <td class="w-50">عنوان</td>
                            <td class="w-25">تاریخ</td>
                            <td class="w-25"></td>
                    </tr>        
                @foreach ($data['posts']->all() as $item)
                        <tr class="row">
                            <td class="card-title w-50"><strong>{{ $item->title }}</strong></td>
                            <td class="w-25">{{ $item->created_at }}</td>
                            <td class="w-25">
                                <span style=" float:left; margin-left:30px;">
                                <a href="/dashboard/{{ $item->id }}/show" class="btn btn-primary">مشاهده</a></span>
            @endforeach
        </table>
        @endif
    <br><br>
    <h2>نظرات</h2>
    
    @if (count($data['comments']->all()) == 0)
            <strong>کامنت جدید وجود ندارد</strong>
            @else
    @foreach ($data['comments']->all() as $item)
            <div class="card" style="margin:20px">
                <div class="card card-body">
                    <small class="float-left"> نویسنده: {{ $item->creator->name }}</small>
                            {{ Form::open(['action' => ['DashboardController@destroyComment' , $item->id], 'method' => 'POST']) }}
                            {{ Form::hidden('_method', 'DELETE')}}
                                <span class="float-left mx-auto"> 
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
    @endforeach
    @endif
    
    
    {{-- {{ $posts->links() }} --}}

@else
<div style="align-items: center;
            display: flex;
            justify-content: center;
            font-size:50px;
            height:100hv;
">
    <div class="title m-b-md">آخه تو ادمینی؟</div></div>
@endif
@endsection
