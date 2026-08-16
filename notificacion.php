<?php
require_once '../controller/connection.php';

/**
 * Webhook para Valor Paytech
 * 
 * Este script recibe notificaciones de cambios en el estado de pagos realizados
 * a través de la pasarela de pagos Valor Paytech.
 * 
 * Documentación oficial: https://www.valorpaytech.com/docs/webhooks
 */
// 1. Obtener el cuerpo de la petición (JSON)
$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);


// 2. Log de depuración (Opcional pero RECOMENDADO)
// Esto crea un archivo .log para que veas qué te envió la pasarela si algo falla.
file_put_contents('pagos.log', "[" . date('Y-m-d H:i:s') . "] Datos recibidos: " . $json_data . PHP_EOL, FILE_APPEND);

if (!$data) {
  http_response_code(400); // Bad Request
  exit("No data received");
}

// 3. Validación de Seguridad (Firma/Hash)
// NOTA: Valor Paytech envía un header con una firma para validar la autenticidad.
// Aquí deberías comparar el hash enviado con uno generado por ti usando tu Webhook Secret.
$webhook_secret = "4IwK1%Ka8dmqKkSA2%AI33yKV91RyY$@";
$header_signature = $_SERVER['pago_valor'] ? $_SERVER['pagp_valor']: '';

/* Lógica de validación (simplificada):
   Si la firma no coincide, debes ignorar la petición por seguridad.
  considera usar hash_hmac con SHA256 u otro método según la documentación de Valor Paytech.
*/

if (empty($json_payload) || empty($signature_enviada)) {
    http_response_code(400);
    exit("Faltan datos o firma");
}

$computed_signature = hash_hmac('sha256', $json_data, $webhook_secret);
if (!hash_equals($computed_signature, $header_signature)) {
  http_response_code(403); // Prohibido: Firma inválida
  exit("Invalid signature");
}


// 4. Procesar según el estado de la transacción
$status = $data['status'] ? $data['status'] : ''; // El nombre exacto depende de la documentación de Valor
$order_id = $data['order_id'] ? $data['order_id'] : '';
$transaction_id = $data['uuid'] ? $data['uuid'] : ''; // ID único de Valor Paytech

switch ($status) {
  case 'approved':
  case 'success':
    // AQUI ACTUALIZAS TU BASE DE DATOS
    actualizarPedido($order_id, 'Pagado', $transaction_id);
    break;

  case 'declined':
  case 'failed':
    actualizarPedido($order_id, 'Fallido', $transaction_id);
    break;

  default:
    // Otros estados (pendiente, reembolsado, etc.)
    break;
}

// 5. Responder a Valor Paytech con un 200 OK
// Esto le dice a la pasarela: "Ya recibí la info, no me la vuelvas a enviar".
http_response_code(200);
echo "Webhook processed";

/**
 * Función de ejemplo para actualizar tu DB
 */
function actualizarPedido($id, $estado, $tx_id)
{
  // Aquí iría tu conexión PDO y el UPDATE de SQL
  // Ejemplo: UPDATE pedidos SET estado = '$estado', transaccion_id = '$tx_id' WHERE id = '$id'
}
