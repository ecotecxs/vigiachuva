<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

$userId = $_SESSION['user_id']; // Recupera o ID do usuário logado

// Conexão com o banco de dados
include 'conexao.php';

// Consulta para obter os dados do usuário
$sql = "SELECT nm_user, foto_perfil FROM tb_user WHERE id_user = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$stmt->bind_result($nm_user, $foto_perfil);
$stmt->fetch();
$stmt->close();

// Define uma imagem padrão caso o usuário não tenha escolhido uma foto
if (!$foto_perfil) {
    $foto_perfil = 'img/perfil-de-usuario.png'; // Caminho da imagem padrão
}

// Consulta para obter os pontos do usuário na tabela tb_pontos
$sql_pontos = "SELECT pontos FROM tb_pontos WHERE nome_usuario = ?";
$stmt_pontos = $conexao->prepare($sql_pontos);
$stmt_pontos->bind_param('s', $nm_user);
$stmt_pontos->execute();
$stmt_pontos->bind_result($pontos);
$stmt_pontos->fetch();
$stmt_pontos->close();

// Consulta para contar os comentários do usuário
$sql_comentarios = "SELECT COUNT(*) FROM tb_comentarios WHERE nome_usuario = ?";
$stmt_comentarios = $conexao->prepare($sql_comentarios);
$stmt_comentarios->bind_param('s', $nm_user);
$stmt_comentarios->execute();
$stmt_comentarios->bind_result($qt_comentarios);
$stmt_comentarios->fetch();
$stmt_comentarios->close();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user.css">
    <title>User</title>
    <style>
        /* CSS para centralizar a foto de perfil */
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 50vh;
            text-align: center;
        }

        .icone img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
        }
        .stats {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="nav-left">
                <a href="home.html"><img src="img/logo.png" alt="logo"></a>
                <h1>Vigia Chuva</h1>
            </div>
            <div class="nav-right">
                <a href="notificacao.html"><img src="img/packard-bell.png" alt="Ícone 1"></a>
                <div class="dropdown">
                    <h1 class="texto-nav"><img src="img/tres-pontos.png" alt="menu"></h1>
                    <ul class="dropdown-content">
                        <li><a href="conta.php">Conta</a></li>
                        <li><a href="logout.php">Sair</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="icone">
            <img src="<?php echo htmlspecialchars($foto_perfil); ?>" alt="Foto de Perfil">
        </div>
        <div class="borda">
            <span><?php echo htmlspecialchars($nm_user); ?></span>
        </div>
        <div class="stats">
            <div class="pontos">
                <h3>Pontos</h3>
                <span><?php echo htmlspecialchars($pontos ? $pontos : '0'); ?></span>
            </div>
            <div class="coments">
                <h3>Comentários</h3>
                <span><?php echo htmlspecialchars($qt_comentarios); ?></span>
            </div>
        </div>
    </div>

    <nav class="menu-inferior">
        <a href="user.php"><img src="img/do-utilizador.png" alt="Ícone 1"></a>
        <a href="galeria.php"><img src="img/galeria.png" alt="Ícone 2"></a>
        <a href="mapa.html"><img src="img/localizacao.png" alt="Ícone 3"></a>
        <a href="comunidade.php"><img src="img/conversacao.png" alt="Ícone 4"></a>
    </nav>
</body>
</html>
