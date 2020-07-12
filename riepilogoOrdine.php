<?php 

	include("db.php");
	include("functions.php");
	
	if(!isset($_SESSION))
		session_start;
	
	if(isLoggedIn()){
		$idUtente=$_SESSION['user']['id'];
		$ord=mysqli_query($db,"SELECT *  FROM `ordini` WHERE idUtente=$idUtente AND idOrdine=(SELECT MAX( idOrdine) from ordini WHERE idUtente=$idUtente)");
		$ordine=$ord->fetch_assoc();
		include("headerLogged.php");	
		$c=mysqli_query($db,"SELECT  * from carrello WHERE idUtente=$idUtente");
	}else{ 
		include("header.php");
		echo '<script> alert("Effettua il login per fare un acquisto"); window.location="index.php";</script>';
	}
	$indFatt=(mysqli_query($db,"SELECT Indirizzo from fatture where idOrd=(SELECT MAX( idOrdine) from ordini WHERE idUtente=$idUtente)"))->fetch_assoc();
	$paeseFatt=(mysqli_query($db,"SELECT Paese from fatture where idOrd=(SELECT MAX( idOrdine) from ordini WHERE idUtente=$idUtente)"))->fetch_assoc();
	$provFatt=(mysqli_query($db,"SELECT Provincia from fatture where idOrd=(SELECT MAX( idOrdine) from ordini WHERE idUtente=$idUtente)"))->fetch_assoc();
	$capFatt=(mysqli_query($db,"SELECT Cap from fatture where idOrd=(SELECT MAX( idOrdine) from ordini WHERE idUtente=$idUtente)"))->fetch_assoc();
	$cittaFatt=(mysqli_query($db,"SELECT Citta from fatture where idOrd=(SELECT MAX( idOrdine) from ordini WHERE idUtente=$idUtente)"))->fetch_assoc();
	$nome=(mysqli_query($db,"SELECT Nome from utenti WHERE id=$idUtente")->fetch_assoc());
	$cognome=(mysqli_query($db,"SELECT Cognome from utenti WHERE id=$idUtente")->fetch_assoc());
	$prezzoTot=implode(mysqli_query($db, "SELECT TRUNCATE(SUM(prezzo_unita*quantita),2) as totale from ordini  WHERE idOrdine=(SELECT MAX( idOrdine) from ordini WHERE idUtente=$idUtente)")->fetch_assoc());
	$id=mysqli_query($db, "SELECT MAX( idOrdine) from ordini WHERE idUtente=$idUtente)");
	$totale_prezzo=implode(mysqli_query($db,"SELECT totale from fatture WHERE idOrd=(SELECT MAX( idOrdine) from ordini WHERE idUtente=$idUtente)")->fetch_assoc());
	$spedizione=implode(mysqli_query($db,"SELECT TipoSped from fatture WHERE idOrd=(SELECT MAX( idOrdine) from ordini WHERE idUtente=$idUtente)")->fetch_assoc());
	$sconto=implode(mysqli_query($db,"SELECT ScontoPerc from fatture WHERE idOrd=(SELECT MAX( idOrdine) from ordini WHERE idUtente=$idUtente)")->fetch_assoc());
	
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
				<h3 class="breadcrumb-header">Riepilogo ordine</h3>
				
			</div>
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>

<div class="order-details" style="width:1000px; max-heigth:100px; margin-left:190px;margin-top:50px;margin-bottom:30px;">	
			<h4></font>Il tuo ordine è stato confermato , di seguito troverai il riepilogo dell'ordine da te effettuato.</h4>
		</div>

