<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../pages/cadastro.html");
    exit;
}

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

if ($nome === '' || $email === '' || $senha === '') {
    echo "Preencha todos os campos!";
    exit;
}

$sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

if ($conn->query($sql)) {
    header("Location: ../../pages/login.php");
    exit;
}

echo "Erro: " . $conn->error;
