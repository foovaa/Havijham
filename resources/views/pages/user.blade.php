@extends('layouts.app')


@section('title')
{{ $data['user']->name }}
@endsection



@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 col-md-offset-2">
            {{-- This Profile shower --}}
            <div class="card">
                {{-- <div class="profile"> --}}
                        <div class="card-header" style="margin:20px; display: block; min-width:60px;"><strong style="margin-top:10px; font-size:20px; maargin-right:30px;"> داشبورد</strong>
                                    <figure>
                                            <img src="/storage/avatar/{{ $data['user']->avatar }}" style="width:130px; height:130px; float:right; border-radius:50%; margin:10px; margin-right:30px;">                    
                                            <figcaption>
                                                    <br><small>    نام</small>
                                                    <br><strong>   {{ $data['user']->name }}</strong>
                                                    {{-- <br><small>    ایمیل</small><br> --}}
                                                    {{-- <strong>   {{ Auth::user()->email }}</strong> --}}
                                            </figcaption>
                                        </figure>  
                                     
                                    <table>
                                            <tr>
                                                <td class="w-100">
                                                    <div class="card-text" style="margin:15px;">
                                                    <h4 class="card-title"><strong style="color:blue;">درباره من :<br></strong> {{ $data['user']->about_me }}</h4>
                                                </td>
                                            </tr>
                                        </table>        
        
                    </div>

        
                </div>
                <div class="card-header" style="margin-top:20px;" >
                </div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif


                {{-- This section is Posts Table --}}
                <table class="table table-striped">
                    <tr class="row">
                        <td class="w-50">عنوان</td>
                        <td class="w-25">تاریخ نگارش پست</td>
                        <td class="w-25"></td>
                    </tr>
                    @forelse ($data['posts']->all() as $item)
                    <tr class="row">
                        <td class="card-title w-50"><strong>{{ $item->title }}</strong></td>
                        <td class="w-25">{{ $item->created_at->format('Y D M') }}</td>
                        <td class="w-25">
                            <span class="float-left" style="margin:5px; float:inline-end;">
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
