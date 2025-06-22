<?php
session_start();

if ($_SESSION['tipo'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

include("../includes/conexion.php");

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    
    $conn->query("UPDATE productos SET estado = 'inactivo' WHERE id_producto = $id");
}

header("Location: panel.php");
exit();
?>
