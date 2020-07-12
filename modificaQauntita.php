<?php
	include("functions.php");
	include("db.php");
	if(!isset($_SESSION))
		session_start();
		
	$idArticolo=isset($_POST['id'])? clear($_POST['id']):false;
	echo'<script language="javascript"> window.alert("Riempi tutti i campi.");  </script>';
?>