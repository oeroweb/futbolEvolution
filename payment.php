<?php include('layout/header.php'); ?>

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
      <form action="https://path-to-your-api-call" method="post" id="valor-checkout-form">
        <input type="hidden" name="orderId" value="1" />
        <div id="valor-fields"></div>
      </form>
    </section>

  </main>

  <?php include('layout/footer.php'); ?>
  <script src="https://js.valorpaytech.com/V1/js/Passage.min.js" data-name="valor_passage" data-clientToken="4IwK1%Ka8dmqKkSA2%AI33yKV91RyY$@" data-epi="2501407042"></script>
  <script>
    document.addEventListener("passageHiddenFormAdded", function(event) {

      const form = event.detail.form;

      form.addEventListener("submit", function(event) {

        event.preventDefault();

      });

    });
  </script>

</body>

</html>