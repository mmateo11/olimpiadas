<?php
session_start();
if ($_SESSION['tipo'] !== 'ventas') {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Ventas</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <h2>Panel del Jefe de Ventas</h2>
    <nav>
        <ul>
            <li><a href="alta_productos.php">Alta de productos</a></li>
            <li><a href="listar_productos.php">Listar productos</a></li>
            <li><a href="pedidos_pendientes.php">Pedidos pendientes</a></li>
            <li><a href="estado_cuenta.php">Estado de cuenta</a></li>
            <li><a href="../includes/cerrar_sesion.php">Cerrar sesión</a></li>
        </ul>
    </nav>
</body>
</html>
