<?php 
if(!isset($_SESSION)){
    session_start();
}
include("db.php");

function addToCart($db,$idUtente, $idArticolo,$quantita){
	
	mysqli_query($db,"INSERT INTO carrello(idUtente,idArticolo,quantita)VALUES('$idUtente','$idArticolo','$quantita')")or die( mysqli_error($db));
}

function getUserById($id){
	global $db;
	
	$query = "SELECT * FROM utenti WHERE id=" . $id;
	$result = mysqli_query($db, $query);
	$user = mysqli_fetch_assoc($result);

	return $user;
}

function isLoggedIn(){
	global $db;

	if (isset($_SESSION['user'])) {

		$id=$_SESSION['user']['id'];
		$result=mysqli_query($db,"SELECT PassByAdmin from utenti WHERE id=$id");
		$row=mysqli_fetch_assoc($result);
		if($row['PassByAdmin']!=NULL)
			header("Location: passByAdmin.php");
		else return true;
	}else{
		return false;
	}
}

function isAdmin(){	
	if(isLoggedIn()) {
		if ($_SESSION['user']['Admin'] == '1' ) {
			return true;
		}else
			return false;
	} else return false;
}

function clear($var) {
	return addslashes(htmlspecialchars(trim($var)));
}


function inCatalogo($id){
	global $db;

	$result=mysqli_query($db,"SELECT Incatalogo from articoli where id=$id");
	$res=mysqli_fetch_assoc($result);

	return $res['Incatalogo'];
}
?>


