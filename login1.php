
<?php
	
	include("functions.php");
	
	if(!isset($_SESSION)){
		session_start();
	}
	
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
						<h3 class="breadcrumb-header">Login</h3>
						
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
							<form method="post" action="login2.php">
							<div class="form-group">
								<input class="form-control" type="email" name="Email" placeholder="Email" required>
							</div>
							<div class="form-group">
								<input class="form-control" type="password" name="Password" placeholder="Password" required>
							</div>
							</div>
								<button type="submit" class="primary-btn order-submit">Login</button>
								<a style="margin-left:320px"  href="recuperaPass.php"><font color="red">Password dimenticata?</font></a>
							</div>	
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
