<!DOCTYPE html>
<?php
	
	
	if(!isset($_SESSION)){
		
		session_start();
	}
	$id=$_SESSION['user']['id'];
	include("db.php");
	$result= mysqli_query($db,"SELECT SUM(quantita) AS quantita from carrello WHERE idUtente=$id");
		$totale=(int)implode($result->fetch_assoc());
	
	
?>
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
									<button class="search-btn" >Cerca</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->
						<div class="box-3a">
							</div>
						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix" style="margin-top:15px">
							<div class="header-ctn">
							
								<a style="margin-left:-60px" href="logout.php"><font color="white">Logout</font></a>
								
								<?php if($_SERVER['REQUEST_URI']=="/progetto/areaAdmin.php"){
										echo"<a  style='margin-left:20px'><font color='red'><img src='./img/immagine.png'>".$_SESSION['user']['Nome']." ".$_SESSION['user']['Cognome']."</font></a>";
										}
									else echo "<a style='margin-left:20px' href='areaAdmin.php'><img src='./img/immagine.png'>
									<font color='white'> ".$_SESSION['user']['Nome']." ".$_SESSION['user']['Cognome']."</font></a>";
								?>
								<div class="dropdown">
								<?php 
									if($_SERVER['REQUEST_URI']=='/progetto/carrello.php'){
										echo'<a style="margin-left:40px">
											<font color="red">
											<i class="fa fa-shopping-cart" style="margin-right:50px"></i>
											<span  style="margin-right:50px">Carrello</span></font>
											<div class="qty" id="totale" style="margin-right:30px">'; 
											echo $totale; 
											echo'</div></a>';
									}else {
										echo '<a href="carrello.php" style="margin-left:40px">
											<i class="fa fa-shopping-cart" style="margin-right:50px"></i>
											<span  style="margin-right:50px">Carrello</span>
											
											<div class="qty" id="totale" style="margin-right:30px">'; 
										echo $totale;
										echo'</div></a>';
									}
								?>
									
								</div>	
								<a href="http://www.facebook.com" style="margin-left:40px"><font color="white"><i class="fa fa-facebook"></i></font></a>
								
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

		