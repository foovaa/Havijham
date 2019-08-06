
<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-mx">
    <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
    
            <a class="navbar-brand float-right" href="{{ url('/') }}">
                <img src="/storage/logo2.svg" style="width:140px; height:40px;" alt="">
            </a>    

        {{-- <a class="navbar-brand" href="#">Navbar</a> --}}

              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">

        <a class="nav-item nav-link" href="{{ url('/about') }}">
            درباره من
        </a>
        <a class="nav-item nav-link" href="{{ url('/posts') }}">
            بلاگ
        </a>
    
    </div>
{{-- <div class="collapse navbar-collapse d-flex  "> --}}

<ul class="navbar-nav  justify-content-end mr-auto">
        <!-- Authentication Links -->
        @guest
            <li class="nav-item float-left">
                <a class="nav-link" href="{{ route('login') }}">{{ __('ورود') }}</a>
            </li>
            @if (Route::has('register'))
                <li class="nav-item float-left">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('ثبت نام') }}</a>
                </li>
            @endif
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <span class="caret">
                        <img src="/storage/avatar/{{ Auth::user()->avatar }}" style="width:30px; height:30px; border-radius:50%; margin-right:20px; margin-bottom:5px; float:left; posistion:absolute;">
                    </span>
                        {{ Auth::user()->name }} 
                </a>
                


                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a href="{{ route('dashboard') }}" class="dropdown-item">داشبورد</a>
                    
                    {{-- <a href="{{ route('profile') }}" class="dropdown-item fa-sign-out">Profile</a> --}}
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest

        {{-- <a class="nav-item nav-link" href="{{ url('/about') }}">
            About
        </a>
        <a class="nav-item nav-link" href="{{ url('/posts') }}">
            Blog
        </a>


        <a class="navbar-brand float-right" href="{{ url('/') }}">
            <img src="/storage/logo2.svg" style="width:140px; height:40px;" alt="">
        </a> --}}
    
    </ul>



                  {{-- <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                  <a class="nav-item nav-link" href="#">Features</a>
                  <a class="nav-item nav-link" href="#">Pricing</a>
                  <a class="nav-item nav-link disabled" href="#">Disabled</a> --}}

</div>
      
    </div>
      </nav>