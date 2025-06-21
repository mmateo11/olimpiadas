<?php
$host = "localhost";
$usuario = "root"; // por defecto en XAMPP
$clave = "";       // sin clave en XAMPP
$bd = "olimpiadas";

$conn = new mysqli($host, $usuario, $clave, $bd);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
