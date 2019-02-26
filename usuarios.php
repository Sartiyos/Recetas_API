<?php

# Archivo PHP requerido
require 'database.php';

# Clase que contiene los métodos para la tabla Usuarios
class usuarios {
	
	# Método para obtener los datos de un usuario
    public static function getByID($id) {

        # Creamos la consulta
        $consulta = "SELECT * FROM usuarios WHERE username = ?";

        try {

            # Creamos la conexión
            $comando = database::getDb()->prepare($consulta);

            # Ejecutamos la sentencia preparada
            $comando->execute(array($id));

            # Guardamos el resultado
            return $comando->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOEXception $e) {
            return -1;
        }
    } #-------------------------------------------------------------------

    # Método para comprobar si está registrado ese usuario y si tiene contraseña
    public static function logIn($id, $pass) {

		# Creamos la consulta
        $consulta = "SELECT username FROM usuarios WHERE username = ?";
		
		# Creamos la conexión
        $comando = database::getDb() -> prepare($consulta);

        # Ejecutamos la sentencia preparada
        $comando -> execute(array($id));
		
		# Comprobamos si nos ha devuelto al usuario
		if($comando -> rowCount() == 1) {
			
			# Comprobamos si el usuario tiene esa contraseña
			$consulta = "SELECT username, password FROM usuarios WHERE username = ? AND password = ?";
			
			# Creamos la conexión
            $comando = database::getDb()->prepare($consulta);

            # Ejecutamos la sentencia preparada
            $comando -> execute(array($id, $pass));
			
			# Comprobamos si nos ha devuelto al usuario
			if($comando -> rowCount() == 1) {
				echo json_encode(array('respuesta' => "OK"));
			}
			else {
				echo json_encode(array('respuesta' => "ERROR"));
			}
			
		}
		
		else {
			echo json_encode(array('respuesta' => "ERROR404"));
		}
			
    } #-------------------------------------------------------------------

    # Método para actualizar los datos de un usuario
    public static function update($id, $pass, $nombre, $apellidos, $fNaci, $email, $telefono, $foto) {

        # Creamos la consulta
        $consulta = "UPDATE usuarios " .
            "SET password = ?, nombre = ?, apellidos = ?, fNacimiento = ?, email = ?, telefono = ?, foto = ? " .
			"WHERE username = ?";

        try {

            # Creamos la conexión
            $comando = database::getDb()->prepare($consulta);

            # Ejecutamos la sentencia preparada
            $comando->execute(array($pass, $nombre, $apellidos, $fNaci, $email, $telefono, $foto, $id));

            # Devolvemos las filas modificadas
			echo json_encode(array('respuesta' => $comando->rowCount()));

        } catch (PDOEXception $e) {
			echo "NO SE HA PODIDO ACTUALIZAR<br>";
			echo $e;
            return -1;
        }
    } #-------------------------------------------------------------------
	
	# Método para actualizar latitud y longitud de un usuario
    public static function updateGPS($id, $latitud, $longitud) {

        # Creamos la consulta
        $consulta = "UPDATE usuarios SET latitud = ?, longitud = ? WHERE username = ?";

        try {

            # Creamos la conexión
            $comando = database::getDb()->prepare($consulta);

            # Ejecutamos la sentencia preparada
            $comando->execute(array($latitud, $longitud, $id));

            # Devolvemos las filas modificadas
			echo json_encode(array('respuesta' => $comando->rowCount()));

        } catch (PDOEXception $e) {
			echo "NO SE HA PODIDO ACTUALIZAR<br>";
			echo $e;
            return -1;
        }
    } #-------------------------------------------------------------------

    # Método para añadir un nuevo usuario
    public static function newUser($id, $pass, $nombre, $apellidos, $fNaci, $email, $telefono) {

        # Creamos la consulta
		$consulta = "SELECT username, password, nombre, apellidos, fNacimiento, email, telefono FROM usuarios WHERE username = ?";
			
		# Creamos la conexión
		$comando = database::getDb() -> prepare($consulta);

		# Ejecutamos la sentencia preparada
		$comando -> execute(array($id));
			
		# Comprobamos si nos ha devuelto al usuario
		if($comando -> rowCount() == 0) {
			
			# Creamos la consulta
			$consulta = "INSERT INTO usuarios (username, password, nombre, apellidos, fNacimiento, email, telefono) 
					VALUES (?, ?, ?, ?, ?, ?, ?)";

			# Creamos la conexión
			$comando = database::getDb()->prepare($consulta);

			# Ejecutamos la sentencia preparada
			$comando->execute(array($id, $pass, $nombre, $apellidos, $fNaci, $email, $telefono));
			
			# Devolvemos el resultado
			echo json_encode(array('respuesta' => "REGISTRO OK"));
		}
		
		else {
			# Devolvemos el resultado
			echo json_encode(array('respuesta' => "REGISTRO DOBLE"));
		}
			

    } #-------------------------------------------------------------------
	
	# Método para obtener username, longitud, latitud, telefono y email
    public static function getAll() {

        # Creamos la consulta
        $consulta = "SELECT username, longitud, latitud, telefono, email FROM usuarios";

        try {

            # Creamos la conexión
            $comando = database::getDb() -> prepare($consulta);

            # Ejecutamos la sentencia preparada
            $comando->execute();
			
            return $comando->fetchAll(PDO::FETCH_ASSOC);
			

        } catch (PDOEXception $e) {
            return false;
        }
    } #-------------------------------------------------------------------
}
?>
