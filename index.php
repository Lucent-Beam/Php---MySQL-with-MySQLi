<?php



//Invoca los scripts indicados
require 'db/connect.php';
require 'security/security.php';

// Al cargar index.php el array records estará vacío, ya que no ha recibido ningun valor

$records = array();


// Verifica que se haya recibido valores para poder insetarlos en la bd

if (!empty($_POST))

	{

		if(isset($_POST['first_name'], $_POST['last_name'], $_POST['bio']))

			{

				// trim elimina los  espacios en blanco al inicio y al final
				$first_name = trim($_POST['first_name']);
				$last_name = trim($_POST['last_name']);
				$bio = trim($_POST['bio']);

				if(!empty($first_name) && !empty($last_name) && !empty($bio))

					{  

						//Se prepara una sentencia SQL, para ser ejecutada por execute

						$insert = $db->prepare(

						
							"INSERT INTO people 
								(first_name, last_name, bio, created)
								 VALUES
								(?,?,?,NOW())");


						//Agrega variables a una sentencia -- 'sss' todos string

						$insert->bind_param('sss', $first_name, $last_name, $bio);

						//Se ejecuta la sentencia SQL 
						if ($insert->execute())

							{ 	header('Location: index.php');
								die();	}

					}

			}
	}



//Extrae de la bd los datos almacenados para poder mostrar

if($results = $db->query("SELECT * FROM people")){

	if($results->num_rows){

		while ($row = $results->fetch_object()) {
			$records[] = $row;

		}
		$results->free();

	}

}


?>

<!DOCTYPE html>

<html>
<head>
	<title>People</title>
</head>
<body>

	<h3>People</h3>

	<?php

	// Verifica de hay datos en el array records para poder mostrar

		if (!count($records)){

			echo "No records";

		}
		else {
	
	?>


	<table>
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Bio</th>
				<th>Created</th>

			</tr>	

		</thead>	

		<tbody>

			<?php

			//Imprime los datos del Array records
			foreach ($records as $r)
			    {
			?>

			<tr>
				<td><?php echo escape($r->first_name);  ?></td>
				<td><?php echo escape($r->last_name);  ?></td>
				<td><?php echo escape($r->bio);  ?></td>
				<td><?php echo escape($r->created);  ?></td>

			</tr>
			<?php
				}
			?>


		</tbody>	



	</table>

	<?php
		}

	?>

	<hr>

	<form action="" method="post">
		<div  class="field">

			<label for"first_name">First name</label>
			<input type="text" name="first_name" id="first_name" autocomplete="off">
		</div>

		<div class="field">

			<label for"last_name">Last name</label>
			<input type="text" name="last_name" id="last_name" autocomplete="off">

		</div>

		<div class="field">
			<label for"bio">Biography</label>
			<textarea name="bio" id="bio"></textarea>
		</div>

			<input type="submit" value="Insert">
	</form>

	<!--Al hacer click en "Insert" las variables first_name, last_name y bio son guardados en el array records. Se
	lleva a cabo la operación de inserción como se está codificado más arriba -->






</body>
</html>