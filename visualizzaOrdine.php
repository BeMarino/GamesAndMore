<!DOCTYPE html>
<?php
	include("functions.php");
	include("db.php");
	if(!isset($_SESSION))
		session_start();
	
	if(isLoggedIn()){
	
		$idOrdine=isset($_GET['idOrd'])?clear($_GET['idOrd']):false;
		include("headerLogged.php");
		
		$ord=mysqli_query($db,"SELECT  * from ordini WHERE idOrdine=$idOrdine");
		$ordine=$ord->fetch_assoc();
		$idUtente=$ordine['idUtente'];
		$d=$ordine['data'];
		$data= implode(mysqli_query($db,"SELECT date('$d')")->fetch_assoc());
		if (!($_SESSION['user']['id']==$idUtente)&&!isAdmin()) echo '<script>alert("Non puoi accedere a quest\'area.");window.location="index.php";</script>';
		
		
	}else{ include("header.php");
		echo '<script>alert("Registrati o accedi.");window.location="registrazione1.php";</script>';
	}
	$prezzoTot=implode(mysqli_query($db, "SELECT TRUNCATE(SUM(prezzo_unita*quantita),2) as totale from ordini  WHERE idOrdine=$idOrdine")->fetch_assoc());
	$totale_prezzo=implode(mysqli_query($db,"SELECT totale from fatture WHERE idOrd=$idOrdine")->fetch_assoc());
	$spedizione=implode(mysqli_query($db,"SELECT TipoSped from fatture WHERE idOrd=$idOrdine")->fetch_assoc());
	$sconto=implode(mysqli_query($db,"SELECT ScontoPerc from fatture WHERE idOrd=$idOrdine")->fetch_assoc());
	$email=implode(mysqli_query($db,"SELECT Email from utenti WHERE id=$idUtente")->fetch_assoc());
	$nome=implode(mysqli_query($db,"SELECT Nome from utenti WHERE id=$idUtente")->fetch_assoc());
	$cognome=implode(mysqli_query($db,"SELECT Cognome from utenti WHERE id=$idUtente")->fetch_assoc());
	$indFatt=(mysqli_query($db,"SELECT Indirizzo from fatture where idOrd=$idOrdine")->fetch_assoc());
	$paeseFatt=(mysqli_query($db,"SELECT Paese from fatture where idOrd=$idOrdine")->fetch_assoc());
	$provFatt=(mysqli_query($db,"SELECT Provincia from fatture where idOrd=$idOrdine")->fetch_assoc());
	$capFatt=(mysqli_query($db,"SELECT Cap from fatture where idOrd=$idOrdine")->fetch_assoc());
	$cittaFatt=(mysqli_query($db,"SELECT Citta from fatture where idOrd=$idOrdine")->fetch_assoc());
	
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
								<?php if($idUtente!=$_SESSION['user']['id']) echo '<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Ordini utente</h3>
						<ul class="breadcrumb-tree">
						<li><a href="index.php">Home</a></li>
							<li><a href="areaAdmin.php">Area personale</a></li>
							<li ><a href="ricercaUtente.php">ricerca utente</a></li>
							<li class="active">ordini utente n: '.$idUtente.'</li>
							</ul>
					</div>
				</div>';
				else echo'
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">I miei ordini</h3>
						<ul class="breadcrumb-tree">
						<li><a href="index.php">Home</a></li>
							<li><a href="areaPersonale.php">Area personale</a></li>
							<li><a href="iMieiOrdini.php">I miei ordini</a></li>
							<li class="active">Dettaglio ordine</li>
							</ul>
					</div>
				</div>
				<!-- /row -->';?>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
				<div class="container" style=" max-width:800px">
					<?php if(isLoggedIn()){ ?>
							
						<!-- Order Details -->
					
						<ul style="list-style-type:none;  margin-left:-150px;">
							
							<?php 
								$id=$ordine['idOrdine'];
								$quantità=(int)$ordine['quantita'];
								$idArticolo=$ordine['idArticolo'];
								$nomeArticolo=(string)implode(mysqli_query($db,"SELECT nome from articoli WHERE id=$idArticolo")->fetch_assoc());
								$immagine=(string)implode(mysqli_query($db,"SELECT immagine from articoli WHERE id=$idArticolo")->fetch_assoc());
								$categoria=(string)implode(mysqli_query($db,"SELECT categoria from articoli WHERE id=$idArticolo")->fetch_assoc());
								$prezzo_articoli=(float)($quantità*(float)$ordine['prezzo_unita']);
								
								$dataTime = new dateTime($d);
								?>
								<div style="float:left;margin-left:-50px">
								<h3><strong>Ordine Numero: </strong><?php echo $id; ?> </h3> <br>
								<div><strong>Data di acquisto: </strong>  <?php echo $data; ?> </div><br>
								<div><strong>Effettuato da: </strong>  <?php echo $nome." ".$cognome; ?> </div><br>
								<div><strong>Email: </strong>  <?php echo $email; ?> </div><br>
								<div><strong>Destinatario: </strong>  <?php echo $ordine['destinatario']; ?> </div><br>
								<div><strong>Indirizzo di fatturazione: </strong>  <?php echo (string)implode($indFatt).", ".(string)implode($cittaFatt).", ".(string)implode($paeseFatt).", ".(string)implode($provFatt).", ".(string)implode($capFatt); ?> </div><br>
								<div><strong>Indirizzo di spedizione: </strong>  <?php echo $ordine['indirizzo']; ?> </div><br>
								<div><strong>Tipo di spedizione: </strong>  <?php echo $spedizione;?> </div><br>
								<div><strong>Prezzo totale: </strong>  <?php echo $prezzoTot;?>&#8364; </div><br>
								<div><strong>Sconto applicato: </strong>  <?php echo $sconto."%";?> </div><br>
								<div><strong>Prezzo finale scontato: </strong>  <?php echo $totale_prezzo;?>&#8364; </div><br>
								<div><strong>Tipo pagamento: </strong>  <?php echo $ordine['metodoPagamento']; ?> </div><br>
								<button style="margin-top:30px"class="primary-btn" onClick=annullaOrdine(<?php echo $id?>,<?php echo date_format($dataTime, 'Y')?>,<?php echo date_format($dataTime, 'm')?>,<?php echo date_format($dataTime, 'd')?>)>Annulla ordine</button>
								</div>
								
							

					<div style="float:right ;margin-right:-320px">
								<h3><strong>Articoli contenuti </strong> </h3> 
								<div class="product" onfocus="none" style="height:210px; max-width:650px;margin-top:-15px">
								<li style="margin-bottom:10px;margin-top:20px"><div  style="width:850px;heigth: 250px;">	
								
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
								
								</div></li>
								</div>
								
								<?php
							while($ordine=$ord->fetch_assoc()){
								
								$quantità=$ordine['quantita'];
								$idArticolo=$ordine['idArticolo'];
								$nomeArticolo=(string)implode(mysqli_query($db,"SELECT nome from articoli WHERE id=$idArticolo")->fetch_assoc());
								$immagine=(string)implode(mysqli_query($db,"SELECT immagine from articoli WHERE id=$idArticolo")->fetch_assoc());
								$categoria=(string)implode(mysqli_query($db,"SELECT categoria from articoli WHERE id=$idArticolo")->fetch_assoc());
								$prezzo_articoli=$quantità*$ordine['prezzo_unita'];
								
								?>
								<div class="product" onfocus="none" style="height:210px; max-width:650px;margin-top:-5px">
									<li style="margin-bottom:10px;margin-top:20px">
										<div  style="width:850px;heigth: 250px;">	
											
											<div class="product-img" onfocus="none" style="position:absolute;max-height:200px; max-width:200px;margin-bottom:20px;margin-left:30px">
												<img style="height:210px; width:200px" src="<?php echo $immagine; ?>" alt="">
											</div>
										
											<div class="product-body" style="position:absolute; background-color:rgba(0, 0, 0, 0); min-height:150px; margin-top:40px; margin-left:30px">
												<a href="product.php?idArticolo=<?php echo $idArticolo; echo'"';?>">							
													<h3 class="product-name"><?php echo $nomeArticolo; ?></h3>
												</a>
										
												<p class="product-category"><?php echo $categoria; ?>
												</p>
												<h4 class="product-price"><?php echo $prezzo_articoli;?><a>&#8364;</a></h4>
												<div class="qty-label"  style="margin-left:480px;margin-right:20px; margin-top:-50px; text-transform:uppercase; font-weight:500">
													Quantità <?php echo $quantità; ?>
												</div>
												
											</div>
										</div>	
									</li>
								</div>
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
		
		<?php include("footer.php");?>
	<script>
	function annullaOrdine(idOrdine,anno,mese,giorno){
		
		var date = new Date(anno,mese-1,giorno);
		
		var dateEnd=new Date();
		var numberOfDaysToAdd = 7;
		dateEnd.setDate(date.getDate() + numberOfDaysToAdd); 
		alert(dateEnd);
		if(confirm("Sei sicuro di voler annullare l'ordine?"))
			if(date<=dateEnd){
				$.ajax({
				  type: "POST",
				  url: "annullaOrdine.php",
				  data: ({idOrdine: idOrdine}),
				  success: function (result) {
					  
					 if(result==1){
						  alert("Ordine annullato.");
						  window.location.replace("iMieiOrdini.php");
					  }else if(result==2){
						  alert("Errore durante l'annullamento dell'ordine.");
						  window.location.replace("iMieiOrdini.php");
					  }if(result==3){
						  alert("Non puoi accede a questa pagina.");
						  window.location.replace("iMieiOrdini.php");
					  }
				  }, dataType: 'text'
				});
			}else alert("Il termine per l'annullamento dell'ordine è scaduto.");
			
		
		
	}
	</script>