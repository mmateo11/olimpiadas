<?php
session_start();
if (isset($_SESSION['usuario'])) {
    header("Location: clientes/inicio.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Portal Turístico</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="conteiner">
    <h2>Ingreso al Portal</h2>
    <form action="validar_login.php" method="POST">
        <label>Correo:</label>
        <input type="email" name="correo" required><br>

        <label>Contraseña:</label>
        <input type="password" name="clave" required><br>

        <input type="submit" value="Ingresar">
    </form>
    <footer>
    <p>¿No tienes cuenta? <a href="registro_cliente.php" >Registrarse</a></p>
    </footer>    
</div>
</body>
</html>

