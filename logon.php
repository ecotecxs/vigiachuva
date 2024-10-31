<?php
session_start();  // Inicia a sessão
$_SESSION['user_id'] = $usuario->id; // ID do usuário
$_SESSION['user_name'] = $usuario->nome; // Nome do usuário

$nome = $_POST['nome'];
$senha = $_POST['senha'];

include 'conexao.php';

$select = "SELECT * FROM tb_user WHERE nm_user = ?";
$stmt = $conexao->prepare($select);
$stmt->bind_param('s', $nome);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user && password_verify($senha, $user['senha'])) {
    // Se as credenciais estiverem corretas, salvar o ID do usuário na sessão
    $_SESSION['user_id'] = $user['id_user'];  // Salva o ID do usuário logado na sessão
    $_SESSION['nome_usuario'] = $user['nm_user'];
    header('location: home.html');
} else {
    echo "<script>alert('Usuário ou Senha incorretos'); history.back();</script>";
}
?>
