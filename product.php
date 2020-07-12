
<?php


	
	if(!isset($_SESSION)){
		session_start();
	}
	
	
	include ("functions.php");
	include("db.php");
	
	if(isLoggedIn()){
		if(isAdmin())
			include("headerAdmin.php");
		else include ("headerLogged.php");
	}else include("header.php");	
	
	$id=isset($_GET['idArticolo']) ? clear($_GET['idArticolo']) : false;


	$result=mysqli_query($db,"SELECT * from articoli WHERE id='$id'");
	$row=mysqli_fetch_assoc($result);
	
	$categoria=$row['categoria'];
	$result2=mysqli_query($db,"SELECT * from articoli WHERE categoria='$categoria' and id!=$id");
	$i=0;

?>

		
		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li><a  href="index.php">Home</a></li>
						<li <?php if($categoria=="Videogames") echo 'class="active"';?> ><a href="videogames.php">Videogames</a></li>
						<li <?php if($categoria=="Musica") echo 'class="active"';?> ><a href="musica.php">Musica</a></li>
						<li <?php if($categoria=="Film") echo 'class="active"';?>><a href="film.php">Film</a></li>
						<li <?php if($categoria=="GiochiDaTavolo") echo 'class="active"';?>><a href="giochiDaTavolo">Giochi da tavolo</a></li>
						<li <?php if($categoria=="Gadget") echo 'class="active"';?>><a href="gadget.php">Gadget</a></li>
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
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2" style="margin-left:-200px">
						<div id="product-main-img" >
							<div class="product-preview" >
								<img src="./<?php echo $row['immagine'];?>" alt="">
							</div>							
						</div>
					</div>
					<!-- /Product main img -->

					

					<!-- Product details -->
					<div class="col-md-5" style="margin-left:350px;margin-top:50px">
						<div class="product-details">
							<h2 class="product-name"><?php echo $row['nome'];?></h2>
							
							<div>
								<h3 class="product-price"><?php echo $row['prezzo'];echo'&#8364';?> </h3>
								<?php 
								if( inCatalogo($id)){
									if($row['quantita']>0) echo'
									<span class="product-available"><font color ="#11cf19">Disponibile</font> 	</span>';
									else echo'<span class="product-available">Non disponibile</span>';
								}
								else echo'<span class="product-available">Articolo non più in catalogo</span>';?>
							</div>
							
							
							
							<div class="add-to-cart">
								<div class="qty-label">
									Quantità
									<div class="input-number">
										<input type="number" id="quantita" name="quantita"  value=1 max=<?php echo $row['quantita'];?>>
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
								<?php 
								if(inCatalogo($id)){
									if (isLoggedIn()) echo'
									<button type="submit" class="add-to-cart-btn" onclick=addToCart('.$id.',"quantita")><i class="fa fa-shopping-cart" ></i> Aggiungi al carrello</button>
									';
									else echo'<button type="submit" class="add-to-cart-btn" onclick=logga()><i class="fa fa-shopping-cart" ></i> Aggiungi al carrello</button>';
								}?>
							</div>
							
							<ul class="product-links">
								<li>Categoria:</li>
								<li><a href="<?php echo $categoria.".php"; ?>"><?php echo $row['categoria'];?></a></li>
								<li>
							</ul>

							<ul class="product-links">
								<li>Condividi:</li>
								<li><a href="https://www.facebook.com"><i class="fa fa-facebook"></i></a></li>
							</ul>	
							<?php if(isAdmin()){
									echo '<a href="modificaArticolo.php?id=';echo $row['id'];echo'"><button style="margin-top:30px" type="submit" class="primary-btn">Modifica articolo</button></a>';
									}
							?>
							
						</div>
					</div>
					<!-- /Product details -->

					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Articoli simili</h3>
						</div>
					</div>

					<?php 						
					
					while(($row2 = mysqli_fetch_assoc($result2) )&& ($i<4)){
						
						 echo'
						<div class="col-md-3 col-xs-6">
						<div class="product" style="height:400px; width:201px ;float:left; ;margin-right:10px">
						
							<div class="product-img">
								<img width="150px" height="200px" src="./';echo $row2['immagine'];echo'" alt=""';echo'>
							</div>
							<div class="product-body">
								<p class="product-category">';echo $row2["categoria"];echo'</p>
								<h3 class="product-name"><a href="product.php?idArticolo=';echo $row2['id'];echo '">';echo $row2['nome']; echo'</a></h3>
								<h4 class="product-price">';echo $row2['prezzo'];?><a> &#8364;</a><?php echo' </h4>';
							if (isLoggedIn()){ echo'
									<button  style="width:150px" class="primary-btn add-to-cart-btn" onclick=addToCart(';echo $row["id"].',1)><i class="fa fa-shopping-cart" ></i></button>';
							}else echo'<button  class="primary-btn add-to-cart-btn" onclick=logga()><i class="fa fa-shopping-cart" ></i></button>';
							echo'
							</div>
						</div>
						</div>
						</a>';
						$i++;
					}
					
				?>	


				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->
		<script>
		function addToCart(idArt,idQuantita){
			var quantita =document.getElementById(idQuantita).value;
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
<?php
	include("footer.php");
?>