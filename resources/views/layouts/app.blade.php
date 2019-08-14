<!DOCTYPE html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
    <html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="صادق ایپکی جو">
    <meta name="description" content="هویج هام وبگاهی برای به اشتراک گذاشتن تجربیات برنامه نویسی.">
@yield('keywords')

<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title')</title>        


    <!-- Scripts -->
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MD9QJ9S');</script>
    <!-- End Google Tag Manager -->
    
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    {{-- <script src="jquery-3.4.1.min.js"></script> --}}
    @yield('star_js')    
    
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">



    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">




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
