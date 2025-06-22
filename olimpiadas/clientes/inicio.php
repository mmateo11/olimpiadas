<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] !== 'cliente') {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio Cliente</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <div class="conteiner">
    <h2>Bienvenido, <?php echo $_SESSION['usuario']; ?></h2>
    <nav>
        <ul>
            <li><a href="productos.php" target="contenido">Ver productos</a></li>
            <li><a href="carrito.php" target="contenido">Mi carrito</a></li>
            <li><a href="mis_pedidos.php" target="contenido">Mis pedidos</a></li>
            <li><a href="../includes/cerrar_sesion.php">Cerrar sesión</a></li>
        </ul>
    </nav>
    </div>
</body>
</html>
