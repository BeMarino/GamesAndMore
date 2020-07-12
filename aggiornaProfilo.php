<?php

	include("db.php");
	include("functions.php");
	if(!isset($_SESSION)){
		session_start();
	}
	if(!isLoggedIn())echo'<script language="javascript"> window.alert("Devi effettuare il login per accedere a questa pagina")  ;window.location="login1.php"; </script>';		
	include("headerLogged.php");
	
?>
<!-- BREADCRUMB -->
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
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Aggiorna profilo</h3>
						
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
							<form method="post" action="aggiornaProfilo1.php">
							<div class="form-group">
								<label>Nome</label>
								<input class="form-control" type="text" name="Nome" placeholder=<?php
									$id_utente= $_SESSION['user']['id'];
									$result=mysqli_query($db,"SELECT Nome from utenti WHERE id='$id_utente'");
									while ($row = $result->fetch_assoc()) {
										echo $row['Nome'];
									}									
								?> >
							</div>
							<div class="form-group">
								<label>Cognome</label>
								<input class="form-control" type="text" name="Cognome" placeholder=<?php
									$id_utente= $_SESSION['user']['id'];
									$result=mysqli_query($db,"SELECT Cognome from utenti WHERE id='$id_utente'");
									while ($row = $result->fetch_assoc()) {
										echo $row['Cognome'];
									}									
								?>  >
							</div>
							<div class="form-group">
								<label>Email</label>
								<input class="form-control" type="email" name="email" placeholder=<?php
									$id_utente= $_SESSION['user']['id'];
									$result=mysqli_query($db,"SELECT Email from utenti WHERE id='$id_utente'");
									while ($row = $result->fetch_assoc()) {
										echo $row['Email'];
									}									
								?> >
							</div>
							<div class="form-group">
								<label>Password attuale</label>
								<input class="form-control" type="password" name="vecchiaPassword" placeholder="Vecchia Password">
							</div>
							<h6><font color=red>La password deve contenere almeno 6 caratteri</font></h6>
							<div class="form-group">
								<label>Nuova password</label>
								<input class="form-control" type="password" name="password1" placeholder="Nuova Password">
							</div>
							<div class="form-group">
								<label>Conferma nuova password</label>
								<input class="form-control" type="password" name="password2" placeholder="Conferma password" >
							</div>
							<div class="form-group">
								<label>Paese</label>
								<input class="form-control" type="text" name="paese" placeholder=<?php
									$id_utente= $_SESSION['user']['id'];
									$result=mysqli_query($db,"SELECT Nazione from utenti WHERE id='$id_utente'");
									while ($row = $result->fetch_assoc()) {
										echo $row['Nazione'];
									}									
								?> >
							</div>
							<div class="form-group">
								<label>Città</label>
								<input class="form-control" type="text" name="città" placeholder=<?php
									$id_utente= $_SESSION['user']['id'];
									$result=mysqli_query($db,"SELECT citta from utenti WHERE id='$id_utente'");
									while ($row = $result->fetch_assoc()) {
										echo $row['citta'];
									}									
								?> >
							</div>
							<div class="form-group">
								<label>Indirizzo</label>
								<input class="form-control" type="text" name="indirizzo" placeholder="<?php
									$id_utente= $_SESSION['user']['id'];
									$result=mysqli_query($db,"SELECT Indirizzo from utenti WHERE id='$id_utente'");
									while ($row = $result->fetch_assoc()) {
										echo $row['Indirizzo'];
									}									
								?> ">
							</div>
							<div class="form-group">
								<label>Provincia</label>
								<input class="form-control" type="text" name="provincia" placeholder=<?php
									$id_utente= $_SESSION['user']['id'];
									$result=mysqli_query($db,"SELECT Provincia from utenti WHERE id='$id_utente'");
									while ($row = $result->fetch_assoc()) {
										echo $row['Provincia'];
									}									
								?> >
							</div>
							<div class="form-group">
								<label>Cap</label>
								<input class="form-control" type="number" name="cap" placeholder=<?php
									$id_utente= $_SESSION['user']['id'];
									$result=mysqli_query($db,"SELECT Cap from utenti WHERE id='$id_utente'");
									while ($row = $result->fetch_assoc()) {
										echo $row['Cap'];
									}									
								?> >
							</div>
							
							<div class="form-group">
								<label>Domanda di sicurezza</label>
								<select class="form-control" name="domanda" >
									<option selected disabled><?php
									$id_utente= $_SESSION['user']['id'];
									$result=mysqli_query($db,"SELECT Domanda from utenti WHERE id='$id_utente'");
									while ($row = $result->fetch_assoc()) {
										echo $row['Domanda'];
									}									
								?> </option>
									<option value="Cognome da nubile di tua madre">Cognome da nubile di tua madre</option>
									<option value="Nome del tuo primo animale domestico">Nome del tuo primo animale domestico</option>
								</select>
									
							</div>
							<div class="form-group">
								<label>Risposta</label>
								<input class="form-control" type="tel" name="risposta" placeholder=<?php
									$id_utente= $_SESSION['user']['id'];
									$result=mysqli_query($db,"SELECT Risposta from utenti WHERE id='$id_utente'");
									while ($row = $result->fetch_assoc()) {
										echo $row['Risposta'];
									}									
								?>  >
							</div>
							
							</div>
								<button type="submit" class="primary-btn order-submit">Aggiorna Profilo</button>
								
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
