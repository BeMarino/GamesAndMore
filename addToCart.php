<?php 
include ("functions.php");
include ("db.php");


$idUtente=$_SESSION['user']['id'];
$idArticolo=isset($_POST['idArticolo'])? clear($_POST['idArticolo']):false;
$quantità=isset($_POST['quantita'])? clear($_POST['quantita']):false;
$disponibilita=(int)implode(mysqli_query($db,"SELECT quantita from articoli where id =$idArticolo")->fetch_assoc());

if($quantità<=$disponibilita){

if(mysqli_num_rows(mysqli_query($db,"SELECT * from carrello where idArticolo=$idArticolo AND idUtente=$idUtente" ))==0 ){

	addToCart($db,$_SESSION['user']['id'],$idArticolo,$quantità);
	echo 1;
}
else {
	
	$q=mysqli_query($db,"SELECT quantita from carrello where idArticolo=$idArticolo AND idUtente=$idUtente")->fetch_assoc();
	if(($quantità+$q['quantita'])>$disponibilita) 
		echo "Impossibile aggiungere gli articoli al carrello , la disponibilità massima dell'articolo è ". $disponibilita;
	else{
		$quantità+=$q['quantita'];
		if(mysqli_query($db,"UPDATE carrello set quantita=$quantità where idArticolo=$idArticolo AND idUtente=$idUtente"))
			echo 1;
	}
}
}else echo"Impossibile aggiungere gli articoli al carrello , la disponibilità massima dell'articolo è ". $disponibilita;



?>