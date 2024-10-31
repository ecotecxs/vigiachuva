<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user.css">
    <title>User</title>
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

<?php 
session_start();  // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    // Redireciona para a página de login se o usuário não estiver logado
    header('Location: login.html');
    exit;
}

// Conexão com o banco de dados
include 'conexao.php';

// Recupera o ID do usuário da sessão
$userId = $_SESSION['user_id'];

// Consulta para obter os dados do usuário logado
$sql = "SELECT nm_user FROM tb_user WHERE id_user = ?";
$stmt = $conexao->prepare($sql);

if ($stmt === false) {
    die("Erro ao preparar a consulta: " . $conexao->error);
}

$stmt->bind_param('i', $userId);
$stmt->execute();
$stmt->bind_result($nm_user);
$stmt->fetch();
$stmt->close();
$conexao->close();
?>

    <div class="container">
        <div class="icone">
            <img src="img/perfil-de-usuario.png" alt="icone">
        </div>
        <div class="borda">
                    <span><?php echo htmlspecialchars($nm_user); ?></span>
                </div>
        <div class="stats">
            <div class="pontos">
                <h3>Pontos</h3>
            </div>
            <div class="coments">
                <h3>Comentários</h3>
            </div>
        </div>
    </div>

    <nav class="menu-inferior">
        <a href="user.php"> <img src="img/do-utilizador.png" alt="Ícone 1"></a>
        <a href="galeria.html"><img src="img/galeria.png" alt="Ícone 2"></a>
        <a href="mapakley.php"> <img src="img/localizacao.png" alt="Ícone 3"></a>
        <a href="comentario.html"> <img src="img/conversacao.png" alt="Ícone 4"></a>
      </nav>
</body>
</html>
