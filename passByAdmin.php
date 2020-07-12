
<?php
	
	include("functions.php");
	
	if(!isset($_SESSION)){
		session_start();
	}
	
	
	include("headerLogged.php");
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
						<h3 class="breadcrumb-header">Modifica password</h3>
						
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->
        <div class="order-details" style="width:1000px; max-heigth:100px; margin-left:190px;margin-top:50px;margin-bottom:30px;">	
			<h4>Ciao <font color=red><?php echo $_SESSION['user']['Nome'];?></font>, la tua password è stata modifica per motivi di sicurezza , ti preghiamo di inserirne una nuova.</h4>
		</div>
		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-7">
						
						<div class="billing-details" style="margin-top:-25px">
							
							<div class="form-group">
								<input class="form-control" type="password" id="password1" placeholder="Nuova password" required>
								<h6><font color=red>La password deve contenere almeno 8 caratteri</font></h6>
							</div>
							<div class="form-group">
								<input class="form-control" type="password" id="password2" placeholder="Conferma password" required>
							</div>
							</div>
								<button style="margin-bottom:30px" type="submit" class="primary-btn order-submit" onClick=passByAdmin(<?php echo $_SESSION['user']['id'];?>)>conferma</button>
								
								
						</form>			
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
          <form role="form" method="post" action="recupero.php">
            <div class="form-group">
              <label for="email" style="color:#343a40; font-weight:700; margin-left:5px;">Email</label>
              <input type="text" class="form-control" name="email" placeholder="Inserisci email">
            </div>
              <button type="submit" value="invia" class="btn btn-outline-success btn-block"> Invia</button>
          </form>
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
		function passByAdmin(idUtente){
	
			
		var password1=document.getElementById("password1").value;
		var password2=document.getElementById("password2").value;
		
	
		
		if(password1!=password2){
			alert("Le password non coincidono");
		}else if(password1.length<8)
			alert("Inserire una password di almeno 8 caratteri");
			else{
			
		 $.ajax({
		  type: "POST",
		  url: "passByAdmin1.php",
		  data: ({id: idUtente, pass1: password1}),
		  success: function (result) {
			
			  if(result==1){
			  alert("La tua password è stata modificata");
			  window.location="index.php";
			  }
			  else if(result==2){
			  alert("C'è stato un errore, riprovare più tardi");
			  window.location="passByAdmin.php";
			  }
		  }, dataType: 'text'
		});
		}
		
	}
			
	
	</script>
	
 
 <?php
	include('footer.php');
	?>
