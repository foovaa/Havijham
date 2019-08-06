<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-mx">
    <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
    
            <a class="navbar-brand float-right" style=" margin-top:10px;" href="{{ url('/') }}">
                <img src="/storage/logo2.svg" style="width:140px; height:40px;" alt="">
            </a>    
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">

        <a class="nav-item nav-link" href="{{ url('/') }}">
            خانه
        </a>
        <a class="nav-item nav-link" href="{{ url('/posts') }}">
            بلاگ
        </a>
    
    </div>

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
        <span class="caret">
                <img src="/storage/avatar/{{ Auth::user()->avatar }}" style="width:30px; height:30px; border-radius:50%; margin-right:20px; margin-bottom:5px; float:left; posistion:absolute;">
            </span>
            <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} 
                    </a>
                


                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                    <a href="{{ route('dashboard') }}" class="dropdown-item">داشبورد</a>
                    
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('خروج') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</div>
</div>
</nav>