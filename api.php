<?php

	# Archivo PHP requerido
	require 'usuarios.php';

	# Objeto necesario para mostrar los datos
	$api = new usuarios();

	# Actualizamos los datos del usuario
	if(isset($_GET['username']) && isset($_GET['password']) && isset($_GET['nombre']) && isset($_GET['apellidos']) && isset($_GET['fNacimiento']) && isset($_GET['email']) && isset($_GET['telefono']) && isset($_GET['foto'])) {
		$api = usuarios::update($_GET['username'], $_GET['password'], $_GET['nombre'], $_GET['apellidos'], $_GET['fNacimiento'], $_GET['email'], $_GET['telefono'], $_GET['foto']);
	}

	# Damos de alta a un nuevo usuario, antes comprobando si existe alguien con el mismo nombre de usuario
    elseif(isset($_GET['username']) && isset($_GET['password']) && isset($_GET['nombre']) && isset($_GET['apellidos']) && isset($_GET['fNacimiento']) && isset($_GET['email']) && isset($_GET['telefono'])) {
		$api = usuarios::newUser($_GET['username'], $_GET['password'], $_GET['nombre'], $_GET['apellidos'], $_GET['fNacimiento'], $_GET['email'], $_GET['telefono']);
	}

	# Comprobamos si el usuario existe y tiene esa contraseÃ?a
	elseif(isset($_GET['username']) && isset($_GET['password'])) {
		$api = usuarios::logIn($_GET['username'], $_GET['password']);		
	}
	
	# Consultamos el usuario, su latitud y longitud
	elseif (isset($_GET['username']) && isset($_GET['latitud']) && isset($_GET['longitud'])) {
		$api = usuarios::updateGPS($_GET['username'], $_GET['latitud'], $_GET['longitud']);
	}

	# Obtenemos los datos del usuario
	elseif (isset($_GET['username'])) {
		$api = usuarios::getById($_GET['username']);
		
		# Mostramos los datos por pantalla
		echo json_encode($api);
	}
	
	# Obtenemos todos los usuarios registrados
	else{
		$api = usuarios::getAll();
		# Mostramos los datos por pantalla
		echo json_encode($api);
	}
		
?>
