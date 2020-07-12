<!DOCTYPE html>
<?php
include("functions.php");
include("db.php");
if(!isset($_SESSION))
	session_start();

if(isLoggedIn()){
	if (isAdmin()) {
		$idUtente=isset($_GET['idUtente'])?clear($_GET['idUtente']):false;
	}
	else{
	$idUtente=$_SESSION['user']['id']; 
	}
	
	$anagrafica=mysqli_query($db,"SELECT  * from utenti WHERE id=$idUtente ");
}else{ include("header.php");
	echo '<script>alert("Registrati o accedi per visualizzare il carrello");window.location="registrazione1.php";</script>';
}
$prezzoTot=0;
$row=$anagrafica->fetch_assoc();

	
?>


<div id="breadcrumb" class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<div class="col-md-12">
				<h3 class="breadcrumb-header">Profilo utente</h3>
				<ul class="breadcrumb-tree">
				<li><a href="index.php">Home</a></li><?php if(isAdmin())echo'
					<li><a href="areaAdmin.php">Area personale</a></li>';
					else echo '<li><a href="areaPersonale.php">Area personale</a></li>';?>
					<li ><a href="ricercaUtente.php">ricerca utente</a></li>
					<li class="active">profilo utente</li>
					</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /BREADCRUMB -->


				
					
<div class="col-md-7">
	
	<div style="margin-top:-20px; margin-right:100px">
		<form method="post" action="aggiornaProfilo1.php">
		<div class="form-group">
			<label>Nome</label>
			<input class="form-control" type="text" readonly id="Nome"  placeholder=<?php
				
				
					echo $row['Nome'];
										
			?> >
		</div>
		<div class="form-group">
			<label>Cognome</label>
			<input class="form-control" type="text" readonly id="Cognome" placeholder=<?php
				
				
					echo $row['Cognome'];
													
			?>  >
		</div>
		<div class="form-group">
			<label>Email</label>
			<input class="form-control" type="email" readonly name="email" placeholder=<?php
				
					echo $row['Email'];
													
			?> >
		</div>
		
		<div class="form-group">
			<label>Paese</label>
			<input class="form-control" type="text" readonly name="paese" placeholder=<?php
				
					echo $row['Nazione'];
													
			?> >
		</div>
		<div class="form-group">
			<label>Città</label>
			<input class="form-control" type="text" readonly name="città" placeholder=<?php
					echo $row['Citta'];
													
			?> >
		</div>
		<div class="form-group">
			<label>Indirizzo</label>
			<input class="form-control" type="text" readonly name="indirizzo" placeholder="<?php
					echo $row['Indirizzo'];
													
			?> ">
		</div>
		<div class="form-group">
			<label>Provincia</label>
			<input class="form-control" type="text" readonly name="provincia" placeholder=<?php
					echo $row['Provincia'];
													
			?> >
		</div>
		<div class="form-group">
			<label>CAP</label>
			<input class="form-control" type="number" readonly name="cap" disabled placeholder=<?php
					echo $row['Cap'];
													
			?> >
		</div>
		
		<div class="form-group">
			<label>Domanda di sicurezza</label>
			<select class="form-control" readonly name="domanda" disabled>
				<option selected disabled><?php
					echo $row['Domanda'];
													
			?> </option>
				<option value="Cognome da nubile di tua madre">Cognome da nubile di tua madre</option>
				<option value="Nome del tuo primo animale domestico">Nome del tuo primo animale domestico</option>
			</select>
				
		</div>
		<div class="form-group">
			<label>Risposta</label>
			<input class="form-control" type="tel" readonly name="risposta" placeholder=<?php
					echo $row['Risposta'];
													
			?>  >
		</div>
		
	
		</form>
	</div>

</div>

				
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
	
