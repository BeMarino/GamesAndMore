<!DOCTYPE html>

	<head>
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Games & more</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<!-- Slick -->
		<link type="text/css" rel="stylesheet" href="css/slick.css"/>
		<link type="text/css" rel="stylesheet" href="css/slick-theme.css"/>

		<!-- nouislider -->
		<link type="text/css" rel="stylesheet" href="css/nouislider.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>

		

    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div padding-left=10px ;class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div  class="header-logo">
								<a href="index.php" class="logo">
									<img src="./img/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form action="cercaArticolo.php">
									<input class="input" name="ricerca" placeholder="Cerca prodotto">
									<button class="search-btn">Cerca</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix" style="margin-top:15px">
							<div class="header-ctn">
							<?php if($_SERVER['REQUEST_URI']=="/progetto/login1.php")echo'
								<a style="margin-left:-40px" href="login1.php"><font color="red">Login</font></a>';
								else echo'<a style="margin-left:-40px" href="login1.php"><font color="white">Login</font></a>'?>
							<?php if($_SERVER['REQUEST_URI']=="/progetto/registrazione1.php")echo'	
								<a style="margin-left:20px" href="registrazione1.php"><font color="red">Registrati</font></a>';
								else echo'<a style="margin-left:20px" href="registrazione1.php"><font color="white">Registrati</font></a>';?>
								<div class="dropdown">
									<a href="carrello.php" style="margin-left:40px">
										<i class="fa fa-shopping-cart" style="margin-right:50px"></i>
										<span  style="margin-right:50px">Carrello</span>
										<div class="qty" id="totale" style="margin-right:30px">0</div>
									</a>
								</div>	
								<a href="http://www.facebook.com" class="newsletter-follow" style="margin-left:40px"><font color="white"><i class="fa fa-facebook"></i></font></a>
								
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		

		