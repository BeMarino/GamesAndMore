<!DOCTYPE html>
<?php
	include("functions.php");
	include("db.php");
	if(!isset($_SESSION))
		session_start();
	
	if(isLoggedIn()){
		$idUtente=$_SESSION['user']['id'];
		$totale=(int)implode(mysqli_query($db,"SELECT COUNT(*) from carrello WHERE idUtente=$idUtente")->fetch_assoc());
		include("headerLogged.php");
		
		$c=mysqli_query($db,"SELECT  * from carrello WHERE idUtente=$idUtente");
	}else{ include("header.php");
		echo '<script>alert("Registrati o accedi per visualizzare il carrello");window.location="registrazione1.php";</script>';
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
						<h3 class="breadcrumb-header">Il tuo carrello</h3>
						<ul class="breadcrumb-tree">
						<li><a href="index.php">Home</a></li>
							<li class="active">Carrello</li>
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
				<div class="container" style=" max-width:800px">
					<?php if(isLoggedIn()){
							if($totale==0){?>
						<div class="row">
							<h3 align="center">Il tuo carrello è vuoto</h3>
						</div>
							<?php }else{?>
						<!-- Order Details -->
					<div class="col-md-5 order-details" style="margin-left:625px;min-width:450px;">
						<div class="section-title text-center">
							<h3 class="title">Dettagli carrello</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>Articolo</strong></div>
								<div><strong>Prezzo</strong></div>
							</div>
							<div class="order-products">
							<?php 
							
							while($carrello=$c->fetch_assoc()){
								$id=$carrello['idArticolo'];
								$a=mysqli_query($db,"SELECT * from articoli WHERE id=$id");
								$articolo=$a->fetch_assoc();
								?>
								<div class="order-col">
									<div id="info<?php echo $articolo['id'];?>1"><a id="q<?php echo $articolo['id'];?>"><?php echo $carrello['quantita']?></a><?php echo'x '.$articolo['nome'];?></div>
									<div id="info<?php echo $articolo['id'];?>2"><?php echo $carrello['quantita']*$articolo['prezzo'].'&#8364';?></div>
								</div>
								
								<?php $prezzoTot+=$carrello['quantita']*$articolo['prezzo'];}
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
								<div ><strong id="costoFinale" class="order-total">
								<?php
									if($prezzoTot>300) echo number_format($prezzoTot/10*7,2) .'&#8364';
									
									else if($prezzoTot>200&&$prezzoTot<300)echo number_format($prezzoTot/10*8,2) .'&#8364';
									
									else if($prezzoTot>100&&$prezzoTot<200)echo number_format($prezzoTot/10*9,2) .'&#8364';
									else echo $prezzoTot.'&#8364';
								?></strong></div>
							</div>
						</div>
						
						<a href="checkout.php" class="primary-btn order-submit">procedi con l'ordine</a>
					</div>
					<!-- /Order Details -->
				
				<?php 
					$c=mysqli_query($db,"SELECT  * from carrello WHERE idUtente=$idUtente");
					while($carrello=$c->fetch_assoc()){
						$id=$carrello['idArticolo'];
						$a=mysqli_query($db,"SELECT * from articoli WHERE id=$id");
						$articolo=$a->fetch_assoc();
						
					?>
						
						
							<div class="product" onfocus="none" id="div<?php echo $articolo['id'];?>" style="height:230px; max-width:800px;margin-left:-270px;margin-top:-15px;">
								<div class="product-img" onfocus="none" style="position:absolute;height:200px; width:180px;margin-top:5px;margin-left:30px">
									<a href="product.php?idArticolo=<?php echo $articolo['id'];?>"><p>
									<img  style="height:200px; width:180px;margin-top:10px" src="<?php echo $articolo["immagine"]; ?>" alt="Immagine non disponibile">
									</p></a>
								</div>
									
								<div class="product-body" style="position:absolute; background-color:rgba(0, 0, 0, 0); min-height:150px; margin-top:40px; margin-left:30px">
									<a href="product.php?idArticolo=<?php echo $articolo['id']; echo'"';?>"></p>							
									<h3 class="product-name"><?php echo $articolo['nome']; ?></a></h3>
									<h4 class="product-price"><?php echo $articolo['prezzo'];?><a>&#8364;</a></h4>
									<p class="product-category"><?php echo $articolo["categoria"]; ?>
								
									<div class="qty-label"  style="margin-left:480px;margin-right:20px; margin-top:-100px; text-transform:uppercase; font-weight:500">
									Quantità
										<div class="input-number"  style="position:relative;width:100px">
											<input type="number" id="quantita<?php echo $articolo['id'];?>" max="<?php echo $articolo['quantita']; ?>" value=<?php echo $carrello['quantita']; ?> >
											<span class="qty-up"  onClick=pulsante(<?php echo $articolo['id'];?>)>+</span>
											<span class="qty-down"  onClick=pulsante(<?php echo $articolo['id'];?>)>-</span>
										
											<button  type="submit" class="primary-btn" name="bottone" id="<?php echo $articolo['id'];?>" onclick=conferma(this.id,quantita<?php echo $articolo['id'];?>.value,<?php echo $articolo['quantita'];?>,<?php echo $_SESSION['user']['id'] ;?>,<?php echo $totale;?>,<?php echo $carrello['quantita'];?>) style="position:absolute;display:none;margin-left:65px; margin-top:-45px">Conferma</button>
										</div>
									</div>
									<a  style="position:absolute; margin-left:195px; margin-top:15px;" href=javascript:rimuovi(<?php echo $articolo['id'];?>,<?php echo $_SESSION['user']['id'];?>);><font color="red">Rimuovi <br> articolo</font></a>
								</div>
								
							</div>
							
							
					<?php  }}}	?>
				
				
			</div>
			<!-- /container -->
			
				
			
		
		</div>
		<!-- /SECTION -->
		
		
		
	<script language="JavaScript"> 
		
		function onlynumber(field) { 

			if (isNaN(field.value)){ 
		
				field.value=field.value.substr(0, field.value.length-1); 
			} 
		} 
		--> 
		
		function pulsante(idOgg){
			
			document.getElementById(idOgg).style.display=''; 
				
		}
		
		function conferma(idOgg,quantita,disponibilità,utente,totale,qCarrello,nomeArticolo) {

			var a=parseInt(totale);
			var c=parseInt(qCarrello);
			if(quantita<=disponibilità){
				document.getElementById(idOgg).style.display='none';
		 $.ajax({
		  type: "POST",
		  url: "modificaQuantita.php",
		  data: ({id: idOgg, quant: quantita,idUtente:utente}),
		  success: function (result) {
			  alert(result);
			 
			  window.location.reload();
		  }, dataType: 'text'
		});
			}else alert("Disponibilità massima ="+ disponibilità);
			
		}
		
		
		function rimuovi(idArt,idUtente) {			
			if(confirm("Sei sicuro di voler eliminare questo elemento?")) {
			 $.ajax({
			  type: "POST",
			  url: "rimuovi.php",
			  data: ({idArticolo: idArt, idUtente: idUtente}),
			  success: function (result) {
			
				 if(result==1){
					  alert("Articolo rimosso");
					  window.location="carrello.php";
				  }else if(result==2){
					  alert("Errore durante l'eliminazione dell'articolo");
					  window.location="carrello.php";
				  }
			  }, dataType: 'text'
			});
			}
		}
		
</script> 
<?php include("footer.php");?>
