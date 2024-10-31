<?php

$nome = $_POST['nome'];
$email = $_POST['email'];
$data = $_POST['data'];
$senha = $_POST['senha'];

$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

include 'conexao.php';

$insert = "INSERT INTO tb_user (id_user, nm_user, email, senha) VALUES (NULL, ?, ?, ?)";

$stmt = $conexao->prepare($insert);
$stmt->bind_param('sss', $nome, $email, $senha_hash,);

if ($stmt->execute()) {
    header('location: login.html');
} else {
    echo "<script>alert('Erro ao cadastrar usuário'); history.back();</script>";
}

$stmt->close();
$conexao->close();

?>