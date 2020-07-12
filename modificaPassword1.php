<?php
	include("db.php");
	include("functions.php");
	
	if(!isset($_SESSION)){
    session_start();
	}
	
	$idd=isset($_POST['id1'])? clear($_POST['id1']):false;
	
	
	
	$pass1=isset($_POST['pass1'])? clear($_POST['pass1']):false;
	$pass2=isset($_POST['pass2'])? clear($_POST['pass2']):false;
	
	$result=mysqli_query($db,"SELECT * from utenti WHERE id=$idd");
	if(mysqli_num_rows($result)==0){
		echo 1;
	}else{
		if(strcmp(trim($pass1),trim($pass2))==0){
			$pass=md5($pass1);
			if(mysqli_query($db,"UPDATE utenti set PassByAdmin='$pass' where id=$idd"))
				echo 3;
			else 4;
			}else echo 2;
		}
	
	
	
?>
