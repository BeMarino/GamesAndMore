 <?php
	if(!isset($_SESSION)){
		session_start();
	}
	include("header.php");
    include ("db.php");
    include("functions.php");
	
	
	$name = isset($_POST['Nome']) ? clear($_POST['Nome']) : false;
	$surname = isset($_POST['Cognome']) ? clear($_POST['Cognome']) : false;
	$password_1 = isset($_POST['password1']) ? clear($_POST['password1']) : false;
	$password_2 = isset($_POST['password2']) ? clear($_POST['password2']) : false;
	$email = isset($_POST['email']) ? clear($_POST['email']) : false;
	$nazione = isset($_POST['paese']) ? clear($_POST['paese']) : false;
	$indirizzo = isset($_POST['indirizzo']) ? clear($_POST['indirizzo']) : false;
	$città = isset($_POST['città']) ? clear($_POST['città']) : false;
	$cap = isset($_POST['cap']) ? clear($_POST['cap']) : false;
	$provincia = isset($_POST['provincia']) ? clear($_POST['provincia']) : false;
	$domanda = isset($_POST['domanda']) ? clear($_POST['domanda']) : false;
	
	if($domanda=="Domanda di sicurezza") $domanda=false;
	
	$risposta = isset($_POST['risposta']) ? clear($_POST['risposta']) : false;
	$errore1='<script language="javascript"> window.alert("Riempi tutti i campi.");window.location="registrazione1.php";  </script>';
	$errore2='<script language="javascript"> window.alert("Nome troppo lungo. Massimo 16 caratteri.");  window.location="registrazione1.php";</script>';
	$errore3='<script language="javascript"> window.alert("Cognome troppo lungo. Massimo 16 caratteri..") ; window.location="registrazione1.php";</script>';
	$errore4='<script language="javascript"> window.alert("Lunghezza della password non valida. Minimo 8 caratteri .")  ; window.location="registrazione1.php";</script>';
	$errore5='<script language="javascript"> window.alert("Attenzione, le due password non coincidono."); window.location="registrazione1.php"; </script>';
	$errore6='<script language="javascript"> window.alert("Indirizzo email non valido."); window.location="registrazione1.php" ;</script>';
	$errore7='<script language="javascript"> window.alert("Lunghezza dell\'indirizzo email non valida. Massimo 60 caratteri."); window.location="registrazione1.php" ;</script>';
	$errore8='<script language="javascript"> window.alert("L\'email è già in uso.") ;window.location="registrazione1.php"; </script>';
	$errore9='<script language="javascript"> window.alert("Formato Provincia errato")  ;window.location="registrazione1.php"; </script>';
	$n_error=0;
	if(empty($name) || empty($surname) || empty($password_1) || empty($password_2) || empty($email)|| empty($nazione) || empty($indirizzo) || empty($città) || empty($cap)|| empty($provincia)||empty($risposta)) {
		echo $errore1;
    $n_error=$n_error+1;
  }
	if(strlen($name) > 30) {
		echo $errore2;
    $n_error=$n_error+1;
  }
	if(strlen($surname) > 30) {
		echo $errore3;
    $n_error=$n_error+1;
  }
	if(strlen($password_1) < 8 ) {
    $n_error=$n_error+1;
		echo $errore4;
		echo $password_1;
  }
	if($password_1!=$password_2) {
    $n_error=$n_error+1;
		echo $errore5;
  }
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $n_error=$n_error+1;
		echo $errore6;
  }

	if(mysqli_num_rows(mysqli_query($db,"SELECT * FROM utenti WHERE Email LIKE '$email'")) > 0) 
		echo $errore8;
	
	if(strlen($provincia) > 2) {
		echo $errore9;
    $n_error=$n_error+1;
  }
	if($n_error==0){
		$password = md5($password_1);
		$trn_date = date("Y-m-d H:i:s");
		if(mysqli_query($db,"INSERT INTO utenti (Nome, Cognome, Password,Email, Nazione,Indirizzo,Citta ,Cap,Provincia,Domanda,Risposta)
									VALUES ('$name','$surname','$password','$email','$nazione','$indirizzo','$città','$cap','$provincia','$domanda','$risposta')")) {
			mysqli_query($db,"UPDATE utenti SET Admin='1' WHERE Email LIKE '$email' AND id LIKE '1'");
			
			echo '<script language="javascript">if(window.confirm("Registrazione andata a buon fine. ")); window.location="index.php"; </script>';

		} else {
			echo 'Errore nella query: '.mysqli_error($db);
		}
	}
	
	
include("footer.php");
?>
