<?php
session_start();
if ($_SESSION['tipo'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}
include("../includes/conexion.php");

if (isset($_GET['entregar'])) {
    $id = $_GET['entregar'];
    $conn->query("UPDATE pedidos SET estado = 'entregado' WHERE id_pedido = $id");
    $conn->query("INSERT INTO ventas_realizadas (id_pedido, fecha) VALUES ($id, NOW())");
}

$pedidos = $conn->query("SELECT * FROM pedidos WHERE estado = 'pendiente'");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedidos pendientes</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <a href="panel.php" class="boton-volver">Volver</a>
    <div class="conteiner2">
    <h2>Pedidos pendientes</h2>

    <?php while ($p = $pedidos->fetch_assoc()): ?>
        <p><strong>Pedido #<?= $p['id_pedido'] ?></strong> |
           <a href="?entregar=<?= $p['id_pedido'] ?>">Marcar como entregado</a></p>
        <ul>
        <?php
            $detalles = $conn->query("SELECT d.*, pr.descripcion FROM detalle_pedido d 
            JOIN productos pr ON d.id_producto = pr.id_producto 
            WHERE d.id_pedido = " . $p['id_pedido']);
            while ($d = $detalles->fetch_assoc()):
        ?>
            <li><?= $d['descripcion'] ?> - <?= $d['cantidad'] ?> unidad(es)</li>
        <?php endwhile; ?>
        </ul>
    <?php endwhile; ?>
    </div>
</body>
</html>

