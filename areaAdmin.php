<?php
	if(!isset($_SESSION)){
    session_start();
}
	include ('db.php');
	include ('functions.php');
	
	if(isLoggedIn()){
		include("headerLogged.php");
	}else include("header.php");
	if(!isAdmin()){
		echo '<script language="javascript"> window.alert("Non puoi accedere a questa area in quanto non sei un amministratore.");window.location="index.php";  </script>';
	}
	

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
						<h3 class="breadcrumb-header">Area personale</h3>
						
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

					<div class="col-md-5 order-details" style="float: right" >
						<a   href="iMieiOrdini.php"><font color="red">I miei ordini</font></a><br><br>
						<a   href="nominaAdmin.php"><font color="red">Nomina admin</font></a><br><br>
						<a   href="rimuoviAdmin.php"><font color="red">Rimuovi admin</font></a><br><br>
						<a   href="aggiungiArticolo.php"><font color="red">Aggiungi un nuovo articolo</font></a><br><br>
						<a   href="rimuoviArticolo.php"><font color="red">Rimuovi o reinserisci un articolo dal catalogo</font></a><br><br>
						<a   href="ricercaUtente.php"><font color="red">Ricerca un utente</font></a><br><br>
						
						
					</div>
					
					<!-- Order Details -->
					<div class="col-md-5 order-details" >
						<div class="section-title text-center">
							<h3 class="title">Il tuo profilo</h3>
						</div>
						<div class="product-img" style="margin-left:100px">
							<img src="./img/profilo.png" alt="">
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>Nome:</strong></div>
								<div>
								<?php
									$id_utente= $_SESSION['user']['id'];
									$result=mysqli_query($db,"SELECT Nome from utenti WHERE id='$id_utente'");
									while ($row = $result->fetch_assoc()) {
										echo $row['Nome'];
									}									
								?>
								</div>
							</div>
							<div class="order-col">
								<div><strong>Cognome:</strong></div>
								<div>
								<?php
									$id_utente= $_SESSION['user']['id'];
									$result=mysqli_query($db,"SELECT Cognome from utenti WHERE id='$id_utente'");
									while ($row = $result->fetch_assoc()) {
										echo $row['Cognome'];
									}									
								?>
								</div>
							</div>	
							<div class="order-col">
								<div><strong>Email:</strong></div>
								<div>
								<?php
									$id_utente= $_SESSION['user']['id'];
									$result=mysqli_query($db,"SELECT Email from utenti WHERE id='$id_utente'");
									while ($row = $result->fetch_assoc()) {
										echo $row['Email'];
									}				
															
								?>
								</div>
							</div>
							<div class="order-col">
								<div><strong>Indirizzo:</strong></div>
								<div>
								<?php
									$id_utente= $_SESSION['user']['id'];
									$result=mysqli_query($db,"SELECT Indirizzo from utenti WHERE id='$id_utente'");
									while ($row = $result->fetch_assoc()) {
										echo $row['Indirizzo'];
									}				
															
								?>
								</div>
							</div>
							<div class="order-col" style="margin-left:150px"><strong>
								<a href="aggiornaProfilo.php"><font color="red">Aggiorna Profilo</font>
								
								</strong></div>
							</div>
							
						
					<!-- /Order Details -->
					
				</div>	
				<!-- /row -->
			</div>
			
			<!-- /container -->
		</div>
		<!-- /SECTION -->
		
			
    <div class="modal fade bannerformmodal" tabindex="-1" role="dialog" aria-labelledby="bannerformmodal" aria-hidden="true" id="bannerformmodal">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body" style="padding:40px 50px;">
          <a
        </div>
      </div>
      
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
	
      $(document).ready(function(){
      $("#myBtn").click(function(){
      $("#myModal").modal();
    });
});
</script>
 <?php
	include('footer.php');
	?>
