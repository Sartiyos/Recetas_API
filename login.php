<?php

# Datos de la base de datos
$hostname = 'localhost';
$database = 'recetas_app';
$username = 'root';
$password = '';

$json = array();

	# Verificamos que le llege estos datos
	if(isset($_GET['usuario']) && isset($_GET['clave'])) {

		# Almacenamos los datos en estas variables
		$usuario = $_GET['usuario'];
		$clave = $_GET['clave'];

		# Nos conectamos al servidor
		$conexion = mysqli_connect($hostname, $username, $password, $database);

		# Creamos la consulta comparando los datos
		$consulta = "SELECT username, password FROM usuarios WHERE username = '{$usuario}' AND password = '{$clave}'";

		# Obtenemos el resultado de la consulta
		$resultado = mysqli_query($conexion, $consulta);

		# Convertimos el resultado en un array
		if($registro = mysqli_fetch_array($resultado)) {
			$json['JSON'][] = "SESION INICIADA CORRECTAMENTE";
		} else {
			echo "NO SE HA ENCONTRADO DATOS<br>";
		}

		# Cerramos la conexión con la base de datos
		mysqli_close($conexion);
		
		# Mostramos el JSON
		echo json_encode($json);
	}

	else {
		echo "NO HAS PASADO DATOS <br>";
		$registro['usuario'] = 'NO';
		$registro['clave'] = 'NO';
		$json['JSON'][] = $registro;

		# Mostramos el JSON
		echo json_encode($json);
	}
?>