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

$metodo_pago = $_POST['metodo_pago'] ?? 'no especificado';

$conn->query("INSERT INTO pedidos (id_cliente, estado, metodo_pago) VALUES ($id_cliente, 'pendiente', '$metodo_pago')");
$id_pedido = $conn->insert_id;

foreach ($_SESSION['carrito'] as $id_prod => $cant) {
    $conn->query("INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad) VALUES ($id_pedido, $id_prod, $cant)");
}

include("../includes/enviar_mail.php");
echo '<link rel="stylesheet" href="../css/estilos.css">';
enviar_mail($correo, $id_pedido);


unset($_SESSION['carrito']);

    echo "<div style='text-align:center; margin-top:40px; background-color: white;
        width: 90vh;
        padding-bottom: 1rem;
        display: block;
        border-radius: 5%;
        align-items: center;
        margin: 0 auto;'>
        <h2>Compra realizada correctamente</h2>
        <p>Método de pago elegido: <strong>$metodo_pago</strong></p>
        <a href='inicio.php' class='boton-volver'>Volver al inicio</a>
      </div>";
?>

