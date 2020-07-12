<?php
	include("functions.php");
	include("db.php");
	if(!isset($_SESSION))
		session_start();

	$idOrdine=isset($_POST['idOrdine'])?clear($_POST['idOrdine']):false;
	
	$ord=(mysqli_query($db,"SELECT  * from ordini WHERE idOrdine=$idOrdine "))->fetch_assoc();
	
	if(isLoggedIn()){
		if (!isAdmin()&&!($_SESSION['user']['id']==$ord['idUtente'])){
			echo 3  ;
		}
		else {
			if(mysqli_query($db,"DELETE from ordini where idOrdine=$idOrdine"))
				echo 1;
			else echo 2;
		}
	}
	
	
	
?>
