<?php
session_start();

// Solo accesible para usuarios de tipo "ventas" o "admin"
if ($_SESSION['tipo'] !== 'ventas') {
    header("Location: ../index.php");
    exit();
}

include("../includes/conexion.php");

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    
    // Baja lógica del producto
    $conn->query("UPDATE productos SET estado = 'inactivo' WHERE id_producto = $id");
}

// Volver al panel automáticamente
header("Location: panel.php");
exit();
?>
