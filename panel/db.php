<?php
$host = "fdb1028.awardspace.net";
$user = "4557195_proyecto";
$password = "cris.20034"; // Cambia según tu configuración
$dbname = "4557195_proyecto";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}
?>