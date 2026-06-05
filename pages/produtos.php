<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produtos — BuyNow</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

  <?php
  $basePath = '../';
  $paginaAtiva = 'produtos';
  include __DIR__ . '/../includes/navbar.php';
  ?>

  <main>
    <section class="produtos produtos-pagina">
      <div class="container">
        <h1 class="titulo-ofertas">Produtos</h1>

        <div class="busca-produtos">
          <label for="pesquisa-produtos">Buscar por nome</label>
          <input type="text" id="pesquisa-produtos" placeholder="Ex: headset, placa de vídeo, ryzen...">
        </div>

        <div class="grid-produtos" id="grid-produtos">

          <article class="produto-item">
            <span class="badge">-20%</span>
            <img src="../images/produtosOfertas/headset-gamer-hyperx-cloud-stinger-2-drivers-50mm-preto-519t1aa_1689972862_gg.png" alt="Headset Gamer HyperX Cloud">
            <h3>Headset Gamer HyperX Cloud Stinger 2</h3>
            <div class="rating">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star-half"></i>
            </div>
            <p class="preco">R$ 169,90</p>
            <button type="button" class="add-cart">Adicionar ao Carrinho</button>
          </article>

          <article class="produto-item">
            <span class="badge">-15%</span>
            <img src="../images/produtosOfertas/placa de video.png" alt="Placa de Vídeo RTX 2060">
            <h3>Placa de Vídeo PCyes NVIDIA RTX 2060</h3>
            <div class="rating">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </div>
            <p class="preco">R$ 1.499,99</p>
            <button type="button" class="add-cart">Adicionar ao Carrinho</button>
          </article>

          <article class="produto-item">
            <span class="badge">-10%</span>
            <img src="../images/produtosOfertas/processador-amd-ryzen-7-7800x3d-5-0ghz-max-turbo-cache-104mb-am5-8-nucleos-video-integrado-100-100000910wof_1680784502_gg.png" alt="Processador AMD Ryzen 7 7800X3D">
            <h3>Processador AMD Ryzen 7 7800X3D</h3>
            <div class="rating">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star-half"></i>
            </div>
            <p class="preco">R$ 2.299,99</p>
            <button type="button" class="add-cart">Adicionar ao Carrinho</button>
          </article>

          <article class="produto-item">
            <img src="../images/produtosOfertas/rx580.png" alt="Placa de Vídeo AMD RX 580">
            <h3>Placa de Vídeo Gigabyte AMD RX 580</h3>
            <div class="rating">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star-half"></i>
            </div>
            <p class="preco">R$ 800,00</p>
            <button type="button" class="add-cart">Adicionar ao Carrinho</button>
          </article>
          
          <article class="produto-item">
            <img src="../images/produtosOfertas/RX7600XT.png" alt="Placa de Vídeo AMD RX 7600 XT">
            <h3>Placa de Vídeo PCyes AMD RX 7600 XT</h3>
            <div class="rating">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star-half"></i>
            </div>
            <p class="preco">R$ 1.599,99</p>
            <button type="button" class="add-cart">Adicionar ao Carrinho</button>
          </article>
        </div>

        <p class="empty-state" id="empty-produtos" hidden>Nenhum produto com esse nome.</p>
      </div>
    </section>
  </main>

  <?php include __DIR__ . '/../includes/footer.php'; ?>

  <script src="../assets/js/script.js?v=2"></script>
</body>
</html>
