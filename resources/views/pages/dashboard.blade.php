@extends('layouts.app')



@section('keywords')
    <meta name="keywords" content="هویج هام,{{Auth::user()->name}},داشبورد, برنامه نویسی">
@endsection


@section('title')
داشبورد {{ auth()->user()->name }}
@endsection



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-2">
            {{-- This Profile shower --}}
            <div class="card">
                {{-- <div class="profile"> --}}
                        <div class="card-header" style="margin:20px; display: block; min-width:60px;"><strong style="margin-top:10px; font-size:20px; maargin-right:30px;"> داشبورد</strong>
                            {{ Form::open(['action' => 'DashboardController@update', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}    
                        <span style="float:right">
                            <figure>

                                    <img src="/storage/avatar/{{ Auth::user()->avatar }}" style="width:130px; height:130px; float:right; border-radius:50%; margin:10px; margin-right:30px;">                    
                                    <figcaption>
                                            <br><small>    نام</small>
                                            <br><strong>   {{ Auth::user()->name }}</strong>
                                            <br><small>    ایمیل</small><br>
                                            <strong>   {{ Auth::user()->email }}</strong>
                                    </figcaption>
                                </figure>
                            <div class="form-group">
                                    {{Form::file('avatar')}}
                                </div>
                        </span>
                            <span class="about-me" style="float:left;">
                            {{ Form::token() }}
                                    {{ Form::label('about_me', 'درباره من')}}
                                    {{ Form::textarea('about_me', Auth::user()->about_me, ['class' => 'form-control flote-left', 'rows' => '5', 'style' => 'margin-bottom:20px;']) }}                
                                    @if ($user->is_admin)
                                    <div style="float:left; margin-right:5px;">
                                            <a href="/dashboard/{{ $user->id }}/admin" class="btn btn-success">پنل مدیریت</a>
                                            {{-- <a href="/dashboard/comments" class="btn btn-success">Comments</a> --}}
                                    </div>
                                @endif
                                    {{ Form::submit('بروز رسانی اطلاعات', ['class' => 'btn btn-primary', 'style' => 'float:left; '])}}
                                    {{ Form::close() }}
        
                                </span>
        
                    </div>

        
                </div>
                <div class="card-header" style="margin-top:20px;" >
                        <strong>درباره من</strong><br><br>
                        <?php echo nl2br(Auth::user()->about_me) ?>
                </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div style="margin:10px;">
                    <div class="float-right" style="margin-bottom:20px;">
                        <a href="/posts/create" class="btn btn-primary">ایجاد پست</a>
                    </div>
                </div>

                {{-- This section is Posts Table --}}
                <table class="table table-striped">
                    <tr class="row">
                        <td class="w-40">عنوان</td>
                        <td class="w-15">در تاریخ</td>
                        <td class="w-15">وضعیت</td>
                        <td class="w-20">پیام</td>
                        <td class="w-10"></td>
                    </tr>

                    @forelse ($user->posts as $item)
                    <tr class="row">
                        <td class="card-title w-40"><strong>{{ $item->title }}</strong></td>
                        <td class="w-15"><small>{{ $item->created_at->format('Y D M') }}</small></td>
                            @if ( $item->approved )
                                <td class="w-15">
                                        <span class="float-right" style=" color:blue;">بررسی شده</span>
                                </td>
                                <td class="w-20">
                                    <span class="float-right" style="color:green;">تایید شد</span>
                                </td>
                            @elseif ($item->review) 
                                <td class="w-15">
                                        <span class="float-right" style="color:blue;">بررسی شده</span>
                                </td>
                                <td class="w-20">
                                    <span class="float-right" style="color:red;">برای بازبینی</span>
                                </td>
                                @else
                                    <td class="w-15">
                                            <span class="float-right">بررسی نشده</span>
                                    </td> 
                                    <td class="w-20"></td>
                                    @endif

                        <td class="w-10">
                            <span class="float-left">
                                    <a href="/posts/{{ $item->id }}" class="btn btn-primary">مشاهده</a></span>
                        </td>
                    </tr>
                    @empty
                        <td>شما تا حالا پستی ننوشته اید</td>
                    @endforelse
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
