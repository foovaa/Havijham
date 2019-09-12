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
                        <div style="display: block; margin-bottom: 20px;">
                        <figure>
                            <img src="/storage/avatar/{{ $data['user']->avatar }}" style="width:130px; height:130px; float:right; border-radius:50%; margin:10px; margin-right:30px;">                    
                                <figcaption>
                                    <br><small>    نام</small>
                                    <br><strong>   {{ $data['user']->name }}</strong>
                                    {{-- <br><small>    ایمیل</small><br> --}}
                                    {{-- <strong>   {{ Auth::user()->email }}</strong> --}} 
                                </figcaption>
                        </figure>  
                    </div>

                    </div>
                </div>
                <div class="card-header" style="margin-top:20px;" >
                    <strong>درباره من</strong><br><br>
                    <?php echo nl2br($data['user']->about_me) ?>
                </div>
            <div class="card-body">
<h3>پست ها </h3>
                {{-- This section is Posts Table --}}
                @forelse ($data['posts']->all() as $item)
                    <table class="table table-striped">
                        <tr class="row">
                            <td class="w-50">عنوان</td>
                            <td class="w-25">تاریخ نگارش پست</td>
                            <td class="w-25"></td>
                        </tr>
                        <tr class="row">
                            <td class="card-title w-50"><strong>{{ $item->title }}</strong></td>
                            <td class="w-25">{{ $item->created_at->format('Y D M') }}</td>
                            <td class="w-25">
                                <span class="float-left" style="margin:5px; float:inline-end;">
                                    <a href="/posts/{{ $item->id }}" class="btn btn-primary">مشاهده</a></span>
                            </td>
                        </tr>
                    </table>
                @empty
                {{ $data['user']->name }} هنوز پستی ننوشته !!
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
