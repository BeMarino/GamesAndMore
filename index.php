<!DOCTYPE html>
<html lang="it">
<?php	
	if(!isset($_SESSION)){
		session_start();
	}
	include("functions.php");
	include("db.php");
	
	if (isLoggedIn()){
		if (isAdmin()){
			include("headerAdmin.php");
		}else include("headerLogged.php");
	}else include("header.php");
	
	
?>
	<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li class="active"><a href="index.php">Home</a></li>
						<li><a href="videogames.php">Videogames</a></li>
						<li><a href="musica.php">Musica</a></li>
						<li><a href="film.php">Film</a></li>
						<li><a href="giochiDaTavolo.php">Giochi da tavolo</a></li>
						<li><a href="Gadget">Gadget</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="col-md-5 order-details" style="position:absolute;margin-left:875px;margin-top:100px;width:400px;height:380px">
				<h3 style="margin-left:20px"class="title"><font color=red >Le nostre promozioni</font></h3><br>
					<div >
						<img width="100px" height="100px" src="./img/10" alt="">
					</div>
					<div style="position:absolute; margin-left:200px;margin-top:-110px" >
						<img width="125px" height="125px" src="./img/20" alt="">
					</div>
					<div style="position:absolute; margin-left:80px;margin-top:-25px">
						<img width="150px" height="150px" src="./img/30" alt="">
					</div>
					<h4 style="margin-top:150px" class="title"><strong>Ricevi il 10% di sconto per ogni 100&#8364 spesi.*</strong></h4>
					<h6  ><font color=grey>*Fino ad un massimo del 30%</font></h6>
				</div>

					<!-- section title -->
					<div class="col-md-12;" style=" margin-left:15px">
						<div class="section-title">
							<h3 class="title">Nuove uscite - videogames</h3>
							
						</div>
					</div>
					<!-- /section title -->
<?php 						
					echo'<ul>';
					$i=5;
					$result=mysqli_query($db,'SELECT * from articoli where InCatalogo=1 and categoria = "Videogames" ORDER BY id DESC' );
					while($i>0){
						$row = mysqli_fetch_assoc($result);
					echo'<li heigth="280px" >
					<a href=';echo'"product.php?idArticolo='; echo $row['id'];echo'">';
					echo'
					<div class="product add-to-cart" style="height:325px; width:151px ;float:left; ;margin-right:10px">
					
						<div class="product-img">
							<img width="150px" height="150px" src="./';echo $row['immagine'];echo'" alt="">
						</div>
						<div class="product-body">
							<p class="product-category"><a href="'.$row['categoria'].'">';echo $row["categoria"];echo'</a></p>
							<h3 class="product-name"><a href="product.php?idArticolo='.$row['id'].'">';echo $row['nome']; echo'</a></h3>
							<h4 class="product-price">';echo $row['prezzo'];?><a> &#8364;</a><?php echo' </h4>';
							if (isLoggedIn()){ echo'
									<button  style="width:120px" class="primary-btn add-to-cart-btn" onclick=addToCart(';echo $row["id"].',1)><i class="fa fa-shopping-cart" ></i></button>';
							}else echo'<button style="width:120px" class="primary-btn add-to-cart-btn" onclick=logga()><i class="fa fa-shopping-cart" ></i></button>';
								
						echo'</div>
					</a>
					</li>';
					$i--;
					}
					
					echo'</ul>';
				?>	

					<!-- section title -->
					<div class="col-md-12" style="margin-top:20px; margin-bottom:-15px">
						<div class="section-title">
							<h3 class="title">Nuove uscite - giochi da tavolo</h3>
							
						</div>
					</div>
					<!-- /section title -->
<?php 						
					echo'<ul>';
					$i=5;
					$result=mysqli_query($db,'SELECT * from articoli where InCatalogo=1 and categoria = "Giochi da tavolo" ORDER BY id DESC' );
					while($i>0){
						$row = mysqli_fetch_assoc($result);
					echo'<li heigth="280px" >
					<a href=';echo'"product.php?idArticolo='; echo $row['id'];echo'">';
					echo'
					<div class="product" style="height:325px; width:151px ;float:left; ;margin-right:10px">
					
						<div class="product-img">
							<img width="150px" height="150px" src="./';echo $row['immagine'];echo'" alt="">
						</div>
						<div class="product-body">
							<p class="product-category"><a href="'.$row['categoria'].'">';echo $row["categoria"];echo'</a></p>
							<h3 class="product-name"><a href="product.php?idArticolo='.$row['id'].'">';echo $row['nome']; echo'</a></h3>
							<h4 class="product-price">';echo $row['prezzo'];?><a> &#8364;</a><?php echo' </h4>';
							if (isLoggedIn()){ echo'
									<button  style="width:120px" class="primary-btn add-to-cart-btn" onclick=addToCart(';echo $row["id"].',1)><i class="fa fa-shopping-cart" ></i></button>';
							}else echo'<button style="width:120px" class="primary-btn add-to-cart-btn" onclick=logga()><i class="fa fa-shopping-cart" ></i></button>';
								
						echo'</div>
					</div>
					</a>
					</li>';
					$i--;
					}
					echo'</ul>';
				?>	
				
				<!-- section title -->
					<div class="col-md-12" style="margin-top:20px; margin-bottom:-15px">
						<div class="section-title">
							<h3 class="title">Nuove uscite - Musica</h3>
							
						</div>
					</div>
					<!-- /section title -->
