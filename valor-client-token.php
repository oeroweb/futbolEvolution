<?php
// Prevent any output when included as a module
if (!defined('VALOR_TOKEN_INCLUDED')) {
  define('VALOR_TOKEN_INCLUDED', true);

function valorRequest($url, $verifySsl)
{
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
  curl_setopt($ch, CURLOPT_TIMEOUT, 30);
  curl_setopt($ch, CURLOPT_ENCODING, '');
  curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $verifySsl);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, $verifySsl ? 2 : 0);

  $response = curl_exec($ch);
  $error = curl_error($ch);
  $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
  $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
  curl_close($ch);

  return [
    'response' => $response,
    'error' => $error,
    'code' => $code,
    'contentType' => $contentType,
    'headerSize' => $headerSize
  ];
}

function valorGetClientTokenData()
{
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
  $debug = isset($cfg['debug']) ? (bool)$cfg['debug'] : true;

  if ($appId === '' || $appKey === '' || $epi === '') {
    return [
      'ok' => false,
      'http_code' => 500,
      'payload' => [
        'error' => true,
        'message' => 'Missing VALOR_APP_ID, VALOR_APP_KEY, or VALOR_EPI'
      ]
    ];
  }

  $query = http_build_query([
    'appid' => $appId,
    'appkey' => $appKey,
    'epi' => $epi,
    'txn_type' => 'clientToken',
    'ecomm_channel' => 'passagejs'
  ]);

  $url = rtrim($apiBase, '/') . '/?' . $query;

  $result = valorRequest($url, $verifySsl);
  $response = $result['response'];
  $error = $result['error'];
  $code = $result['code'];
  $contentType = $result['contentType'];
  $headerSize = $result['headerSize'];

  if ($response === false) {
    return [
      'ok' => false,
      'http_code' => 502,
      'payload' => [
        'error' => true,
        'message' => 'Client token request failed',
        'detail' => $error
      ]
    ];
  }

  $body = $response;
  if ($headerSize > 0) {
    $body = substr($response, $headerSize);
  }

  $data = json_decode($body, true);

  if (!is_array($data) && strpos($apiBase, ':4430') !== false) {
    $altBase = str_replace(':4430', '', $apiBase);
    $altUrl = rtrim($altBase, '/') . '/?' . $query;
    $result = valorRequest($altUrl, $verifySsl);
    $response = $result['response'];
    $error = $result['error'];
    $code = $result['code'];
    $contentType = $result['contentType'];
    $headerSize = $result['headerSize'];

    if ($response !== false) {
      $body = $response;
      if ($headerSize > 0) {
        $body = substr($response, $headerSize);
      }
      $data = json_decode($body, true);
      if (is_array($data)) {
        $url = $altUrl;
        $apiBase = $altBase;
      }
    }
  }

  if (!is_array($data)) {
    $payload = [
      'error' => true,
      'message' => 'Invalid response from token API',
      'status' => $code,
      'content_type' => $contentType
    ];

    if ($debug) {
      $payload['response_preview'] = substr(trim($body), 0, 300);
      $payload['provider_url'] = preg_replace('/appkey=[^&]*/', 'appkey=***', $url);
    }

    return [
      'ok' => false,
      'http_code' => ($code >= 400 ? $code : 502),
      'payload' => $payload
    ];
  }

  $clientToken = '';
  if (isset($data['clientToken'])) {
    $clientToken = $data['clientToken'];
  } elseif (isset($data['client_token'])) {
    $clientToken = $data['client_token'];
  }

  if ($clientToken === '') {
    if (isset($data['desc']) && $data['desc'] !== '') {
      $providerMessage = $data['desc'];
    } elseif (isset($data['msg']) && $data['msg'] !== '') {
      $providerMessage = $data['msg'];
    } elseif (isset($data['mesg']) && $data['mesg'] !== '') {
      $providerMessage = $data['mesg'];
    } else {
      $providerMessage = 'Client token not found in response';
    }

    return [
      'ok' => false,
      'http_code' => ($code >= 400 ? $code : 502),
      'payload' => [
        'error' => true,
        'message' => $providerMessage,
        'status' => $code
      ]
    ];
  }

  return [
    'ok' => true,
    'http_code' => 200,
    'payload' => [
      'clientToken' => $clientToken,
      'epi' => $epi,
      'apiBase' => rtrim($apiBase, '/')
    ]
  ];
}

// Only execute direct access code when called directly
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
  header('Content-Type: application/json');
  $result = valorGetClientTokenData();
  http_response_code($result['http_code']);
  echo json_encode($result['payload']);
  exit;
}
}
