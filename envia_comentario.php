<?php
session_start();

include_once("conexao.php");

if (!isset($_SESSION['nome_usuario'])) {
    header('Location: login.html');
    exit();
}

$nome_usuario = $_SESSION['nome_usuario'];
$comentario = $_POST['comentario'];
$endereco = $_POST['endereco'];
$grau = $_POST['grau'];
$data_hora = date("Y-m-d H:i:s");

// Se o comentário estiver vazio, não armazene
if (!empty($comentario)) {
    $sql = "INSERT INTO tb_comentarios (nome_usuario, comentario, ponto_referencia, grau_alagamento, data_hora)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssss", $nome_usuario, $comentario, $endereco, $grau, $data_hora);

    if ($stmt->execute()) {
        echo "Comentário enviado com sucesso!";
    } else {
        echo "Erro ao enviar comentário.";
    }

    $stmt->close();
}
$conexao->close();
?>   