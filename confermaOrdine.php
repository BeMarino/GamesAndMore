<?php 

	include("db.php");
	include("functions.php");
	
	if(!isset($_SESSION))
		session_start;
	$a=0;

	$idUtente=$_SESSION['user']['id'];

	$carrello_utente=mysqli_query($db,"SELECT  * from carrello WHERE idUtente=$idUtente");
	
	
	
	$totale=isset($_POST['totale'])?clear($_POST['totale']):false;
	
	$spedizione=isset($_POST['spedizione'])?clear($_POST['spedizione']):false;
	$pagamento=isset($_POST['pagamento'])?clear($_POST['pagamento']):false;
	$intestatario=isset($_POST['intestatario'])?clear($_POST['intestatario']):false;
	$numeroCarta=isset($_POST['carta'])?clear($_POST['carta']):false;
	$validità=isset($_POST['validita'])?clear($_POST['validita']):false;
	$codice=isset($_POST['codice'])?clear($_POST['codice']):false;
	$email=isset($_POST['email'])?clear($_POST['email']):false;
	$note=isset($_GET['note'])?clear($_GET['note']):false;
	
	$sconto=isset($_GET['sconto'])?clear($_GET['sconto']):false;
	$nome=isset($_GET['nome'])?clear($_GET['nome']):false;
	$cognome=isset($_GET['cognome'])?clear($_GET['cognome']):false;
	$destinatario=$nome.' '.$cognome;
	$indirizzoi=isset($_GET['indirizzo'])?clear($_GET['indirizzo']):false;
	$citta=isset($_GET['citta'])?clear($_GET['citta']):false;
	$paese=isset($_GET['paese'])?clear($_GET['paese']):false;
	$cap=isset($_GET['cap'])?clear($_GET['cap']):false;
	$provincia=isset($_GET['provincia'])?clear($_GET['provincia']):false;
	$indirizzo=$indirizzoi.','.$citta.','.$paese.','.$provincia.','.$cap;
	
	$nomef=isset($_GET['nomef'])?clear($_GET['nomef']):false;
	$cognomef=isset($_GET['cognomef'])?clear($_GET['cognomef']):false;
	$indirizzof=isset($_GET['indirizzof'])?clear($_GET['indirizzof']):false;
	$cittaf=isset($_GET['cittaf'])?clear($_GET['cittaf']):false;
	$paesef=isset($_GET['paesef'])?clear($_GET['paesef']):false;
	$capf=isset($_GET['capf'])?clear($_GET['capf']):false;
	$provinciaf=isset($_GET['provinciaf'])?clear($_GET['provinciaf']):false;
	
	if(($result=mysqli_query($db,"SELECT MAX(idOrdine) from ordini"))==false)
		$id=0;
	else $id=(int)implode($result->fetch_assoc())+1;
	
	
	while($row=$carrello_utente->fetch_assoc()){
		$a=(int)$row['idArticolo'];
		$b=(int)$row['quantita'];
		$disponibilita=(int)implode(mysqli_query($db,"SELECT quantita from articoli where id =$a")->fetch_assoc());
		$d=(float)implode(mysqli_query($db,"select prezzo from articoli where id=$a")->fetch_assoc());
		$rimanenza=$disponibilita-$b;
		mysqli_query($db,"INSERT INTO ordini(idOrdine,idUtente,idArticolo,destinatario,quantita,prezzo_unita,metodoPagamento,indirizzo,note) VALUES ($id,$idUtente,$a,'$destinatario',$b,'$d','$pagamento','$indirizzo','$note')") or die ("Error in query1:  ".mysqli_error($db));
		mysqli_query($db,"UPDATE articoli set quantita=".$rimanenza." where id=$a" );
		mysqli_query($db,"DELETE  from carrello where idUtente=$idUtente")or die(mysqli_error($db));
	}
		
		
		
		$bo=mysqli_query($db,"SELECT idOrdine,data from ordini where idUtente=$idUtente AND idOrdine=(SELECT MAX(idOrdine) from ordini where idUtente=$idUtente)" );
		while($boh=$bo->fetch_assoc()){
		$boh1=$boh['idOrdine'];
		$boh2=$boh['data'];
		}
		
		mysqli_query($db,"INSERT INTO fatture(idOrd,data,Nome,Cognome,Indirizzo,Citta,Provincia,Cap,Paese,Totale,ScontoPerc,TipoSped) VALUES ($boh1,'$boh2','$nomef','$cognomef','$indirizzof','$cittaf','$provinciaf',$capf,'$paesef',$totale,$sconto,'$spedizione')")or die ("Error in query2:  ".mysqli_error($db));
		echo 1;	
?>