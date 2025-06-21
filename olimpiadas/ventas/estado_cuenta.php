<?php
session_start();
if ($_SESSION['tipo'] !== 'ventas') {
    header("Location: ../index.php");
    exit();
}
include("../includes/conexion.php");

$ventas = $conn->query("
    SELECT v.*, c.correo 
    FROM ventas_realizadas v
    JOIN pedidos p ON v.id_pedido = p.id_pedido
    JOIN clientes c ON p.id_cliente = c.id_cliente
    ORDER BY v.fecha DESC
");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estado de cuenta</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <h2>Ventas realizadas</h2>
    <a href="panel.php" class="boton-volver">Volver</a><br><br>

    <table>
        <tr>
            <th>ID Venta</th>
            <th>ID Pedido</th>
            <th>Cliente</th>
            <th>Fecha</th>
        </tr>
        <?php while ($row = $ventas->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id_venta'] ?></td>
            <td><?= $row['id_pedido'] ?></td>
            <td><?= $row['correo'] ?></td>
            <td><?= $row['fecha'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
