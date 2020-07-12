<?php
	include("db.php");
	include("functions.php");
	
	if(!isset($_SESSION)){
    session_start();
	}
	
	$email=isset($_POST['email'])? clear($_POST['email']):false;
	$password1=isset($_POST['pass1'])? clear($_POST['pass1']):false;
	$password=md5($password1);
	
	
	if(mysqli_query($db,"UPDATE utenti set Password='$password' WHERE Email='$email'")){
		echo 1;
	}else{
		echo 2;
	}
	
	
	
?>