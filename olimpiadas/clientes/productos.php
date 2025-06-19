<?php
session_start();
if ($_SESSION['tipo'] !== 'cliente') {
    header("Location: ../index.php");
    exit();
}

include("../includes/conexion.php");

$sql = "SELECT * FROM productos";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <h2>Lista de productos</h2>
    <a href="../index.php">Ir al inicio</a><br><br>

    <a href="carrito.php">Ir al carrito</a><br><br>

    <form action="carrito.php" method="POST">
        <table>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Agregar</th>
            </tr>
            <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $row['codigo'] ?></td>
                <td><?= $row['descripcion'] ?></td>
                <td>$<?= $row['precio'] ?></td>
                <td><input type="number" name="cantidades[<?= $row['id_producto'] ?>]" value="1" min="1"></td>
                <td><input type="checkbox" name="productos[]" value="<?= $row['id_producto'] ?>"></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <input type="submit" value="Agregar al carrito">
    </form>
</body>
</html>
