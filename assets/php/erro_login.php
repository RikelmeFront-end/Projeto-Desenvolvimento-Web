<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Erro — Login</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .erro-container {
      background: white;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      text-align: center;
      max-width: 400px;
    }

    .erro-icon { font-size: 60px; margin-bottom: 20px; }

    h1 { color: #e74c3c; margin-bottom: 15px; font-size: 24px; }

    p { color: #666; margin-bottom: 25px; font-size: 16px; }

    .btn-voltar {
      display: inline-block;
      padding: 12px 30px;
      background: #667eea;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-weight: bold;
      transition: background 0.3s;
    }

    .btn-voltar:hover { background: #5568d3; }
  </style>
</head>
<body>
  <div class="erro-container">
    <div class="erro-icon">❌</div>
    <h1>Login incorreto</h1>
    <p>O e-mail ou a senha está errado. Tente novamente.</p>
    <a href="../../pages/login.php" class="btn-voltar">Voltar ao login</a>
  </div>
</body>
</html>
