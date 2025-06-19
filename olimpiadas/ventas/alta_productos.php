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

    $conn->query("INSERT INTO productos (codigo, descripcion, precio) VALUES ('$codigo', '$descripcion', $precio)");
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
    <form method="POST">
        <label>Código:</label>
        <input type="text" name="codigo" required><br>
        <label>Descripción:</label>
        <input type="text" name="descripcion" required><br>
        <label>Precio:</label>
        <input type="number" name="precio" step="0.01" required><br>
        <input type="submit" value="Cargar">
    </form>
</body>
</html>
