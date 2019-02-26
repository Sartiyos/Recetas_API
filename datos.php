<?php

# Datos de la base de datos
$hostname = 'localhost';
$database = 'recetas_app';
$username = 'root';
$password = '';

$json = array();

	# Verificamos que le llege estos datos
	if(isset($_GET['usuario'])) {

		# Almacenamos los datos en estas variables
		$usuario = $_GET['usuario'];

		# Nos conectamos al servidor
		$conexion = mysqli_connect($hostname, $username, $password, $database);

		# Creamos la consulta comparando los datos
		$consulta = "SELECT * FROM usuarios WHERE username = '{$usuario}'";

		# Obtenemos el resultado de la consulta
		$resultado = mysqli_query($conexion, $consulta);

		$prueba = mysqli_fetch_array($resultado);

		# Cerramos la conexión con la base de datos
		mysqli_close($conexion);
		
		# Mostramos el JSON
		echo json_encode($prueba);
	}
?>