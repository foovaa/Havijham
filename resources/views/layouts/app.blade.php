<!DOCTYPE html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
    <html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="صادق ایپکی جو">
    <meta name="description" content="هویج هام وبگاهی برای به اشتراک گذاشتن تجربیات برنامه نویسی.">
    {{-- <meta http-equiv="Content-Security-Policy" content="default-src &apos;self&apos;; script-src &apos;self&apos; https://ajax.googleapis.com; style-src &apos;self&apos;; img-src &apos;self&apos; data:"> --}}

@yield('keywords')

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title')</title>        


{{-- all styles --}}
@include('includes.styles') 

{{-- all scripts --}}
@include('includes.scripts')    



{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
 --}}




</head>
<body>

    <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MD9QJ9S"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    
    {{-- <div id="app"> --}}
            @include('includes.navbar')
            <div  class="container">
                    <div style="margin:20px;">@include('includes.messages')</div>
                    <main class="py-5">
                    <div class="board board-img col-md-14">
                        <div class="card-text py-5">
                                <div class="ml-4" style="margin-right:20px;">
                                        @yield('content')
                            </div>                            
                        </div>
                    </div>
                </main>
                @include('includes.footer')

        </div>
    {{-- </div> --}}
</body>
</html>
