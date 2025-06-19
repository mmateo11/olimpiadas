<?php
session_start();
if ($_SESSION['tipo'] !== 'ventas') {
    header("Location: ../index.php");
    exit();
}
include("../includes/conexion.php");

$resultado = $conn->query("SELECT * FROM productos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de productos</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <h2>Productos cargados</h2>
    <a href="panel.php">Volver</a><br><br>

    <table>
        <tr>
            <th>ID</th>
            <th>Código</th>
            <th>Descripción</th>
            <th>Precio</th>
        </tr>
        <?php while ($row = $resultado->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id_producto'] ?></td>
            <td><?= $row['codigo'] ?></td>
            <td><?= $row['descripcion'] ?></td>
            <td>$<?= $row['precio'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
