<?php
session_start();
include("../includes/conexion.php");

if (!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

$correo = $_SESSION['usuario'];
$res = $conn->query("SELECT id_cliente FROM clientes WHERE correo = '$correo'");
$row = $res->fetch_assoc();
$id_cliente = $row['id_cliente'];

$pedidos = $conn->query("SELECT * FROM pedidos WHERE id_cliente = $id_cliente AND estado = 'pendiente'");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mis pedidos</title>
  <link rel="stylesheet" href="../css/estilos.css?v=2"> 
</head>
<body>
  <h2>Pedidos Pendientes</h2>
  <a href="inicio.php" class="boton-volver">Volver</a>

  <?php while ($p = $pedidos->fetch_assoc()): ?>
    <div class="pedido-card">
      <h3>
        Pedido #<?= $p['id_pedido'] ?>
        <a class="anular-link" href="anular_pedido.php?id=<?= $p['id_pedido'] ?>">Anular</a>
      </h3>
      <ul>
        <?php
        $detalles = $conn->query("SELECT d.*, p.descripcion FROM detalle_pedido d 
                                  JOIN productos p ON d.id_producto = p.id_producto 
                                  WHERE d.id_pedido = " . $p['id_pedido']);
        while ($d = $detalles->fetch_assoc()):
        ?>
          <li><?= $d['descripcion'] ?> – <?= $d['cantidad'] ?> unidad(es)</li>
        <?php endwhile; ?>
      </ul>
    </div>
  <?php endwhile; ?>
</body>
</html>

