<header class="app-header navbar shadow">
  <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="float-left">
    <a class="navbar-brand" href="{{ url('index') }}">
      <img class="navbar-brand-full" src="img/logo.png" height="50" alt="Laptop Manager" style="
      width: 70px;
      margin-left: 20px;
      margin-bottom: 10px; ">
      <div style="font-size:15px;">
        <span class="text-dark"><strong>L</strong>aptop</span>
        <span class="text-dark"><strong>M</strong>anager</span>
      </div>
    </a>
  </div>
  <!-- <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
    <span class="navbar-toggler-icon"></span>
  </button> -->
  <ul class="nav navbar-nav ml-auto">

    <li class="nav-item dropdown">
      <a class="nav-link text-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        {{-- Auth::user()->username() --}}
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-header text-center">
          <strong>Settings</strong>
        </div>
              <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                <i class="fa fa-lock"></i> {{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </li>
          </ul>
        </header>
