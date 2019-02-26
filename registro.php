<?php

# Datos de la base de datos
$hostname = 'localhost';
$database = 'recetas_app';
$username = 'root';
$password = '';

$json = array();

	# Verificamos que le llege estos datos
	if(isset($_GET['usuario']) && isset($_GET['clave']) && isset($_GET['nombre']) && isset($_GET['apellidos']) && isset($_GET['fNacimiento']) && isset($_GET['email']) && isset($_GET['telefono']) && isset($_GET['foto'])) {

		# Almacenamos los datos en estas variables
		$usuario = $_GET['usuario'];
		$clave = $_GET['clave'];
		$nombre = $_GET['nombre'];
		$apellidos = $_GET['apellidos'];
		$nacimiento = $_GET['fNacimiento'];
		$email = $_GET['email'];
		$telefono = $_GET['telefono'];
		$foto = $_GET['foto'];

		# Nos conectamos al servidor
		$conexion = mysqli_connect($hostname, $username, $password, $database);

		# Creamos la consulta para insertar los datos en la base de datos
		$insert = "INSERT INTO usuarios(username, password, nombre, apellidos, fNacimiento, email, telefono, foto) VALUES ('{$usuario}', '{$clave}', '{$nombre}', '{$apellidos}', '{$nacimiento}', '{$email}', '{$telefono}', '{$foto}')";

		$resultado_insert = mysqli_query($conexion, $insert);

		if($resultado_insert) {
			$consulta = "SELECT * FROM usuarios WHERE username = '{$usuario}'";
			$resultado = mysqli_query($conexion, $consulta);

			if($registro = mysqli_fetch_array($resultado)) {
				$json['JSON'][] = $registro;
			}

			# Cerramos la conexión con la base de datos
			mysqli_close($conexion);

			# Mostramos el JSON
			echo json_encode($json);
		}

		else {
			$resulta['usuario'] = 'NO REGISTRA';
			$resulta['clave'] = 'NO REGISTRA';
			$resulta['nombre'] = 'NO REGISTRA';
			$resulta['apellidos'] = 'NO REGISTRA';
			$resulta['fNacimiento'] = '0';
			$resulta['email'] = 'NO REGISTRA';
			$resulta['telefono'] = '0';
			$resulta['foto'] = 'NO REGISTRA';
			$json['JSON'][] = $resulta;

			# Mostramos el JSON
			echo json_encode($json);
		}
	}

	else {
		$resulta['usuario'] = 'NO';
		$resulta['clave'] = 'NO';
		$resulta['nombre'] = 'NO';
		$resulta['apellidos'] = 'NO';
		$resulta['fNacimiento'] = '0';
		$resulta['email'] = 'NO';
		$resulta['telefono'] = '0';
		$resulta['foto'] = 'NO';
		$json['JSON'][] = $resulta;

		# Mostramos el JSON
		echo json_encode($json);
	}
?>