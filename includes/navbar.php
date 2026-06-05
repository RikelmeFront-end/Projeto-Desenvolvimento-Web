<?php
if (!isset($basePath)) {
  $basePath = '';
}
if (!isset($paginaAtiva)) {
  $paginaAtiva = '';
}
?>
<header>
  <nav class="navbar">
    <a href="<?php echo $basePath; ?>index.php" class="logo">
      <img src="<?php echo $basePath; ?>images/icons/icons8-mac-os-32.ico" alt="BuyNow">
      <span>BuyNow</span>
    </a>

    <ul class="menu" id="menu">
      <li><a href="<?php echo $basePath; ?>index.php" class="<?php echo $paginaAtiva === 'home' ? 'active' : ''; ?>">Home</a></li>
      <li><a href="<?php echo $basePath; ?>pages/produtos.php" class="<?php echo $paginaAtiva === 'produtos' ? 'active' : ''; ?>">Produtos</a></li>
      <li><a href="<?php echo $basePath; ?>pages/sobre.php" class="<?php echo $paginaAtiva === 'sobre' ? 'active' : ''; ?>">Sobre</a></li>
      <li><a href="<?php echo $basePath; ?>pages/contato.php" class="<?php echo $paginaAtiva === 'contato' ? 'active' : ''; ?>">Contato</a></li>
    </ul>

    <div class="nav-right">
      <?php if (isset($_SESSION['usuario_nome'])): ?>
        <input type="hidden" id="usuario-logado" value="1">
        <div class="nav-logado">
          <span class="nome-user"><?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></span>
          <button type="button" class="cart-btn" id="btn-carrinho" aria-label="Abrir carrinho">
            <svg class="cart-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="M6 6h15l-1.5 9H8L6 6z"/>
              <path d="M6 6L5 3H2"/>
              <circle cx="9.5" cy="19.5" r="1"/>
              <circle cx="17.5" cy="19.5" r="1"/>
            </svg>
            <span class="cart-badge" id="contador-carrinho">0</span>
          </button>
          <a href="<?php echo $basePath; ?>logout.php" class="btn-entrar">Sair</a>
        </div>
      <?php else: ?>
        <a href="<?php echo $basePath; ?>pages/cadastro.html" class="btn-criar">Criar conta</a>
        <a href="<?php echo $basePath; ?>pages/login.php" class="btn-entrar">Entrar</a>
      <?php endif; ?>

      <i class="fa-solid fa-bars menu-toggle" id="botao-menu"></i>
    </div>
  </nav>
</header>
