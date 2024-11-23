<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

// Conexão com o banco de dados
include 'conexao.php';

$userId = $_SESSION['user_id'];
$foto_perfil = $_POST['foto_perfil'];

// Atualiza a foto de perfil do usuário no banco de dados
$sql = "UPDATE tb_user SET foto_perfil = ? WHERE id_user = ?";
$stmt = $conexao->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar a consulta: " . $conexao->error);
}

$stmt->bind_param('si', $foto_perfil, $userId);

if ($stmt->execute()) {
    header('Location: user.php'); // Redireciona para a página do usuário
} else {
    echo "<script>alert('Erro ao atualizar foto de perfil'); history.back();</script>";
}



$stmt->close();
$conexao->close();
?>