<!-- /BREADCRUMB -->
<div class="section">
			<!-- container -->
				<div class="container" style=" max-width:800px">
					<?php if(isLoggedIn()){ ?>
							
						<!-- Order Details -->
					
					<ul style="list-style-type:none;  margin-left:-150px;">
							
							<?php 
								$id=$ordine['idOrdine'];
								$data=$ordine['data'];
								$quantità=(int)$ordine['quantita'];
								$idArticolo=$ordine['idArticolo'];
								$nomeArticolo=(string)implode(mysqli_query($db,"SELECT nome from articoli WHERE id=$idArticolo")->fetch_assoc());
								$immagine=(string)implode(mysqli_query($db,"SELECT immagine from articoli WHERE id=$idArticolo")->fetch_assoc());
								$categoria=(string)implode(mysqli_query($db,"SELECT categoria from articoli WHERE id=$idArticolo")->fetch_assoc());
								$prezzo_articoli=(float)($quantità*(float)$ordine['prezzo_unita']);
								
								
								?>
								<div style="float:left;margin-left:-50px">
								<h3><strong><font color =red>Riepilogo ordine</font> </strong></h3> <br>
								<h3><strong>Ordine Numero: </strong><?php echo $id; ?> </h3> <br>
								<div><strong>Data di acquisto: </strong>  <?php echo $data; ?> </div><br>
								<div><strong>Effettuato da: </strong>  <?php echo (string)implode($nome)." ".(string)implode($cognome); ?> </div><br>
								<div><strong>Email: </strong>  <?php echo $_SESSION['user']['Email']; ?> </div><br>
								<div><strong>Destinatario: </strong>  <?php echo $ordine['destinatario']; ?> </div><br>
								<div><strong>Indirizzo di spedizione: </strong>  <?php echo $ordine['indirizzo']; ?> </div><br>
								<div><strong>Indirizzo di fatturazione: </strong>  <?php echo (string)implode($indFatt).", ".(string)implode($cittaFatt).", ".(string)implode($paeseFatt).", ".(string)implode($provFatt).", ".(string)implode($capFatt); ?> </div><br>
								<div><strong>Tipo di spedizione: </strong>  <?php echo $spedizione;?> </div><br>
								<?php if($sconto!=0&&$sconto!=NULL)  {echo'
								<div><strong>Prezzo iniziale (senza spedizione): </strong>  '. $prezzoTot.'&#8364; </div><br>
								<div><strong>Sconto applicato: </strong> '. $sconto.'% </div><br>
								<div><strong>Prezzo finale: </strong>  '. $totale_prezzo.'&#8364 </div><br>'; } else echo'
									<div><strong>Prezzo totale: </strong>'.$totale_prezzo.'&#8364 </div><br>
								<div><strong>Tipo pagamento: </strong>'.$ordine['metodoPagamento'].' </div><br>';?>
							</div>

						<div style="float:right ;margin-right:-230px">
							<h3 style="margin-left:-100px"><font color=red><strong>Articoli contenuti </strong></font> </h3> 
							<li style="margin-bottom:10px;margin-top:20px">
							<div class="product" onfocus="none" style="height:210px; width:650px;margin-top:-15px; margin-left:-100px">
								<div  style="width:850px;heigth: 250px;">	
								
								<div class="product-img" onfocus="none" style="position:absolute;height:200px; width:200px;margin-top:5px;margin-left:30px">
									<img style="height:200px; width:200px;" src="<?php echo $immagine; ?>" alt="">
								</div>
									
								<div class="product-body" style="position:absolute; background-color:rgba(0, 0, 0, 0); min-height:150px; margin-top:40px; margin-left:30px">
									<a href="product.php?idArticolo=<?php echo $idArticolo; echo'"';?>">							
									<h3 class="product-name"><?php echo $nomeArticolo; ?></a></h3>
									
									<p class="product-category"><?php echo $categoria; ?>
									</p>
									<h4 class="product-price"><?php echo $prezzo_articoli;?><a>&#8364;</a></h4>
									<div class="qty-label"  style="margin-left:480px;margin-right:20px; margin-top:-50px; text-transform:uppercase; font-weight:500">
									Quantità <?php echo $quantità; ?>
									</div>
									
								</div>
								
								</div>
								</div>
							</li>	
								<?php
							while($ordine=$ord->fetch_assoc()){
								
								$quantità=$ordine['quantita'];
								$idArticolo=$ordine['idArticolo'];
								$nomeArticolo=(string)implode(mysqli_query($db,"SELECT nome from articoli WHERE id=$idArticolo")->fetch_assoc());
								$immagine=(string)implode(mysqli_query($db,"SELECT immagine from articoli WHERE id=$idArticolo")->fetch_assoc());
								$categoria=(string)implode(mysqli_query($db,"SELECT categoria from articoli WHERE id=$idArticolo")->fetch_assoc());
								$prezzo_articoli=$quantità*$ordine['prezzo_unita'];
								
								?>
								<li style="margin-bottom:10px;margin-top:20px">
								<div class="product" onfocus="none" style="height:210px; width:650px;margin-top:-5px;margin-left:-100px">
								<div  style="width:850px;heigth: 250px;">	
								
								<div class="product-img" style="position:absolute;height:180px; width:200px;margin-bottom:20px;margin-left:30px">
									<img style="height:210px; width:200px" src="<?php echo $immagine; ?>" alt="">
								</div>
									
								<div class="product-body" style="position:absolute; background-color:rgba(0, 0, 0, 0); min-height:150px; margin-top:40px; margin-left:30px">
									<a href="product.php?idArticolo=<?php echo $idArticolo; echo'"';?>">							
									<h3 class="product-name"><?php echo $nomeArticolo; ?></a></h3>
									
									<p class="product-category"><?php echo $categoria; ?>
									</p>
									<h4 class="product-price"><?php echo $prezzo_articoli;?><a>&#8364;</a></h4>
									<div class="qty-label"  style="margin-left:480px;margin-right:20px; margin-top:-50px; text-transform:uppercase; font-weight:500">
									Quantità <?php echo $quantità; ?>
									</div>
									
								</div>
								
								</div>
								</div>
								</li>
							<?php }?>
							
						</div>
					</ul>
					
					<!-- /Order Details -->
				
							<?php } 
					?>
				
				
			</div>
			<!-- /container -->
			
				
			
		
		</div>
		<!-- /SECTION -->
