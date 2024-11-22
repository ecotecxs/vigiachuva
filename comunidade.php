<?php
session_start();
include_once("conexao.php");

$query = "SELECT nome_usuario, comentario, ponto_referencia, grau_alagamento, data_hora FROM tb_comentarios ORDER BY data_hora DESC";
$result = $conexao->query($query);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidade de Comentários</title>
    <link rel="stylesheet" href="comunidade.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ponnala&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
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

    <h1 id="titulo">Comentários</h1>
    <div class="comentarios">
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<div class='comentario'>";
            echo "<p> " . htmlspecialchars($row['nome_usuario']) . "</p>";
            echo "<p> " . htmlspecialchars($row['data_hora']) . "</p>";
        ?>
    </div>
    <div id="caixa">

        <?php
            echo "<p> " . htmlspecialchars($row['ponto_referencia']) . "</p>";
        ?>
       
            <?php
             echo "<p> " . htmlspecialchars($row['grau_alagamento']) . "</p>";
            ?>
        
        </div>
        <div id="comentario">
    <?php
            
            echo "<p> " . htmlspecialchars($row['comentario']) . "</p>";
    ?>
    <div id="espaço" >
        <?php
        echo "</div><hr>";
        }
        ?>
    </div>
</div>
        
    
    
    <nav class="menu-inferior">
        <a href="user.php"><img src="img/do-utilizador.png" alt="Ícone 1"></a>
        <a href="galeria.html"><img src="img/galeria.png" alt="Ícone 2"></a>
        <a href="mapa.html"><img src="img/localizacao.png" alt="Ícone 3"></a>
        <a href="comunidade.php"><img src="img/conversacao.png" alt="Ícone 4"></a>
    </nav>
</body>

</html>