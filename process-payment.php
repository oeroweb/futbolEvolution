<?php
header('Content-Type: application/json');

if (!isset($_SESSION)) {
  session_start();
}

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

// Log received fields for debugging
error_log("PROCESS_PAYMENT: Received amount='$amount', token='" . substr($token, 0, 20) . "...'");
error_log("PROCESS_PAYMENT: \$_POST contents: " . json_encode($_POST));

if ($token === '' && isset($_POST['passage_token'])) {
  $token = trim($_POST['passage_token']);
  error_log("PROCESS_PAYMENT: Token found in passage_token field");
}

if ($amount === '' || $token === '') {
  http_response_code(400);
  error_log("PROCESS_PAYMENT: Missing fields - amount='" . $amount . "', token='" . substr($token, 0, 20) . "...'");
  echo json_encode([
    'error' => true,
    'message' => 'Missing required fields: amount or token',
    'debug' => [
      'amount_received' => $amount !== '',
      'token_received' => $token !== '',
      'post_keys' => array_keys($_POST)
    ]
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

// Ensure cardholderName is present (required by some payment processors)
if (!isset($payload['cardholderName']) || $payload['cardholderName'] === '') {
  // Try to get from session if available
  if (isset($_SESSION['usuario']['nombres']) || isset($_SESSION['usuario']['apellidos'])) {
    $payload['cardholderName'] = trim(
      (isset($_SESSION['usuario']['nombres']) ? $_SESSION['usuario']['nombres'] : '') . ' ' .
      (isset($_SESSION['usuario']['apellidos']) ? $_SESSION['usuario']['apellidos'] : '')
    );
  } else {
    $payload['cardholderName'] = 'Card Holder'; // Default fallback
  }
}

$url = rtrim($apiBase, '/') . '/?saleapi=';

// Convert payload to URL-encoded format (some payment APIs expect this)
$postData = http_build_query($payload);

// Log the request for debugging
error_log("VALOR SALE REQUEST: " . json_encode([
  'url' => $url,
  'payload' => $payload,
  'post_data' => $postData,
  'timestamp' => date('Y-m-d H:i:s')
]));

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Accept: application/json',
  'Content-Type: application/x-www-form-urlencoded'
]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $verifySsl);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $verifySsl ? 2 : 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
$response = curl_exec($ch);
$error = curl_error($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Log the response for debugging
error_log("VALOR SALE RESPONSE: " . json_encode([
  'response' => $response,
  'error' => $error,
  'http_code' => $code,
  'timestamp' => date('Y-m-d H:i:s')
]));

if ($response === false) {
  http_response_code(502);
  error_log("VALOR SALE FAILED: " . $error);
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
    'status' => $code,
    'raw_response' => substr($response, 0, 500) // Include first 500 chars for debugging
  ]);
  exit;
}

// Check for Valor-specific error messages
if (isset($data['response']) && $data['response'] === null) {
  error_log("VALOR NULL RESPONSE: " . json_encode($data));
  
  // If response is null but we have error codes, it might be a processing issue
  if (isset($data['error_no']) && isset($data['error_code'])) {
    http_response_code(400);
    echo json_encode([
      'error' => true,
      'message' => 'Payment processing failed. Please check your card details.',
      'valor_response' => $data
    ]);
    exit;
  }
}

http_response_code($code >= 200 && $code < 300 ? 200 : 400);
echo json_encode($data);
