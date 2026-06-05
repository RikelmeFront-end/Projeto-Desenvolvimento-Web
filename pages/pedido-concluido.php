<?php
session_start();

if (!isset($_SESSION['usuario_nome'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['ultimo_pedido'])) {
    header("Location: produtos.php");
    exit;
}

$pedido = $_SESSION['ultimo_pedido'];
unset($_SESSION['ultimo_pedido']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pedido confirmado — BuyNow</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

  <?php
  $basePath = '../';
  $paginaAtiva = '';
  include __DIR__ . '/../includes/navbar.php';
  ?>

  <main class="pagina-interna">
    <section class="conteudo-pagina">
      <div class="container checkout-sucesso">
        <div class="checkout-sucesso-box">
          <div class="checkout-sucesso-icone">✓</div>
          <h1>Pedido confirmado!</h1>
          <p>Obrigado, <?php echo htmlspecialchars($pedido['nome']); ?>. Recebemos seu pedido e em breve entraremos em contato.</p>

          <div class="checkout-sucesso-detalhes">
            <p><strong>Número do pedido:</strong> #<?php echo htmlspecialchars($pedido['numero']); ?></p>
            <p><strong>Total:</strong> <?php echo htmlspecialchars($pedido['total']); ?></p>
            <p><strong>Entrega em:</strong> <?php echo htmlspecialchars($pedido['endereco']); ?></p>
          </div>

          <a href="produtos.php" class="btn-primary">Voltar aos produtos</a>
        </div>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/../includes/footer.php'; ?>

  <script>
    sessionStorage.removeItem("buynow-carrinho-itens");
  </script>
  <script src="../assets/js/script.js"></script>
</body>
</html>
