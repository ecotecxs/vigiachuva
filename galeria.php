<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.html');
    exit;
}

$userId = $_SESSION['user_id'];

// Array com os caminhos das imagens disponíveis no servidor
$imagens = [
    'img/cachorro.png',
    'img/guaxinim.png',
    'img/moldura-prata.png',
    'img/coala.png',
    'img/moldura.png',
    'img/pascoa.png'
];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="galeria.css">
    <title>Galeria</title>
</head>
<body>
<nav class="navbar">
        <div class="nav-left">
            <a href="home.html"><img src="img/logo.png" alt="logo"></a>
            <h1>Vigia Chuva</h1>
        </div>

        <div class="nav-right">
            <a href="notificacao.html"><img src="img/packard-bell.png" alt="Ícone 1"></a>
           
        </div>
    </nav>

    <h1>GALERIA</h1>
    <div class="galeria">
        <?php foreach ($imagens as $imagem): ?>
            <div class="galeria-item">
                <img src="<?php echo $imagem; ?>" alt="Imagem">
                <!-- Formulário para selecionar a imagem como foto de perfil -->
                <form method="POST" action="atualizar_foto.php">
                    <input type="hidden" name="foto_perfil" value="<?php echo $imagem; ?>">
                    <button type="submit">Selecionar</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <nav class="menu-inferior">
        <a href="user.php"> <img src="img/do-utilizador.png" alt="Ícone 1"></a>
        <a href="galeria.php"><img src="img/galeria.png" alt="Ícone 2"></a>
        <a href="mapa.html"> <img src="img/localizacao.png" alt="Ícone 3"></a>
        <a href="comunidade.php"> <img src="img/conversacao.png" alt="Ícone 4"></a>
      </nav>
</body>
</html>
