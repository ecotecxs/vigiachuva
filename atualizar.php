<?php
// Conexão com o banco de dados
include 'conexao.php';

// Verificar conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Atualizar o nome de usuário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newUsername = $_POST['username'];
    $userId = $_POST['user_id'];

    $sql = "UPDATE tb_user SET nm_user = ? WHERE id_user = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('si', $newUsername, $userId);
    
    if ($stmt->execute()) {
        echo "Nome de usuário atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o nome de usuário.";
    }

    $stmt->close();
}

$conexao->close();
?>
