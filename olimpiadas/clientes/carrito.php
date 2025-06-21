<?php
session_start();
if ($_SESSION['tipo'] !== 'cliente') {
    header("Location: ../index.php");
    exit();
}

include("../includes/conexion.php");

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productos'])) {
    foreach ($_POST['productos'] as $id_prod) {
        $cantidad = $_POST['cantidades'][$id_prod] ?? 1;
        $_SESSION['carrito'][$id_prod] = $cantidad;
    }
}

// Eliminar producto
if (isset($_GET['eliminar'])) {
    unset($_SESSION['carrito'][$_GET['eliminar']]);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <h2>Mi carrito</h2>
    <a href="../index.php" class="boton-volver">Ir al inicio</a><br><br>
    <a href="productos.php" class="boton-volver">Volver a productos</a><br><br>

    <?php if (empty($_SESSION['carrito'])): ?>
        <p>No hay productos en el carrito.</p>
    <?php else: ?>
        <form action="confirmar_compra.php" method="POST">
            <table>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                    <th>Eliminar</th>
                </tr>
                <?php
                $total = 0;
                foreach ($_SESSION['carrito'] as $id => $cantidad):
                    $res = $conn->query("SELECT * FROM productos WHERE id_producto = $id");
                    $prod = $res->fetch_assoc();
                    $subtotal = $prod['precio'] * $cantidad;
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?= $prod['descripcion'] ?></td>
                    <td><?= $cantidad ?></td>
                    <td>$<?= $prod['precio'] ?></td>
                    <td>$<?= $subtotal ?></td>
                    <td><a href="?eliminar=<?= $id ?>">Eliminar</a></td>
                </tr>
                <?php endforeach; ?>
            </table>
            <p><strong>Total: $<?= $total ?></strong></p>
            <label>Método de pago:</label>
            <select name="metodo_pago" required>
            <option value="efectivo">Efectivo</option>
            <option value="transferencia">Transferencia bancaria</option>
            <option value="tarjeta">Tarjeta de crédito</option>
            </select><br><br>

            <input type="submit" value="Confirmar compra">
        </form>
    <?php endif; ?>
</body>
</html>
