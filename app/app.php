<?php
$server_DB = "localhost";
$user_DB = "root";
$pass_DB = "";
$db_DB = "empleados";

$conn = new mysqli($server_DB,$user_DB,$pass_DB,$db_DB);

if ($conn->connect_error){
    die("Error al conectarse con la base de datos: " . $conn->connect_error);
}

//Sonà Horaria
date_default_timezone_set('America/Santo_Domingo');

?>