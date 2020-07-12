<?php
	if(!isset($_SESSION)){
    session_start();
}
	include('header.php');
?>


       <!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Recupera Password</h3>
						
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
							<label>Email</label>
								<input class="form-control" type="email" id="email" placeholder="Email" required>
							</div>
							<div class="form-group">
							<label>Domanda di sicurezza</label>
								<select class="form-control" id="domanda" required>
									<option selected disabled>Domanda di sicurezza</option>
									<option value="Cognome da nubile di tua madre">Cognome da nubile di tua madre</option>
									<option value="Nome del tuo primo animale domestico">Nome del tuo primo animale domestico</option>
								</select>
									
							</div>
							<div class="form-group">
							<label>Risposta</label>
								<input class="form-control" type="text" autocomplete="New-password" id="risposta" placeholder="Risposta" required>
							</div>
							</div>
								<button Style="margin-left:390px; margin-top:-30px;margin-bottom:15px"  class="primary-btn order-submit" onClick=recuperaPass()>Conferma dati</button>
								
						<div style="display:none" id="divPassword">
							<div class="form-group">
							<label>Inserisci nuova password</label>
								<input class="form-control" type="password" id="password1" placeholder="Nuova password" required >
								<h6><font color=red>La password deve contenere almeno 6 caratteri</font></h6>
							</div>
							
							<div class="form-group">
							
							<label>Conferma password</label>
								<input class="form-control" type="password" id="password2" AUTOCOMPLETE="Off" placeholder="Conferma Password" required >
							</div>
							<button  Style="margin-left:390px;margin-bottom:15px"  class="primary-btn order-submit" onClick=modificaPass()>Modifica Password</button>
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
	
	function recuperaPass(){
		
		var email=document.getElementById("email").value;
		var domanda=document.getElementById("domanda").value;
		var risposta=document.getElementById("risposta").value;
		
		 $.ajax({
		  type: "POST",
		  url: "recuperaPass1.php",
		  data: ({email: email, domanda: domanda, risposta : risposta}),
		  success: function (result) {
			
			  if(result==1){
			  alert("L'email inserita non è associata a nessun account");
			  window.location="recuperaPass.php"
			  }
			  else  if(result==2){
			  alert("La domada di sicurezza non corrisponde");
			  window.location="recuperaPass.php";
			  }else  if(result==3){
			  alert("La risposta di sicurezza non corrisponde");
			  window.location("recuperaPass.php");
			  }
			  else {
			  document.getElementById("divPassword").style.display="";
			  }
		  }, dataType: 'text'
		});
		
	}
	
	function modificaPass(){
		
		var email=document.getElementById("email").value;
		var password1=document.getElementById("password1").value;
		var password2=document.getElementById("password2").value;
		
		if(password1!=password2){
			alert("Le password non coincidono");
		}else if(password1.length<8)
			alert("Inserire una password di almeno 8 caratteri");
			else{
			
		
		 $.ajax({
		  type: "POST",
		  url: "modificaPass.php",
		  data: ({email: email, pass1: password1}),
		  success: function (result) {
			
			  if(result==1){
			  alert("La tua password è stata modificata, clicca 'ok' per andare al login");
			  window.location="login1.php";
			  }
			  else if(result==2){
			  alert("C'è stato un errore, riprovare più tardi");
			  window.location="recuperaPass.php";
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
