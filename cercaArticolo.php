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
		
	$articolo = isset($_GET['ricerca']) ? clear($_GET['ricerca']) : false;
	
	$result=mysqli_query($db,"SELECT * from articoli WHERE nome LIKE '%$articolo%'");
	
	
	

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
						<li><a href="musica.php">Musica</a></li>
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
						<h3 class="breadcrumb-header">Risultati ricerca</h3>
						
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
				<div id="store" class="col-md-9">
			<?php 		
					if (mysqli_num_rows($result)==0)echo'
						<h3 class="product-name">Nessun risultato trovato</h3>';
					echo'<ul>';
					while($row = mysqli_fetch_assoc($result)){
					echo'<li>
					<a href=';echo'"product.php?idArticolo='; echo $row['id'];echo'">';
					echo'
					<div class="product" style="height:350px; width:151px ;float:left; ;margin-right:10px">
					
						<div class="product-img">
							<img src="./';echo $row['immagine'];echo'" alt="">
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

		
		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Chi siamo</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>90100 Palermo,Italia</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+39-091658912</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>servizio_clienti@gamesandmore.it</a></li>
								</ul>
							</div>
						</div>

				

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Informazioni</h3>
								<ul class="footer-links">
									
									<li><a href="#">Normativa sulla Privacy</a></li>
									<li><a href="#">Ordini e resi</a></li>
									<li><a href="#">Termini e condizioni</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Servizi</h3>
								<ul class="footer-links">
									<li><a href="#">Account</a></li>
									
									<li><a href="#">Traccia il mio ordine</a></li>
									<li><a href="#">Aiuto</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->
				<!-- jQuery Plugins -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/slick.min.js"></script>
		<script src="js/nouislider.min.js"></script>
		<script src="js/jquery.zoom.min.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>


