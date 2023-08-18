<?php 
$host = "localhost";
$db_name = "Tienda";
$username = "root";
$password = "";


$mysqli = new mysqli($host, $username, $password, $db_name, 3307);

if ($mysqli->connect_error) {
    die("Conexión fallida: " . $mysqli->connect_error);
}

?>