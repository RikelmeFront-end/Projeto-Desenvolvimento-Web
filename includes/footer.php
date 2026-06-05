<?php
if (!isset($basePath)) {
  $basePath = '';
}
?>
<footer class="footer">
  <div class="footer-container">
    <div class="footer-section">
      <h3>Sobre Nós</h3>
      <p>
        A BuyNow é uma loja online de peças de informática. A ideia surgiu porque montar PC
        costuma ser caro e confuso — a gente tenta deixar isso mais simples, reunindo headset,
        placa de vídeo, processador e outros itens num lugar só.
      </p>
    </div>

    <div class="footer-section">
      <h3>Links Rápidos</h3>
      <ul>
        <li><a href="<?php echo $basePath; ?>index.php">Home</a></li>
        <li><a href="<?php echo $basePath; ?>pages/sobre.php">Sobre</a></li>
        <li><a href="<?php echo $basePath; ?>pages/produtos.php">Produtos</a></li>
        <li><a href="<?php echo $basePath; ?>pages/contato.php">Contato</a></li>
      </ul>
    </div>
  </div>

  <div class="footer-bottom">
    <p>© 2026 BuyNow. Todos os direitos reservados.</p>
  </div>
</footer>
