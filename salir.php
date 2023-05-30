<?php 

	session_start();
	session_destroy();
	echo "<script>alert('Acaba de Cerrar Sesion');</script>";
	header("location: index.php");
	exit();
	
?>