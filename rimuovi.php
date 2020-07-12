<?php 
	include("db.php");
	include("functions.php");
	
	$idArticolo=(int)isset($_POST['idArticolo'])? clear($_POST['idArticolo']):false;
	$idUtente=(int)isset($_POST['idUtente'])? clear($_POST['idUtente']):false;
	
	if(mysqli_query($db,"DELETE FROM carrello WHERE idArticolo=$idArticolo AND idUtente=$idUtente")){
		echo 1;
	}else echo 2;
?>