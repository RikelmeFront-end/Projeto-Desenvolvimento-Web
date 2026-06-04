<?php
session_start();

// apaga todas as sessões
session_unset();
session_destroy();

// volta pra home
header("Location: ./index.php");
exit;
?>