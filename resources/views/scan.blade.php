<!DOCTYPE html>
<html class='no-js' >
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Laptop Manager</title>
		
		
		<!--==================================================================
			CSS Stylesheets
		==================================================================-->
        <link rel="stylesheet" href="css/coreui.min.css">
        <link rel="stylesheet" href="css/all.css">
        <link href="css/simple-line-icons.css" rel="stylesheet"> 
        <script src="js/jquery.min.js"></script>
        <link href="css/vanillatoasts.css" rel="stylesheet">
        <link href="css/load.css" rel="stylesheet">


        <link href="css/access.css" rel="stylesheet">

        <script src="js/sweetalert.min.js"></script>
       
		
    </head>
	<body class="bg-dark">

    <div class="se-pre-con"></div>
    
    
	<!--==================================================================
			PAGE
		==================================================================-->


    <div class="app">
        <div id="particles"></div>
        <header>
            <nav class="navbar navbar-dark bg-dark" >
                  <a class="navbar-brand" href="/">Access</a>
             </nav>
        </header>
        <br>
      
  <main>
                <div class="container ">
                    <div class="row justify-content-center">
                        <div class="card col-6">
                            <div class="card shadow-lg" style="background-color: rgba(200, 203, 206, 0.13) !important;">
                                <div class="card-header text-center"><h4 class="text-dark">Coincidencia</h4></div>
                                <div class="card-body bg-oxford justify-content-center text-center">

                                <!-- WAITING -->
                                    <div class="waiting-section">
                                        <h5 class="card-title">Esperando..</h5>
                                        <div class="lds-ripple"><div></div><div></div></div>
                                    </div>
                                    
                                <!-- RESULTS -->
                                    <div class="good">
                                    <h5 class="card-title">Encontrado</h5>
                                    <div class="swal2-icon swal2-success swal2-animate-success-icon" style="display: flex;">
                                            <span class="swal2-success-line-tip"></span>
                                            <span class="swal2-success-line-long"></span>
                                        </div>
                                    </div>
                                    
                                    <div class="bad">
                                    <h5 class="card-title">No encontrado</h5>
                                        <div class="swal2-icon swal2-error swal2-animate-error-icon" style="display: flex;">
                                        <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span>
                                        <span class="swal2-x-mark-line-right"></span></span></div>
                                    </div>

                                    
                                    <script>
                                    $(".bad").hide();
                                    $(".good").hide();
                                    </script>

                                        <form action="checking" id="check" method="post">
                                            @csrf
                                            <input id="asset" type="text" name="asset" class="form-control">
                                        </form>
                                        <br>
                                    <div class="names-section">
                                        <label id="emp-name" class="text-light list-group-item bg-oxford"></label>
                                    </div>
                                    
                                    
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-7 card-deck justify-content-center imgs-section">
                            <div id="first" class="card">
                              <img width="40%" id="employee-image" class="shadow-lg rounded " src="">
                            </div>
                        </div>
                    </div>  

                </div>
            </main>
        

            
			<!--==================================================================
				Footer
			==================================================================-->
			<footer>
				<div class='navbar fixed-bottom navbar-dark'>
                    <div class="row">
                        Icons made by <a href="https://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon"> www.flaticon.com</a>
                    </div>
				</div>
			</footer>
			
		</div>
    </div>		
  
		<style>
        footer{
            box-shadow: 0px, 2px, 0px solid black;
        }
        .card{
            background:none;
            border: 0px;
        }
        </style>
		<!--==================================================================
			JavaScript Files
		==================================================================-->
		<script src="js/popper.min.js"></script>
        <script src="js/jquery.dataTables.min.js"></script>
        <script src="js/dataTables.bootstrap4.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/coreui.min.js"></script>
        <script type="text/javascript" src="js/vanillatoasts.js"></script>
		
    </body>

<script type="text/javascript" src="js/particles.min.js"></script>
<script type="text/javascript" src="js/scripts/scanner.js"></script>
</html>