<?php
session_start();
include("../includes/conexion.php");

// Redirige si el carrito está vacío
if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
    header("Location: carrito.php");
    exit();
}

// Obtener datos del usuario
$correo = $_SESSION['usuario'];
$res = $conn->query("SELECT id_cliente FROM clientes WHERE correo = '$correo'");
$row = $res->fetch_assoc();
$id_cliente = $row['id_cliente'];

// Obtener método de pago del formulario (con respaldo)
$metodo_pago = $_POST['metodo_pago'] ?? 'no especificado';

// Crear pedido
$conn->query("INSERT INTO pedidos (id_cliente, estado, metodo_pago) VALUES ($id_cliente, 'pendiente', '$metodo_pago')");
$id_pedido = $conn->insert_id;

// Agregar detalles del pedido
foreach ($_SESSION['carrito'] as $id_prod => $cant) {
    $conn->query("INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad) VALUES ($id_pedido, $id_prod, $cant)");
}

// Enviar mail (simulado)
include("../includes/enviar_mail.php");
echo '<link rel="stylesheet" href="../css/estilos.css">';
enviar_mail($correo, $id_pedido);

// Vaciar carrito
unset($_SESSION['carrito']);

// Confirmación en pantalla
echo "<div style='text-align:center; margin-top:40px;'>
        <h2>Compra realizada correctamente</h2>
        <p>Método de pago elegido: <strong>$metodo_pago</strong></p>
        <a href='inicio.php' class='boton-volver'>Volver al inicio</a>
      </div>";
?>

