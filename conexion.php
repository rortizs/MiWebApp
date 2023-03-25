<?php

$servidor = "localhost"; //127.0.0.1
$baseDatos = "app"; //nombre de la base de datos
$usuario = "root"; //usuario
$clave = ""; //password

//try catch

try {

	$conexion = new PDO("mysql:host=$servidor;dbname=$baseDatos", $usuario, $clave);

} catch (Exception $ex) {

	//imprimo el mensaje si existe algun error
	echo $ex->getMessage();

}
