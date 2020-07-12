<?php
	include("functions.php");
	include("db.php");
	
	if(!isset($_SESSION))
		session_start();
	
	$quantita=isset($_POST['quant'])? clear($_POST['quant']):false;
	$idArticolo=isset($_POST['id'])? clear($_POST['id']):false;
	$idUtente=isset($_POST['idUtente'])? clear($_POST['idUtente']):false;
	
	
	if(mysqli_query($db,"UPDATE carrello set quantita=$quantita WHERE idArticolo=$idArticolo AND idUtente=$idUtente"))
		echo "Quantità aggiornata";
	

	

?>