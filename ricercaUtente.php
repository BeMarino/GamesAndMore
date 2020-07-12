<?php

	include("db.php");
	include("functions.php");
	
	if(!isset($_SESSION)){
    session_start();
}	
	
	if(!isAdmin()){
		echo'<script> alert("Devi essere un amministratore per accedere a questa pagina");window.location.replace("index.php");</script>';
		include("header.php");
	}else include("headerAdmin.php");
	
	
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
						<h3 class="breadcrumb-header">Ricerca un utente</h3>
						
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->
        
		<!-- SECTION -->
		<div class="section" style="margin-bottom:100px;">
			<!-- container -->
			<div class="container">
				<!-- row -->

					<div class="row" >	
						<div style="margin-top:-25px;  position: relative;">	
							
							<div class="form-group">
								<select class="form-control" style="max-width:500px;" id="utenti" required >
									<option selected disabled>Seleziona un utente </option>;
									<?php $utenti=mysqli_query($db,"SELECT * FROM utenti ORDER BY Cognome");
									while($row=$utenti->fetch_assoc()) {
										if($row['id']!=$_SESSION['user']['id']){
									?>
										<option  name="selettore" value="utente" id=<?php echo $row['id']; ?> onClick=mostraAnagrafica(this.id)><?php echo $row['Nome'].' '.$row['Cognome'].', '.$row['Email'].', '.$row['Citta']; ?></option>;
									<?php }}
									?>	
									</select>
									<form id="id" Style="display:none"></form>
									
							</div>
							
							
						<div class="col-md-5 azioni-admin order-details absolute" id ="azioniAdmin" style="display:none; " >
							
							<div id="breadcrumb" class="section" style="margin-left:-30px;margin-right:-30px;margin-top:-14px">
							<!-- container -->
								<div class="container">
									<!-- row -->
									<div class="row">
										<div class="col-md-12">
											<h3 class="breadcrumb-header" style="margin-left:125px">Azioni admin</h3>
											
										</div>
									
									<!-- /row -->
								</div>
							<!-- /container -->
							</div>
							</div>
							<button style="margin-left:90px" type="submit"  class="primary-btn order-submit" onClick=modificaAnagraficaUtenti()>Modifica dati utente</button>
							<button style="margin-left:90px;padding-right:39px" type="submit" class="primary-btn order-submit"  onClick=modificaPassword()>Modifica password</button>
							<button style="margin-left:90px; padding-right:23px" type="submit"  class="primary-btn order-submit" onClick=mostraOrdini(<?php echo $row['id']?>)>Mostra ordini utente</button>
							

						
						</div>
							<div class="col-md-5 azioni-admin order-details absolute" id="alert" style="display:none">
						<div class="product-img" style="margin-left:100px">
							<img src="./img/alert.png" alt="">
						</div>
						<label style="margin-left:65px">Inserisci solo i dati che vuoi modificare</label>
					</div>	
						<div style="display:inline-block;margin-left: -25px; " class="form-group" id="lista" ></div>
						</div>
						
						<div style="display:inline-block;margin-left: -25px; " class="form-group" id="demo" ></div>
						</div>
							
						</div>	
						
						
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
	
	
	function mostraAnagrafica(idUtenti){
	
		 $.ajax({
		  type: "POST",
		  url: "mostraAnagrafica.php?idUtente="+idUtenti,
		  
		  success: function (result) {
			document.getElementById("lista").innerHTML=result;
			  
		  }, dataType: 'text'
		});
		document.getElementById("azioniAdmin").style="display:inline-block;position:absolute; margin-right:25px; margin-top:200px;";
	
		document.getElementById("id").value=idUtenti;
	}
	
	
	
	function modificaAnagraficaUtenti(){
		
		var id=document.getElementById("id").value;
		 $.ajax({
		  type: "POST",
		  url: "modificaAnagrafica.php?idUtente="+id,
		  
		  success: function (result) {
			document.getElementById("lista").innerHTML=result;
			  
		  }, dataType: 'text'
		});
		document.getElementById("alert").style="display:inline-block;position:absolute; margin-right:25px; margin-top:600px;";
		
	}



	function mostraOrdini(){

		
		var id=document.getElementById("id").value;
		var categoria=document.getElementById(id).value;
		
		$.ajax({
			type: "POST",
			url: "mostraOrdini.php?idUtente="+id,
			data: ({categoria: categoria}),
			success: function (result) {
			document.getElementById("lista").innerHTML=result;
			  
				},
				dataType: 'text'
		});
		document.getElementById("alert").style="display:none";
	}
	
	function aggiornaProfilo(idUtente){

		var nome=$("#NomeForm[type=text]")[0].value;
		var cognome=$("#cognomeForm[type=text]")[0].value;
		var indirizzo=$("#indirizzoForm[type=text]")[0].value;
		var citta=$("#cittàForm[type=text]")[0].value;
		var paese=$("#paeseForm[type=text]")[0].value;
		var email=$("#emailForm[type=email]")[0].value;
		var provincia=$("#provinciaForm[type=text]")[0].value;
		var cap=$("#capForm[type=number]")[0].value;
		var domanda=$("#domandaForm")[0].value;
		var risposta=$("#rispostaForm")[0].value;
		
		$.ajax({
		  type: "POST",
		  url: "aggiornaProfilo2.php",
		  data: ({id: idUtente, Nome:nome, Cognome:cognome, Indirizzo:indirizzo, Citta:citta, Nazione:paese, Email:email, Provincia:provincia, Cap:cap, Domanda:domanda, Risposta:risposta}),
		  success: function (result) {

			 if(result==1){
				 
				alert("Anagrafica utente modificata"); 
				window.location.reload();
			 }else {
				  alert("Errore");
				  window.location.reload();
			  }
		  }, dataType: 'text'
		});
	}
	
	function modificaPassword(){
	
		var idUtente= $('#utenti option:selected')[0].id;
		
		$.ajax({
			type: "POST",
			url: "modificaPassword.php",
			data: ({id:idUtente}),
			success: function (result) {
			document.getElementById("lista").innerHTML=result;
			  
				},
				dataType: 'text'
		});
		document.getElementById("alert").style="display:none";
	}
	
	function modificaPass(idUtente){

		
		var pass1=$("#password1[type=password]")[0].value;
		var pass2=$("#password2[type=password]")[0].value;
		
		$.ajax({
				type: "POST",
				url: "modificaPassword1.php",
				data: ({id1:idUtente ,pass1:pass1, pass2:pass2}),
				success: function (result) {
				if(result==1)alert("Utente non trovato");
				else if(result==3)alert("Password utente correttamente modificata");
				else if (result==4)alert("La query non è andata a buon fine");
				else alert("Le password non coincidono");
					},
					dataType: 'text'
					
			});
			mostraAnagrafica(idUtente);
			
			 	
		
	}

	</script>
	

 <?php
	include('footer.php');
	?>