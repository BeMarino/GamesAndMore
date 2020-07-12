<!DOCTYPE html>
<?php
	include("functions.php");
	include("db.php");
	if(!isset($_SESSION))
		session_start();
	$id=isset($_POST['id'])? clear( $_POST['id']):false;
	
	
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
							<li class="active">modifica password utente</li>
							</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
</div>
		<!-- /BREADCRUMB -->
	<!-- SECTION -->
		
				
					
<div class="col-md-7">
	
	<div style="margin-top:-20px; margin-right:100px">
								
		<div  id="divPassword">
			<div class="form-group">
			<label>Inserisci nuova password</label>
				<input class="form-control" type="password" id="password1" autocomplete="New-password" placeholder="Nuova password" required >
			</div>
			
			<div class="form-group">
			<label>Conferma password</label>
				<input class="form-control" type="password" id="password2" AUTOCOMPLETE="Off" placeholder="Conferma Password" required >
			</div>
			<button  Style="margin-left:390px;margin-bottom:15px"  class="primary-btn order-submit" onClick=modificaPass(<?php echo $id?>)>Modifica Password</button>
		</div>		
	</div>

</div>
		
<script>

</script>	