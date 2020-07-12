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
		$totale=(int)implode(mysqli_query($db,"SELECT COUNT(*) from carrello WHERE idUtente=$idUtente")->fetch_assoc());
		$totale_ordini=(int)implode(mysqli_query($db,"SELECT COUNT(*) from ordini WHERE idUtente=$idUtente")->fetch_assoc());
		include("headerLogged.php");
		
		$ord=mysqli_query($db,"SELECT  * from ordini WHERE idUtente=$idUtente GROUP BY idOrdine ORDER BY idOrdine DESC");
	}else{ include("header.php");
		echo '<script>alert("Registrati o accedi per visualizzare gli ordini");window.location="login.php";</script>';
	}
	$prezzoTot=0;
	
	
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
						<h3 class="breadcrumb-header">I miei ordini</h3>
						<ul class="breadcrumb-tree">
						<li><a href="index.php">Home</a></li>
							<li><a href="areaPersonale.php">Area personale</a></li>
							<li class="active">I miei ordini</li>
							</ul>
					</div>
				</div>
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
				<div class="container" style=" max-width:800px">
					<?php if(isLoggedIn()){
							if($totale_ordini==0){?>
						<div class="row">
							<h3 align="center">Non hai ancora effettuato ordini</h3>
						</div>
							<?php }else{?>
						<!-- Order Details -->
					
						<ul style="list-style-type:none;  margin-left:-150px;">
							
							<?php 
							
							while($ordine=$ord->fetch_assoc()){
								$id=$ordine['idOrdine'];
								$data=$ordine['data'];
								$totale_prezzo=(float)implode(mysqli_query($db,"SELECT totale from fatture WHERE idOrd=$id")->fetch_assoc());
								$totale_articoli=(int)implode(mysqli_query($db,"SELECT COUNT(*) from ordini WHERE idOrdine=$id and idUtente=$idUtente")->fetch_assoc());
								?>
							<li style="margin-bottom:10px;margin-top:20px"><div class="order-details" style="width:850px;heigth: 250px;">	
							
						
								<h3><strong>Ordine numero: </strong><?php echo $id; ?> </h3> 
								<div><strong>Effettuato giorno: </strong>  <?php echo $data; ?> </div>
								<div><strong>Numero tot. articoli </strong> <?php echo $totale_articoli; ?></div><br>
								<strong>Articoli </strong>
								<?php
								$res=mysqli_query($db,"SELECT * from ordini WHERE idOrdine=$id");
								while($row=$res->fetch_assoc()) {
									$idArticolo=$row['idArticolo'];
									$nome= (string)implode(mysqli_query($db,"SELECT nome from articoli WHERE id=$idArticolo")->fetch_assoc());
									?><div><?php echo $nome; ?></div><?php
								}
								
								?>
								<br>
								<div><strong>TOTALE</strong></div>
								<div ><strong id="costoFinale" class="order-total"><?php echo $totale_prezzo.'&#8364';?></strong></div>
								<a class="primary-btn order-submit" style="float:right;margin-top:-50px;" href="visualizzaOrdine.php?idOrd=<?php echo $id; ?>">Visualizza dettagli</a>
							
							
							</div></li>
							<?php } ?>
						
						</ul>
					
					<!-- /Order Details -->
				
							<?php } 
					}?>
				
				
			</div>
			<!-- /container -->
			
				
			
		
		</div>
		<!-- /SECTION -->
		
		