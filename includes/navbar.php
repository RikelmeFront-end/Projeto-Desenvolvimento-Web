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
        <span class="nome-user">👋 <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></span>
        <a href="<?php echo $basePath; ?>logout.php" class="btn-entrar">Sair</a>
      <?php else: ?>
        <a href="<?php echo $basePath; ?>pages/cadastro.html" class="btn-criar">Criar conta</a>
        <a href="<?php echo $basePath; ?>pages/login.html" class="btn-entrar">Entrar</a>
      <?php endif; ?>

      <i class="fa-solid fa-bars menu-toggle" id="botao-menu"></i>
    </div>
  </nav>
</header>
