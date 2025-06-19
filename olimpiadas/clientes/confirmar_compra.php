<?php
session_start();
include("../includes/conexion.php");

if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    header("Location: carrito.php");
    exit();
}

$correo = $_SESSION['usuario'];
$res = $conn->query("SELECT id_cliente FROM clientes WHERE correo = '$correo'");
$row = $res->fetch_assoc();
$id_cliente = $row['id_cliente'];

$conn->query("INSERT INTO pedidos (id_cliente, estado) VALUES ($id_cliente, 'pendiente')");
$id_pedido = $conn->insert_id;

foreach ($_SESSION['carrito'] as $id_prod => $cant) {
    $conn->query("INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad) VALUES ($id_pedido, $id_prod, $cant)");
}

// Enviar mails si es necesario
include("../includes/enviar_mail.php");
enviar_mail($correo, $id_pedido);

unset($_SESSION['carrito']);

echo "Compra realizada correctamente. <a href='inicio.php'>Volver al inicio</a>";
