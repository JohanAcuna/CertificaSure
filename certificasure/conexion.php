<?php
	$enlace = mysqli_connect("localhost", "root", "", "certificasure");
   // password en el server: ""
	if (mysqli_connect_errno()) {
    	printf("Falló la conexión: %s\n", mysqli_connect_error());
    	exit();
	}
	
	/* cambiar el conjunto de caracteres a utf8 */
	if (!mysqli_set_charset($enlace, "utf8")) {
    	printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($enlace));
    	exit();
	}else {
	}
?>