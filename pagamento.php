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
	}else{ 
		include("header.php");
		echo '<script> alert("Effettua il login per fare un acquisto"); window.location="index.php";</script>';
	}
	
	$nome=($_POST['nome']=='')?$_SESSION['user']['Nome']:clear($_POST['nome']);
	$cognome=($_POST['cognome']=='')?$_SESSION['user']['Cognome']:clear($_POST['cognome']);
	$indirizzo=($_POST['indirizzo']=='')?$_SESSION['user']['Indirizzo']:clear($_POST['indirizzo']);
	$citta=($_POST['citta']=='')?$_SESSION['user']['Citta']:clear($_POST['citta']);
	$paese=($_POST['paese']=='')?$_SESSION['user']['Nazione']:clear($_POST['paese']);
	$cap=($_POST['cap']=='')?$_SESSION['user']['Cap']:clear($_POST['cap']);
	$provincia=($_POST['provincia']=='')?$_SESSION['user']['Provincia']:clear($_POST['provincia']);
	
	$nomef=isset($_POST['nomef'])?clear($_POST['nomef']):false;
	$cognomef=isset($_POST['cognomef'])?clear($_POST['cognomef']):false;
	$indirizzof=isset($_POST['indirizzof'])?clear($_POST['indirizzof']):false;
	$cittaf=isset($_POST['cittaf'])?clear($_POST['cittaf']):false;
	$paesef=isset($_POST['paesef'])?clear($_POST['paesef']):false;
	$capf=isset($_POST['capf'])?clear($_POST['capf']):false;
	$provinciaf=isset($_POST['provinciaf'])?clear($_POST['provinciaf']):false;
	$note=isset($_POST['note'])?clear($_POST['note']):false;
	
	$prezzoFinale=2.99;
	$prezzoTot=0;
	$sconto=0;
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
						<h3 class="breadcrumb-header">pagamento</h3>
						<ul class="breadcrumb-tree">
							<li><a href="index.php">Home</a></li>
							<li><a href="carrello.php">carrello</a></li>
							<li><a href ="checkout.php" >Spedizione</a></li>
							<li class="active">pagamento</li>
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
				
				<div class="col-md-5 order-details" style="margin-top:00px;float:right">
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
							
							if($prezzoTot>300){
								$sconto=30;
								echo "<div class='order-col' id='sconto'><font color='green'><strong>Sconto 30%</strong></font>";
								echo"<div id='sconto2'><strong><font color='green'>".number_format(-$prezzoTot/10*3,2) .'</font>&#8364</strong>'."</div></div>";
								}
							else if($prezzoTot>200&&$prezzoTot<300){
									$sconto=20;
									echo "<div class='order-col' id='sconto'><font color='green'><strong>Sconto 20%</strong></font>";
									echo"<div id='sconto2'><strong><font color='green'>".number_format(-$prezzoTot/10*2,2) .'</font>&#8364</strong>'."</div></div>";
									
								}
								else if($prezzoTot>100&&$prezzoTot<200){
									$sconto=10;
									echo "<div class='order-col' id='sconto'><font color='green'><strong>Sconto 10%</strong></font>";
									echo"<div id='sconto2'><strong><font color='green'>".number_format(-$prezzoTot/10 ,2).'</font>&#8364</strong>'."</div></div>";
									
									}
								?>
							
							
							</div>
							<div class="order-col">
								<div id="spedizionet">Spedizione standard</div>
								<div  id="costoSpedizione" >2.99<?php echo '&#8364'?></strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTALE</strong></div>
								<div><strong id="tot" class="order-total"><?php if($prezzoTot>300){ echo number_format($prezzoTot/10*7+2.99,2) .'&#8364';
								$prezzoFinale=number_format($prezzoTot/10*7+2.99,2);
								}
									else if($prezzoTot>200&&$prezzoTot<300){echo number_format($prezzoTot/10*8+2.99,2) .'&#8364';
									$prezzoFinale=number_format($prezzoTot/10*8+2.99,2);
									}
									else if($prezzoTot>100&&$prezzoTot<200){
										echo number_format($prezzoTot/10*9+2.99,2) .'&#8364';
										$prezzoFinale=number_format($prezzoTot/10*9+2.99,2);
									}
									else{
										
										$prezzoFinale=$prezzoTot+2.99;
										echo $prezzoFinale.'&#8364';
									}?></strong></div>
							</div>
						</div>
						
						
						
					</div>
					<!-- /Order Details -->

				
				
					<h3 style="margin-left:-35px">Scegli una  modalità di spedizione</h3>
					
					<div class="input-radio" style="margin-left:-35px">
						<input type="radio" id="standard" name="spedizione" checked value="standard" onclick=somma("standard",<?php echo $prezzoFinale?>)>
						<label for="standard">
							<span></span>
							Standard &nbsp(2,99&#8364; Consegna in 2 settimane)
						</label>
					</div>
					<div class="input-radio" style="margin-left:-35px" onclick=somma("veloce",<?php echo $prezzoFinale?>)>
						<input type="radio" id="veloce" name="spedizione" value="veloce">
						<label for="veloce">
							<span></span>
							Veloce &nbsp &nbsp &nbsp (5,99&#8364; Consegna in una settimana)
						</label>
					</div>
					<div class="input-radio" style="margin-left:-35px" onclick=somma("premium",<?php echo $prezzoFinale?>)>
						<input type="radio" id="premium" name="spedizione" value="premium">
						<label for="premium">
							<span></span>
							Premium &nbsp(8,99&#8364; Consegna in 2-3 giorni)
						</label>
					</div>
					
				
					<h3 style="margin-left:-35px;margin-top:20px">Seleziona metodo di pagamento</h3>
				
					<div class="input-radio" style="margin-left:-35px">
						<input type="radio" id="cc" name="pagamento"  value="Carta di credito" checked onclick=show("divCc","divPaypal")>
						<label for="cc">
							<span></span>
							Carta Di Credito
						</label>
					</div>
					<div class="input-radio" style="position:absolute;margin-left:125px;margin-top:-25px " onclick=show("divPaypal","divCc")>
						<input type="radio" id="paypal" name="pagamento" value="paypal">
						<label for="paypal">
							<span></span>
							PayPal
						</label>
					</div>
					
					
					<div class="col-md-7" style="margin-top:20px">
						<!-- Dettagli pagamento -->
						<!-- carta di credito-->
						<div style="margin-left:-50px;width:600px;" id="divCc" class="billing-details" >
							<div class="section-title">
								<h3 class="title">pagamento con carta di credito </h3>
							</div>
				
							<div class="form-group">
								<input class="form-control" type="text" id="intestatario"name="intestatario"  placeholder="Intestario carta" required>
							</div>
							<div class="form-group">
								<input class="form-control" type="text" id="numeroCarta" name="numeroCarta"  placeholder="Numero carta" required>
							</div>
							<div class="form-group">
								<input class="form-control" type="month" id="validità" name="validità" placeholder="Periodo validità" required>
							</div>
							<div class="form-group">
								<input class="form-control" style="-moz-appearance:textfield"type="number" max="999" id="codice" name="codice" required  placeholder="Codice di sicurezza a 3 cifre" >
							</div>
							
						</div>
						<!-- /carta di credito -->
						
						<!-- PayPal -->
						
						<div style="margin-left:-50px;width:600px;display:none" id="divPaypal"  class="billing-details" >
							<div class="section-title">
								<h3 class="title">pagamento con Paypal </h3>
							</div>
							
							<div class="form-group">
								<input class="form-control" type="email" id="email" name="email"  placeholder="Email" >
							</div>
							<div class="form-group">
								<input class="form-control" type="password" id="password" name="password"  placeholder="Password" >
							</div>
							
						</div>
						<button style="margin-left:100px" type="submit" id="btn" onclick=conferma() class="primary-btn order-submit">conferma ordine</button>
						
						
						<!-- /PayPal -->

					</div>

					
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
		
		<script language="javascript">
		
		function show(idToShow,idToHide){
			
			document.getElementById(idToShow).style="margin-left:-50px; width:600px;";
			document.getElementById(idToHide).style="margin-left:-50px; width:600px; display:none";
			if(idToShow=="divCc"){
				document.getElementById("intestatario").required=true;
				document.getElementById("numeroCarta").required=true;
				document.getElementById("validità").required=true;
				document.getElementById("codice").required=true;
				document.getElementById("email").required=false;
				document.getElementById("password").required=false;
					
			}else{
				
				document.getElementById("intestatario").required=false;
				document.getElementById("numeroCarta").required=false;
				document.getElementById("validità").required=false;
				document.getElementById("codice").required=false;
				document.getElementById("email").required=true;
				document.getElementById("password").required=true;
			}
			
		}
		
		function somma(idSpedizione,totale){
			var totaleV=totale;
			
			if(idSpedizione=="standard"){
				document.getElementById("spedizionet").innerHTML="Spedizione Standard";
				document.getElementById("costoSpedizione").innerHTML="2.99<?php echo '&#8364'?>";
				document.getElementById("tot").innerHTML=(totaleV).toFixed(2) +'\u20AC' ;
			}
			
			if(idSpedizione=="veloce"){
				document.getElementById("spedizionet").innerHTML="Spedizione Veloce";
				document.getElementById("costoSpedizione").innerHTML="5.99<?php echo '&#8364'?>";
				document.getElementById("tot").innerHTML=(totaleV+3).toFixed(2) +'\u20AC';
			}
			
			if(idSpedizione=="premium"){
				document.getElementById("spedizionet").innerHTML="Spedizione Premium";
				document.getElementById("costoSpedizione").innerHTML="8.99<?php echo '&#8364'?>";
				document.getElementById("tot").innerHTML=(totaleV+6).toFixed(2) +'\u20AC';
			}
		}
		
		
		function conferma() {
			
			if(document.getElementById("standard").checked==true)
				spedizione="standard";
			else if(document.getElementById("veloce").checked==true)
				spedizione="veloce";
			else spedizione="premium";
			
			var totale=parseFloat(document.getElementById("tot").innerHTML.substring(0,document.getElementById("tot").innerHTML.length-1));
			var pagamento;
			var spedizione;
			if(document.getElementById("cc").checked==true){
				
				pagamento="Carta Di Credito";
				
				var intestatario=document.getElementById("intestatario").value;
				var carta=document.getElementById("numeroCarta").value;
				var validita=document.getElementById("validità").value;
				var codice=document.getElementById("codice").value;
				
				
				var pattNumeroCarta = new RegExp(/^\d{16}$/);
				var pattCodice = new RegExp(/^\d{3}$/);
				var pattNome = new RegExp(/^[A-Z][a-z]+([-']?[A-Z][a-z]+)*( [A-Z][a-z]+([-']?[A-Z][a-z]+)*)+$/);
				var pattMese = new RegExp(/^(0?[1-9]|1[012])[\/\-]\d{2}$/);
			
				
				if((pattNome.test(intestatario))&&(pattNumeroCarta.test(carta))&&(pattCodice.test(codice))&&(pattMese.test(validita))){
					
					$.ajax({
				  type: "POST",
				  url:"<?php echo'confermaOrdine.php?nome='.$nome.'&cognome='.$cognome.'&note='.$note.'&indirizzo='.$indirizzo.'&citta='.$citta.'&provincia='.$provincia.
				  '&paese='.$paese.'&cap='.$cap.'&nomef='.$nomef.'&cognomef='.$cognomef.'&cittaf='.$cittaf.'&paesef='.$paesef.'&indirizzof='.$indirizzof.'&capf='.$capf.'&provinciaf='.$provinciaf.'&sconto='.$sconto
				  ?>" ,
				  data: ({pagamento:pagamento,spedizione:spedizione,intestatario: intestatario, carta: carta,validita:validita,codice:codice,totale:totale}),
				  success: function (result) {
					if(result==1){
						window.location="riepilogoOrdine.php";
					}else{ alert(result+"Impossibile effettuare l'ordine");
					
						}
						}, dataType: 'text'
					});
				}else alert("Impossibile effettuare l'ordine: dati pagamento errati");
			}else{ 
				pagamento="PayPal";
				var email=document.getElementById("email").value;
				var password=document.getElementById("password").value;
				var pattEmail = new RegExp(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
				if(pattEmail.test(email)){
					$.ajax({
				  type: "POST",
				  url:"<?php echo'confermaOrdine.php?nome='.$nome.'&cognome='.$cognome.'&note='.$note.'&indirizzo='.$indirizzo.'&citta='.$citta.'&provincia='.$provincia.
				  '&paese='.$paese.'&cap='.$cap.'&nomef='.$nomef.'&cognomef='.$cognomef.'&cittaf='.$cittaf.'&paesef='.$paesef.'&indirizzof='.$indirizzof.'&capf='.$capf.'&provinciaf='.$provinciaf.'&sconto='.$sconto
				  ?>" ,
				  data: ({pagamento:pagamento,spedizione:spedizione,email:email,totale:totale}),
				  success: function (result) {
					if(result==1){
						window.location="riepilogoOrdine.php";
					}else{ alert(result+"Impossibile effettuare l'ordine");
					
						}
						}, dataType: 'text'
					});
				}else alert("Inserire Email valida");
				}
			
			
			
			
			
			
			
			
		}
		
		
		
		</script>
<?php include("footer.php");?>