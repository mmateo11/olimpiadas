<?php
function enviar_mail($correo_destino, $id_pedido) {
    $asunto = "Confirmación de compra - Pedido #$id_pedido";
    $mensaje = "Gracias por su compra. Su pedido ha sido registrado con el número: $id_pedido.";

    echo "
    <div class='email-simulado'>
        <h3>Correo enviado (simulado)</h3>
        <p><strong>Para:</strong> $correo_destino</p>
        <p><strong>Asunto:</strong> $asunto</p>
        <p><strong>Mensaje:</strong> $mensaje</p>
    </div>";
}
?>
