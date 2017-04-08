 <nav class="teal darken-1">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo hide">Logo</a>
      <ul id="nav-mobile" class="right">
        <li>
            <a class="" href="sass.html">Sass</a>
            <div class="line"></div>
        </li>
        <li>
            <a class="" href="badges.html">Components</a>
            <div class="line"></div>
        </li>
        <li>
            <a class="" href="collapsible.html">JavaScript</a>
            <div class="line"></div>
        </li>
      </ul>
        <ul id="slide-out" class="side-nav fixed">
          <li>
                <div class="userView white center">
                    <a href="#!user">
                        <img class="circle"
                            src="{{asset('images/me.jpg')}}">
                        <div style="background-image: url({{asset('images/me.jpg')}})" class="img">
                            
                        </div>
                    </a>
                    <a href="#!name">
                        <span class="name">Cesar Santana</span>
                    </a>
                    <a href="#!name">
                        <span class="name">Fullstack Developer</span>
                    </a>
                    <a href="#!email">
                        <span class="email">casc.santana@gmail.com</span>
                    </a>

                    <div class="center">
                        <button class=" button-pulse btn red">Hire me!</button>
                    </div>
                </div>
          </li>
          <li><a href="#!">Sobre mi</a></li>
          <li><a href="#!">Trabajos</a></li>
          <li><a href="#!">Componentes</a></li>
          <li><a href="#!">Librerias</a></li>
          <li><a href="#!">Blog</a></li>
        </ul>

        <a href="#" data-activates="slide-out" class="button-collapse">
            <i class="material-icons">menu</i>
        </a>
    </div>
    <div class="header">
        @yield('page_header')
    </div>   
  </nav>
        


{{-- <nav class="navbar navbar-static-top custom-nav">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand cursive" href="{{ url('/') }}">
                {GG}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

             <ul class="nav navbar-nav navbar-left navbar-list">
                <!-- Authentication Links -->
                <li><a href="{{ route('login') }}">Blog</a></li>
                <li><a href="{{ route('register') }}">Recetas</a></li>
                <li><a href="{{ route('register') }}">Productos</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right  navbar-list">
                <li><a href="{{ route('register') }}">Galería</a></li>
                <li><a href="{{ route('register') }}">Cursos</a></li>

                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->first_name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav> --}}