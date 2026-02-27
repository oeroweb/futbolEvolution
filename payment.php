<?php
include('layout/header.php');

if (!isset($_GET['id'])) {
  header("Location:game.php");
  exit;
}

$id = $_GET['id'];
$amount = isset($_GET['amount']) ? $_GET['amount'] : '';

$valorFormAction = 'process-payment.php';
$valorIsDemo = false;
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
      <form action="<?= htmlspecialchars($valorFormAction, ENT_QUOTES) ?>" method="post" id="valor-checkout-form">
        <input type="hidden" name="orderId" value="<?= htmlspecialchars($id, ENT_QUOTES) ?>" />
        <input type="hidden" name="amount" value="<?= htmlspecialchars($amount, ENT_QUOTES) ?>" />
        <div id="valor-fields"></div>
      </form>
    </section>

  </main>

  <?php include('layout/footer.php'); ?>
  <script src="https://js.valorpaytech.com/V2/js/Passage.min.js"></script>
  <script>
    const tokenEndpoint = 'valor-client-token.php';

    fetch(tokenEndpoint, { credentials: 'same-origin' })
      .then((res) => {
        return res.json().then((data) => {
          if (!res.ok) {
            const msg = data && data.message ? data.message : 'Unable to get client token';
            throw new Error(msg + ' (HTTP ' + res.status + ')');
          }
          return data;
        });
      })
      .then((data) => {
        if (!data || !data.clientToken) {
          throw new Error('No clientToken returned');
        }

        new PassageJS({
          clientToken: data.clientToken,
          epi: data.epi || '',
          formAction: '<?= htmlspecialchars($valorFormAction, ENT_QUOTES) ?>',
          isDemo: <?= $valorIsDemo ? 'true' : 'false' ?>,
          variant: 'lightbox',
          submitText: 'Pay Now',
          customData: {
            order_id: '<?= htmlspecialchars($id, ENT_QUOTES) ?>'
          },
          onSuccess: (result) => {
            console.log('Payment successful:', result);
            window.location.href = '/success';
          },
          onError: (error) => {
            console.error('Payment failed:', error);
            alert('Payment failed. Please try again.');
          }
        });
      })
      .catch((err) => {
        console.error('Failed to initialize payment:', err);
        alert('Payment initialization failed: ' + err.message);
      });
  </script>

</body>

</html>
