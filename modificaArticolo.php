<?php
	
	if(!isset($_SESSION)){
		session_start();
	}
	include("functions.php");
	if(!isAdmin())echo'<script language="javascript"> window.alert("Devi essere un admin per accedere a questa pagina")  ;window.location="index.php"; </script>';		
	include("headerAdmin.php");
	include("db.php");
	$id=isset($_GET['id'])? clear($_GET['id']) : false;
	$result=mysqli_query($db,"SELECT * from articoli WHERE id='$id'");
	$row = mysqli_fetch_assoc($result);
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
						<h3 class="breadcrumb-header">Modifica articolo</h3>
						
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
				
					<div class="col-md-5 order-details" style="float:right; margin-top:20px">
						<div class="product-img" style="margin-left:100px">
							<img src="./img/alert.png" alt="">
						</div>
						<label style="margin-left:65px">Inserisci solo i dati che vuoi modificare</label>
					</div>	
					<div class="col-md-7">
						
						<div style="margin-top:-20px; margin-right:100px">
							<form method="post" action="modificaArticolo1.php">
							<input type="hidden" name="idArticolo" value=<?php echo $id; ?>>
							<div class="form-group">
								<label>Nome articolo</label>
								<input class="form-control" type="text" name="nome" placeholder=<?php
									
									echo $row['nome'];
																		
								?> >
							</div>
							
							<div class="form-group">
								<label>Categoria</label>
								<select class="form-control" name="categoria" >
									<option selected disabled><?php
				
										echo $row['categoria'];
																		
								?> </option>
									<option value="Videogames">Videogames</option>
									<option value="Musica">Musica</option>
									<option value="Film">Film</option>
									<option value="Giochi da tavolo">Giochi da tavolo</option>
									<option value="Gadget">Gadget</option>
								</select>
									
							</div>
							
							<div class="form-group">
								<label>Prezzo</label>
								<input class="form-control" type="text" name="prezzo" placeholder=<?php
									
									echo $row['prezzo'];
															
								?>  
							</div>
							
							<div class="form-group" style="margin-top:20px">
								<label class="btn primary-btn" for="immagine" >
								<input name="immagine" id="immagine" type="file" style="display:none" onchange="$('#upload-file-info').html(this.files[0].name)">Carica nuova immagine</label>
								<span class='label label-info' name="upload-file-info" id="upload-file-info"></span>
							</div>
							
							<div class="form-group" style="margin-top:15px">
								<label>Quantità disponibile</label>
								<div class="input-number">
									<input class="form-control" type="number" name="quantità" min=0 value=<?php	echo $row['quantita'];?> >
									<span class="qty-up">+</span>
									<span class="qty-down">-</span>
								</div>
							</div>
							
							
							
						</div>
								<button type="submit" class="primary-btn order-submit">Conferma modifiche</button>
								
							</div>
							</form>
						</div>
				
					</div>
					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/resume.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script language="javascript">
	$(document).ready(function(){
		$('select[name="sicurezza"]').on('change', function(){
			var val = $(this).val();
			$('input[name="domanda"]').val($(this).val());
		});
		
		
	
	});
	</script>
	
 <?php
	include("footer.php");
 ?>
