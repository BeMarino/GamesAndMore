<?php
	include("db.php");
	include("functions.php");
	
	if(!isset($_SESSION)){
    session_start();
	}
	
	$articolo=isset($_POST['id'])? clear($_POST['id']):false;
	if(mysqli_query($db,"UPDATE articoli set InCatalogo=0  WHERE id='$articolo'")){
		if(mysqli_query($db,"DELETE from carrello WHERE idArticolo=$articolo")){
		echo 1;
		}else echo 3;
	}else{
		echo 2;
	}
?>	