<?php
session_start();
include("../includes/conexion.php");

$correo = $_SESSION['usuario'];
$res = $conn->query("SELECT id_cliente FROM clientes WHERE correo = '$correo'");
$row = $res->fetch_assoc();
$id_cliente = $row['id_cliente'];

$pedidos = $conn->query("SELECT * FROM pedidos WHERE id_cliente = $id_cliente AND estado = 'pendiente'");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis pedidos</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <h2>Pedidos Pendientes</h2>
    <a href="inicio.php">Volver</a><br><br>

    <?php while ($p = $pedidos->fetch_assoc()): ?>
        <p><strong>Pedido #<?= $p['id_pedido'] ?></strong> |
           <a href="anular_pedido.php?id=<?= $p['id_pedido'] ?>">Anular</a></p>
        <ul>
        <?php
            $detalles = $conn->query("SELECT d.*, p.descripcion FROM detalle_pedido d JOIN productos p ON d.id_producto = p.id_producto WHERE d.id_pedido = " . $p['id_pedido']);
            while ($d = $detalles->fetch_assoc()):
        ?>
            <li><?= $d['descripcion'] ?> - <?= $d['cantidad'] ?> unidad(es)</li>
        <?php endwhile; ?>
        </ul>
    <?php endwhile; ?>
</body>
</html>
