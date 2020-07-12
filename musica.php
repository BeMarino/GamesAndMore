<!DOCTYPE html>

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
		
	
	
	$result=mysqli_query($db,"SELECT * from articoli WHERE categoria LIKE 'musica' AND InCatalogo=1");
	
	
	
	

?>
<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li><a href="index.php">Home</a></li>
						<li><a href="videogames.php">Videogames</a></li>
						<li class="active"><a href="musica.php">Musica</a></li>
						<li><a href="film.php">Film</a></li>
						<li><a href="giochiDaTavolo">Giochi da tavolo</a></li>
						<li><a href="gadget.php">Gadget</a></li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->
					<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Musica</h3>
						
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- STORE -->
				<div id="store" style="margin-left:100px" class="col-md-9">
			<?php 						
					echo'<ul>';
					while($row = mysqli_fetch_assoc($result)){
					echo'<li>
					<a href=';echo'"product.php?idArticolo='; echo $row['id'];echo'">';
					echo'
					<div class="product" style="height:350px; width:151px;float:left; ;margin-right:40px">
					
						<div class="product-img">
							<img width="150px" height="150px" src="';echo $row['immagine'];echo'" alt="">
						</div>
						<div class="product-body">
							<p class="product-category">';echo $row["categoria"];echo'</p>
							<h3 class="product-name"><a href="#">';echo $row['nome']; echo'</a></h3>
							<h4 class="product-price">';echo $row['prezzo'];?><a> &#8364;</a><?php echo' </h4>';
							if (isLoggedIn()){ echo'
									<button  style="width:120px" class="primary-btn add-to-cart-btn" onclick=addToCart(';echo $row["id"].',1)><i class="fa fa-shopping-cart" ></i></button>';
							}else echo'<button style="width:120px" class="primary-btn add-to-cart-btn" onclick=logga()><i class="fa fa-shopping-cart" ></i></button>';
							echo'
						</div>
					</div>
					</a>
					</li>';
					}
					echo'</ul>';
				?>	

					
				
						
			
				
				
			</div>
		</div>
	</div>
			
			<!-- /container -->
		
		<!-- /SECTION -->

		
		<?php include("footer.php");?>
	
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
