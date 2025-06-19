<?php
session_start();
include("../includes/conexion.php");

$id = $_GET['id'] ?? 0;

// Eliminar registros hijos en orden correcto
$conn->query("DELETE FROM ventas_realizadas WHERE id_pedido = $id");
$conn->query("DELETE FROM detalle_pedido WHERE id_pedido = $id");
$conn->query("DELETE FROM pedidos WHERE id_pedido = $id");

header("Location: mis_pedidos.php");
