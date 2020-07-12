<?php
	include("functions.php");
	if(!isset($_SESSION)){
		session_start();
	}
	
	include ("db.php");
    
	
	$nome = isset($_POST['nome']) ? clear($_POST['nome']) : false;
	$categoria = isset($_POST['categoria']) ? clear($_POST['categoria']) : false;
	$prezzo = isset($_POST['prezzo']) ? clear($_POST['prezzo']) : false;
	$immagine = isset($_POST['immagine']) ? clear($_POST['immagine']) : false;
	$quantità = isset($_POST['quantita']) ? clear($_POST['quantita']) : false;
	$i=1;
	$slash='\\';
	while($immagine{strlen ( $immagine )-$i}!=$slash){
		$i++;

	}
	$immagin=substr($immagine,strlen ( $immagine )-$i+1,strlen($immagine)-1);
	
	
	$immagine1="img/".$immagin;
	$n_error=0;
	
	if (empty($nome)||empty($categoria)||empty($prezzo)||empty($quantità)||empty($immagine)) {
		$n_error=$n_error+1;
	}
	
	if($categoria=="Categoria") $n_error=$n_error+1;
	
	if(strlen($nome)>70) {
		if(strlen($nome) > 70) {
			$n_error=$n_error+1;
		}
	}
	
	
	if ($n_error==0) {
		if(mysqli_query($db,"INSERT INTO articoli (nome, categoria, prezzo,immagine,quantita)VALUES ('$nome','$categoria','$prezzo','$immagine1','$quantità')"))
			echo 1;
		else 
			echo 2;
	} else {
		echo 3;
	}
	
	
	



?>