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
$saleEndpoint = getenv('VALOR_SALE_ENDPOINT') ?: (isset($cfg['sale_endpoint']) ? $cfg['sale_endpoint'] : 'sale');
$surchargeIndicator = getenv('VALOR_SURCHARGE_INDICATOR') !== false ? getenv('VALOR_SURCHARGE_INDICATOR') : (isset($cfg['surcharge_indicator']) ? $cfg['surcharge_indicator'] : '0');
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
  'ecomm_channel' => 'passagejs',
  'amount' => $amount,
  'token' => $token,
  'invoicenumber' => substr(preg_replace('/[^A-Za-z0-9]/', '', isset($_POST['orderId']) ? trim($_POST['orderId']) : ''), 0, 12),
  'orderdescription' => 'Futbol Evolution'
];

$payload['surchargeIndicator'] = (string)$surchargeIndicator;

$optionalFields = [
  'email',
  'phone',
  'address1',
  'address2',
  'city',
  'state',
  'zip',
  'country',
  'billing_country',
  'shipping_country',
  'cardholdername',
  'cardholderName'
];

foreach ($optionalFields as $field) {
  if (isset($_POST[$field]) && $_POST[$field] !== '') {
    $payload[$field] = $_POST[$field];
  }
}

if (!isset($payload['cardholdername']) && isset($_POST['cc_name']) && trim($_POST['cc_name']) !== '') {
  $payload['cardholdername'] = trim($_POST['cc_name']);
}

$payload['shipping_country'] = isset($payload['shipping_country']) ? strtoupper($payload['shipping_country']) : 'US';
$payload['billing_country'] = isset($payload['billing_country']) ? strtoupper($payload['billing_country']) : 'US';

if (isset($payload['cardholderName']) && !isset($payload['cardholdername'])) {
  $payload['cardholdername'] = $payload['cardholderName'];
}
unset($payload['cardholderName']);

// Ensure cardholdername is present (required by some payment processors)
if (!isset($payload['cardholdername']) || $payload['cardholdername'] === '') {
  // Try to get from session if available
  if (isset($_SESSION['usuario']['nombres']) || isset($_SESSION['usuario']['apellidos'])) {
    $payload['cardholdername'] = trim(
      (isset($_SESSION['usuario']['nombres']) ? $_SESSION['usuario']['nombres'] : '') . ' ' .
      (isset($_SESSION['usuario']['apellidos']) ? $_SESSION['usuario']['apellidos'] : '')
    );
  } else {
    $payload['cardholdername'] = 'Card Holder'; // Default fallback
  }
}

$saleEndpoint = ltrim($saleEndpoint, '?');
$url = rtrim($apiBase, '/') . '/?' . $saleEndpoint;

$postData = json_encode($payload);
$logPayload = $payload;
$logPayload['appid'] = '***';
$logPayload['appkey'] = '***';
$logPayload['token'] = substr($token, 0, 6) . '...';

// Log the request for debugging
error_log("VALOR SALE REQUEST: " . json_encode([
  'url' => $url,
  'payload' => $logPayload,
  'timestamp' => date('Y-m-d H:i:s')
]));

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  'Accept: application/json',
  'Content-Type: application/json'
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

$isApproved = false;
if (isset($data['success_url']) && $data['success_url'] === true) {
  $isApproved = true;
} elseif (isset($data['error_no'], $data['error_code']) && $data['error_no'] === 'S00' && $data['error_code'] === '00') {
  $isApproved = true;
} elseif (isset($data['msg']) && strtoupper($data['msg']) === 'APPROVED') {
  $isApproved = true;
} elseif (isset($data['response']) && strtolower((string)$data['response']) === 'approved') {
  $isApproved = true;
}

if (!$isApproved) {
  $providerMessage = 'Payment was not approved.';
  if (isset($data['desc']) && $data['desc'] !== '') {
    $providerMessage = $data['desc'];
  } elseif (isset($data['msg']) && $data['msg'] !== '') {
    $providerMessage = $data['msg'];
  } elseif (isset($data['mesg']) && $data['mesg'] !== '') {
    $providerMessage = $data['mesg'];
  }

  http_response_code(400);
  echo json_encode([
    'error' => true,
    'message' => $providerMessage,
    'valor_response' => $data
  ]);
  exit;
}

http_response_code($code >= 200 && $code < 300 ? 200 : 400);
echo json_encode($data);
