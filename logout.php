<?php

	session_start();
	session_destroy();
	unset($_SESSION['user']);
	echo '<script language="javascript"> window.alert("Logout effettuato")  ;window.location="index.php"; </script>'
?>