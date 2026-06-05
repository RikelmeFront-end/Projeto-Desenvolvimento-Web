<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BuyNow</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>

  <?php
  $basePath = '';
  $paginaAtiva = 'home';
  include __DIR__ . '/includes/navbar.php';
  ?>

  <main>
    <section class="hero">
      <div class="container">
        <div class="texto-esquerda">
          <h1>Tecnologia que simplifica sua vida.</h1>
          <p>
            Os melhores componentes para seu PC com performance extrema, design moderno e tecnologia de última geração.
          </p>
          <a href="./pages/produtos.php" class="btn-hero">Explorar Produtos</a>
        </div>

        <div class="imagem-direita">
          <img src="./images/imgrenderizada.png" alt="produto">
        </div>
      </div>
    </section>

    <section class="produtos">
      <div class="container">
        <h2 class="titulo-ofertas">Ofertas da Semana</h2>

        <div class="ofertas-semana">
          <div class="ofertas-semana">
          <div class="card-oferta">
            <span class="badge">-20%</span>
            <img src="./images/produtosOfertas/headset-gamer-hyperx-cloud-stinger-2-drivers-50mm-preto-519t1aa_1689972862_gg.png" alt="Headset Gamer HyperX Cloud">
            <h3>Headset Gamer HyperX Cloud</h3>
            <div class="rating">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star-half"></i>
            </div>
            <p class="preco">R$ 169,90</p>
            <button class="add-cart">Adicionar ao Carrinho</button>
          </div>

          <div class="card-oferta">
            <span class="badge">-15%</span>
            <img src="./images/produtosOfertas/placa de video.png" alt="Placa de Vídeo RTX 2060">
            <h3>Placa de Vídeo PCyes NVIDIA RTX 2060</h3>
            <div class="rating">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <p class="preco">R$ 1.499,99</p>
            <button class="add-cart">Adicionar ao Carrinho</button>
          </div>

          <div class="card-oferta">
            <span class="badge">-10%</span>
            <img src="./images/produtosOfertas/processador-amd-ryzen-7-7800x3d-5-0ghz-max-turbo-cache-104mb-am5-8-nucleos-video-integrado-100-100000910wof_1680784502_gg.png" alt="Processador AMD Ryzen 7 7800X3D">
            <h3>Processador AMD Ryzen 7 7800X3D</h3>
            <div class="rating">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star-half"></i>
            </div>
            <p class="preco">R$ 2.299,99</p>
            <button class="add-cart">Adicionar ao Carrinho</button>
          </div>
        </div>
        </div>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/includes/footer.php'; ?>

  <script src="./assets/js/script.js"></script>
</body>
</html>