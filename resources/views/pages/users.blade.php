@extends('layouts.app')


@section('title')
اعضا
@endsection



@section('content')
    <h1>پست ها</h1>
    @forelse ($users as $item)
    <div style="margin : 20px;">
        <div class="card">
            <div class="wrapper">
                <div>
                    <figure>
                        <a href="/users/{{ $item->id }}">
                            <img src="/storage/avatar/{{ $item->avatar }}" style="width:70px; height:70px; margin:5px; border-radius:50%;" alt="">
                            <figcaption>
                                {{ $item->name }}              
                            </figcaption>
                        </a>
                    </figure>
                </div>
                <div class="card-text" style="margin:15px;">
                    <h4 class="card-title"><strong style="color:blue;">درباره من :</strong>
                        <?php 
                            if(strlen($item->about_me) > 300) {
                            echo substr($item->about_me, 0, 300).' ...';
                        } else {
                            echo $item->about_me;
                        }
                            ?></h4>
                    {{-- <hr> --}}
                {{-- <small>{{ $item->created_at->format('Y M D') }}</small> --}}
                </div>
            </div>
        </div>
    </div>
@empty
<h2>هنوز کسی عضو نشده</h2>
@endforelse
{{ $users->links() }}
@endsection


