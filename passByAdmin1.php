<?php
	include("db.php");
	include("functions.php");
	
	if(!isset($_SESSION)){
    session_start();
	}
	
	$id=isset($_POST['id'])? clear($_POST['id']):false;
	$password1=isset($_POST['pass1'])? clear($_POST['pass1']):false;
	
	$password=md5($password1);
	
	
	if(mysqli_query($db,"UPDATE utenti set Password='$password', PassByAdmin=NULL WHERE id=$id")){
		echo 1;
	}else{
		echo 2;
	}
	
	
	
?>