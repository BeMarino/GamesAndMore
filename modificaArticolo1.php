<?php
	include("db.php");
	include("functions.php");
	
	if(!isset($_SESSION)){
    session_start();
	}
	
	$id=isset($_POST['idArticolo'])? clear($_POST['idArticolo']):false;
	$categoria=isset($_POST['categoria'])? clear($_POST['categoria']):false;
	$nome=isset($_POST['nome'])? clear($_POST['nome']):false;
	$prezzo=isset($_POST['prezzo'])? clear($_POST['prezzo']):false;
	$immagine=isset($_POST['immagine'])? clear($_POST['immagine']):false;
	$quantità=isset($_POST['quantità'])? clear($_POST['quantità']):false;
	
	$errore1='<script language="javascript"> window.alert("Nome troppo lungo. Massimo 70 caratteri.");  window.location="modificaArticolo1.php?=id"'.$id.'";</script>';
	
	$n_error=0;
	
	if(!empty($nome)){
		if(strlen($nome) > 70) {
			echo $errore1;
			$n_error=$n_error+1;
		}else 
			if(!mysqli_query($db,"UPDATE articoli SET nome='$nome' WHERE id = '$id' "))
				echo 'Errore nella query: '.mysqli_error($db);
		
	}
	
	if(!empty($categoria)){
		if(!mysqli_query($db,"UPDATE articoli SET categoria='$categoria' WHERE id = '$id' "))
			echo 'Errore nella query: '.mysqli_error($db);
	}
	
	if(!empty($prezzo)){
		$prezzo=number_format($prezzo, 2, '.', ',');
		if(!mysqli_query($db,"UPDATE articoli SET prezzo='$prezzo' WHERE id = '$id' "))
			echo 'Errore nella query: '.mysqli_error($db);
	}

	if(!empty($immagine)){
		if(!mysqli_query($db,"UPDATE articoli SET immagine='img/$immagine' WHERE id = '$id' "))
			echo 'Errore nella query: '.mysqli_error($db);
	}
	
	if(!empty($quantità)){
		if(!mysqli_query($db,"UPDATE articoli SET quantita='$quantità' WHERE id = '$id' "))
			echo 'Errore nella query: '.mysqli_error($db);
	}
	
	if ($n_error==0) 
		echo '<script language="javascript"> window.location="product.php?idArticolo='.$id.'";window.alert="Articolo modificato con successo! ";</script>'
 
		

?>	