<?php
$nome = $_POST['nome'];
$email = $_POST['email'];
$data = $_POST['data']; 
$senha = $_POST['senha'];

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

include 'conexao.php';

$insert = "INSERT INTO tb_user (id_user, nm_user, email, senha, dt_nascimento) VALUES (NULL, ?, ?, ?, ?)";
$stmt = $conexao->prepare($insert);

if (!$stmt) {
    die("Erro na preparação do SQL: " . $conexao->error);
}

$stmt->bind_param('ssss', $nome, $email, $senha_hash, $data);

if ($stmt->execute()) {
    header('Location: login.html');
    exit();
} else {
    echo "<script>alert('Erro ao cadastrar usuário: {$stmt->error}'); history.back();</script>";
}

$stmt->close();
$conexao->close();
?>