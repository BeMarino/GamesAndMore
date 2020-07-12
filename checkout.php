<!DOCTYPE html>
<?php 

	include("db.php");
	include("functions.php");
	if(!isset($_SESSION))
		session_start;
	if(isLoggedIn()){
		$idUtente=$_SESSION['user']['id'];
		$totale=(int)implode(mysqli_query($db,"SELECT COUNT(*) from carrello WHERE idUtente=$idUtente")->fetch_assoc());
		include("headerLogged.php");
		
		$c=mysqli_query($db,"SELECT  * from carrello WHERE idUtente=$idUtente");
	}else{ include("header.php");
		echo '
	<script> alert("Effettua il login per fare un acquisto"); window.location("index.php");</script>';
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
						<h3 class="breadcrumb-header">Spedizione</h3>
						<ul class="breadcrumb-tree">
						<li><a href="index.php">Home</a></li>
							<li><a href="carrello.php">Carrello</a></li>
							<li class="active">Spedizione</li>
						</ul>
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
						<!-- Billing Details -->
					<form id="indirizzoDiverso" method="post" action="pagamento.php" >
						<div style="margin-left:-50px;width:600px" class="billing-details">
							<div class="section-title">
								<h3 class="title">Dati di fatturazione e spedizione</h3>
							</div>
						
							<div class="form-group">
								<input class="input" type="text" name="nomef"  value="<?php echo $_SESSION['user']['Nome'];?>" placeholder="Nome" required>
							</div>
							<div class="form-group">
								<input class="input" type="text"  name="cognomef" value="<?php echo $_SESSION['user']['Cognome'];?>" placeholder="Cognome" required>
							</div>
							<div class="form-group">
								<input class="input" type="text"  name="indirizzof" value="<?php echo $_SESSION['user']['Indirizzo'];?>" placeholder="Indirizzo" required>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="cittaf" value="<?php echo $_SESSION['user']['Citta'];?>" placeholder="Città" required>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="provinciaf" value="<?php echo $_SESSION['user']['Provincia'];?>" placeholder="Provincia" required>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="capf" value="<?php echo $_SESSION['user']['Cap'];?>" placeholder="CAP" required>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="paesef" value="<?php echo $_SESSION['user']['Nazione'];?>" placeholder="Paese" required>
							</div>
							
						</div>
						<!-- /Billing Details -->
						
						<div class="col-md-5 order-details" style="margin-left:700px;margin-top:-400px;min-width:450px">
						<div class="section-title text-center">
							<h3 class="title">Riepilogo ordine</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>ARTICOLO</strong></div>
								<div><strong>PREZZO</strong></div>
							</div>
							<div class="order-products">
							<?php 
							
							while($carrello=$c->fetch_assoc()){
								$id=$carrello['idArticolo'];
								$a=mysqli_query($db,"SELECT * from articoli WHERE id=$id");
								$articolo=$a->fetch_assoc();
								?>
								<div class="order-col">
									<div id="info<?php echo $articolo['id'];?>1"><?php echo $carrello['quantita'].'x '.$articolo['nome'];?></div>
									<div id="info<?php echo $articolo['id'];?>2"><?php echo $carrello['quantita']*$articolo['prezzo'].'&#8364';?></div>
							</div><?php $prezzoTot+=$carrello['quantita']*$articolo['prezzo'];}
									if($prezzoTot>300){echo "<div class='order-col' id='sconto'><font color='green'><strong>Sconto 30%</strong></font>";
									echo"<div id='sconto2'><font color='green'><strong>".number_format(-$prezzoTot/10,2)*3 .'</font>&#8364</strong>'."</div></div>";}
									else if($prezzoTot>200&&$prezzoTot<300){echo "<div class='order-col' id='sconto'><font color='green'><strong>Sconto 20%</strong></font>";
									echo"<div id='sconto2'><font color='green'><strong>".number_format(-$prezzoTot/10,2)*2 .'</font>&#8364</strong>'."</div></div>";}
									else if($prezzoTot>100&&$prezzoTot<200){echo "<div class='order-col' id='sconto'><font color='green'><strong>Sconto 10%</strong></font>";
									echo"<div id='sconto2'><font color='green'><strong>".number_format(-$prezzoTot/10 ,2).'</font>&#8364</strong>'."</div></div>";}
								?>
								
							</div>
							
							<div class="order-col">
								<div><strong>TOTALE</strong></div>
								<div><strong class="order-total"><?php
									if($prezzoTot>300) echo number_format($prezzoTot/10*7,2) .'&#8364';
									
									else if($prezzoTot>200&&$prezzoTot<300)echo number_format($prezzoTot/10*8,2) .'&#8364';
									
									else if($prezzoTot>100&&$prezzoTot<200)echo number_format($prezzoTot/10*9,2) .'&#8364';
									else echo $prezzoTot.'&#8364';
								?></strong></div>
							</div>
						</div>
						
						
						
					</div>
					<!-- /Order Details -->

						
<!-- Shiping Details -->
						<div class="shiping-details" style="margin-left:-50px;width:600px">
							
						<div class="input-checkbox">
								<input type="checkbox" id="shipingAddress" onclick=spostaBottone("bottone")>
								<label for="shipingAddress">
									<span></span>
									Spedire ad un indirizzo diverso?
								</label>
								<div class="caption">
									<div class="form-group">
										<input class="input" type="text" id="nome" name="nome" placeholder="Nome">
									</div>
									<div class="form-group">
										<input class="input" type="text" id="cognome" name="cognome" placeholder="Cognome">
									</div>
									<div class="form-group">
										<input class="input" type="text" id="indirizzo" name="indirizzo" placeholder="Indirizzo">
									</div>
									<div class="form-group">
										<input class="input" type="text" id="citta" name="citta" placeholder="Città">
									</div>
									<div class="form-group">
										<input class="input" type="text" id="provincia"name="provincia" placeholder="Provincia">
									</div>
									<div class="form-group">
										<input class="input" type="text" id="cap" name="cap" placeholder="CAP">
									</div>
									<div class="form-group">
										<input class="input" type="text" id="paese"name="paese" placeholder="Paese">
									</div>
									
								
								</div>
							</div>
						</div><div class="order-notes"  style="margin-left:-55px;width:600px">
							<textarea class="input" name="note" id="note" placeholder="Note ordine"></textarea>
						</div>
						<button  type="submit" id="bottone" style="position:absolute;margin-top:-160px;margin-left:300px" class="primary-btn order-submit" >Vai al pagamento</button>
					
					<form>
					</div>
						<!--Shiping Details -->

					
						
						
					</div>

					
					
					
					
					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
<?php include("footer.php");?>

<script>
	
	
	
	
	function spostaBottone(bottone) {
		if(document.getElementById("shipingAddress").checked==true){
			document.getElementById(bottone).style="position:absolute; margin-top:-150px; margin-left:300px";
			document.getElementById("note").style="margin-top:30px";
			document.getElementById("nome").required=true;
			document.getElementById("cognome").required=true;
			document.getElementById("indirizzo").required=true;
			document.getElementById("paese").required=true;
			document.getElementById("citta").required=true;
			document.getElementById("cap").required=true;
			document.getElementById("provincia").required=true;
		}else{
			document.getElementById("indirizzoDiverso").reset(); 
			document.getElementById(bottone).style="position:absolute;margin-top:-160px;margin-left:300px";
			document.getElementById("note").style="";
			document.getElementById("nome").required=false;
			document.getElementById("cognome").required=false;
			document.getElementById("indirizzo").required=false;
			document.getElementById("paese").required=false;
			document.getElementById("citta").required=false;
			document.getElementById("cap").required=false;
			document.getElementById("provincia").required=false;
		}
		
		
			
	}
	
	
	</script>