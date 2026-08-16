<?php
if (!isset($_SESSION)) {
  session_start();
}

require_once 'system/controller/helpers.php';
require_once 'valor-client-token.php';
include('layout/header.php');

if (!isset($_GET['id'])) {
  header("Location:game.php");
  exit;
}

$id = $_GET['id'];
$amount = isset($_GET['amount']) ? $_GET['amount'] : '';

if ($amount === '' || !is_numeric($amount) || (float)$amount <= 0) {
  $detallePartido = detallePartido($con, $id);
  if (!empty($detallePartido) && mysqli_num_rows($detallePartido) >= 1) {
    $detalle = mysqli_fetch_assoc($detallePartido);
    if (isset($detalle['costo']) && is_numeric($detalle['costo']) && (float)$detalle['costo'] > 0) {
      $amount = $detalle['costo'];
    }
  }
}

$valorTokenResult = valorGetClientTokenData();
$valorClientToken = '';
$valorTokenError = '';
$valorApiBase = '';
$valorEpi = '';

if ($valorTokenResult['ok']) {
  $valorClientToken = isset($valorTokenResult['payload']['clientToken']) ? $valorTokenResult['payload']['clientToken'] : '';
  $valorApiBase = isset($valorTokenResult['payload']['apiBase']) ? $valorTokenResult['payload']['apiBase'] : '';
  $valorEpi = isset($valorTokenResult['payload']['epi']) ? $valorTokenResult['payload']['epi'] : '';
} else {
  $valorTokenError = isset($valorTokenResult['payload']['message']) ? $valorTokenResult['payload']['message'] : 'Unable to initialize secure payment form.';
}

$valorFormAction = 'process-payment.php';
$valorIsDemo = false;
$defaultEmail = isset($_SESSION['usuario']['email']) ? $_SESSION['usuario']['email'] : '';
$defaultPhone = isset($_SESSION['usuario']['telefono']) ? $_SESSION['usuario']['telefono'] : '';
$defaultName = '';
if (isset($_SESSION['usuario']['nombres']) || isset($_SESSION['usuario']['apellidos'])) {
  $defaultName = trim(
    (isset($_SESSION['usuario']['nombres']) ? $_SESSION['usuario']['nombres'] : '') . ' ' .
    (isset($_SESSION['usuario']['apellidos']) ? $_SESSION['usuario']['apellidos'] : '')
  );
}
?>

