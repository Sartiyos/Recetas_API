<?php

# CLASE PARA CONECTARNOS A LA BASE DE DATOS
class database {

    # ATRIBUTOS
    # Atributo para crear la conexión
    private $conn;

    # Parametros de la conexión
    private static $dsn = 'mysql:dbname=recetas_app;host=localhost';

    # Datos para iniciar sesión en la base de datos
    private static $usuario = 'root';
    private static $password = '';

    # Método para conectarnos a la base de datos
    public function getDb() {

        try {
            $conn = new PDO(self::$dsn, self::$usuario, self::$password);

        } catch (PDOException $e) {
            echo 'Error en la conexion: ' . $e->getMessage();
            $conn = null;
        }

    return $conn;
    }
}
?>
