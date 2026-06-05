<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contato — BuyNow</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

  <?php
  $basePath = '../';
  $paginaAtiva = 'contato';
  include __DIR__ . '/../includes/navbar.php';
  ?>

  <main class="pagina-interna">
    <section class="conteudo-pagina">
      <div class="container contact-layout">
        <div>
          <h1>Contato</h1>
          <p class="texto-contato">
            Tem dúvida sobre algum produto ou quer saber se tem estoque? Manda mensagem
            pelo formulário ou chama no WhatsApp.
          </p>

          <ul class="contact-list">
            <li>
              <strong>E-mail</strong>
              <span>contato@buynow.com.br</span>
            </li>
            <li>
              <strong>WhatsApp</strong>
              <span>(21) 97476-4633</span>
            </li>
            <li>
              <strong>Horário</strong>
              <span>Segunda a sexta, das 9h às 18h</span>
            </li>
          </ul>

          <a href="https://wa.me/5521974764633?text=Oi,%20vim%20pelo%20site%20BuyNow" class="btn-whatsapp" target="_blank" rel="noopener noreferrer">
            <i class="fa-brands fa-whatsapp"></i> Chamar no WhatsApp
          </a>
        </div>

        <form class="contact-form" id="form-contato" novalidate>
          <h2>Mandar mensagem</h2>

          <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Seu nome" required>
            <span class="form-error" data-error="nome"></span>
          </div>

          <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" placeholder="seu@email.com" required>
            <span class="form-error" data-error="email"></span>
          </div>

          <div class="form-group">
            <label for="mensagem">Mensagem</label>
            <textarea id="mensagem" name="mensagem" rows="5" placeholder="Escreve aqui..." required></textarea>
            <span class="form-error" data-error="mensagem"></span>
          </div>

          <button type="submit" class="btn-primary">Enviar</button>
          <p class="form-success" id="form-success" hidden>Recebemos sua mensagem. Obrigado!</p>
        </form>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/../includes/footer.php'; ?>

  <script src="../assets/js/script.js"></script>
</body>
</html>
