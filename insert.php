<?php
session_start();
include_once("conexao.php");
mysqli_set_charset($conexao, 'utf8');

// Verifica se o usuário está logado
if (!isset($_SESSION['nome_usuario'])) {
    header('Location: login.html');
    exit();
}

$nome_usuario = $_SESSION['nome_usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Se for uma requisição POST, insere a nova sinalização no banco

    // Pegando dados do formulário de sinalização
    $endereco = $_POST['endereco'];
    $grau = $_POST['grau'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $comentario = $_POST['comentario'];
    $data_hora = date("Y-m-d H:i:s");

    $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : null;
    $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : null;

    if (!$latitude || !$longitude) {
        die("Erro: Latitude ou longitude não foram fornecidas.");
    }

    // Inserindo a sinalização no banco de dados
    $sql_sinalizacao = "INSERT INTO tb_sinalizacao (nome, ponto_referencia, grau_alagamento, data_hora, ativo, latitude, longitude) VALUES (?, ?, ?, ?, 'SIM', ?, ?)";
    $stmt_sinalizacao = $conexao->prepare($sql_sinalizacao);

    if (!$stmt_sinalizacao) {
        die("Erro na preparação da consulta: " . $conexao->error);
    }

    $stmt_sinalizacao->bind_param("ssssdd", $nome_usuario, $endereco, $grau, $data_hora, $latitude, $longitude);

    if ($stmt_sinalizacao->execute()) {
        // Recupera o ID da sinalização inserida
        $id_sinalizacao = $stmt_sinalizacao->insert_id;
        header('location: mapa.html');

        // Se houver um comentário, insira na tabela de comentários
        if (!empty($comentario)) {
            $sql_comentario = "INSERT INTO tb_comentarios (nome_usuario, comentario, ponto_referencia, grau_alagamento, data_hora, id_sinalizacao) 
                               VALUES (?, ?, ?, ?, ?, ?)";
            $stmt_comentario = $conexao->prepare($sql_comentario);

            if (!$stmt_comentario) {
                die("Erro na preparação da consulta de comentário: " . $conexao->error);
            }

            $stmt_comentario->bind_param("sssssi", $nome_usuario, $comentario, $endereco, $grau, $data_hora, $id_sinalizacao);

            if ($stmt_comentario->execute()) {
                echo "Comentário enviado com sucesso!";
            } else {
                echo "Erro ao enviar comentário: " . $stmt_comentario->error;
            }
        }
    } else {
        echo "Erro ao enviar sinalização: " . $stmt_sinalizacao->error;
    }

    $stmt_sinalizacao->close();
}

// Se for uma requisição GET, retorna as sinalizações ativas
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-type: application/json');

    $busca_mapa = "SELECT * FROM tb_sinalizacao WHERE ativo = 'SIM'";
    $res_consulta = mysqli_query($conexao, $busca_mapa);
    $data = array();

    while ($row = mysqli_fetch_assoc($res_consulta)) {
        $data[] = $row;
    }

    echo json_encode($data, JSON_PRETTY_PRINT);
}

$conexao->close();
