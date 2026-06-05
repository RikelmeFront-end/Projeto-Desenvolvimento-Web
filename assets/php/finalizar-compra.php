<?php
session_start();

if (!isset($_SESSION['usuario_nome'])) {
    header("Location: ../../pages/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../pages/checkout.php");
    exit;
}

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$telefone = trim($_POST['telefone'] ?? '');
$cep = trim($_POST['cep'] ?? '');
$endereco = trim($_POST['endereco'] ?? '');
$numero = trim($_POST['numero'] ?? '');
$complemento = trim($_POST['complemento'] ?? '');
$cidade = trim($_POST['cidade'] ?? '');
$estado = trim($_POST['estado'] ?? '');
$total = trim($_POST['total'] ?? '');
$itensJson = $_POST['itens'] ?? '[]';
$itens = json_decode($itensJson, true);

if (
    $nome === '' || $email === '' || $telefone === '' || $cep === '' ||
    $endereco === '' || $numero === '' || $cidade === '' || $estado === '' ||
    !is_array($itens) || count($itens) === 0
) {
    header("Location: ../../pages/checkout.php?erro=1");
    exit;
}

$enderecoCompleto = $endereco . ', ' . $numero;
if ($complemento !== '') {
    $enderecoCompleto .= ' — ' . $complemento;
}
$enderecoCompleto .= ' — ' . $cidade . '/' . strtoupper($estado) . ' — CEP ' . $cep;

$_SESSION['ultimo_pedido'] = [
    'numero' => date('Ymd') . rand(1000, 9999),
    'nome' => $nome,
    'email' => $email,
    'telefone' => $telefone,
    'endereco' => $enderecoCompleto,
    'total' => $total !== '' ? $total : 'R$ 0,00',
    'itens' => $itens
];

header("Location: ../../pages/pedido-concluido.php");
exit;
