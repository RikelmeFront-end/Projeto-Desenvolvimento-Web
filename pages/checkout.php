<?php
session_start();

if (!isset($_SESSION['usuario_nome'])) {
    header("Location: login.php");
    exit;
}

$nomeUsuario = $_SESSION['usuario_nome'];
$emailUsuario = $_SESSION['usuario_email'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finalizar compra — BuyNow</title>
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
      <div class="container checkout-layout">
        <div class="checkout-resumo">
          <h1>Finalizar compra</h1>
          <p class="checkout-texto">Confira seus itens antes de preencher os dados de entrega.</p>

          <div class="checkout-itens" id="checkout-itens"></div>

          <div class="checkout-total-box">
            <span>Total do pedido</span>
            <strong id="checkout-total">R$ 0,00</strong>
          </div>

          <a href="produtos.php" class="checkout-voltar">← Continuar comprando</a>
        </div>

        <form class="checkout-form auth-form" id="form-checkout" action="../assets/php/finalizar-compra.php" method="POST" novalidate>
          <h2>Dados para entrega</h2>

          <?php if (isset($_GET['erro']) && $_GET['erro'] === '1'): ?>
            <div class="auth-erro">Preencha todos os campos obrigatórios.</div>
          <?php endif; ?>

          <input type="hidden" name="itens" id="checkout-itens-json">
          <input type="hidden" name="total" id="checkout-total-input">

          <div class="form-group">
            <label for="checkout-nome">Nome completo</label>
            <input type="text" id="checkout-nome" name="nome" value="<?php echo htmlspecialchars($nomeUsuario); ?>" placeholder="Seu nome completo" required>
            <span class="form-error" data-error="nome"></span>
          </div>

          <div class="form-group">
            <label for="checkout-email">E-mail</label>
            <input type="email" id="checkout-email" name="email" value="<?php echo htmlspecialchars($emailUsuario); ?>" placeholder="seu@email.com" required>
            <span class="form-error" data-error="email"></span>
          </div>

          <div class="form-group">
            <label for="checkout-telefone">Telefone</label>
            <input type="tel" id="checkout-telefone" name="telefone" placeholder="(21) 99999-9999" required>
            <span class="form-error" data-error="telefone"></span>
          </div>

          <div class="form-group">
            <label for="checkout-cep">CEP</label>
            <input type="text" id="checkout-cep" name="cep" placeholder="00000-000" required>
            <span class="form-error" data-error="cep"></span>
          </div>

          <div class="form-group">
            <label for="checkout-endereco">Endereço</label>
            <input type="text" id="checkout-endereco" name="endereco" placeholder="Rua, avenida..." required>
            <span class="form-error" data-error="endereco"></span>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="checkout-numero">Número</label>
              <input type="text" id="checkout-numero" name="numero" placeholder="123" required>
              <span class="form-error" data-error="numero"></span>
            </div>

            <div class="form-group">
              <label for="checkout-complemento">Complemento</label>
              <input type="text" id="checkout-complemento" name="complemento" placeholder="Apto, bloco...">
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="checkout-cidade">Cidade</label>
              <input type="text" id="checkout-cidade" name="cidade" placeholder="Sua cidade" required>
              <span class="form-error" data-error="cidade"></span>
            </div>

            <div class="form-group">
              <label for="checkout-estado">Estado</label>
              <input type="text" id="checkout-estado" name="estado" placeholder="RJ" maxlength="2" required>
              <span class="form-error" data-error="estado"></span>
            </div>
          </div>

          <button type="submit" class="btn-primary btn-full">Confirmar pedido</button>
        </form>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/../includes/footer.php'; ?>

  <script src="../assets/js/script.js"></script>
</body>
</html>
