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

       <!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Revoca permessi</h3>
						
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
						
						<div class="billing-details" style="margin-top:-25px">
							
							
							<div class="form-group">
								<select class="form-control" id="utente" required>
									<?php	
										$idUtente=$_SESSION['user']['id'];
										$result = mysqli_query($db,"SELECT * from utenti where Admin=1 AND id!=$idUtente");
										echo '<option selected disabled>Seleziona utente </option>';
										while ($row = $result->fetch_assoc()) {
											echo '<option value="' . $row['Email']. '">'.$row['Nome'].' '.$row['Cognome'].' - '.$row['Email'].'</option>';
										} ?>
								</select>
									
							</div>
							
						</div>
						
						<button Style="margin-left:390px; margin-top:-30px;margin-bottom:15px"  class="primary-btn order-submit" onClick=rimuoviAdmin(utente.id)>Revoca permessi</button>
								
							
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
	
	function rimuoviAdmin(emailUtente){
		
		var email=document.getElementById(emailUtente).value;
		

		 $.ajax({
		  type: "POST",
		  url: "rimuoviAdmin1.php",
		  data: ({email: email}),
		  success: function (result) {
			
			  if(result==1){
			  alert("Hai revocato i permessi a "+email);
			  window.location="index.php"
			  }
			  else  if(result==2){
			  alert("Errore durante la richiesta");
			  window.location="rimuoviAdmin.php";
			  }
		  }, dataType: 'text'
		});
		
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