<?php 						
					echo'<ul>';
					$i=5;
					$result=mysqli_query($db,'SELECT * from articoli where InCatalogo=1 and categoria = "Musica" ORDER BY id DESC' );
					while($i>0){
						$row = mysqli_fetch_assoc($result);
					echo'<li heigth="280px" >
					<a href=';echo'"product.php?idArticolo='; echo $row['id'];echo'">';
					echo'
					<div class="product" style="height:340px; width:151px ;float:left; ;margin-right:10px">
					
						<div class="product-img">
							<img width="150px" height="150px" src="./';echo $row['immagine'];echo'" alt="">
						</div>
						<div class="product-body">
							<p class="product-category"><a href="'.$row['categoria'].'">';echo $row["categoria"];echo'</a></p>
							<h3 class="product-name"><a href="product.php?idArticolo='.$row['id'].'">';echo $row['nome']; echo'</a></h3>
							<h4 class="product-price">';echo $row['prezzo'];?><a> &#8364;</a><?php echo' </h4>';
							if (isLoggedIn()){ echo'
									<button  style="width:120px" class="primary-btn add-to-cart-btn" onclick=addToCart(';echo $row["id"].',1)><i class="fa fa-shopping-cart" ></i></button>';
							}else echo'<button style="width:120px" class="primary-btn add-to-cart-btn" onclick=logga()><i class="fa fa-shopping-cart" ></i></button>';
								
						echo'</div>
						
					</div>
					</a>
					</li>';
					$i--;
					}
					echo'</ul>';
				?>	
				
				<!-- section title -->
					<div class="col-md-12" style="margin-top:20px; margin-bottom:-15px">
						<div class="section-title">
							<h3 class="title">Nuove uscite - Film</h3>
							
						</div>
					</div>
					<!-- /section title -->
<?php 						
					echo'<ul>';
					$i=5;
					$result=mysqli_query($db,'SELECT * from articoli where InCatalogo=1 and categoria = "Film" ORDER BY id DESC'  );
					while($i>0){
						$row = mysqli_fetch_assoc($result);
					echo'<li heigth="280px" >
					<a href=';echo'"product.php?idArticolo='; echo $row['id'];echo'">';
					echo'
					<div class="product" style="height:355px; width:151px ;float:left; ;margin-right:10px">
					
						<div class="product-img">
							<img width="150px" height="150px" src="./';echo $row['immagine'];echo'" alt="">
						</div>
						<div class="product-body">
							<p class="product-category"><a href="'.$row['categoria'].'">';echo $row["categoria"];echo'</a></p>
							<h3 class="product-name"><a href="product.php?idArticolo='.$row['id'].'">';echo $row['nome']; echo'</a></h3>
							<h4 class="product-price">';echo $row['prezzo'];?><a> &#8364;</a><?php echo' </h4>';
							if (isLoggedIn()){ echo'
									<button  style="width:120px" class="primary-btn add-to-cart-btn" onclick=addToCart(';echo $row["id"].',1)><i class="fa fa-shopping-cart" ></i></button>';
							}else echo'<button style="width:120px"  class="primary-btn add-to-cart-btn" onclick=logga()><i class="fa fa-shopping-cart" ></i></button>';
								
						echo'</div>
						
					</div>
					</a>
					</li>';
					$i--;
					}
					echo'</ul>';
				?>	
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		
		
	<script>
	function addToCart(idArt,quantita){
		
			
			$.ajax({
		  type: "POST",
		  url: "addToCart.php",
		  data: ({idArticolo: idArt, quantita:quantita}),
		  success: function (result) {
			
			 if(result==1){
				 
				 var risposta =window.confirm("Gli articoli sono stati aggiunti al carrello. Vuoi andare al carrello? "); 
				if(risposta)window.location="carrello.php";
				else window.location.reload();
			 }else {
				  alert(result);
				  window.location="product.php?idArticolo="+idArt;
			  }
		  }, dataType: 'text'
		});
		
		}
		
		function logga(){
			alert("Accedi o registrati prima di aggiungere degli articoli al carrello");window.location="registrazione1.php";
		}
		</script>
<?php include("footer.php");?>


