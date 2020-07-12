<?php
	include("db.php");
	include("functions.php");
	
	if(!isset($_SESSION)){
    session_start();
	}
	
	$email=isset($_POST['email'])? clear($_POST['email']):false;
	$domanda=isset($_POST['domanda'])? clear($_POST['domanda']):false;
	$risposta=isset($_POST['risposta'])? clear($_POST['risposta']):false;
	
	$result=mysqli_query($db,"SELECT * from utenti WHERE Email='$email'");
	if(mysqli_num_rows($result)==0){
		echo 1;
	}else{
		$account=$result->fetch_assoc();
		if($domanda!=$account['Domanda'])
			echo 2;
		else
		if($risposta!=$account['Risposta'])
			echo 3;
	}
	
	
	
?>


       