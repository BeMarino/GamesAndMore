<?php
	if(!isset($_SESSION)){
    session_start();
}
	include ("functions.php");
	if(isLoggedIn())
		if(isAdmin()){
			header("Location: areaAdmin.php");
			EXIT;
		}else include('headerLogged.php');
	else {
		header("Location: index.php");
		EXIT;
	}
	include ('db.php');

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
						<a   style="position:absolute;margin-top:10px" href="ordiniUtente.php"><font color="red">I tuoi ordini</font></a><br><br>
						<a   href="carrello.php"><font color="red">Vai al carrello</font></a><br><br>
						<a class="title"  href="ordiniUtente.php"><font color="red">Annulla ordine</font></a><br><br>
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
								<a href="aggiornaProfilo.php"><font color="red">Aggiorna Profilo</font></a>
								
								</strong>
							</div>
						</div>
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
