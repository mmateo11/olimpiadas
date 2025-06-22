<?php
session_start();
if ($_SESSION['tipo'] !== 'cliente') {
    header("Location: ../index.php");
    exit();
}

include("../includes/conexion.php");
$sql = "SELECT * FROM productos WHERE estado = 'activo'";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body><div class="conteiner2">
    <h2>Catálogo de paquetes turísticos</h2>

    <div style="text-align: center;">
        <a href="../index.php" class="boton-volver">Ir al inicio</a>
        <a href="carrito.php" class="boton-volver">Ir al carrito</a>
    </div>
     </div>

    <form action="carrito.php" method="POST">
        <div class="catalogo-productos">
            <?php while ($row = $resultado->fetch_assoc()): 
                $img = "../img/" . $row['codigo'] . ".jpg";
                if (!file_exists($img)) {
                    $img = "../img/default.jpg";
                }
            ?>
            <div class="producto-tarjeta">
                <img src="<?= $img ?>" alt="<?= $row['descripcion'] ?>">
                <h3><?= $row['descripcion'] ?></h3>
                <p><strong>$<?= $row['precio'] ?></strong></p>
                <label>Cantidad:</label>
                <input type="number" name="cantidades[<?= $row['id_producto'] ?>]" value="1" min="1">
                <div>
                    <input type="checkbox" name="productos[]" value="<?= $row['id_producto'] ?>">
                    <label>Agregar</label>
                </div>
                
            </div>
            <?php endwhile; ?>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <input type="submit" value="Agregar seleccionados al carrito">
        </div>
    </form>
</body>
</html>

