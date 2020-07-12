
<?php
	
	include("functions.php");
	include("db.php");
	
	if(!isAdmin()){
		include("header.php");
		echo '<script language="javascript">if(window.confirm("Devi essere un admin per accedere a questa pagina. ")); window.location="index.php"; </script>';
		
	}else include("headerAdmin.php");
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
						<h3 class="breadcrumb-header">Nuovo articolo</h3>
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
						
						<div style="margin-top:-20px">
							
							<div class="form-group">
								<input class="form-control" type="text" id="nome" name="Nome" placeholder="Nome Articolo" required>
							</div>
							<div class="form-group">
								<select class="form-control" id="categoria" name="categoria" required>
									<option selected disabled>Categoria</option>
									<option value="Videogames">Videogames</option>
									<option value="Musica">Musica</option>
									<option value="Film">Film</option>
									<option value="Giochi da tavolo">Giochi da tavolo</option>
									<option value="Gadget">Gadget</option>
								</select>
							</div>
							<div class="form-group">
								<input class="form-control"  type="text" id="prezzo" name="prezzo" placeholder="9.99 &euro;" required >
							</div>
							<div class="form-group" >
							
								<label class="btn primary-btn" for="immagine"  >
								<input name="immagine" id="immagine" type="file" style="display:none" onchange="$('#upload-file-info').html(this.files[0].name)">Carica immagine
								<input type="hidden" name="nomeFile" value="files[0].name"></label>
								<span class='label label-info' name="upload-file-info" id="upload-file-info"></span>
							</div>
							<div class="form-group input-number">
								<input class="number form-control" id="quantita" type="number" min="1" name="quantità" placeholder="Quantità unità disponibili" >
								<span class="qty-up" onClick=showValue('quantita')>+</span>
								<span class="qty-down">-</span>
							</div>
							<button type="submit" class="primary-btn order-submit" onclick=aggiungiArticolo(nome.id,categoria.id,prezzo.id,immagine.id,quantita.id)>Aggiungi articolo</button>
							
							
						</div>
				
					</div>
					
								
								
				</div>
				<!-- /row -->
				
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

<script language="JavaScript">

	var flag=0;
	
	function showValue(idOgg){
		if(flag==0){
			document.getElementById(idOgg).value=0;
			flag=1;
		}
	}
	
	function aggiungiArticolo(idNome,idCat,idPrezzo,idImmagine,idQuantita){
		
		var nome=document.getElementById(idNome).value;
		var cat=document.getElementById(idCat).value;
		var prezzo=document.getElementById(idPrezzo).value;
		var immagine=document.getElementById(idImmagine).value;
		var quantita=document.getElementById(idQuantita).value;

		 $.ajax({
		  type: "POST",
		  url: "aggiungiArticolo1.php",
		  data: ({nome: nome, categoria: cat, prezzo: prezzo, immagine: immagine, quantita: quantita}),
		  success: function (result) {
			if(result==1){
				alert("Articolo aggiunto");
				window.location("areaAdmin.php");
			}
			else{
				alert("Errore durante l'inserimento dell'articolo , provare più tardi");
				window.location("aggiungiArticolo.php");
			}
		  }, dataType: 'text'
		});
		
	}
</script >
<?php
	
	include("footer.php");
?>