<?php
	include("db.php");
	include("functions.php");
	
	if(!isset($_SESSION)){
    session_start();
	}
	
	$email=isset($_POST['email'])? clear($_POST['email']):false;
	
	
	
	if(mysqli_query($db,"UPDATE utenti set Admin=0 WHERE Email='$email'")){
		echo 1;
	}else{
		echo 2;
	}
?>	