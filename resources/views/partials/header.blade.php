<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/styles2.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="css/styles2.css"> -->
    <link href="https://fonts.googleapis.com/css?family=Arimo|Open+Sans" rel="stylesheet">
    <link rel="icon" href="img/favicon.png">
    <link rel="stylesheet" href="css/all.css">
    <link href="css/simple-line-icons.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert.min.js"></script>

    <title>CQTS</title>

  </head>

  <body>

    @include('sweet::alert')
    <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
      <a class="navbar-brand" href="{{ url(' ') }}">
        <img src="img/clogo.png" height="45">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">

          <li class="nav-item">
            <a href="{{ url('') }}" style="color:white; font-size:18px; text-transform:uppercase; padding-right:10px; font-weight:500;">Nueva requisición</a>
          </li>
          <li class="nav-item">
            <a href="{{ url('myrequests') }}" style="color:white; font-size:18px; text-transform:uppercase; padding-right:10px; font-weight:500;">Mis requisiciones</a>
          </li>
         @if (Auth::check() && DB::table('users')->where('uid', \Auth::user()->samaccountname)->exists())
            <li class="nav-item">
              <a href="{{ url('index') }}" style="color:white; font-size:18px; text-transform:uppercase; padding-right:10px; font-weight:500;">Admin panel</a>
            </li>
          @else
            @if (Auth::check())
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color:white; font-size:18px; text-transform:uppercase; padding-right:10px; font-weight:500;">Logout</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
              @endif
            @endif
        </ul>
      </div>
    </nav>
    <br>
    
