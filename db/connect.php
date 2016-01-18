<!-- Script de conexión a la base de datos -->
<?php

	//Guarda la conexión en una variable
	$db = new mysqli('127.0.0.1', 'root', '', 'app');

	//Verifica si existe un error
	if ($db->connect_errno){
		
		//Muestra un mensaje del último error de la conexión
		echo $db->connect_error;
		
	}


?>