<body>
  <!-------------- INICIO DE PAGINA -------------->
  <main class="main">
    <?php include('layout/navbar.php'); ?>

    <section class="section-banner">
      <div class="boxoverlay">
        <div class="center">
          <div class="box-texto">
            <h2 class="title">Payment</h2>
          </div>
        </div>
      </div>
    </section>
    <section class="section-formulario">
      <div class="box-formulario">
        <div class="box-texto">
          <h2 class="title">Complete your payment</h2>
          <p class="texto">Review the order details and enter your card information to complete the registration.</p>
        </div>
        <form action="javascript:void(0);" method="post" id="valor-checkout-form">
          <input type="hidden" name="orderId" value="<?= htmlspecialchars($id, ENT_QUOTES) ?>" />
          <input type="hidden" name="amount" value="<?= htmlspecialchars($amount, ENT_QUOTES) ?>" />
          <input type="hidden" name="token" value="" id="card-token" />
          <input type="hidden" name="actionUrl" value="<?= htmlspecialchars($valorFormAction, ENT_QUOTES) ?>" />
          <div id="payment-status" style="margin-bottom:16px;color:#1f2937;font-weight:600;"></div>
          <div style="margin-bottom:20px;">
            <strong>Order:</strong> <?= htmlspecialchars($id, ENT_QUOTES) ?><br>
            <strong>Amount:</strong> $<?= htmlspecialchars($amount, ENT_QUOTES) ?>
          </div>
          <div id="valor-fields"></div>
        </form>
      </div>
    </section>

  </main>

  <?php include('layout/footer.php'); ?>
  <?php if ($valorClientToken !== ''): ?>
    <script
      src="https://js.valorpaytech.com/V1/js/Passage.min.js"
      data-name="valor_passage"
      data-clientToken="<?= htmlspecialchars($valorClientToken, ENT_QUOTES) ?>"
      data-epi="<?= htmlspecialchars($valorEpi, ENT_QUOTES) ?>"
      data-url="<?= htmlspecialchars($valorApiBase, ENT_QUOTES) ?>"
      data-variant="inline"
      data-submitText="Process Payment"
      data-cardholderName="true"
      data-email="true"
      data-phone="true"
      data-billingAddress="false"
      data-defaultCardholderName="<?= htmlspecialchars($defaultName, ENT_QUOTES) ?>"
      data-defaultEmail="<?= htmlspecialchars($defaultEmail, ENT_QUOTES) ?>"
      data-defaultPhone="<?= htmlspecialchars($defaultPhone, ENT_QUOTES) ?>">
    </script>
  <?php endif; ?>
  <script>
    const form = document.getElementById('valor-checkout-form');
    const statusEl = document.getElementById('payment-status');
    const cardTokenInput = document.getElementById('card-token');
    const orderId = (form.querySelector('input[name="orderId"]') || {}).value || '';
    const amountRaw = (form.querySelector('input[name="amount"]') || {}).value || '';
    const amount = Number(amountRaw);
    const hasClientToken = <?= $valorClientToken !== '' ? 'true' : 'false' ?>;
    const tokenError = <?= json_encode($valorTokenError) ?>;

    function setStatus(message, isError = false) {
      statusEl.textContent = message;
      statusEl.style.color = isError ? '#b91c1c' : '#1f2937';
    }

    function isApprovedPayment(data) {
      const response = data && data.response ? String(data.response).toLowerCase() : '';
      const msg = data && data.msg ? String(data.msg).toLowerCase() : '';
      return response === 'approved' ||
        data && data.success_url === true ||
        data && data.error_no === 'S00' && data.error_code === '00' ||
        msg === 'approved';
    }

    function findPassageToken() {
      const selectors = [
        'input[name="passage_token"]',
        'input[name="passageToken"]',
        'input[name="cardToken"]',
        'input[name="card_token"]',
        'input[name="token"]',
        'input[name="passage-token"]'
      ];

      for (const selector of selectors) {
        const field = document.querySelector(selector);
        if (field && field.value.trim() !== '') {
          console.log('Token found in field:', selector, 'value:', field.value.trim());
          return field.value.trim();
        }
      }

      console.log('No token found in any of these selectors:', selectors);
      return '';
    }

    function syncCardToken() {
      const token = findPassageToken();
      if (token && cardTokenInput) {
        cardTokenInput.value = token;
        console.log('Token synced to cardTokenInput:', token);
      }
      return token;
    }

    function debugFormFields(targetForm) {
      if (!targetForm) {
        return;
      }
      const inputs = targetForm.querySelectorAll('input');
      console.log('Form fields debug:');
      inputs.forEach(input => {
        console.log(`  ${input.name || input.id}: "${input.value}"`);
      });
    }

    function validateCheckout(submitEvent) {
      console.log('Validating checkout...');

      if (!orderId) {
        submitEvent.preventDefault();
        setStatus('Unable to process payment: missing order ID.', true);
        return false;
      }

      if (!amountRaw || Number.isNaN(amount) || amount <= 0) {
        submitEvent.preventDefault();
        setStatus('Unable to process payment: invalid amount.', true);
        return false;
      }

      // Sincronizar token antes de validar
      const tokenValue = syncCardToken();
      console.log('Token value for validation:', tokenValue);

      // Debug: mostrar todos los campos del formulario
      const currentForm = submitEvent && submitEvent.target ? submitEvent.target : form;
      debugFormFields(currentForm);

      if (!tokenValue) {
        submitEvent.preventDefault();
        setStatus('Please complete your card details and try again.', true);
        return false;
      }

      setStatus('Processing payment...');
      return true;
    }

    if (!orderId) {
      setStatus('Unable to start checkout: missing order ID.', true);
    } else if (!amountRaw || Number.isNaN(amount) || amount <= 0) {
      setStatus('Unable to start checkout: invalid amount.', true);
    } else if (!hasClientToken) {
      setStatus('Payment initialization failed: ' + tokenError, true);
    } else {
      setStatus('Secure payment form ready.');
    }

    form.addEventListener('submit', function(e) {
      e.preventDefault();
      console.log('Main form submit intercepted');
      
      // Sincronizar token antes de validar
      const tokenValue = syncCardToken();
      console.log('Token synced for submission:', tokenValue);

      // Validar todos los campos
      if (!validateCheckout(e)) {
        return;
      }

      // Crear FormData con los campos requeridos
      const formData = new FormData();
      formData.append('orderId', orderId);
      formData.append('amount', amountRaw);
      formData.append('token', cardTokenInput.value);

      // Agregar cualquier otro campo del formulario
      const inputs = form.querySelectorAll('input, select, textarea');
      inputs.forEach(input => {
        if (input.name && input.name !== 'token' && !['orderId', 'amount', 'actionUrl'].includes(input.name)) {
          if (!formData.has(input.name)) {
            formData.append(input.name, input.value);
          }
        }
      });

      console.log('Main form - FormData to send:');
      for (let [key, value] of formData.entries()) {
        console.log(`  ${key}: ${value}`);
      }

      setStatus('Processing payment...');

      fetch('process-payment.php', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        console.log('Response status:', response.status);
        return response.json();
      })
      .then(data => {
        console.log('Payment response:', data);
        if (data.error) {
          setStatus('Payment failed: ' + (data.message || data.mensaje || 'Unknown error'), true);
        } else if (isApprovedPayment(data)) {
          setStatus('Payment successful! Redirecting...', false);
          setTimeout(() => {
            window.location.href = 'game.php?payment=success';
          }, 1500);
        } else if (data.response === null && data.error_no) {
          setStatus('Payment processing error: ' + (data.desc || 'Please contact support'), true);
        } else {
          setStatus('Payment completed. Status: ' + (data.response || 'unknown'), false);
        }
      })
      .catch(error => {
        console.error('Payment error:', error);
        setStatus('Payment processing failed: ' + error.message, true);
      });
    });

    document.addEventListener('passageHiddenFormAdded', function(event) {
      const passageForm = event.detail && event.detail.form ? event.detail.form : form;
      if (!passageForm) {
        return;
      }

      setStatus('Secure payment form ready.');
      console.log('Passage form ready:', passageForm);
      console.log('Passage form action:', passageForm.action);

      // Cambiar el action del formulario de Passage a javascript:void(0) para prevenir envío automático
      passageForm.action = 'javascript:void(0);';
      
      // Intentar sincronizar el token periódicamente
      const tokenCheckInterval = setInterval(() => {
        const token = findPassageToken();
        if (token && !cardTokenInput.value) {
          cardTokenInput.value = token;
          console.log('Token auto-synced:', token);
          setStatus('Card details verified and ready for payment.');
          clearInterval(tokenCheckInterval);
        }
      }, 1000); // Check every second

      // También escuchar por eventos de token generado
      if (window.Passage) {
        window.Passage.on('tokenGenerated', function(data) {
          const generatedToken = data && (data.token || data.cardToken);
          if (generatedToken) {
            cardTokenInput.value = generatedToken;
            console.log('Token generated via event:', generatedToken);
            setStatus('Card details verified and ready for payment.');
            clearInterval(tokenCheckInterval);
          }
        });
      }

      // Crear una función para enviar el pago
      function submitPayment() {
        console.log('submitPayment() called');

        // Sincronizar token antes de validar
        const tokenValue = syncCardToken();
        console.log('Token synced for submission:', tokenValue);

        // Validar todos los campos
        const validationEvent = new Event('submit');
        if (!validateCheckout(validationEvent)) {
          return;
        }

        // Crear FormData con los campos requeridos
        const formData = new FormData();
        formData.append('orderId', orderId);
        formData.append('amount', amountRaw);
        formData.append('token', cardTokenInput.value);

        // Agregar cualquier otro campo del formulario de Passage
        const passageInputs = passageForm.querySelectorAll('input, select, textarea');
        passageInputs.forEach(input => {
          if (input.name && input.name !== 'token' && !['orderId', 'amount'].includes(input.name)) {
            if (!formData.has(input.name)) {
              formData.append(input.name, input.value);
            }
          }
        });

        console.log('FormData to send:');
        for (let [key, value] of formData.entries()) {
          console.log(`  ${key}: ${value}`);
        }

        setStatus('Processing payment...');

        // Enviar a process-payment.php vía AJAX
        fetch('process-payment.php', {
          method: 'POST',
          body: formData
        })
        .then(response => {
          console.log('Response status:', response.status);
          return response.json();
        })
        .then(data => {
          console.log('Payment response:', data);

          if (data.error) {
            setStatus('Payment failed: ' + (data.message || data.mensaje || 'Unknown error'), true);
          } else if (isApprovedPayment(data)) {
            setStatus('Payment successful! Redirecting...', false);
            setTimeout(() => {
              window.location.href = 'game.php?payment=success';
            }, 1500);
          } else if (data.response === null && data.error_no) {
            setStatus('Payment processing error: ' + (data.desc || data.message || 'Please contact support'), true);
          } else {
            setStatus('Payment completed. Status: ' + (data.response || 'unknown'), false);
          }
        })
        .catch(error => {
          console.error('Payment error:', error);
          setStatus('Payment processing failed: ' + error.message, true);
        });
      }

      // Interceptar submit del formulario de Passage
      passageForm.addEventListener('submit', function(e) {
        console.log('passageForm submit intercepted');
        e.preventDefault();
        submitPayment();
      });

      // Buscar el botón de envío de Passage y asignarle el evento click
      const submitButtons = passageForm.querySelectorAll('button[type="submit"], input[type="submit"]');
      console.log('Found submit buttons:', submitButtons.length);
      submitButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
          console.log('Submit button clicked');
          e.preventDefault();
          submitPayment();
        });
      });
    });

  </script>

</body>

</html>
