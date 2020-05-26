<header class="app-header navbar ">
  <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="float-left">
    <a class="navbar-brand" href="{{ url('index') }}">
      <img  src="img/logo.png" height="50" alt="Laptop Manager" style="
      width: 70px;
      margin-left: 30px;
     ">
      <div style="font-size:15px;">
        <span class="text-dark"><strong>L</strong>aptop</span>
        <span class="text-dark"><strong>M</strong>anager</span>
      </div>
    </a>
  </div>

<div class="container">
  <ul class="nav navbar-nav ml-auto">

    <li class="nav-item dropdown">
      <a class="nav-link text-dark" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
      @if ( isset(Auth::user()->name) )
                           
        {{ Auth::user()->name }}

      @endif
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-header text-center">
          <strong>Configuracion</strong>
        </div>
              <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                <i class="fa fa-lock"></i> {{ __('Salir') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </li>
          </ul>
  </div>
        </header>
