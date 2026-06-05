<?php
include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($nome == '' || $email == '' || $senha == '') {
        echo "Preencha todos os campos!";
        exit;
    }

    $sql = "INSERT INTO usuarios (nome, email, senha)
            VALUES ('$nome', '$email', '$senha')";

    if ($conn->query($sql)) {
        header("Location: ../../pages/login.html");
        exit;
    } else {
        echo "Erro: " . $conn->error;
    }

} else {
    header("Location: ../../pages/cadastro.html");
    exit;
}
?>
