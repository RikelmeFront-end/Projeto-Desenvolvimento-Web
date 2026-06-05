<?php
session_start();
include "./conexao.php";

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$sql = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    $_SESSION['usuario_nome'] = $user['nome'];
    $_SESSION['usuario_email'] = $user['email'];

    header("Location: ../../index.php");
    exit;
}
header("Location: ../../pages/login.php?erro=1");
exit;
