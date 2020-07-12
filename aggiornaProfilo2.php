<?php
	
	include ("db.php");
	include("functions.php");
	if(!isset($_SESSION)){
		session_start();
	}
	
		if(isAdmin()){
	
	$id = isset($_POST['id'])? clear($_POST['id']):false;
	$nome = isset($_POST['Nome']) ? clear($_POST['Nome']) : false;
	$cognome = isset($_POST['Cognome']) ? clear($_POST['Cognome']) : false;
	
	$password_1 = isset($_POST['password1']) ? clear($_POST['password1']) : false;
	
	$email = isset($_POST['Email']) ? clear($_POST['Email']) : false;
	$nazione = isset($_POST['Nazione']) ? clear($_POST['Nazione']) : false;
	$indirizzo = isset($_POST['Indirizzo']) ? clear($_POST['Indirizzo']) : false;
	$città = isset($_POST['Citta']) ? clear($_POST['Citta']) : false;
	$cap = isset($_POST['Cap']) ? clear($_POST['Cap']) : false;
	$provincia = isset($_POST['Provincia']) ? clear($_POST['Provincia']) : false;
	$domanda = isset($_POST['Domanda']) ? clear($_POST['Domanda']) : false;
	if($domanda=="Domanda di sicurezza") $domanda=false;
	$risposta = isset($_POST['Risposta']) ? clear($_POST['Risposta']) : false;
	
	$errore1='<script language="javascript"> window.alert("Nome troppo lungo. Massimo 30 caratteri.");  window.location="aggiornaProfilo1.php";</script>';
	$errore2='<script language="javascript"> window.alert("Cognome troppo lungo. Massimo 60 caratteri..") ; window.location="aggiornaProfilo1.php";</script>';
	$errore3='<script language="javascript"> window.alert("Lunghezza della password non valida. Minimo 6 caratteri e massimo 20.")  ; window.location="registrazione1.php";</script>';
	$errore4='<script language="javascript"> window.alert("Attenzione, le due password non coincidono."); window.location="aggiornaProfilo1.php"; </script>';
	$errore5='<script language="javascript"> window.alert("Indirizzo email non valido."); window.location="aggiornaProfilo1.php" ;</script>';
	$errore6='<script language="javascript"> window.alert("Lunghezza dell\'indirizzo email non valida. Massimo 100 caratteri."); window.location="registrazione1.php" ;</script>';
	$errore7='<script language="javascript"> window.alert("L\'email è già in uso.") ;window.location="aggiornaProfilo1.php"; </script>';
	$errore8='<script language="javascript"> window.alert("Formato Provincia errato")  ;window.location="aggiornaProfilo1.php"; </script>';
	$n_error=0;
	$result=mysqli_query($db,"SELECT Password from utenti WHERE  id=$id");
	$row=mysqli_fetch_assoc($result);
	
	if(!empty($nome)){
		if(strlen($nome) > 30) {
			echo $errore1;
			$n_error=$n_error+1;
		}else 
			if(!mysqli_query($db,"UPDATE utenti SET Nome='$nome' WHERE id = '$id' "))
				echo 'Errore nella query: '.mysqli_error($db);
		
	}
	
	if(!empty($cognome)){
		if(strlen($cognome) > 60) {
			echo $errore2;
			$n_error=$n_error+1;
		}else if(!mysqli_query($db,"UPDATE utenti SET Cognome='$cognome' WHERE id= '$id' "))
			echo 'Errore nella query: '.mysqli_error($db);
	}
	
	
	
	if(!empty($password_1)){
		if(strlen($password_1) < 6 || strlen($password_1) > 20) {
			$n_error=$n_error+1;
			echo $errore3;
		}else 
			$nuovaPassword=md5($password_1);
		if(!mysqli_query($db,"UPDATE utenti set Password='$nuovaPassword' WHERE id='$id'"))
			echo 'Errore nella query: '.mysqli_error($db);
	}			
	
		if(!empty($email)){
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo $errore5;
			}else if(mysqli_num_rows(mysqli_query($db,"SELECT * FROM utenti WHERE Email LIKE '$email'")) > 0) 
					echo $errore7;
				else
					if(!mysqli_query($db,"UPDATE utenti SET Email='$email' WHERE id= '$id' "))
					echo 'Errore nella query: '.mysqli_error($db);
		}
		
		if(!empty($nazione)){
			if(strlen($nazione)<=60){
				if(!mysqli_query($db,"UPDATE utenti SET Nazione='$nazione' WHERE id= '$id' "))
				echo 'Errore nella query: '.mysqli_error($db);
			}else echo'<script language="javascript"> window.alert("Nome nazione troppo lungo"); window.location="aggiornaProfilo1.php"; </script>';
		}
		
		
		if(!empty($indirizzo)){
			if(strlen($indirizzo)<=100){
				if(!mysqli_query($db,"UPDATE utenti SET Indirizzo='$indirizzo' WHERE id= '$id' "))
				echo 'Errore nella query: '.mysqli_error($db);
			}else echo'<script language="javascript"> window.alert("Indirizzo troppo lungo"); window.location="aggiornaProfilo1.php"; </script>';
		} 
		
		if(!empty($città)){
			if(strlen($città)<=60){
				if(!mysqli_query($db,"UPDATE utenti SET Citta='$città' WHERE id= '$id' "))
				echo 'Errore nella query: '.mysqli_error($db);
			}else echo'<script language="javascript"> window.alert("Nome città troppo lungo"); window.location="aggiornaProfilo1.php"; </script>';
		}
		
		if(!empty($cap)){
			if(strlen($cap)<=5){
				if(!mysqli_query($db,"UPDATE utenti SET Cap='$cap' WHERE id= '$id' "))
				echo 'Errore nella query: '.mysqli_error($db);
			}else echo'<script language="javascript"> window.alert("Il CAP può contenere solo numeri"); window.location="aggiornaProfilo1.php"; </script>';
		}
		
		if(!empty($provincia)){
			if(strlen($provincia) > 2) {
				echo $errore9;
			}else if(!mysqli_query($db,"UPDATE utenti SET Provincia='$provincia' WHERE id= '$id' "))
				  echo 'Errore nella query: '.mysqli_error($db);
		}
		
		if(!empty($domanda)){
			if(!mysqli_query($db,"UPDATE utenti SET Domanda='$domanda' WHERE id = '$id' "))
			echo 'Errore nella query: '.mysqli_error($db);
		}
		
		if(!empty($risposta)){
			if(strlen($risposta)<=100){
				if(!mysqli_query($db,"UPDATE utenti SET Risposta='$risposta' WHERE id= '$id' "))
				echo 'Errore nella query: '.mysqli_error($db);
			}else echo'<script language="javascript"> window.alert("Risposta troppo lunga"); window.location="aggiornaProfilo1.php"; </script>';
		}
		
	echo 1;
		
	}else echo '<script language="javascript"> window.alert("Devi effettuare il login per accedere a questa pagina.");  window.location="login1.php";</script>';
 
?>
