<?php
if(!isset($_SESSION)){
    session_start();
}
include("functions.php");
if(isLoggedIn()) echo'<script> alert("Hai già effettuato l\'accesso");window.location.replace("index.php")</script>';
	else
		include('header.php');
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
						<h3 class="breadcrumb-header">Registrazione</h3>
						
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

					<div class="col-md-7">
						
						<div style="margin-top:-20px">
							<form method="post" action="registrazione2.php">
							<div class="form-group">
								<input class="form-control" type="text" name="Nome" placeholder="Nome" required>
							</div>
							<div class="form-group">
								<input class="form-control" type="text" name="Cognome" placeholder="Cognome"required>
							</div>
							<div class="form-group">
								<input class="form-control" type="email" name="email" placeholder="name@example.com" required>
							</div>
							<div class="form-group">
								<input class="form-control" type="password" name="password1" placeholder="Password"required>
							</div>
							<h6><font color=red>La password deve contenere almeno 8 caratteri</font></h6>
							<div class="form-group">
								<input class="form-control" type="password" name="password2" placeholder="Conferma password"required>
							</div>
							<div class="form-group">
								<input class="form-control" type="text" name="paese" placeholder="Paese"required>
							</div>
							<div class="form-group">
								<input class="form-control" type="text" name="città" placeholder="Città"required>
							</div>
							<div class="form-group">
								<input class="form-control" type="text" name="indirizzo" placeholder="Indirizzo, numero civico"required>
							</div>
							<div class="form-group">
								<input class="form-control" type="text" name="provincia" placeholder="Provincia"required>
							</div>
							<div class="form-group">
								<input class="form-control" type="text" name="cap" placeholder="Cap"required>
							</div>
							
							<div class="form-group">
								<select class="form-control" name="domanda" required>
									<option selected disabled>Domanda di sicurezza</option>
									<option value="Cognome da nubile di tua madre">Cognome da nubile di tua madre</option>
									<option value="Nome del tuo primo animale domestico">Nome del tuo primo animale domestico</option>
								</select>
									
							</div>
							<div class="form-group">
								<input class="form-control" type="tel" name="risposta" placeholder="Risposta" required>
							</div>
							
							</div>
								<button type="submit" class="primary-btn order-submit">Registrati</button>
								<a style="margin-left:270px"  href="login1.php"><font color="red">Già iscritto? Accedi da qui</font></a>
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
