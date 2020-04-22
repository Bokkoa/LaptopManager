<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.8
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
<head>
  <base href="./">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- CSRF -->
  <meta name="_token" content="{{ csrf_token() }}">

  <title>Laptop Manager</title>

  <!-- Icons and CSS-->
  <link rel="stylesheet" href="css/coreui.min.css">
  <link rel="stylesheet" href="css/all.css">
  <link href="css/simple-line-icons.css" rel="stylesheet">
  <link href="css/vanillatoasts.css" rel="stylesheet">
  <link href="css/load.css" rel="stylesheet">
  <link rel="stylesheet" href="js/chosen/chosen.min.css">
  <link rel="stylesheet" href="js/chosen/patch.css">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="css/dataTables.bootstrap4.min.css">
  <link href="css/mycss.css" rel="stylesheet">

  <!-- IMAGES -->
  <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
  <link rel="icon" href="img/favicon.png" type="image/x-icon">

  <!-- SCRIPTS -->
  <script src="js/jquery.min.js"></script>
  <script src="js/sweetalert.min.js"></script>
  <script src="js/chosen/chosen.jquery.min.js"></script>

</head>


<script>
   $(document).ready(function() {
		// Animate loader off screen
		$(".se-pre-con").fadeOut("slow");
	});
  </script>


<body class="app header-fixed alert-dark sidebar-fixed aside-menu-fixed sidebar-lg-show">
<div class="se-pre-con"></div>
@include('sweet::alert')

@include('partials\navbar')

<div class="app-body text-dark">
@include('partials\sidebar')
@yield('content')
</div>

@include('partials\includes')
</body>
</html>
