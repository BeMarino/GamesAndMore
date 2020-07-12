<?php

	include("db.php");
	include("functions.php");
	
	if(!isset($_SESSION)){
    session_start();
}	
	if(isLoggedIn()){
		if(!isAdmin()){
			echo'<script> alert("Devi essere un amministratore per accedere a questa pagina");window.location("index.php");</script>';
			include("headdrLogged.php");
		}else include("headerAdmin.php");
	}else include("header.php");
?>
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
						<h3 class="breadcrumb-header">Rimuovi o reinserisci un articolo dal catalogo</h3>
						
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

						
						<div style="margin-top:-25px">
							
						
							<div style="width:500px;"class="form-group">
								<select class="form-control" id="categoria" required >
									<option selected disabled>Seleziona categoria </option>;
										<option value="videogames" onClick=mostraArticoli(categoria.id)>Videogames</option>;
										<option value="musica" onClick=mostraArticoli(categoria.id)>Musica</option>;
										<option value="film" onClick=mostraArticoli(categoria.id)>Film</option>;
										<option value="giochi da tavolo" onClick=mostraArticoli(categoria.id)>Giochi Da Tavolo</option>;
										<option value="gadget" onClick=mostraArticoli(categoria.id)>Gadget</option>;
									</select>
									
							</div>
							
							<div style="margin-left: -25px;"class="form-group" id="lista" >
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
	
	$(document).ready(function(){
		$('select[name="sicurezza"]').on('change', function(){
			var val = $(this).val();
			$('input[name="domanda"]').val($(this).val());
		});
		
		
	
	});
	
	function mostraArticoli(idCategoria){
		
		var categoria=document.getElementById(idCategoria).value;
		
		

		 $.ajax({
		  type: "POST",
		  url: "mostraArticoli.php",
		  data: ({categoria: categoria}),
		  success: function (result) {
			document.getElementById("lista").innerHTML=result;
			  
		  }, dataType: 'text'
		});
		
	}
	
	function rimuoviArticolo1(idArticolo){
		
		
		if(confirm("Sei sicuro di voler eliminare questo articolo? ")){	

		 $.ajax({
		  type: "POST",
		  url: "rimuoviArticolo1.php",
		  data: ({id: idArticolo}),
		  success: function (result) {
			if(result==1){
				alert("Articolo rimosso dal catalogo");
				window.location.reload();
			}
			else if(result==2){
				alert("Errore durante l'eliminazione dell'articolo , provare più tardi");
				window.location("rimuoviArticolo.php");
			}else alert("Articolo rimosso dal catalogo ma non dal carrello");
			
		  }, dataType: 'text'
		});
		
		}
	}
	
		function ripristinaArticolo1(idArticolo){
		
		
		if(confirm("Sei sicuro di voler ripristinare questo articolo? ")){	

		 $.ajax({
		  type: "POST",
		  url: "ripristinaArticolo1.php",
		  data: ({id: idArticolo}),
		  success: function (result) {
			if(result==1){
				alert("Articolo reinserito nel catalogo");
				window.location.reload();
			}
			else if(result==2){
				alert("Errore durante l'inserimento dell'articolo , riprovare");
				window.location("rimuoviArticolo.php");
			}
			
		  }, dataType: 'text'
		});
		
		}
	}



	</script>
	
    <script>
      $(document).ready(function(){
      $("#myBtn").click(function(){
      $("#myModal").modal();
    });
});
</script>
 <?php
	include('footer.php');
	?>
