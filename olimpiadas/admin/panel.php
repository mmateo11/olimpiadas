<?php
session_start();
if ($_SESSION['tipo'] !== 'admin') {
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
    <div class="conteiner2">
    <h2>Panel del Jefe de Ventas</h2>
    <nav>
        <ul>
            <li class="lista"><a href="alta_productos.php">Alta de productos</a></li>
            <li class="lista"><a href="listar_productos.php">Listar productos</a></li>
            <li class="lista"><a href="pedidos_pendientes.php">Pedidos pendientes</a></li>
            <li class="lista"><a href="estado_cuenta.php">Estado de cuenta</a></li>
            <li class="lista"><a href="../includes/cerrar_sesion.php">Cerrar sesión</a></li>
        </ul>
    </nav>
    </div>
</body>
</html>
