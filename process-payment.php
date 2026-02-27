<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode([
    'error' => true,
    'message' => 'Method not allowed'
  ]);
  exit;
}

$cfg = [];
$cfgFile = __DIR__ . '/config/valor.php';
if (file_exists($cfgFile)) {
  $cfg = require $cfgFile;
}

$appId = getenv('VALOR_APP_ID') ?: (isset($cfg['app_id']) ? $cfg['app_id'] : '');
$appKey = getenv('VALOR_APP_KEY') ?: (isset($cfg['app_key']) ? $cfg['app_key'] : '');
$epi = getenv('VALOR_EPI') ?: (isset($cfg['epi']) ? $cfg['epi'] : '');
$apiBase = getenv('VALOR_API_BASE') ?: (isset($cfg['api_base']) ? $cfg['api_base'] : 'https://securelink.valorpaytech.com:4430');
$verifySsl = isset($cfg['verify_ssl']) ? (bool)$cfg['verify_ssl'] : true;

if ($appId === '' || $appKey === '' || $epi === '') {
  http_response_code(500);
  echo json_encode([
    'error' => true,
    'message' => 'Missing VALOR_APP_ID, VALOR_APP_KEY, or VALOR_EPI'
  ]);
  exit;
}

$amount = isset($_POST['amount']) ? trim($_POST['amount']) : '';
$token = isset($_POST['token']) ? trim($_POST['token']) : '';

if ($token === '' && isset($_POST['passage_token'])) {
  $token = trim($_POST['passage_token']);
}

if ($amount === '' || $token === '') {
  http_response_code(400);
  echo json_encode([
    'error' => true,
    'message' => 'Missing required fields: amount or token'
  ]);
  exit;
}

$payload = [
  'appid' => $appId,
  'appkey' => $appKey,
  'epi' => $epi,
  'txn_type' => 'sale',
  'amount' => $amount,
  'token' => $token,
  'orderId' => isset($_POST['orderId']) ? trim($_POST['orderId']) : ''
];

$optionalFields = [
  'email',
  'phone',
  'address1',
  'address2',
  'city',
  'state',
  'zip',
  'country',
  'cardholderName'
];

foreach ($optionalFields as $field) {
  if (isset($_POST[$field]) && $_POST[$field] !== '') {
    $payload[$field] = $_POST[$field];
  }
}

$url = rtrim($apiBase, '/') . '/?saleapi=';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Accept: application/json',
  'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $verifySsl);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $verifySsl ? 2 : 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
$response = curl_exec($ch);
$error = curl_error($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($response === false) {
  http_response_code(502);
  echo json_encode([
    'error' => true,
    'message' => 'Sale API request failed',
    'detail' => $error
  ]);
  exit;
}

$data = json_decode($response, true);

if (!is_array($data)) {
  http_response_code(502);
  echo json_encode([
    'error' => true,
    'message' => 'Invalid response from Sale API',
    'status' => $code
  ]);
  exit;
}

http_response_code($code >= 200 && $code < 300 ? 200 : 400);
echo json_encode($data);
