<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sobre — BuyNow</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

  <?php
  $basePath = '../';
  $paginaAtiva = 'sobre';
  include __DIR__ . '/../includes/navbar.php';
  ?>

  <main class="pagina-interna">
    <section class="conteudo-pagina">
      <div class="container">
        <h1>Sobre a BuyNow</h1>

        <p>
          A BuyNow é uma loja online de peças de informática. A ideia surgiu porque montar PC
          costuma ser caro e confuso — a gente tenta deixar isso mais simples, reunindo headset,
          placa de vídeo, processador e outros itens num lugar só.
        </p>

        <p>
          Trabalhamos com produtos que usamos ou que já testamos. Não prometemos mil coisas:
          o foco é vender hardware com preço justo e tirar dúvida quando o cliente precisa.
        </p>

        <h2>O que você encontra aqui</h2>
        <ul class="lista-sobre">
          <li>Headsets e periféricos</li>
          <li>Placas de vídeo</li>
          <li>Processadores AMD e Intel</li>
          <li>Ofertas da semana na página inicial</li>
        </ul>

        <p class="link-pagina">
          <a href="produtos.php">Ver todos os produtos</a>
        </p>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/../includes/footer.php'; ?>

  <script src="../assets/js/script.js?v=2"></script>
</body>
</html>
