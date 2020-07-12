 <?php
	if(!isset($_SESSION)){
    session_start();
}
	include("header.php");
    include ("db.php");
	include("functions.php");
  
  

	$email = isset($_POST['Email']) ? clear($_POST['Email']) : false;
	$password_1 = isset($_POST['Password']) ? clear($_POST['Password']) : false;
	$errore1='<script language="javascript"> window.alert("Riempi tutti i campi."); window.location="login1.php"; </script>';
	$errore2='<script language="javascript"> window.alert("Utente non trovato. Effettua una registrazione."); window.location="registrazione1.php"; </script>; ';
	$errore3='<script language="javascript"> window.alert("Password errata. Recupera la password se pensi di averla dimenticata."); window.location="login1.php"; </script>';
    $n_error=0;
    $password = md5($password_1);
	
	
	
	if(empty($email) || empty($password)) {
		echo $errore1;
    $n_error=$n_error+1;
	}
	if(mysqli_num_rows(mysqli_query($db,"SELECT * FROM utenti WHERE Email LIKE '$email'")) == 0) {
		echo $errore2;
     $n_error=$n_error+1;
	} 
	if(mysqli_num_rows(mysqli_query($db,"SELECT * FROM utenti WHERE Email LIKE '$email' AND Password!='$password'")) >0) {
    echo $errore3;
     $n_error=$n_error+1;
	} 
	if($n_error==0){
		$result = mysqli_query($db,"SELECT * FROM utenti WHERE email LIKE '$email' AND Password='$password'");
		if(mysqli_num_rows($result)==1) {
			$row = mysqli_fetch_assoc($result);
			$name = $row['Nome'];
			$surname = $row['Cognome'];
			$userid = $row['id'];
			$_SESSION['user'] = $row;
			if(isLoggedIn()) {
				header("Location: index.php");
			}
		}
	}
	include("footer.php");
?>