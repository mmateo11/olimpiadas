<?php
session_start();
if ($_SESSION['tipo'] !== 'ventas') {
    header("Location: ../index.php");
    exit();
}
include("../includes/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];

    // SUBIDA DE IMAGEN
    $imagen_nombre = null;
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        $nombre_temp = $_FILES['imagen']['tmp_name'];
        $imagen_nombre = basename($_FILES['imagen']['name']);
        $destino = "../img/" . $imagen_nombre;
        move_uploaded_file($nombre_temp, $destino);
    }

    // Guarda el producto
    $sql = "INSERT INTO productos (codigo, descripcion, precio, imagen)
            VALUES ('$codigo', '$descripcion', $precio, '$imagen_nombre')";
    $conn->query($sql);

    echo "<p>Producto agregado con éxito. <a href='panel.php'>Volver</a></p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta de productos</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <h2>Alta de nuevo producto</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Código:</label>
        <input type="text" name="codigo" required><br>

        <label>Descripción:</label>
        <input type="text" name="descripcion" required><br>

        <label>Precio:</label>
        <input type="number" name="precio" step="0.01" required><br>

        <label>Imagen:</label>
        <input type="file" name="imagen" accept="image/*"><br><br>

        <input type="submit" value="Cargar">
    </form>
    <a href="panel.php" class="boton-volver">Volver al panel</a>
</body>
</html>

