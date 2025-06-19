<?php
include("includes/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO clientes (correo, clave) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $correo, $clave);
    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Cliente</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h2>Registrar nuevo cliente</h2>
    <form method="POST">
        <label>Correo:</label>
        <input type="email" name="correo" required><br>

        <label>Contraseña:</label>
        <input type="password" name="clave" required><br>

        <input type="submit" value="Registrarse">
    </form>
</body>
</html>
