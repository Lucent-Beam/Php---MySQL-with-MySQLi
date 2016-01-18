<!-- Script para convertir los caracteres a entidades html -->
<?php

function escape($string)

	{
		return 	htmlentities(trim($string), ENT_QUOTES, 'UTF-8' );	
	}

?>