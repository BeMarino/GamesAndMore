<?php 
	
	include("functions.php");
	include("db.php");
	
	$categoria =isset($_POST['categoria'])? clear($_POST['categoria']):false;
	$result = mysqli_query($db,"SELECT * from articoli WHERE categoria LIKE '$categoria'AND inCatalogo=1 ");
	$result2 = mysqli_query($db,"SELECT * from articoli WHERE categoria LIKE '$categoria'AND inCatalogo=0 ");
?>	
			<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<h3 class="title">In catalogo</h3>
			<?php 						
					echo'<ul>';
					while($row = $result->fetch_assoc()){
					echo'<li >
					<a href=';echo'"product.php?idArticolo='; echo $row['id'];echo'">';
					echo'
					<div class="product" style="height:340px; width:152px ;float:left; ;margin-right:10px">
					
						<div width="150px" height="150px" class="product-img">
							<img width="150px" height="150px" src="';echo $row['immagine'];echo'" alt="">
						</div>
						<div  class="product-body">
							<p class="product-category"><a href="videogames.php">';echo $row["categoria"];echo'</p>
							<h3 class="product-name"><a href="product.php?idArticolo=';echo $row['id'].'">';echo $row['nome']; echo'</a></h3>
							
						</div>
						<button id='.$row['id'].' class="primary-btn order-submit " style="position:relative;width:145px; margin-bottom:10px; margin-left:4px" onClick=rimuoviArticolo1(this.id)>Rimuovi </button>
					</div>
					</a>
					</li>';
					}
					echo'</ul>';
				?>	

		</div>
		
				<div class="container">
				<h3 class="title">Fuori catalogo</h3>
			<?php 						
					echo'<ul>';
					while($row = $result2->fetch_assoc()){
					echo'<li >
					<a href=';echo'"product.php?idArticolo='; echo $row['id'];echo'">';
					echo'
					<div class="product" style="height:340px; width:152px ;float:left; ;margin-right:10px">
					
						<div width="150px" height="150px" class="product-img">
							<img width="150px" height="150px" src="';echo $row['immagine'];echo'" alt="">
						</div>
						<div  class="product-body">
							<p class="product-category"><a href="videogames.php">';echo $row["categoria"];echo'</p>
							<h3 class="product-name"><a href="product.php?idArticolo=';echo $row['id'].'">';echo $row['nome']; echo'</a></h3>
							
						</div>
						<button id='.$row['id'].' class="primary-btn order-submit" style="margin-bottom:-185px;margin-left:4px" onClick=ripristinaArticolo1(this.id)>Ripristina</button>
					</div>
					</a>
					</li>';
					}
					echo'</ul>';
				?>	

		</div>
	</div>
