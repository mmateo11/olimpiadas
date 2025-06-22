<?php
session_start();
if ($_SESSION['tipo'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

include("../includes/conexion.php");

if (isset($_GET['baja'])) {
    $id = (int) $_GET['baja'];
    $conn->query("UPDATE productos SET estado = 'inactivo' WHERE id_producto = $id");
    header("Location: listar_productos.php");
    exit();
}

// Cambiar estado a activo
if (isset($_GET['activar'])) {
    $id = (int) $_GET['activar'];
    $conn->query("UPDATE productos SET estado = 'activo' WHERE id_producto = $id");
    header("Location: listar_productos.php");
    exit();
}

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
    <a href="panel.php" class="boton-volver">Volver al panel</a>
    <div class="conteiner2">
    <h2>Productos cargados</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id_producto'] ?></td>
                <td><?= $row['codigo'] ?></td>
                <td><?= $row['descripcion'] ?></td>
                <td>$<?= $row['precio'] ?></td>
                <td><?= ucfirst($row['estado']) ?></td>
                <td>
                    <?php if ($row['estado'] === 'activo'): ?>
                        <a href="?baja=<?= $row['id_producto'] ?>" onclick="return confirm('¿Dar de baja este producto?')">Dar de baja</a>
                    <?php else: ?>
                        <a href="?activar=<?= $row['id_producto'] ?>" onclick="return confirm('¿Reactivar este producto?')">Reactivar</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    </div>
</body>
</html>


