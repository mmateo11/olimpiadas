<?php
function enviar_mail($correo_destino, $id_pedido) {
    // Esto simula el envío, en un entorno real deberías usar PHPMailer o similar
    $asunto = "Confirmación de compra - Pedido #$id_pedido";
    $mensaje = "Gracias por su compra. Su pedido ha sido registrado con el número: $id_pedido.";
    $remitente = "From: sistema@turismo.com";

    // mail($correo_destino, $asunto, $mensaje, $remitente); // Descomentá si usás servidor real

    // Por ahora, simplemente mostramos el mensaje
    echo "<p><strong>Correo simulado a:</strong> $correo_destino</p>";
    echo "<p><strong>Asunto:</strong> $asunto</p>";
    echo "<p><strong>Mensaje:</strong> $mensaje</p>";
}
